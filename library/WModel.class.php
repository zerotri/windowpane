<?php

class WModel
{
	public $id;
	public $data = array();
	public $template = array();
	private $type;
	public function __construct($type)
	{
		$this->type = $type;
	}
	public function getType()
	{
		return $this->type;
	}
	public function loadModel()
	{
		//$vars = WConfig::loadYAML("/app/".$model."/".$model.".yaml");
		//$vars[$this->type];
	}
	public function loadData($fields = "*", $first = 0, $count = 0)
	{
		global $windowpane;
		$fieldString = "";
		if(is_array($fields))
		{
			foreach($fields as $count => $field)
			{
				if(count == 0)
					$fieldString .= "$field";
				else
					$fieldString .= ", $field";
			}
		}
		else $fieldString = $fields;
		$queryString = "SELECT $fieldString FROM posts WHERE id >= $first ORDER BY id";
		if($count > 0)
		{
			$queryString = $queryString . " LIMIT $count";
		}
		$data = $windowpane->db->query($queryString);
		return $data;
	}
}
?>