<?

class CRUD_Item extends container implements CRUD_Interface
{
	protected $storage = null;
	
	protected $guid = "";
	
	protected $cbCreate = null;
	protected $cbDelete = null;
	protected $cbUpdate = null;
	protected $cbGet = null;

	// =================================================================

	public function __construct ($storage) 
	{}
	public function __destruct () 
	{}
	
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
