<?php

class View {

	public static function make($view_name, $data = NULL)
	{
		if (is_array($data)) extract($data);
		
		$view_name = preg_replace('/[^\w\/]/', '', $view_name);
		$view_path = APP_PATH . 'views/' . $view_name . '.php';
		if ( ! file_exists($view_path))
		{
			header('HTTP/1.1 500');
			die("Missing view '$view_name'");
		}
		require_once $view_path;
	}
	
}