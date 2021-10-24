<?
include_once ("Address_Container.php");

class main
{
	public function itterate ($key, $value) 
	{
		$value->printMe ();
		return (true);
	}

	public function setAddress ($address)
	{
		$address->setName ("Mike Fuhrman");
		$address->setAddress ("PO Box 64-0662");
		$address->setCity ("San Francisco");
		$address->setState ("CA");
		$address->setZip ("94109");
		$address->setTele ("313-522-0224");
		$address->setEmail ("mfuhrman@enetarch.net");
	}

	public function run ()
	{
		$container = new Address_Container ();
		$address = null;

		for ($t = 0; $t < 10; $t++)
		{
			$address = $container->newAddress ();
			$this->setAddress ($address);
		}

		$anon0 = $this->itterate;
		$anon1 = function ($key, $value) { $value->printMe (); return (true); };
		$anon2 = "main::itterate";
		$anon3 = __class__ . "::" . get_class_methods  (__class__) [0];
		
		print ("anon = " . $anon3 . "\r\r\n\n");
		
		$container->foreach ($anon3);
	}
}


$main = new main ();



$main->run();

// main::run ();

?>
