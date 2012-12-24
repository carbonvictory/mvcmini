<?php 

// --------------------------------------------------------------
// Define your routes and controller methods here.
//
// 		Route::make($uri, $controller_logic);
//
// 		Route::make('uri/segments', function() 
// 		{
// 			// controller logic
// 		});
//
// Wildcard values passed to controller in order of appearance.
// 
// 		Route::make('articles/(:num)', function($id)
// 		{
// 			// value of (:num) supplied as $id
// 		});
// --------------------------------------------------------------

Route::make('/', function()
{
	View::make('welcome');
});