<?
include_once ("FileStorage.php");
include_once ("Store_Container.php");

$filename = "address";

$rowLen = Store_Container::getMaxSize();

$storage = new FileStorage ();
$storage->open ($filename); 

// =====================================================================

class main 
{
	private $storage = null;
	private $cotainer = null;
	
	public function __construct ($storage)
	{ 
		$this->storage = $storage; 
		$this->container = new Store_Container ($storage);
	}
	
	public function itterate ($key, $value) 
	{
		print ("class = " . get_class ($value) . "\r\n");
		
		$value->printMe ();
		return (true);
	}

	public function run ()
	{
		$max = $this->storage->getRowCount ();

		for ($t=0; $t < 10; $t++)
		{
			$nID = rand (0, $max);
			print (__method__ . " ( " . $nID . " ) \r\n" );

			$address = $this->container->get_Address ($nID);
			$address->printMe ();
		}
		
		print ("=============================================== \r\n");

		$this->container->foreach ("main::itterate");
	}
}

$main = new main ($storage);
$main->run();

// =====================================================================


$storage->close ();
?>
