<!DOCTYPE html>
<html>
	<head>
		<title>404 Not Found</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			html {
				height: 100%;
				background: url(/cassowary/casuarius.jpg) no-repeat center center;
				background-size: cover;
			}
			body {
				max-width: 40em;
				margin: auto;
				background-color: rgba(245,241,230,0.5);
			}
		</style>
	</head>
	<body>
		<h1>Not Found</h1>
		<p>The requested URL <?php echo $_SERVER["REQUEST_URI"] ?> was not found on this server.</p>
	</body>
</html>
