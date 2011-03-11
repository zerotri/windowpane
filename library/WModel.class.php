<?php

class WModel
{
	public $data = array();
	public $template = array();
	public function loadModel($filename)
	{
		$vars = WConfig::loadYAML($filename);
		//foreach()
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