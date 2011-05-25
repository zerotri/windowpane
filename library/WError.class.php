<?php
class WError
{
	private static $instance = null;
	private static $errors = array();
	private function __construct()
	{

	}
	public static function log($error)
	{
		array_push($errors, $error);
	}
	public static function list()
	{
		
	}
}
?>