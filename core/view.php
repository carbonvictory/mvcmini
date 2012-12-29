<?php

/**
 * View handler.
 *
 * Views are invoked in a controller function by calling
 * View::show(), with the name of the view as the first argument.
 *
 * An array of data can optionally be passed - the array values 
 * are extract()ed.
 *
 * <code>
 *
 *      // loads the view called view_name.php
 *      View::show('view_name');
 *
 *      // loads the view called test.php in the /views subfolder /common
 *      View::show('common/test');
 *
 *      // loads the view called view_name.php and creates
 *      // a variable $foo with a value of 'test' that can
 *      // be used in the view
 *
 *      View::show('view_name', array('foo' => 'test'));
 *
 * </code>
 *
 * You may also load a view from another view using the same syntax:
 *
 * <code>
 *
 *      <?php View::show('view_name'); ?>
 *      <p>Your view HTML.</p>
 *
 * </code>
 *
 * @package		mvcMini
 * @author		Scott A. Murray <design@carbonvictory.com>
 */
class View {

	/**
	 * Renders a view to the browser.
	 *
	 * @param   string  $view_name
	 * @param   array   $data
	 * @return  void
	 */
	public static function show($view_name, $data = NULL)
	{
		if (is_array($data)) extract($data);
		
		$view_path = VIEWS_DIR . self::_clean($view_name) . '.php';
		if ( ! file_exists($view_path)) error(500, "Missing view '$view_path'");
		require_once $view_path;
	}
	
	/**
	 * Sanitizes a view name by stripping out everything but
	 * letters, numbers, underscores, and forward slashes.
	 *
	 * @param   string  $view_name
	 * @return  string
	 */
	private static function _clean($view_name = '')
	{
		return preg_replace('/[^\w\/]/', '', $view_name);
	}
	
}