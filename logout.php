<?php

// Setup
require_once 'cassowary-setup.php';

// logout if necessary

if (phpCAS::isAuthenticated()) {
	phpCAS::logoutWithRedirectService(
		(empty($_SERVER["HTTPS"]) ? "http://" : "https://" )
		. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Logged Out</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
<?php if ($cassowary_show_pics): ?>
			html {
				height: 100%;
				background: url(<?php echo $cassowary_dir ?>/casuarius-egg.jpg) no-repeat center center;
				background-size: cover;
			}
<?php endif ?>
			body {
				max-width: 40em;
				margin: auto;
				background-color: rgba(255,255,255,0.5);
			}
		</style>
	</head>
	<body>
		<h1>Logout successful</h1>
		<p>You have successfully logged out.
		<P><a href="<?php echo $cassowary_parent ?>/login/">Click here to login to <strong><?php echo $_SERVER["HTTP_HOST"] ?></strong> again</a>
		<p>For security reasons, exit your web browser.
	</body>
</html>
