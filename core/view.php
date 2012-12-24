<?php

/**
* View handler.
*
* Views are invoked in a controller function by calling
* Route::make(), with the name of the view as the first argument.
*
* An array of data can optionally be passed - the array values 
* are extract()ed.
*
* <code>
*
*      // loads the view called view_name.php
*      Route::make('view_name');
*
*      // loads the view called test.php in the views/ subfolder common/
*      Route::make('common/test');
*
*      // loads the view called view_name.php and creates
*      // a variable $foo with a value of 'test' that can
*      // be used in the view
*
*      Route::make('view_name', array('foo' => 'test'));
*
* </code>
*
* @package		mvcMini
* @author		Scott A. Murray <design@carbonvictory.com>
* @link			https://github.com/carbonvictory/mvcmini
*/
class View {

	/**
	 * Renders a view to the browser.
	 *
	 * @param   string  $view_name
	 * @param   array   $data
	 * @return  void
	 */
	public static function make($view_name, $data = NULL)
	{
		if (is_array($data)) extract($data);
		
		$view_path = VIEWS_DIR . static::_clean($view_name) . '.php';
		if ( ! file_exists($view_path))
		{
			header('HTTP/1.1 500 Server Error');
			die("Missing view '$view_path'");
		}
		require_once $view_path;
	}
	
	/**
	 * Sanitizes a view name by stripping out everything but
	 * letters, numbers, underscores, and forward slashes.
	 *
	 * @param   string  $view_name
	 * @return  string
	 */
	protected static function _clean($view_name = '')
	{
		return preg_replace('/[^\w\/]/', '', $view_name);
	}
	
}