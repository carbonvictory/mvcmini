<?php

/**
 * mvcMini - An MVC skeleton for very small PHP projects.
 *
 * @package  mvcMini
 * @version  1.0
 * @author   Scott A. Murray <design@carbonvictory.com>
 * @link     http://github.com/carbonvictory/mvcmini
 */

// --------------------------------------------------------------
// Set error reporting. E_ALL in development, OFF in production.
// --------------------------------------------------------------

ini_set('display_errors', E_ALL);

// --------------------------------------------------------------
// Define URL to web root, WITH trailing slash.
// ex. 'http://localhost/site_name/www/'
// --------------------------------------------------------------

define('BASE_PATH',	'http://localhost:8080/mvcmini/www/');

// --------------------------------------------------------------
// Define paths to public asset directories, WITH trailing slash.
// ex. ASSET_DIR . 'ext/';
// --------------------------------------------------------------

define('ASSET_DIR',	BASE_PATH . 'assets/');
define('IMAGE_DIR', ASSET_DIR . 'img/');
define('CSS_DIR', 	ASSET_DIR . 'css/');
define('JS_DIR', 	ASSET_DIR . 'js/');

// --------------------------------------------------------------
// Define path to /app folder relative to /www directory,
// WITH trailing slash.
// --------------------------------------------------------------

define('APP_PATH', '../app/');

// --------------------------------------------------------------
// Define path to framework core relative to /www directory,
// WITH trailing slash.
// --------------------------------------------------------------

define('CORE_PATH',	'../core/');

// --------------------------------------------------------------
// Define path to data storage directory, WITH trailing slash.
// --------------------------------------------------------------

define('STORAGE_PATH',	APP_PATH . 'storage/');

// --------------------------------------------------------------
// Start mvcMini.
// --------------------------------------------------------------

require_once CORE_PATH . 'bootstrap.php';