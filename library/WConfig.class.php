<?php
include(Windowpane::getRootDirectory().'/includes/sfYaml.php');
function parseArray($inputname, $arraytoappend, $data)
{
	global $windowpane;
	foreach($data as $key => $value)
	{
		if(is_array($value))
		{
			if($inputname != "")
				$branchName = $inputname.".$key";
			else
				$branchName = $inputname."$key";
			//$arraytoappend[$inputname] = array();
			$arraytoappend = parseArray($branchName, $arraytoappend, $value);
		}
		else
		{
			if($inputname != "")
				$branchName = $inputname.".$key";
			else
				$branchName = $inputname."$key";
			$value = preg_replace( "/\{root\}/i", Windowpane::GetRootDirectory(), $value);
			$arraytoappend[$branchName] = $value;
		}
	}
	return $arraytoappend;
}
class WConfig
{
	public $_variables = array();
	public static function loadYAML($filename)
	{
		return sfYaml::load($filename);
	}
	function loadConfig($filename)
	{
		include(Windowpane::getRootDirectory().'/config/config-defaults.php');
		$this->Config = $Config;
		$vars = sfYaml::load($filename);
		$this->_variables = parseArray("",$this->_variables, $vars);
	}
	function __construct()
	{
		$this->loadConfig(Windowpane::getRootDirectory().'/config/config.yaml');
	}
	function get($name)
	{
	    switch($name)
	    {
	        default: $value = $this->_variables[$name];
	            break;
	    }
        return $value;
	}
	function set($name, $value)
	{
		$this->_variables[$name] = $value;
	}
};

?>