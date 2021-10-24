<?
include_once ("Itterate_Interface.php");

abstract class Itterate implements Itterate_Interface
{
	protected $nCurrent = 0;
	protected $list = [];
	
	public function foreach ($foo) 
	{ $this->foreachin ($this->list, $foo); }
	
	protected function ForEachIn ($list, $foo)
	{
		$t = 0;
		
		while ($t < count ($list))
		{
			$value = $list [$t];
			
			$rtn = $foo ($t, $value);
			$t++;
			
			if (! $rtn)
				return;
		}
	}


}
?>
