<?php

class WXML
{
	public $data = array();
	function __construct($name)
	{
		$data = array();
		$data['name'] = $name;
	}
	function element($name)
	{
		$elem = new WXML($name);
		$data[] = $elem;
		return $elem;
	}
	function attribute($name, $value)
	{
		$data[$name] = $value;
		return $this;
	}
};

?>