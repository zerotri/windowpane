<?php
class Posts extends WController
{
	public function view($id = null)
	{
		return $this->render();
	}
	public function viewChrome($id = null)
	{
		return "Using Google Chrome!";
	}
}
?>