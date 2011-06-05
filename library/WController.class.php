<?php

class WController
{
	protected $model;
	protected $controller;
	protected $action;
	protected $view;

	function __construct($model, $controller, $action)
	{
		global $windowpane;
		//set controller and action variables
		$this->controller = $controller;
		$this->action = $action;
		$vars = Inflection::pluralize($model);

		//create new model
		$this->model = new WModel($model);
		$this->view = $windowpane->generate("View");
		$appfolder = ucwords($controller);
		$this->view->setFile("/app/{$windowpane->Config['Routing']['Defaults']['Application']}/$appfolder/$action.tpl");
		$properData = array();
		$viewData = $this->model->loadData();
		foreach($viewData as $index => $row)
		{
			$object = new WObject($model,$row['id']);
			foreach($row as $key => $value)
			{
				$object->$key = $value;
			}
			$properData[$index] = $object;
		}
		$this->view->$vars = $properData;
	}

	function set($name,$value) {
	debug_func($this,"set");
		$this->view->$name = $value;
	}

	function render() {
			return $this->view->render();
	}
}

?>