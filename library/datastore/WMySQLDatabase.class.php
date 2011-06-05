<?php

class WMySQLDatabase
{
	protected $_dbLink;

	function __construct() {
	}
	function __destruct() {
	}
	// Control
	function connect($host, $user, $pass, $database)
	{
		$this->_dbLink = mysql_connect($host, $user, $pass);
		mysql_select_db($database, $this->_dbLink);
		if($this->_dbLink == false)
		{
			die(mysql_error());
		}
	}
	function disconnect()
	{
		mysql_close($this->_dbLink);
	}
	function query($string)
	{
		$data = array();
		if ($queryresult = mysql_query($string, $this->_dbLink))
		{
			while($line = mysql_fetch_assoc($queryresult))
			{
				$data[] = $line;
			}
			return $data;
		}
		else
		{
			die(mysql_error());
		}
	}
		
}
?>