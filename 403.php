<!DOCTYPE html>
<html>
	<head>
		<title>403 Forbidden</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
<?php if ($cassowary_show_pics): ?>
			html {
				height: 100%;
				background: url(<?php echo $cassowary_dir ?>/casuarius.jpg) no-repeat center center;
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
		<h1>Access Forbidden</h1>
		<p>Access to the requested URL <?php echo $_SERVER["REQUEST_URI"] ?>
		   is forbidden for the user: <?php echo phpCAS::getUser() ?></p>
		<p><a href='<?php echo $cassowary_parent ?>/logout/'>Logout</a></p>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackEvent', 'Error', 'AccessForbidden', '<?php echo phpCAS::getUser() ?>']);
  //_paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://piwik.houptlab.org/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="https://piwik.houptlab.org/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
	</body>
</html>
