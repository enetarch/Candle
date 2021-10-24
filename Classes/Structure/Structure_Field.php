<?

class Structure_Field 
{
	private $szName = "";
	private $value = null;
	private $nType = 0;
	private $nMaxSize = 0;
	private $nSize = 0;

	// =============================================

	public function __construct ()
	{ }

	public function __destruct ()
	{ $this->vValue = null; }

	// =============================================

	public function init ($szFName, $nType, $value, $nMaxSize=1)
	{
		$this->initThis ($szFName, $nType);

		$this->nMaxSize = FieldTypes::getSize ($nType, $nMaxSize);

		$this->nSize = strlen ($value);

		$this->value = $value;
	}

	// =============================================

	private function initThis ($szName, $nType)
	{
		$szName = trim ($szName);  

		$this->szName = $szName;
		$this->nType = $nType;
	}

	// =============================================

	public function Name ()
	{ return ($this->szName); }

	public function FieldType ()
	{ return ($this->nType); }

	public function Size ()
	{ return ($this->nSize); }

	public function MaxSize ()
	{ return ($this->nMaxSize); }

	// =============================================

	public function getValue ()
	{ return ($this->value); } 

	public function setValue ($value)
	{ $this->value = $value; } 

	// =============================================

	public function getState () // byte string
	{ return ($this->value); }
		
