<?php

/**
 *   Cassowary - a territorial CAS client
 *
 * @author   Chuck Houpt <chuck@habilis.net>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */

// Setup
require_once 'cassowary-setup.php';

// force CAS authentication, if not already authenticated

if ( ! phpCAS::isAuthenticated()) {
	phpCAS::forceAuthentication();
}

// logout or re-login if requested

if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
} elseif (isset($_REQUEST['login'])) {
	phpCAS::logoutWithRedirectService($_SERVER["SCRIPT_URI"]);
}

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

$root = $_SERVER["DOCUMENT_ROOT"];
$path = realpath($root . $_SERVER["REDIRECT_URL"]);

// check that path exists and is a sub-path of root

if ($path !== FALSE && substr($path, 0, strlen($root)) === $root) {

	$file = file_get_contents( $path );
	
	// Extract additional cassowary-users from meta elements
	
	libxml_use_internal_errors(true); // suppress ill-formed HTML warnings
	
	$doc = new DOMDocument();
	$doc->loadHTML($file);
	$xpath = new DOMXPath($doc);
	$meta = $xpath->query("//meta[@name='cassowary-users']/@content");
	foreach ($meta as $content) {
		$cassowary_users  = array_merge($cassowary_users, preg_split("/\s+/", $content->value));
	}
	
	// Check that the current user is allowed access
	
	if (in_array(strtolower(phpCAS::getUser()), $cassowary_users)) {
		echo $file;
		if ($cassowary_show_debug) {
			echo "<pre>";
			echo "Cassowary Debug Info\nPath: " . $_SERVER["SCRIPT_URI"]
			. "\nUser: " . phpCAS::getUser()
			. "\nACL: " . implode(' ', $cassowary_users)
			. "\n<a href='/logout/'>Logout</a> <a href='?login'>Re-Login</a>";
			if (phpCAS::hasAttributes()) {
				echo "\nAttributes:\n";
				print_r (phpCAS::getAttributes());
			}
			echo "</pre>";
		}
	} else {
		header('HTTP/1.1 403 Forbidden'); // http_response_code(403);
		include('403.php');
	}
} else {
	header('HTTP/1.1 404 Not Found'); // http_response_code(404);
	include('404.php');
}