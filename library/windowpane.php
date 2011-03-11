<?php
include('WHook.class.php');
include('WObject.class.php');
include('WMySQL.class.php');
include('WUtil.class.php');
include('WModel.class.php');
include('WConfig.class.php');
include('WView.class.php');

class Windowpane
{
	public $config;
	public $db;
	public function __construct()
	{
		$this->config = new WConfig();
		$this->db = new WMySQL();
		$this->db->connect("127.0.0.1:3306","root","root", "windowpane");
	}
	public function __destruct()
	{
		$this->db->disconnect();
	}
	public function generate($type)
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
				return new WMySQL();
				break;
		}
	}
}
?>