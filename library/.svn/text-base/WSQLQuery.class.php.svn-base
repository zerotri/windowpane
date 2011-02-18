<?php

class WSQLQuery {
	protected $_type=0;	// query type:
	                    // 0: None
						// 1: CREATE/DROP [TABLE] [PARAMETERS]
						// 2: UPDATE [TABLE] SET [FIELDS] WHERE [CONDITION]
						// 3: INSERT INTO [TABLE(FIELDS)] VALUES [VALUES]
						// 4: SELECT/DELETE [FIELDS] FROM [TABLE] WHERE [CONDITION]
						//
	protected $_id=0;

	protected $_operation="";
	protected $_parameters="";
	protected $_condition="";
	protected $_order="";
	protected $_join="";
	
	protected $_dbLink;
	
	protected $_query;

	function __construct() {
		$this->_type = 0;
		$this->_operation = "";
		$this->_parameters = "";
		$this->_condition = "";
		$this->_order = "";
		$this->_join = "";
		$this->_query = "";
	}
	function __destruct() {
	}
	// Control
	function connect($host, $user, $pass)
	{
		$_dbLink = mysql_connect($host, $user, $pass);
	}
	function disconnect()
	{
		mysql_close($_dbLink);
	}
	
	// Operations
	function create($table)
	{
		$this->_type = 1;
		$this->_operation = "CREATE ".$table;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	function drop($table)
	{
		$this->_type = 1;
		$this->_operation = "DROP ".$table;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	
	//
	function select($fields)
	{
		$this->_type = 4;
		$this->_operation = "SELECT ".$fields;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	function delete($fields)
	{
		$this->_type = 4;
		$this->_operation = "DELETE ".$fields;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	function insert()
	{
		$this->_type = 4;
		$this->_operation = "DELETE ".$fields;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	function update($table)
	{
		$this->_type = 2;
		$this->_operation = "UPDATE ".$table;
		$this->_condition = "";
		$this->_parameters = "";
		$this->_join = "";
		return $this;
	}
	function set($fields)
	{
	    if($_type == 2)
			$_parameters = " SET " . $fields;
		return $this;
	}
	function from($table)
	{
	    if($this->_type == 4)
			$this->_parameters = " FROM " . $table;
		return $this;
	}
	function where($condition)
	{
	    if(($this->_type == 2) || ($this->_type == 4))
		{
			$this->_condition = " WHERE " . $condition;
		}
		return $this;
	}
	function orderBy($field)
	{
		if($this->_type == 4)
			$this->_order = " ORDER BY " .$field;
		return $this;
	}
	function getQuery()
	{
		return	  $this->_operation
		 		. $this->_parameters
		 		. $this->_condition
		 		. $this->_join
		 		. $this->_order;
	}
	function execute()
	{
		
	}
		
}
?>