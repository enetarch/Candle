<?
include_once ("FileStorage.php");
include_once ("Store_Container.php");

$filename = "address";

$structure = Store_Container::getStructure();
// $rowLen = $structure->getSize ();
// $rowLen = $structure ["getSize"];
$rowLen = $structure ["getSize"] ();

$storage = new FileStorage ();

$bFile = file_exists ( $filename . ".data");
if ($bFile)
{ $storage->open ($filename); }
else
{ $storage->create ($filename, $nrowLen); }

// =====================================================================

class main
{
	private $storage = null;
	
	public function __construct ($storage)
	{ $this->storage = $storage; }
	
	public function itterate ($key, $value) 
	{
		print ("class = " . get_class ($value) . "\r\n");
		
		$value->printMe ();
		return (true);
	}

	public function setAddress ($address)
	{
		$address->setFirstName ("Default First");
		$address->setLastName ("Default Last");
		$address->setStreet1 ("Default Street 1");
		$address->setStreet2 ("Default Street 2");
		$address->setCity ("Some City");
		// $address->setState ("AA");
		$address->setZip ("12345-6789");
		$address->setTele ("123-456-7890");
		$address->setEmail ("info@enetarch.net");
	}

	public function run ()
	{
		$container = new Store_Container ($this->storage);
		$address = null;

		for ($t = 0; $t < 10; $t++)
		{
			$address = $container->newAddress ();
			$this->setAddress ($address);
		}

		$container->foreach ("main::itterate");
		
		print (" ============================================== \r\n");

		$container->store ();

		$container->foreach ("main::itterate");
	}
}

$main = new main ($storage);
$main->run();

// =====================================================================


$storage->close ();
?>
