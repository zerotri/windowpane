<?php

class WView
{
	private $vars = array();
	private $path = "";
	public function __set($var, $val)
	{
		$this->vars[$var] = $val;
	}
	public function __get($var)
	{
		return $this->vars[$var];
	}
	public function setFile($file)
	{
		$this->path = Windowpane::getRootDirectory() . $file;
	}
	public function render()
	{
		if ($this->path == "") 'No template specified';
		if (file_exists($this->path) == false)
		{
			throw new Exception('Template not found: '. $this->path);
			return 'Template not found: '. $this->path;
		}
        extract($this->vars);
        ob_start();
        include($this->path);
        return ob_get_clean();
	}
}

?>