<?
include_once ("Itterate.php");
include_once ("Address_Item.php");

class Address_Container extends Itterate
{
	protected $aryInstances = [];
	
	public function __construct ()
	{}
	
	public function newAddress ()
	{ 
		$rtn = new Address_Item ();
		$this->aryInstances [] = $rtn;
		return ($rtn);
	}
	
	public function removeAddress ($instance)
	{
		$found = find ($instance);
		if ($found != null)
			unset ($this->aryInstances [$t]);
	}
	
	public function findAddress ($instance)
	{
		for ($t = 0; $t < length ($this->aryInstances); $t++)
			if ($this->aryInstances == $instance)
				return ($t);
		
		return (null);
	}
	
	public function foreach ($foo)
	{ $this->foreachin ($this->aryInstances, $foo); }
	
	public function getCount ()
	{ return count ($this->aryInstances); }
	
	public function getInstance ($n)
	{ return ($this->aryInstances [$n]); }
	
	public function getFirst ()
	{ return ($this->aryInstances [0]); }
	
	public function getLast ()
	{ 
		$nLen = length ($this->aryInstances);
		return ($this->aryInstances [$nLen-1]);
	}
	
}
?>
