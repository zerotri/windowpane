<?php
class WUtil
{
    private function __construct()
    {
        
    }
	public static function pipeFunctionIntoString($function)
	{
		$args = func_get_args();
		if((func_num_args() > 1) && (isset($args)))
		{
			array_shift($args);
		}
		ob_start();
		if (isset($args))
		{
			return call_user_func_array($hook, $args);
		}
		else
		{
			return call_user_func($hook);
		}
		$data = ob_get_contents();
		ob_end_clean(); # end buffer
		return $data;
	}
    static function setCookie($name, $value)
    {
            $_COOKIE[$name] = $value;
    }
    static function getCookie($name, $function)
    {
        if(isset($_COOKIE[$name]))
            return $_COOKIE[$name];
        return;
    }
    static function getCookieExists($name)
    {
        return (isset($_COOKIE[$name]));
    }
}

?>