	public function setState ($value)
	{ $this->value = $value; }

/*
	public function getState2 () // byte string
	{ 
		byte[] chunk = null;
		int nLen = 0;

		switch (nType)
		{
			case FieldType.isBool:
				return BitConverter.GetBytes((bool) vValue);
  
			case FieldTypes::isByte:
			{
				nLen = ((byte[]) vValue).Length;
				chunk = new byte[nLen+4];
				BitConverter.GetBytes(nLen).CopyTo (chunk, 0);
				((byte[]) vValue).CopyTo(chunk, 4);
				return chunk;
			}

			case FieldTypes::isChar:
			{
				nLen = ((char[]) vValue).Length;
				chunk = new byte[nLen+4];
				BitConverter.GetBytes(nLen).CopyTo (chunk, 0);
				((char[]) vValue).CopyTo(chunk, 4);
				return chunk;
			}

			case FieldTypes::isDateTime:
				return BitConverter.GetBytes((long) ((DateTime) vValue).Ticks);
  
			case FieldTypes::isDouble:
				return BitConverter.GetBytes((double) vValue);

			case FieldTypes::isInteger:
				return BitConverter.GetBytes((int) vValue);
  
			case FieldTypes::isIntegerArray:
				nLen = ((int[]) vValue).Length;
				chunk = new byte[nMaxSize];

				for (int t=0; t<nLen; t++)
					BitConverter.GetBytes(((int[]) vValue)[t]).CopyTo (chunk, t*4);
				return chunk;
  
			case FieldTypes::isLong:
				if (vValue == null) return BitConverter.GetBytes((long) 0);
			
				try
				{ chunk = BitConverter.GetBytes((long) vValue); }
				catch (System.InvalidCastException)
				{ chunk = BitConverter.GetBytes((long) 0); }

				return chunk;

			case FieldTypes::isLongArray:
				nLen = ((long[]) vValue).Length;
				chunk = new byte[nMaxSize];

				for (int t=0; t<nLen; t++)
					BitConverter.GetBytes(((long[]) vValue)[t]).CopyTo (chunk, t*8);
				return chunk;

			case FieldTypes::isString:
			{
				chunk = new byte[nSize];
				char[] szChar = ((string) vValue).ToCharArray();
				for (int t=0; t<szChar.Length; t++)
					chunk[t] = (byte) szChar[t];
				return chunk;
			}
		}

		return null;
	}

	public function getValue2 ()
	{
		switch ($this->nType)
		{
			case FieldTypes::isBool:
				$this->vValue = value;
				break;

			case FieldTypes::isByte:
				$this->vValue = value;
				if (value !=null) 
				{ nSize = ((byte[]) (value)).Length; }
				else
				{ nSize = 0;}
				break;

			case FieldTypes::isChar:
				$this->vValue = value;
				if (value !=null) 
				{ nSize = ((char[]) (value)).Length; }
				else
				{ nSize = 0;}
				break;

			case FieldTypes::isDateTime:
				$this->vValue = value;
				break;

			case FieldTypes::isDouble:
			case FieldTypes::isInteger:
			case FieldTypes::isLong:
				$this->vValue = value;
				break;

			case FieldTypes::isIntegerArray:
				if (value.GetType() != typeof (int[]))
				{
					objError.init ("Expected int []", -1, "", szCallPath, value.GetType().ToString());
					if (bDebugging) objDebug.ErrorMsg (objError);
					return;
				}

				if (((int[]) value).Length != ((int[]) vValue).Length)
				{
					objError.init ("Array size mismatch", -1, "", szCallPath, 
						"" + ((int[]) value).Length + " != " + ((int[]) vValue).Length);
					if (bDebugging) objDebug.ErrorMsg (objError);
					return;
				}

				((int[]) value).CopyTo ((int[]) vValue, 0);
				break;

			case FieldTypes::isLongArray:
				if (value.GetType() != typeof (long[]))
				{
					objError.init ("Expected long []", -1, "", szCallPath, value.GetType().ToString());
					if (bDebugging) objDebug.ErrorMsg (objError);
					return;
				}

				if (((long[]) value).Length != ((long[]) vValue).Length)
				{
					objError.init ("Array size mismatch", -1, "", szCallPath, 
						"" + ((long[]) value).Length + " != " + ((long[]) vValue).Length);
					if (bDebugging) objDebug.ErrorMsg (objError);
					return;
				}

				((long[]) value).CopyTo ((long[]) vValue, 0);
				break;

			case FieldTypes::isString:
				if (value !=null) 
				{ nSize = ((string) (value)).Length; }
				else
				{ nSize = 0;}
				$this->vValue = value;
				break;
		}
	}
	
	public setState2 ($chunk, int nPos)
	{
		int $nLen = 0;
		switch ($this->nType)
		{
			case FieldTypes::isBool:
				vValue = (bool) BitConverter.ToBoolean (chunk, nPos);
				break;
  
			case FieldTypes::isByte:
			{
				byte[] bObject = new byte[nMaxSize];
				nSize = (int) BitConverter.ToInt16 (chunk, nPos);
				for (int t=0; t<nLen; t++)
					bObject[t] = chunk[nPos +4 +t];
				vValue = bObject;
				break;
			}

			case FieldTypes::isChar:
			{
				char[] bObject = new char[nMaxSize];
				nSize = (int) BitConverter.ToInt16 (chunk, nPos);
				for (int t=0; t<nLen; t++)
					bObject[t] = (char) chunk[nPos +4 +t];
				vValue = bObject;
				break;
			}

			case FieldTypes::isDateTime:
				long nDate = BitConverter.ToInt64 (chunk, nPos);
				vValue = new DateTime (nDate);
				break;
  
			case FieldTypes::isDouble:
				vValue = (double) BitConverter.ToDouble (chunk, nPos);
				break;

			case FieldTypes::isInteger:
				vValue = (int) BitConverter.ToInt16 (chunk, nPos);
				break;
  
			case FieldTypes::isIntegerArray:
				nLen = ((int[]) vValue).Length;
				for (int t=0; t<nLen; t++)
					((int[]) vValue)[t] = (int) BitConverter.ToInt16 (chunk, nPos + (4*t));
				break;
  
			case FieldTypes::isLong:
				vValue = (long) BitConverter.ToInt64 (chunk, nPos);
				break;

			case FieldTypes::isLongArray:
				nLen = ((long[]) vValue).Length;
				for (int t=0; t<nLen; t++)
					((long[]) vValue)[t] = (long) BitConverter.ToInt64 (chunk, nPos + (8*t));
				break;

			case FieldTypes::isString:
			{
				byte[] bzChunk = new byte[nMaxSize];
				for (int t=0; t<nMaxSize; t++)
					bzChunk[t] = chunk[nPos +t];
				vValue = Functions.ByteToString (bzChunk);
				break;
			}
		}
	}
*/
}

?>
