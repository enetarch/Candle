<?
// NameSpace \\ENetArch\Storage\;

interface CRUD_Interface
{
	function getID ();
	static function getStructure ();
	function getState ();
	function setState ($state);
	
	function store ();
}

?>
