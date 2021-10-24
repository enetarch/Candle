<?
include_once ("functions.php");
include_once ("FieldTypes.php");
include_once ("Structure_Field.php");

class Structure 
{
	private $instances = [];

	// =============================================

	public function __construct ()
	{}

	public function __destruct ()
	{}

	// =============================================
	// Create an instance of the Class

	public function newField ($szName, $nType, $vValue, $nMaxSize)
	{   		
		// print (__Method__ . " ( " . $szName . ", " . $nType . ", " . $vValue . ", " . $nMaxSize. " )\r\n " );
		
		$instance = new Structure_Field ();

		$instance->init ($szName, $nType, $vValue, $nMaxSize);

		$this->instances [] = $instance;

		return ($instance);
	}

	// =============================================
	// Delete a Class from the container

	public function deleteField ($n) 
	{
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return false;

		if (($n < 1) || ($n > $nCount)) 
			return false;

		// ============================
		// Core Code

		unset ($this->instances [$n]);
		
		return true;
	}

	// =============================================
	// return a Class from the container

	public function getField ($n)
	{ 
		// print (__method__ . " ( " . $n . " ) \r\n");
		
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return false;

		if (($n < 0) || ($n > $nCount)) 
			return false;

		// ============================
		// Returns

		return ($this->instances [$n]);
	}

	public function setField ($n, $value)
	{ 
		// print (__method__ . " ( " . $n . ", " . $value . " ) \r\n");

		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return false;

		if (($n < 0) || ($n > $nCount)) 
			return false;

		// ============================
		// Returns

		$this->instances [$n]->setValue ($value);
	}

	// =============================================
	// return the count of all items in the Class container

	public function Count ()
	{ return count ($this->instances); }

	// =============================================
	// Find a field in the container by name

	public function getField2 ($szName) 
	{
		// ============================
		// Validations

		if (strlen ($szName) == 0) 
			return null;

		$nCount = count ($this->instances); 
		
		if ($nCount == 0) 
			return null;
		
		// No objError, just exit.  !hing to see here

		// ============================
		// Core Code
		
		$field = null;

		$t = 0;
		while (($t < $nCount) && ($field == null))
		{
			if ($this->instances [$t]->Name() == $szName) 
				$field = $this->instances [$t];	

			$t++;
		}

		return ($field);
	}

	public function setField2 ($szName, $szValue) 
	{
		// ============================
		// Validations

		if (strlen ($szName) == 0) 
			return null;

		$nCount = count ($this->instances); 
		
		if ($nCount == 0) 
			return null;
		
		// No objError, just exit.  !hing to see here

		// ============================
		// Core Code
		
		$field = null;

		$t = 0;
		while (($t < $nCount) && ($field == null))
		{
			if ($this->instances [$t]->Name() == $szName) 
				$field = $this->instances [$t];	

			$t++;
		}
		
		if ($field != null)
			$field->setValue ($szValue);
	}

	// =============================================

	public function getSize () 
	{
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return null;

		// ============================
		// Core Code
		
		$nSize = 0;

		for ($t=0; $t<$nCount; $t++)
			$nSize += $this->instances [$t]->Size();				

		return ($nSize);
	}

	// =============================================

	public function MaxSize ()
	{
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return null;

		// ============================
		// Core Code
		
		$nSize = 0;

		for ($t=0; $t<$nCount; $t++)
			$nSize += $this->instances [$t]->MaxSize();				

		return ($nSize);
	}

	// =============================================

	public function getState ()
	{
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return null;

		// ============================
		// Core Code

		$space = space (250);
		$szTemp = "";
		
		for ($t=0; $t<$nCount; $t++)
		{ 
			$field = $this->instances [$t];

			$szTemp .= substr ($field->getState () . $space, 0, $field->MaxSize () ) . "|";
		}
		
		return ($szTemp);
	}

	public function setState ($state)
	{
		// ============================
		// Validations

		if (strlen ($state) < $this->MaxSize ())
			return;

		// ============================
		// Core Code

		$nPos = 0;

		$nCount = count ($this->instances);

		for ($t=0; $t<$nCount; $t++)
		{ 
			$nSize = $this->instances [$t]->MaxSize ();
			$value = substr ($state, $nPos, $nSize);
			$this->instances [$t]->setState ($value) ;
			$nPos += $nSize +1;
		}
	}

	// =============================================

	public function getSchema ()
	{
		// ============================
		// Validations

		$nCount = count ($this->instances);
		
		if ($nCount == 0) 
			return null;

		// Name - String - 40
		// FieldType - Integer - 4
		// Size - Integer - 4
		// Attributes - Integer - 4
		// total size per field = 52 bytes

		// ============================
		// Core Code

		$space = space (250);

		$szTemp = "";

		for ($t=0; $t<$nCount; $t++)
		{ 
			$row = "";
			$row .= substr ($this->instances [$t]->Name () . $space, 0, 40) . "|";
			$row .= substr ($this->instances [$t]->FieldType () . $space, 0, 4) . "|";
			// $row .= substr ($this->instances [$t]->Size () . $space, 0, 40 . "|";
			$row .= substr ($this->instances [$t]->MaxSize () . $space, 0, 4) . "|";
			$szTemp .= $row . "\r\n";
		}
		
		return ($szTemp);
	}

		// =============================================

	public function setSchema ($schema)
	{
		// ============================
		// Validations

		if (strlen ($schema) == 0)  
			return ;

		// ============================
		// Core Code

		$Field = null;
		$szName = "";
		$nType = 0;
		$nSize  = 0;
		$nMaxSize = 0 ;
		$szAttributes = "";
		$nPos = 0;
		$nCount = 0;

		do 
		{
			// print ("nCount = ( " . $nCount . " ) \r\n" );
			// print ("nPos = ( " . $nPos . " ) \r\n" );
			// print ("value = [ " . substr ($schema, $nPos, 51) . " ]\r\n");
			
			$szName = trim (substr ($schema, $nPos, 40));
			// print ("szName = [ " . $szName . " ]\r\n");
			$szName = trim ($szName);
			$nPos += 41;
			
			$nType = trim (substr ($schema, $nPos, 4));
			// print ("nType = [ " . $nType . " ]\r\n");
			$nType = $nType * 1; 
			$nPos += 5;

			// $nSize = substr ($schema, $nPos, 4); 
			// $nPos += 5;

			$nMaxSize = trim (substr ($schema, $nPos, 4)); 
			// print ("nMaxSize = [ " . $nMaxSize . " ]\r\n");
			$nMaxSize = $nMaxSize * 1;
			$nPos += 5;
			
			// ignore the \r \n characters
			$nPos += 2;
			
			$nField = $this->newField ($szName, $nType, null, $nMaxSize);
			// print ("\r\n");
			
			$nCount ++;

		} while 
		(
			($nPos < strlen ($schema)) and
			($nCount < 10)
		);
	}
}

?>
