<?php

/**
 * The Route class enables the creation of routes and route controller
 * functions in app/routes.php.
 *
 * @package		mvcMini
 * @author		Scott A. Murray <design@carbonvictory.com>
 */
class Route {

	/**
	 * Wrapper for the Router class's define_route() method.
	 *
	 * @param   string   $uri
	 * @param   closure  $controller_logic
	 * @return  void
	 */
	public static function set($uri, $controller_logic)
	{
		Router::define_route($uri, $controller_logic);
	}
	
	/**
	 * Wrapper for the Router class's redirect() method.
	 *
	 * @param   string   $uri
	 * @return  void
	 */
	public static function redirect($destination_uri)
	{
		Router::redirect($destination_uri);
	}

}

/**
 * The Router class directs page requests, validates and sets routes
 * defined in app/routes.php, and executes controller functions.
 *
 * @package		mvcMini
 * @author		Scott A. Murray <design@carbonvictory.com>
 */
class Router {
	
	/**
	 * Stores all the defined routes for the site and their 
	 * controller functions.
	 *
	 * @var array
	 */
	private static $routes = array();
	
	/**
	 * Stores the parameters passed to the current request's controller.
	 *
	 * @var array
	 */
	private static $controller_params = array();
	
	/**
	 * Stores the current request's controller function.
	 *
	 * @var closure
	 */
	private static $controller_function = NULL;
	
	/**
	 * Stores the available route URI wildcards.
	 *
	 * @var array
	 */
	private static $wildcards = array(
		'(:num)',
		'(:abc)',
		'(:any)'
	);
	
	/**
	 * Stores the regexes to which the above wildcards are converted.
	 * Defined in the same order as the wildcards above.
	 *
	 * @var array
	 */
	private static $regexes = array(
		'([\d]+)',
		'([A-z]+)',
		'([\w\+\-\.]+)'
	);
	
	/**
	 * Validates and defines a route declared in app/routes.php.
	 *
	 * @param   string    $uri
	 * @param   closure   $controller_logic
	 * @return  void
	 */
	public static function define_route($uri, $controller_logic)
	{
		if ( ! is_callable($controller_logic)) error(500, "Invalid controller for '$uri'");
		self::$routes[self::_clean($uri)] = $controller_logic;
	}
	
	/**
	 * Routes the current page request.
	 * If a route has been defined for the given URI, call its associated
	 * controller function. If no route is found, throw a 404 error.
	 *
	 * If no URI is passed, default to the home route ('/');
	 *
	 * @param   string    $uri
	 * @return  void
	 */
	public static function route_request($uri = NULL)
	{
		if (is_null($uri))
		{
			call_user_func_array(self::$routes['/'], self::$controller_params);
		}
		else
		{
			if ( ! self::_match_route(rtrim($uri, '/'))) error(404);
			
			ob_start();
			call_user_func_array(self::$controller_function, self::$controller_params);
			ob_end_flush();
		}
	}
	
	/**
	 * Redirects to the given URI.
	 *
	 * @param   string   $destination_uri
	 * @return  void
	 */
	public static function redirect($destination_uri)
	{
		header('Location:' . BASE_PATH . self::_clean($destination_uri));
		exit();
	}
	
	/**
	 * Checks if any routes were defined for the site.
	 *
	 * @return bool
	 */
	private static function _has_routes()
	{
		return ( ! empty(self::$routes));
	}
	
	/**
	 * Attempts to match the current page request with one of the defined routes.
	 * Returns TRUE if a match was made and its controller function was set up,
	 * FALSE if no match could be found.
	 *
	 * @param   string   $uri
	 * @return  bool
	 */
	private static function _match_route($uri)
	{
		if (self::_has_routes())
		{
			foreach (self::$routes as $route_uri => $controller_logic)
			{
				$pattern = '|^' . $route_uri . '$|';
				$pattern = str_replace(self::$wildcards, self::$regexes, $pattern);
				
				if (preg_match($pattern, $uri, $matches) > 0)
				{
					self::$controller_function = $controller_logic;
					self::_set_params($matches);
					return TRUE;
				}
			}
		}

		return FALSE;
	}
	
	/**
	 * Sets the parameters to be passed to the current request's controller function.
	 *
	 * @param   array   $matches
	 * @return  void
	 */
	private static function _set_params($matches)
	{
		array_shift($matches);
		self::$controller_params = ( ! empty($matches)) ? $matches : array();
	}
	
	/**
	 * Sanitizes a route URI.
	 *
	 * @param   string   $uri
	 * @return  bool
	 */
	private static function _clean($uri)
	{
		return preg_replace('/[^\w\/\(\)\:\+\-]/', '', $uri);
	}

}