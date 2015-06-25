<?php

// Setup
require_once '../cassowary/cassowary-setup.php';

// force CAS authentication

if (phpCAS::isAuthenticated()) {
	phpCAS::logoutWithRedirectService($_SERVER["SCRIPT_URI"]);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>403 Forbidden</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			html {
				height: 100%;
				background: url(/cassowary/casuarius-egg.jpg) no-repeat center center;
				background-size: cover;
			}
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
		<P><a href="/login/">Click here to login again</a>
		<p>For security reasons, exit your web browser.
	</body>
</html>
