<?
include_once ("functions.php");
include_once ("Storage_Interface.php");

class FileStorage implements Storage_Interface
{
	private $filename = "";
	private $file = null;
	private $rowCount = 0;
	private $nHeader = 36;
	private $nLength = 0;
	private $nRowCount = 0;
	
	// =================================================================
	
	public function create ($filename, $rowLen)
	{
		print (__METHOD__ . " ( " . $filename . ", ". $rowLen . " )" . "\r\n");

		if (strlen (trim ($filename)) == 0)
			throw (new Exception ("filename empty"));

		if ($rowLen == 0)
			throw (new Exception ("rowLen = 0"));
		
		$this->filename = $filename;
		$this->nLength = $rowLen +1;
		
		$bFile = file_exists ( $filename . ".data");
		$this->file = fopen ($filename . ".data", "c+"); 
		
		print ("EOF = " . (feof ($this->file) ? "True" : "False") . "\r\n");
		print_r (fstat ($this->file));
		print ("\r\n");
		
		$nFileLen = fstat ($this->file) ["size"];
		
		if ($nFileLen == 0)
			$this->writeHeader();
		
		$this->readHeader();
		
		print ("nRowCount = ". $this->nRowCount . "\r\n");
	}
	
	public function open ($filename)
	{
		print (__METHOD__ . " ( " . $filename . " )" . "\r\n");
		
		if (strlen (trim ($filename)) == 0)
			throw (new Exception ("filename empty"));

		$this->filename = $filename;

		$bFile = file_exists ( $filename . ".data");
		$this->file = fopen ($filename . ".data", "r+"); 
		
		print ("EOF = " . (feof ($this->file) ? "True" : "False") . "\r\n");
		print_r (fstat ($this->file));
		print ("\r\n");
		
		$nFileLen = fstat ($this->file) ["size"];
		
		if ($nFileLen == 0)
		// the file wasn't created properly, and should have at least the
		// header information
			return (null);
		
		$this->readHeader();
		
		print ("nRowCount = ". $this->nRowCount . "\r\n");
	}
	
	public function close ()
	{
		fclose ($this->file);
	}
	
	// =================================================================

	public function getRowCount ()
	{ return ($this->nRowCount); }
	
	// =============================

	private function readHeader ()
	{
		print (__METHOD__ . "\r\n");
		
		fseek ($this->file, 0);
		$nRowCount = fread ($this->file, 16);
		
		fseek ($this->file, 18);
		$nLength = fread ($this->file, 16);
		
		print ("nRowCount = " . $nRowCount . "\r\n");
		print ("nLength = " . $nLength . "\r\n");
		
		$this->nRowCount = $nRowCount;
		$this->nLength = $nLength;
	}

	private function writeHeader ()
	{
		print (__METHOD__ . "\r\n");
		
		$nRows = substr (zeros(16) . $this->nRowCount. "|\n", -18 , 18);
		$nLen = substr (zeros(16) . $this->nLength. "|\n", -18 , 18);
		$data = $nRows . $nLen;
		print ("data = " . $data . "\r\n");
		print ("data = " . strlen ($data) . "\r\n");
		
		fseek ($this->file, 0);
		$b = fwrite ($this->file, $data, 36);
		
		if ($b === false)
			print (ferror ($this->file) . "\r\n");
	}

	// =============================
	
	public function add ($byteString)
	{
		print (__METHOD__ . "\r\n");
		// trace ();
		
		$nID = $this->nRowCount;
		
		$nPos = $this->nRowCount++;
		$nPos *= $this->nLength;
		$nPos += $this->nHeader;
		
		flock ($this->file, LOCK_EX);
		$this->writeRow ($nPos, $byteString . "\n");
		$this->writeHeader ();
		flock ($this->file, LOCK_UN);
		
		return ($nID);
	}

	public function update ($thsObject)
	{
		print (__METHOD__ . "\r\n");
		
		$nPos = $nRow;
		$nPos *= $this->nLength;
		$nPos += $this->nHeader;

		flock ($this->file, LOCK_EX);
		$this->writeRow ($nPos, $byteString . "\n");
		flock ($this->file, LOCK_UN);
	}
	
	public function get ($nID)
	{
		print (__METHOD__ . " ( " . $nID . " )\r\n");
		
		if (($nID < 0) || ($nID > $this->nLength))
			throw (new exception ("nID = [ " . $nID . " ] out of range"));
			
		$nPos = $nID;
		$nPos *= $this->nLength;
		$nPos += $this->nHeader;
		
		flock ($this->file, LOCK_SH);
		$rtn = $this->readRow ($nPos);
		flock ($this->file, LOCK_UN);
		
		return ($rtn);
	}

	public function delete ($nID)
	{
	}

	public function find ($thsObject)
	{
	}

	// =============================
	
	private function readRow ($nPos)
	{
		print (__METHOD__ . "\r\n");
		
		fseek ($this->file, $nPos);

		if (ftell ($this->file) != $nPos)
			throw (new exception ("nPos not at (" . $nPos . ")"));
			
		return (fread ($this->file, $this->nLength));
	}

	private function writeRow ($nPos, $byteString)
	{
		print (__METHOD__ . "\r\n");
		// trace ();
		
		$nSize = strlen ($byteString);
		if ($nSize != $this->nLength)
			throw (new exception ("byteString size mismatch (" . $nSize . " != " . $this->nLength . ")"));
		
		fseek ($this->file, $nPos);

		$nFilePos = ftell ($this->file);
		if ($nFilePos != $nPos)
			throw (new exception ("File pos " . $nFilePos . " not at (" . $nPos . ")"));

		fwrite ($this->file, $byteString, $this->nLength);

		$nPos2 = $nPos + $this->nLength;
		$nFilePos = ftell ($this->file);
		if ($nFilePos  != $nPos2)
			throw (new exception ("File pos " . $nFilePos . " not at (" . $nPos2 . ")"));
	}
}

?>
