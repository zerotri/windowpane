<?php
include("windowpane.php");
include("library/conjugation.php");
function debug_func($object, $function, $vars = null)
{
	global $windowpane;
	if($windowpane->config->get("environment.debug") == false)
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
set_exception_handler('catchExceptions');
global $windowpane;
$windowpane = new Windowpane();
$url = "posts/view/1";

$windowpane->direct($url);

//
/*$postView->setFile(Windowpane::getRootDirectory()."/app/v/posts.tpl");
$postData = $postModel->loadData();
$postView->posts = $postData;
$renderedPosts = $postView->render();

//Set view variables
$pageView->posts = $renderedPosts;
$pageView->title = "Template Test";*/

?>
