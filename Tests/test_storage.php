<?
include_once ("FileStorage.php");
include_once ("Store_Container.php");


$filename = "address";

$rowLen = Store_Container::getMaxSize();

$storage = new FileStorage ();

$bFile = file_exists ( $filename . ".data");
if ($bFile)
{ $storage->open ($filename); }
else
{ $storage->create ($filename, $rowLen); }

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

	public function setAddress ($address, $row)
	{
		print (__method__ . " ( " . $row [0] . " ) \r\n");
		
		$address->setFirstName ($row [00]);
		$address->setLastName ($row [01]);
		$address->setStreet1 ($row [02]);
		$address->setStreet2 ($row [03]);
		$address->setCity ($row [04]);
		// $address->setState ($row [05]);
		$address->setZip ($row [06]);
		$address->setTele ($row [07]);
		$address->setEmail ($row [8]);
	}

	public function run ()
	{
		$aryData = file ("test.data");

		$container = new Store_Container ($this->storage);
		$address = null;

		for ($t = 0; $t < 10; $t++)
		{
			$row = explode ("|"  , $aryData [$t]);
			$address = $container->newAddress ();
			$this->setAddress ($address, $row);
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
