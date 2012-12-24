<?php

// --------------------------------------------------------------
// The abstract class Route enables the creation of routes and
// route controller functions in app/routes.php.
//
// Route::make() is a wrapper for Router::define_route().
// --------------------------------------------------------------

class Route {

	/**
	 * Wrapper for the Router class's define_route method.
	 *
	 * @access  public
	 * @param   string   $uri
	 * @param   closure  $controller_logic
	 * @return  void
	 */
	public static function make($uri, $controller_logic) {
		Router::define_route($uri, $controller_logic);
	}

}

// --------------------------------------------------------------
// The Router class is the backbone of the framework.
// --------------------------------------------------------------

class Router {
	
	protected static $routes = array();
	protected static $controller_params = array();
	protected static $controller_function = NULL;
	
	protected static $wildcards = array(
		'(:num)',
		'(:abc)',
		'(:any)'
	);
	
	protected static $regexes = array(
		'([\d]+)',
		'([\A-Za-z]+)',
		'([\w]+)'
	);
	
	public static function define_route($uri, $controller_logic = NULL)
	{
		if ( ! static::_is_valid_controller($controller_logic)) { 
			header('HTTP/1.1 500');
			die("Invalid controller method defined for route '$uri'");
		}
		$clean_uri = preg_replace('/[^\w\/\(\)\:]/', '', $uri);
		static::$routes[$clean_uri] = $controller_logic;
	}
	
	public static function route_request($uri)
	{
		if ($uri === NULL)
		{
			call_user_func_array(static::$routes['/'], static::$controller_params);
		}
		else
		{
			if ( ! static::_match_route(rtrim($uri, '/')))
			{
				header('HTTP/1.1 404');
				die();
			}
			
			ob_start();
			call_user_func_array(static::$controller_function, static::$controller_params);
			ob_end_flush();
		}
	}
	
	protected static function _has_routes()
	{
		return !empty(static::$routes);
	}
	
	protected static function _match_route($uri)
	{
		if (static::_has_routes())
		{
			foreach (static::$routes as $route_uri => $controller_logic)
			{
				$pattern = '|^' . $route_uri . '$|';
				$pattern = str_replace(static::$wildcards, static::$regexes, $pattern);
				
				if (preg_match($pattern, $uri, $matches) > 0)
				{
					static::$controller_function = $controller_logic;
					static::_set_params($matches);
					return TRUE;
				}
			}
		}

		return FALSE;
	}
	
	protected static function _set_params($matches)
	{
		array_shift($matches);
		static::$controller_params = ( ! empty($matches)) ? $matches : array();
	}
	
	protected static function _is_valid_controller($controller = NULL)
	{
		return (is_callable($controller) AND $controller !== NULL);
	}

}