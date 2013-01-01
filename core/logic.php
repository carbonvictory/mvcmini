<?php

/**
 * Logic handler.
 *
 * Since mvcMini is geared toward very small web projects, it does not
 * differentiate between models, libraries, helpers, or extensions. Instead,
 * application logic is stored in modules in the app/logic directory. Each
 * module is a self-contined class that contains one or more properties or 
 * methods encapsulating some of the site's business logic.
 *
 * The class name must have only its first letter capitalized, have '_logic' at
 * the end, and the file must share the class's name (without '_logic'), 
 * all lowercase. 
 * 
 * For example, a logic module named validation.php must only contain a class
 * called Validation_logic.
 *
 * In a route controller, you can call Logic::import(), passing the name of the
 * logic file to the function. Doing so allows you to access the loaded logic 
 * module in a route controller via Logic::module_name()->[...]. 
 
 * You can optionally pass any configuration parameters as an array, which will
 * get passed to any class constructors (also as an array). 
 *
 * <code>
 *
 *      // import validation.php logic module
 *      Logic::import('validation');
 *
 *      // import module with parameters
 *      $config['foo'] = 'bar';
 *      $config['baz'] = 'sus';
 *      Logic::import('validation', $config);
 *
 *      // call one of the imported module's methods
 *      Logic::validation()->foo();
 *
 *      // mvcMini allows you to import modules in subfolders
 *      Logic::import('tools/validation');
 *      Logic::validation()->bar();
 *
 * </code>
 *
 * @package		mvcMini
 * @author		Scott A. Murray <design@carbonvictory.com>
 */
class Logic {

	/**
	 * Stores all the currently loaded logic modules.
	 *
	 * @var array
	 */
	public static $modules = array();
	
	/**
	 * Imports a logic module.
	 *
	 * @param   string  $module_name
	 * @param   array   $params
	 * @return  void
	 */
	public static function import($module_name, $params = NULL)
	{
		$module_name = self::_clean($module_name);
		
		$module_path = LOGIC_DIR . $module_name . '.php';
		if ( ! file_exists($module_path)) error(500, "Missing logic module '$module_name'");
		require_once $module_path;
		
		$module_name = explode('/', $module_name);
		$module_name = array_pop($module_name);
		$module_class_name = ucwords($module_name) . '_logic';
		self::$modules[$module_name] = new $module_class_name($params);
	}
	
	/**
	 * Calls a logic module.
	 *
	 * Returns an object if the module has been loaded, throws a 500 error if 
	 * the module can't be found.
	 *
	 * Second parameter $parameters is unused, but required as per __callStatic().
	 *
	 * @param   string   $module_name
	 * @return  mixed
	 */
	public static function __callStatic($module_name, $parameters = NULL)
	{
		if (array_key_exists($module_name, self::$modules))
		{
			return self::$modules[$module_name];
		}
		
		error(500, "Missing logic module '$module_name'");
	}
	
	/**
	 * Sanitizes a module name.
	 *
	 * @param   string  $module_name
	 * @param   array   $params
	 * @return  void
	 */
	private static function _clean($module_name)
	{
		return strtolower(preg_replace('/[^\w\/]/', '', $module_name));
	}
	
}