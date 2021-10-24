<?
include_once ("getGUID.php");
include_once ("Structure.php");

class Address_Item
{
	protected $structure = null;
	
	const aryFields = 
	[
		[ "szGUID", "1234-5678-abcd-0987-efgh", 10, 40 ],
		[ "szFirstName", "Default First", 10, 20 ],
		[ "szLastName", "Default Last", 10, 20 ],
		[ "szStreet1", "Default Street 1", 10, 40 ],
		[ "szStreet2", "Default Street 2", 10, 40 ],
		[ "szCity", "Default City", 10, 20 ],
		[ "szState", "AA", 10, 2 ],
		[ "szZip", "12345-6789", 10, 10 ],
		[ "szTele", "123-456-7890", 10, 12 ],
		[ "szEmail", "defaultuser@somewhere.net", 10, 80 ],
	];
	
	public function __construct ()
	{ 
		$this->structure = new Structure ();
		
		$this->initStructure ();
		
		$this->structure->setField2 ("szGUID", getGUID ()); 
	}
	
	public function __destruct ()
	{ }

	public function getGUID ()
	{ return ($this->szGUID); }

	// =================================================================
	
	private function initStructure ()
	{
		for ($t = 0; $t < count (Address_Item::aryFields); $t++)
		{
			$field = Address_Item::aryFields [$t];
			
			$szName = $field [0];
			$szValue = $field [1];
			$szType = $field [2];
			$szSize = $field [3];
			
			$this->structure->newField ($szName, $szType, $szValue, $szSize);
		}
	}
	
	// =================================================================
	
	public function init ($szName, $szAddress, $szCity, $szState, $szZip, 
	$szEmail, $szTele)
	{
		$this->structure->setFielld2 ("szName", $szFirstName);
		$this->structure->setFielld2 ("szName", $szLastName);
		$this->structure->setFielld2 ("szStreet1", $szStreet1);
		$this->structure->setFielld2 ("szStreet2", $szStreet2);
		$this->structure->setFielld2 ("szCity", $szCity);
		$this->structure->setFielld2 ("szState", $szState);
		$this->structure->setFielld2 ("szZip", $szZip);
		$this->structure->setFielld2 ("szTele", $szTele);
		$this->structure->setFielld2 ("szEmail", $szEmail);		
	}
	
	// =================================================================

	public function getFirstName ()
	{ return ($this->structure->getField2 ("szFirstName")); }
	
	public function setFirstName ($thsName)
	{ $this->structure->setField2 ("szFirstName", $thsName); }
	
	public function getLastName ()
	{ return ($this->structure->getField2 ("szLastName")); }
	
	public function setLastName ($thsName)
	{ $this->structure->setField2 ("szLastName", $thsName); }
	
	
	public function getStreet1 ()
	{ return ($this->structure->getField2 ("szStreet1")); }
	
	public function setStreet1 ($thsStreet)
	{ $this->structure->setField2 ("szStreet1", $thsStreet); }
	
	public function getStreet2 ()
	{ return ($this->structure->getField2 ("szStreet2")); }
	
	public function setStreet2 ($thsStreet)
	{ $this->structure->setField2 ("szStreet2", $thsStreet); }
	

	public function getCity ()
	{ return ($this->structure->getField2 ("szCity")); }
	
	public function setCity ($thsCity)
	{ $this->structure->setField2 ("szCity", $thsCity); }
	
	public function getState ()
	{ return ($this->structure->getField2 ("szState")); }
	
	public function setState ($thsState)
	{ $this->structure->setField2 ("szState", $thsState); }
	
	public function getZip ()
	{ return ($this->structure->getField2 ("szZip")); }
	
	public function setZip ($thsZip)
	{ $this->structure->setField2 ("szZip", $thsZip); }
	
	public function getTele ()
	{ return ($this->structure->getField2 ("szTele")); }
	
	public function setTele ($thsTele)
	{ $this->structure->setField2 ("szTele", $thsTele); }
	
	public function getEmail ()
	{ return ($this->structure->getField2 ("szEmail")); }
	
	public function setEmail ($thsEmail)
	{ $this->structure->setField2 ("szEmail", $thsEmail); }
	
	// =================================================================

	function printMe ()
	{
		for ($t = 0; $t < $this->structure->Count(); $t++)
		{
			$field = $this->structure->getField ($t);			
			$szName = $field->Name();

			print ($szName . " = " . $this->structure->getField2 ($szName)->getValue() . "\r\n");
		}

		print ("\r\n");
	}
	
}
?>
