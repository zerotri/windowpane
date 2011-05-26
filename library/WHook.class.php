<?php
class WHook
{
	private static $instance = null;
	private static $hooklist = array();
	private static $usedhooks = array();
	private function __construct()
	{

	}
	static function register($name, $function)
	{
		if(!function_exists($function))
			return;
		//make sure hooklist isn't empty
		if(!isset(WHook::$hooklist[$name]))
		{
			WHook::$hooklist[$name] = array($function);
		}
		else
		{
			array_push(WHook::$hooklist[$name],$function);
		}
	}
	static function unregister($name, $function)
	{
		unset(WHook::$hooklist[$name][array_search($function,WHook::$hooklist[$name])]);
	}
	static function call($name)
	{
		$args = func_get_args();
		if((func_num_args() > 1) && (isset($args)))
		{
			array_shift($args);
		}
		//make sure hooklist isn't empty
		if(!empty(WHook::$hooklist))
		{
			//check if the hook exists
			if(isset(WHook::$hooklist[$name]))
			{
				if(!empty(WHook::$hooklist[$name]))
				{
					if (isset($args))
					{
						array_push(WHook::$usedhooks, array($name, $args));
						foreach( WHook::$hooklist[$name] as $hook )
						{
							return call_user_func_array($hook, $args);
						}
					}
					else
					{
						array_push(WHook::$usedhooks, array($name, null));
						foreach( WHook::$hooklist[$name] as $hook )
						{
							return call_user_func($hook);
						}
					}

				}
			}
			else
			{
				
			}
		}
	}
	static function getUsedHooks()
	{
		return WHook::$usedhooks;
	}
}

?>