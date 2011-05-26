<?php

include('../config/inflection.php');
include('WHook.class.php');
include('WObject.class.php');
include('datastore/WDatastore.class.php');
include('datastore/WMySQLDatabase.class.php');
include('WUtil.class.php');
include('WModel.class.php');
include('WView.class.php');

class Windowpane
{
	public $Config;
	public $db;
	public $Platform;
	static public function GetUserPlatform()
	{
		$oses = array(
			'/macintosh|mac os x/i'		=> 'Mac',
			'/linux/i'					=> 'Linux',
			'/windows|win32/i'			=> 'Windows',
			'/android/i'				=> 'Android',
			'/iOS/i'					=> 'iOS'
			);
		$engines = array(
			'/webkit/i'					=> 'WebKit',
			'/gecko/i'					=> 'Gecko',
			'/trident/i'				=> 'Trident'
			);
		$browserStrings = array(
			'/Chrome/i'					=>	"Chrome",
			'/Safari/i'					=>	"Safari",
			'/Firefox/i'				=>	"Firefox",
			'/Opera/i'					=>	"Opera",
			'/MSIE/i'					=>	"InternetExplorer",
			'/Netscape/i'				=>	"Netscape"
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

		//Match OSes
		foreach ( $oses as $pattern => $result )
		{
			if ( preg_match( $pattern, $userAgent ) )
			{
				$os = $result;
				break;
			}
		}
		//determine platform based on os
		if( $os == 'Android' || $os == 'iOS' )
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
		if ( $browser == 'Chrome' || $browser == 'Safari' )
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
		return dirname(dirname(__FILE__));
	}
	public function __construct()
	{
		//load default config settings
		include(Windowpane::getRootDirectory().'/config/config-defaults.php');
		
		//load customized config settings, overriding the defaults
		include(Windowpane::getRootDirectory().'/config/config.php');
		$this->Config = $Config;
		
		//create the database class
		$this->db = new WMySQLDatabase();
		$currentPhase = $this->Config['Environment']['Phase'];
		
		//connect to the database using configuration options
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
		$pageView->setFile("/app/".$this->Config['Routing']['Defaults']['Application']."/index.tpl");

		include(Windowpane::getRootDirectory() . "/app/{$this->Config['Routing']['Defaults']['Application']}/{$controller}/{$controller}.php");
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