<?

class CRUD_Containter extends container implements CRUD_Interface
{
	protected $guid = "";

	protected $cbCreate = null;
	protected $cbDelete = null;
	protected $cbUpdate = null;
	protected $cbGet = null;
	
	// =================================================================

	public function __construct () 
	{}
	
	public function __destruct () 
	{}

	// =================================================================

	public function newAddress ()
	{
		$rtn = null;
		
		if ($this->cbCreate)
			$rtn = $this->cbCreate ();
		else
			$rn = new CRUD_Item ();
			
		return ($rtn);
	}
	
	// =================================================================
	
	public function addCreator ($thsSignal) 
	{ $this->cbCreate = $thisSignal; }
	
	public function addDestructor ($thsSignal) 
	{ $this->cbDelete = $thisSignal; }
	
	public function addUpdator ($thsSignal) 
	{ $this->cbUpdate = $thisSignal; }
	
	public function addGetter ($thsSignal) 
	{ $this->cbGet = $thisSignal; }
	
	// =================================================================

	public function getCount ()
	{
		if ($this->cbCount)
			$rtn = $this->cbCount ();
		else
			$rtn = $this->count;
	}
	
	public function getID () 
	{ return ($this->szGUID); }
	
	public function getState () 
	{
		$rtn = [];

		$rtn ["szGUID"] = $this->szGUID;
		$rtn ["szName"] = $this->szName;
		$rtn ["szAddress"] = $this->szAddress;
		$rtn ["szCity"] = $this->szCity;
		$rtn ["szState"] = $this->szState;
		$rtn ["szZip"] = $this->szZip;
		$rtn ["szTele"] = $this->szTele;
		$rtn ["szEmail"] = $this->szEmail;

		return ($rtn);
	}
	
	public function setState ($state) 
	{
		$this->szGUID = $state ["szGUID"];
		$this->szName = $state ["szName"];
		$this->szAddress = $state ["szAddress"];
		$this->szCity = $state ["szCity"];
		$this->szState = $state ["szState"];
		$this->szZip = $state ["szZip"];
		$this->szTele = $state ["szTele"];
		$this->szEmail = $state ["szEmail"];
	}
	
	public function store () 
	{}
}

?>
