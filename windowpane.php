<?php
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
	/*$error  = '</span>';
	$error .= "<strong><b>$type:</b></strong> $error_message on Line</b> $error_line <b>" .
		"in file [ </b> $error_file <b>]</b>";
	$error .= "<br>Backtrace:<pre>";
	$error .= Print_r(debug_backtrace(),true);
	$error .= "</pre>";*/
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

include('library/WHook.class.php');
include('library/WObject.class.php');
include('library/datastore/WDatastore.class.php');
include('library/datastore/WMySQLDatabase.class.php');
include('library/WUtil.class.php');
include('library/WModel.class.php');
include('library/WView.class.php');
//include("config/routing.php");
include("config/inflection.php");

class Windowpane
{
	public $Config;
	public $db;
	public $Platform;
	static public function GetUserPlatform()
	{
		$oses = array(
			'/macintosh|mac os x/i' => 'Mac',
			'/linux/i' => 'Linux',
			'/windows|win32/i' => 'Windows',
			'/android/i' => 'Android',
			'/iOS/i' => 'iOS'
			);
		$engines = array(
			'/webkit/i' => 'WebKit',
			'/gecko/i' => 'Gecko',
			'/trident/i' => 'Trident'
			);
		$browserStrings = array(
			'/Chrome/i'		=>	"Chrome",
			'/Safari/i'		=>	"Safari",
			'/Firefox/i'	=>	"Firefox",
			'/Opera/i'		=>	"Opera",
			'/MSIE/i'		=>	"InternetExplorer",
			'/Netscape/i'	=>	"Netscape"
			);
		$userAgent = $_SERVER['HTTP_USER_AGENT']; 
		$browser = "Unknown";
		$os = "Unknown";
		$platform = "Desktop";
		$engine = "Unknown";

		//Match browsers
		foreach ( $browserStrings as $pattern => $result )
		{
			if ( preg_match( $pattern, $userAgent ) )
			{
				$browser = $result;
				break;
			}
		}

		//Match oses
		foreach ( $oses as $pattern => $result )
		{
			if ( preg_match( $pattern, $userAgent ) )
			{
				$os = $result;
				break;
			}
		}
		//determine platform based on os
		if($os == 'Android' || $os == 'iOS')
		{
			$platform = 'Mobile';
		}
		
		//Match engines
		foreach ( $engines as $pattern => $result )
		{
			if ( preg_match( $pattern, $userAgent ) )
			{
				$engine = $result;
				break;
			}
		}
		//determine engine based on browser, in the event that $engines is wrong
		if($browser == 'Chrome' || $browser == 'Safari')
		{
			$engine = 'WebKit';
		}
		
		return array(
			'userAgent'	=>	$userAgent,
			'browser'	=>	$browser,
			'platform'	=>	$platform,
			'os'		=>	$os,
			'engine'	=>	$engine
			);
	}
	static public function MakePlatformSpecificFilenames($filePath)
	{
		//input 'public/theme/expression/images/style.less'
		//and it will return:
		//array(
		//		0 => 'public/theme/expression/images/style-mobile-chrome.less',
		//		1 => 'public/theme/expression/images/style-mobile.less',
		//		2 => 'public/theme/expression/images/style-chrome.less',
		//		2 => 'public/theme/expression/images/style.less'
		//		);
	}
	static public function GetRootDirectory()
	{
		return dirname(__FILE__);
	}
	public function __construct()
	{
		include(Windowpane::getRootDirectory().'/config/config-defaults.php');
		$this->Config = $Config;
		$this->db = new WMySQLDatabase();
		$currentPhase = $this->Config['Environment']['Phase'];
		$this->db->connect(
			$this->Config['Database'][$currentPhase]['Server'],
			$this->Config['Database'][$currentPhase]['Username'],
			$this->Config['Database'][$currentPhase]['Password'],
			$this->Config['Database'][$currentPhase]['Database']
			);
		$this->Platform = Windowpane::GetUserPlatform();
	}
	public function __destruct()
	{
		$this->db->disconnect();
	}
	public function direct($url)
	{
		$urlArray = array();
		$urlArray = explode("/",$url);
		$controller = $urlArray[0];
		$action = $urlArray[1];
		$queryString = $urlArray[2];
		$controllerName = $controller;
		$controller = ucwords($controller);
		$model = rtrim($controller, 's');
		//$controller .= "Controller";
		//$controller = $model;

		//Generate view
		$pageView = $this->generate("View");

		//Set view paths
		$pageView->setFile("/app/index.tpl");
		
		$dispatch = new $controller($model,$controllerName,$action);

		$pageView->content = $this->dispatch_with_fallback($dispatch, $action.$this->Platform['browser'], $action, $queryString);
		$pageView->title = $controller;
		
		//render view
		echo $pageView->render();
	}
	public function dispatch($object, $function, $data)
	{
		if ((int)method_exists(get_class($object), $function))
		{
			return call_user_func(array($object,$function),$data);
		}
		else
		{
			/* Error Generation Code Here */
		}
	}
	public function dispatch_with_fallback($object, $function, $fallback, $data)
	{
		if ((int)method_exists(get_class($object), $function))
		{
			return call_user_func(array($object,$function),$data);
		}
		else
		{
			if ((int)method_exists(get_class($object), $fallback))
			{
				return call_user_func(array($object,$fallback),$data);
			}
			else
			{
				/* Error Generation Code Here */
			}
		}
	}
	public function generate($type)
	{
		//if($name != null)
		{
			switch($type)
			{
				case "View":
					return new WView();
					break;
				case "Model":
					return new WModel();
					break;
				case "SQL":
					return new WMySQLDatabase();
					break;
			}
		}
		/*else
		{
			switch($type)
			{
				case "Controller":
					$controllerFile = $name . ".controller.php";
					if(file_exists(ROOT."/app/c/".$controllerFile))
					{
						require_once(ROOT."/app/c/".$controllerFile);
					}
					break;
				case "View":
					break;
				case "Model":
					break;
				case "SQL":
					return new WMySQL();
					break;
			}
		}*/
	}
}
?>