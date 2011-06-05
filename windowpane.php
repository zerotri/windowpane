<?php
include("library/Windowpane.php");
function debug_func($object, $function, $vars = null)
{
	global $windowpane;
	if($windowpane->Config['Environment']['Debug'] == false)
		return;
	echo "<pre>";
	echo get_class($object)."::$function()";
	if($vars != null)
	Print_r($vars);
	echo "</pre>";
}
function __autoload($className) {
	$filePaths = array(
		0=> Windowpane::getRootDirectory() . "/library/" . $className . ".class.php",
		1=> Windowpane::getRootDirectory() . "/library/" . $className . ".inc.php",
		2=> Windowpane::getRootDirectory() . "/app/".$className."/" . $className . ".php");
	foreach($filePaths as $path)
	{
		if(file_exists($path))
		{
			include($path);
			return;
		}
	}
	die("<br>Could not load class $className.<br>");
}

function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.'/tmp/logs/error.log');
	}
}

function catchExceptions($exception)
{
	$error = Array();
	$error['title'] = "A PHP Exception Occurred!";
	$error['string'] = $exception->getMessage();
	$error['file'] = $exception->getFile();
	$error['code'] = Print_r($exception->getCode(),true);
	$error['backtrace'] = $exception->getTraceAsString();
	ob_start();
    include(dirname(__FILE__)."/public/error.html");
    echo ob_get_clean();
}
function errorHandler($error_level, $error_message, $error_file, $error_line, $error_context)
{
	$type = "";
	switch($error_level)
	{
		case E_WARNING: $type="Warning"; break;
		case E_NOTICE: $type="Notice"; break;
		case E_USER_ERROR: $type="User Error"; break;
		case E_USER_WARNING: $type="User Warning"; break;
		case E_USER_NOTICE: $type="User Notice"; break;
		case E_RECOVERABLE_ERROR: $type="Recoverable Error"; break;
		case E_ALL: $type="All"; break;
		default: $type="Unknown Error"; break;
	}
	$error = Array();
	$error['title'] = "A PHP Error Occurred!";
	$error['string'] = $error_message;
	$error['file'] = $error_file;
	$error['code'] = $error_context;
	$error['backtrace'] = Print_r(debug_backtrace(),true);
    ob_start();
    include(dirname(__FILE__)."/public/error.html");
    echo ob_get_clean();
	die();
}
set_error_handler("errorHandler");
set_exception_handler('catchExceptions');

?>
