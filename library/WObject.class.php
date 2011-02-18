<?php

class WObject {

	protected $_type;
	protected $_id;
	protected $_variables;

	function __construct() {
		
		global $inflect;

		$this->_variables = array();
	}

	function __set($name,$value) {
	    $var = WHook::call("wobject_set_value", $name, $value);
	    if(isset($var))
	    {
	        $value = $var;
	    }
	    switch($name)
	    {
			//id should be generated automatically in construction and should be read only
	        case "id": //$this->_id = $value;
	            break;
	        default: $this->_variables[$name] = $value;
	            break;
	    }
	}
	function __get($name) {
	    switch($name)
	    {
	        case "id": $value = $this->_id;
	            break;
	        default: $value = $this->_variables[$name];
	            break;
	    }
        $var = WHook::call("wobject_get_value", array($name));
        if(isset($var))
	    {
	        $value = $var;
	    }
        return $value;
	}

	function __destruct() {
	}
		
}
?>