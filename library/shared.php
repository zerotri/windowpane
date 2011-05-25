<?php
//include('windowpane.php');
/** Check if environment is development and display errors **/


function buildPath($formattedPath) {
	return str_replace("/", DIRECTORY_SEPARATOR , $formattedPath);
}


/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Check register globals and remove them **/

function unregisterGlobals() {
	if (ini_get('register_globals')) {
		$array = array(	'_SESSION', '_POST', '_GET', '_COOKIE',
			'_REQUEST', '_SERVER', '_ENV', '_FILES');
		foreach ($array as $value) {
			foreach ($GLOBALS[$value] as $key => $var) {
				if ($var === $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}

/** Secondary Call Function **/

function performAction($controller,$action,$queryString = null,$render = 0) {

	$controllerName = ucfirst($controller).'Controller';
	$dispatch = new $controllerName($controller,$action);
	$dispatch->render = $render;
	return call_user_func_array(array($dispatch,$action),$queryString);
}

/** Routing **/

function routeURL($url) {
	global $routing;

	foreach ( $routing as $pattern => $result ) {
		if ( preg_match( $pattern, $url ) ) {
			return preg_replace( $pattern, $result, $url );
		}
	}

	return ($url);
}

/** Main Call Function **/
function someFunction()
{
	//echo "cow";
}
function someOtherFunction($name, $value)
{
	//echo " blue ". $name ." ";
	return $value;
}
function callHook() {
	//require_once(ROOT . '/library/WUtil.class.php');
	//include(ROOT . '/library/WHook.class.php');
	global $url;
	global $default;

	$config = new WConfig();
	WHook::register("hook", "someFunction");
	WHook::register("wobject_set_value", "someOtherFunction");
	//WHook::unregister("hook", "someFunction");

	$sql = new WSQLQuery();
	//echo $sql->select("*")->from("table")->where("name='bob'")->orderBy("id")->getQuery();
	$sql->getQuery();

	$object = new WObject;
	$object->somevar = 'lollipop ';
	//echo $object->somevar;

	WHook::call("hook", "moo", "cow");
}
function loadPage($pagename)
{
	// pages are stored in the following way:
	//	$ROOT/app/
}
function __loadinclude($filename)
{
	$data = WUtil::pipeFunctionIntoString('include', $filename );
	return $data;
}

/** Autoload any classes that are required **/



$cache = new Cache();
$inflect = new Inflection();

setReporting();
set_error_handler("errorHandler");
removeMagicQuotes();
unregisterGlobals();
callHook();
?>