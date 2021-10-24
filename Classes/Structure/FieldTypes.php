<?

class FieldTypes  
{
	const isEmpty = 0;
	const isBool = 1;
	const isByteArray = 2;
	const isChar = 3;
	const isDateTime = 4;
	const isDouble = 5;
	const isInteger = 6;
	const isIntegerArray = 7;
	const isLong = 8;
	const isLongArray = 9;
	const isString = 10;

	public static function getSize ($nType, $nSize)
	{
		$rtn = 0;
		switch ($nType)
		{
			case FieldTypes::isEmpty : $rtn = 0;
			case FieldTypes::isBool : $rtn = 4;
			case FieldTypes::isByteArray : $rtn = $nSize;
			case FieldTypes::isChar : $rtn = 4;
			case FieldTypes::isDateTime : $rtn = 8;
			case FieldTypes::isDouble : $rtn = 8;
			case FieldTypes::isInteger : $rtn = 4;
			case FieldTypes::isIntegerArray : $rtn = $nSize*4;
			case FieldTypes::isLong : $rtn = 4;
			case FieldTypes::isLongArray : $rtn = $nSize*4;
			case FieldTypes::isString : $rtn = $nSize;
		}
		
		return ($rtn);
	}
}

?>
