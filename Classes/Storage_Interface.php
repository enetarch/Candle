<?

interface Storage_Interface
{
	function open ($filename);
	function close ();
	
	function add ($thsObject);
	function update ($thsObject);
	function get ($nID);
	function delete ($nID);
	function find ($thsObject);
	
}

?>
