<?php

/**
 * mvcMini - An MVC skeleton framework for very small PHP projects.
 *
 * @package  mvcMini
 * @version  0.1.1
 * @author   Scott A. Murray <design@carbonvictory.com>
 * @link     http://github.com/carbonvictory/mvcmini
 */

// ----------------------------------------------------------------------------
// Set error reporting. E_ALL in development, 0 in production.
// ----------------------------------------------------------------------------

ini_set('display_errors', E_ALL);

// ----------------------------------------------------------------------------
// Define URL to web root, WITH trailing slash.
// ex. 'http://sitename.com/'
// ----------------------------------------------------------------------------

define('BASE_PATH', 'http://sitename.com/');

// ----------------------------------------------------------------------------
// Define paths to public asset directories, WITH trailing slash.
// ex. ASSET_DIR . 'ext/';
// ----------------------------------------------------------------------------

define('ASSET_DIR',	BASE_PATH . 'assets/');

define('IMAGE_DIR',	ASSET_DIR . 'img/');
define('CSS_DIR',	ASSET_DIR . 'css/');
define('JS_DIR',	ASSET_DIR . 'js/');

// ----------------------------------------------------------------------------
// Define path to app folder relative to www directory, WITH trailing slash.
// ----------------------------------------------------------------------------

define('APP_PATH', '../app/');

// ----------------------------------------------------------------------------
// Define path to core relative to www directory, WITH trailing slash.
// ----------------------------------------------------------------------------

define('CORE_PATH', '../core/');

// ----------------------------------------------------------------------------
// Define path to view, logic, and storage directories, WITH trailing slash.
// ----------------------------------------------------------------------------

define('VIEWS_DIR',		APP_PATH . 'views/');
define('LOGIC_DIR',		APP_PATH . 'logic/');
define('STORAGE_DIR',	APP_PATH . 'storage/');

// ----------------------------------------------------------------------------
// Start mvcMini.
// ----------------------------------------------------------------------------

require_once CORE_PATH . 'bootstrap.php';