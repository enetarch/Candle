<?
	public function setKeyValue ($n, $key)
	{ $this->aryKeyValues [$n] = $key; }
	
	public function getKeyValue ($n)
	{ return ($this->aryKeyValues [$n]); }

	public function pushKeyValue ($key)
	{ $this->aryKeyValues [] = $key; }

	public function popKeyValue ()
	{ return (array_pop ($this->aryKeyValues)); }

	public function getNext ()
	{ return ($this->aryKeyValues [$this->nPos++]); }
	
	public function reset ()
	{ $this->nPos = 0; }
	
	// =================================================================


?>
