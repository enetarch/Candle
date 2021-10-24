<?
include_once ("Address_Item.php");

class Store_Item extends Address_Item implements CRUD_Interface
{
	private $storage = null;
	protected $nID = 0;
	
	public function __construct ($storage)
	{ 
		$this->storage = $storage;
		parent::__construct (); 
	}
	
	public function __destruct ()
	{ 
		parent::__destruct ();
		$this->storage = null;	
	}

	// =================================================================
	
	public function creat ()
	{}
	
	// Destory an Item
	public function destroy ()
	{
		$this->storage->delete ($nID);
		$this->nID = 0;
	}

	// Update an Item
	public function update ()
	{		
		$state = $this->item->getState ();
		$this->storage->update ($state);
	}

	// Get the Item's ID
	public function getID ()
	{ return ($this->nID); }

	// =================================================================
	
	public static function getStructure ()
	{
		$rtn = [];

		for ($t = 0; $t < count (parent::aryFields); $t++)
		{
			$field = parent::aryFields [$t];
			$szName = $field [0];

			$rtn [$szName] = "";
		}

		return ($rtn);
	}
	
	public static function getMaxSize ()
	{
		$rtn = 0;

		for ($t = 0; $t < count (parent::aryFields); $t++)
		{
			$field = parent::aryFields [$t];
			$nMaxSize = $field [3]+1;

			$rtn += $nMaxSize;
		}

		return ($rtn);
	}

	public function getState () 
	{ return ( $this->structure->getState () ); }
	
	public function setState ($state) 
	{ $this->structure->setState ($state); }
	
	// ================================================================

	public function recall ($nID)
	{
		print (__method__ . " ( " . $nID . " ) \r\n" );
		if ($nID < 0) 
			throw (new exception ("nID = [ " . $nID . " ] out of range"));

			
		$state = $this->storage->get ($nID);
		$this->setState ($state);
		$this->nID = $nID;
	}
	
	public function store () 
	{
		$str = $this->getState ();
		
		if ($this->nID == 0)
		{ $this->nID = $this->storage->add ($str); }
		else
		{ $this->storage->update ($str); }
	}
	
	// =================================================================
	
	public function printMe ()
	{
		print ("nID = " . $this->nID . "\r\n");
		parent::printMe ();
	}
}

?>
