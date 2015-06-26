<!DOCTYPE html>
<html>
	<head>
		<title>403 Forbidden</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
<?php if ($cassowary_show_pics): ?>
			html {
				height: 100%;
				background: url(/cassowary/casuarius.jpg) no-repeat center center;
				background-size: cover;
			}
<?php endif ?>
			body {
				max-width: 40em;
				margin: auto;
				background-color: rgba(245,241,230,0.5);
			}
		</style>
	</head>
	<body>
		<h1>Access Forbidden</h1>
		<p>Access to the requested URL /<?php echo $_SERVER["REQUEST_URI"] ?>
		   is forbidden for the user: <?php echo phpCAS::getUser() ?></p>
		<p><a href='/logout/'>Logout</a></p>
	</body>
</html>
