<?
include_once ("Address_Container.php");
include_once ("CRUD_Interface.php");
include_once ("Store_Item.php");

class Store_Container extends Address_Container implements CRUD_Interface
{
	private $storage = null;
	private $nID = 0;
	
	public function __construct ($storage)
	{ $this->storage = $storage; }
	
	public function __destruct ()
	{ $this->storage = null; }

	// =================================================================

	public function newAddress ()
	{ 
		$rtn = new Store_Item ($this->storage);
		$this->aryInstances [] = $rtn;
		return ($rtn);
	}
	
	public function create ()
	{
		$rtn = new Storage_Item ($this->storage);
		return ($rtn->getInstance());
	}

	// Destroy the Container
	public function destroy ($nID)
	{
		$this->storage->delete ($nID);
		$this->nID = 0;
	}

	// Get the number of objects in the Container
	public function getCount ()
	{
		return (parent::count ());

//		$n = $this->storage->getRowCount ();
//		return ($n);
	}
	
	// Update the Container
	public function update ($thsInstance)
	{
		$state = $this->container->getState ();
		$this->storage->update ($state);
	}

	// Get the Item
	public function get_Container ($thsInstance)
	{
		$state = $this->storage->get ($nID);
		$container = new Store_Container ($this->storage);
		$container->setState ($state);
	}
	
	// Get the Container's ID
	public function getID ()
	{ return ($this->nID); }

	// Get an Item
	public function get_Address ($nID)
	{
		if (($nID < 0) || ($nID > $this->storage->getRowCount ()))
			throw (new exception ("nID = [ " . $nID . " ] out of range"));

		$address = null;

		if (isset ($this->instances [$nID])) 
		{ 
			print ("Found  = [ " . $nID . " ] \r\n");
			
			$address = $this->instances [$nID]; 
		}
		else
		{ 
			print ("Recalling  = [ " . $nID . " ] \r\n");

			$address = $this->newAddress ();
			$address->recall ($nID);
			$this->instances [$nID] = $address;
		}

		return ($address);
	}
		
	// ================================================================
/*
	protected function ForEachIn ($list, $foo)
	{
		parent::ForEachIn ($list, $foo);
		
		$t = 0;
		
		while ($t < $this->getCount ())
		{
			$value = $this->get_Item ($t);
			
			$rtn = $foo ($t, $value);
			$t++;
			
			if (! $rtn)
				return;
		}
	}
*/	
	// ================================================================
	
	public static function getStructure ()
	{ return (Store_Item::getStructure ()); }

	public static function getMaxSize ()
	{ return (Store_Item::getMaxSize ()); }

	public function getState () {}
	public function setState ($state) {}
	
	public static function store_each ($key, $value) 
	{ 
		$value->store (); 
		return (true);
	}

	// ================================================================

	public function recall ($nID)
	{
		print (__method__ . "\n\r"); 
		
	}
	
	public function store ()
	{
		print (__method__ . "\n\r"); 
		$this->foreach ("Store_Container::store_each"); 
	}

}

?>
