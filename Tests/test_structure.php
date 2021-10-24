<?

include_once ("Structure.php");

class main
{
	private $aryFields = 
	[
		[ "szFirstName", "Default First", 10, 20 ],
		[ "szLastName", "Default Last", 10, 20 ],
		[ "szStreet1", "Street 1", 10, 40 ],
		[ "szStreet2", "Street 2", 10, 40 ],
		[ "szCity", "Some City", 10, 20 ],
		[ "szState", "AA", 10, 2 ],
		[ "szZip", "12345-6789", 10, 10 ],
		[ "szTele", "313-522-0224", 10, 12 ],
		[ "szEmail", "info@enetarch.net", 10, 80 ],
	];
	
	public function run ()
	{
		$container = new Structure ();

		for ($t = 0; $t < count ($this->aryFields); $t++)
		{
			$field = $this->aryFields [$t];
			
			$szName = $field [0];
			$szValue = $field [1];
			$szType = $field [2];
			$szSize = $field [3];
			
			$container->newField ($szName, $szType, $szValue, $szSize);
		}

		// print_r ($container);
		
		print ("================================================\r\n");

		$schema = $container->getSchema ();
		print ($schema . "\r\n");
		
		print ("================================================\r\n");

		$state = $container->getState ();
		print ($state . "\r\n");

		print ("================================================\r\n");
		print ("loading schema\r\n");
		
		$container2 = new Structure ();
		$container2->setSchema ($schema);
		
		print ("================================================\r\n");
		print ("loading state\r\n");

		$container2->setState ($state);

		print ("================================================\r\n");

		$state = $container->getState ();
		print ($state . "\r\n");

		print ("================================================\r\n");

	}
}

$main = new main ();
$main->run();

?>
