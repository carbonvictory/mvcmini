<?php

// --------------------------------------------------------------
// Defines the framework's logic handler.
//
// Since mvcMini is geared toward very small web projects, it
// does not differentiate between models, libraries, helpers,
// or extensions. Instead, application logic is stored in
// modules in the app/logic/ directory. Each module is a
// self-contined class that contains one or more properties
// or methods encapsulating some of the app's business logic.
// The class name must capitalized and have '_module' at the end, 
// and the file must share the class's name (without '_module'). 
// 
// For example, a logic module named validation.php must
// only contain a class called Validation_logic.
//
// In a route controller, you can call Logic::import($module),
// passing the name of the logic module to the function. You
// can optionally pass any configuration parameters as an array,
// which will get passed to any class constructors.
//
// Doing so allows you to access the loaded logic module in
// a route controller via Logic::module($module)->[...].
//
// So, if you wanted to import your validation module, you'd
// call Logic::import('validation') in your controller method,
// and access the class through Logic::module('validation').
// --------------------------------------------------------------

class Logic {

	public static $modules = array();
	
	public static function import($module, $params = NULL)
	{
		$module = strtolower(preg_replace('/[^\w\/]/', '', $module));
		$module_path = APP_PATH . 'logic/' . $module . '_logic.php';
		if ( ! file_exists($module_path))
		{
			header('HTTP/1.1 500');
			die("Missing logic module '$module'");
		}
		require_once $module_path;
		
		$module_class_name = ucwords($module);
		$modules[$module] = new $module_class_name($params);
	}
	
	public static function module($module)
	{
		return $modules[$module];
	}
	
}