<?php

class WLanguage
{
	private static strings = array( "windowpane" => "windowpane" );
	public function __get($var, $val)
	{
		if(isset(strings[$var]))
		{
			return strings[$var];
		}
		else
		{	//pull string from DB.
		}
		
	}
}

?>