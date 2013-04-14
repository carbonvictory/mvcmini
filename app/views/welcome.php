<!doctype html>

<head>

	<title>mvcMini</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
	<link rel="stylesheet" href="<?=CSS_DIR?>welcome.css" media="screen">

</head>

<body>
	
	<article>
	
		<h1>Welcome to <span>mvcMini</span>.</h1>
		
		<p>You're looking at the <strong>default welcome view</strong>. You'll find the file for this view at:</p>
		<pre><?php echo realpath(VIEWS_DIR . 'welcome.php'); ?></pre>
		
		<p>This view is called from a controller method defined in:</p>
		<pre><?php echo realpath(APP_PATH . 'routes.php'); ?></pre>
	
	</article>

</body>

</html>