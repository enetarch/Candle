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
		$container = new Address_Container ();
		$address = null;

		for ($t = 0; $t < 10; $t++)
		{
			$address = $container->newAddress ();
			$this->setAddress ($address);
		}

		$container->foreach ("main::itterate");
	}
}

$main = new main ();
$main->run();

?>
