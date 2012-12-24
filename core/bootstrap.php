<?php

// --------------------------------------------------------------
// Load the view, logic, and storage handlers.
// --------------------------------------------------------------

require_once 'view.php';
require_once 'logic.php';
require_once 'storage.php';

// --------------------------------------------------------------
// Init request router.
// --------------------------------------------------------------

require_once 'router.php';

// --------------------------------------------------------------
// Load defined routes and controllers.
// --------------------------------------------------------------

require_once APP_PATH . 'routes.php';

// --------------------------------------------------------------
// Route the request and call the appropriate controller.
// --------------------------------------------------------------

$uri = (isset($_GET['mvcminiuri'])) ? $_GET['mvcminiuri'] : NULL;
Router::route_request($uri);