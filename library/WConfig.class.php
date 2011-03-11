<?php
include (ROOT.'/includes/sfYaml.php');
function parseArray($inputname, $arraytoappend, $data)
{
	foreach($data as $key => $value)
	{
		if(is_array($value))
		{
			$branchName = $inputname.".$key";
			//$arraytoappend[$inputname] = array();
			$arraytoappend = parseArray($branchName, $arraytoappend, $value);
		}
		else
		{
			$branchName = $inputname.".$key";
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
		$vars = sfYaml::load($filename);
		$this->_variables = parseArray("windowpane",$this->_variables, $vars);
	}
	function __construct()
	{
		$this->loadConfig(ROOT.'/config/config.yaml');
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