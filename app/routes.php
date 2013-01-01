<?php 

/**
 * Define your routes and controller methods here.
 * You may define a route for any URI, WITHOUT leading or trailing slashes.
 *
 * Routes are matched from first to last, so put more specific routes first.
 * When a page request is made that matches one of your defined routes, that 
 * route's closure is executed. This can include showing views, importing logic
 * modules, or anything else you can normally do with PHP.
 *
 * <code>
 *
 *      Route::set('uri/segments', function() 
 *      {
 *           // controller logic
 *      });
 *
 * <code>
 *
 * You also have access to three wildcard tokens:
 *
 * <ul>
 *      <li>(:num) matches numbers only
 *      <li>(:abc) matches letters only
 *      <li>(:any) matches letters, numbers, dashes, plusses, periods, underscores
 * </ul>
 *
 * Wildcard values are passed to the controller function in order of their 
 * appearance in the route URI.
 * 
 * <code>
 *
 *      Route::set('articles/(:num)/(:abc)', function($id, $slug)
 *      {
 *           // value of (:num) supplied as $id
 *           // value of (:abc) supplied as $slug
 *      });
 *
 * </code>
 */

Route::set('/', function()
{
	// You MUST define a route for this URI ('/'), though you're free to change
	// this controller's logic and any views rendered.
	// Your site will default to this route if the user does not supply a URI, 
	// such as when visiting your site's home page (ex. http://yoursite.com/).
	
	View::show('welcome');
});