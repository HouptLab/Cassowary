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

$cassowary_all_users = false;	

$root = $_SERVER["DOCUMENT_ROOT"];
$path = realpath($root . $_SERVER["REDIRECT_URL"]);

// check that path exists and is a sub-path of root

if ($path !== FALSE && substr($path, 0, strlen($root)) === $root) {

	$file = file_get_contents( $path );
	$file_contentlength = filesize( $path );

	if (pathinfo($path, PATHINFO_EXTENSION) === "pdf") {
		$file_contenttype = "application/pdf";	
		
		// Extract additional cassowary-users from .cassowary_users
		$dotfile = file_get_contents(dirname($path) . '/.cassowary_users');
		if ($dotfile) {
			$cassowary_users  = array_merge($cassowary_users, preg_split("/\s+/", $dotfile));
		}
	} else {
		$file_contenttype = "text/html";
	
		// Extract additional cassowary-users from meta elements
	
		libxml_use_internal_errors(true); // suppress ill-formed HTML warnings
	
		$doc = new DOMDocument();
		$doc->loadHTML($file);
		$xpath = new DOMXPath($doc);
		$meta = $xpath->query("//meta[starts-with(@name,'cassowary-')]");

		foreach ($meta as $m) {
			$content = $m->getAttribute('content');
			switch ($m->getAttribute('name')) {
			case 'cassowary-users':
				$cassowary_users = array_merge($cassowary_users, preg_split("/\s+/", $content));
				break;
			case 'cassowary-only-users':
				$cassowary_users = preg_split("/\s+/", $content);
				break 2;
			case 'cassowary-all-users':
				$cassowary_all_users = true;
				break 2;
			}
		}
	}
	
	// Check that the current user is allowed access
	
	if ($cassowary_all_users || in_array(strtolower(phpCAS::getUser()), $cassowary_users)) {
		header('Content-Type: ' . $file_contenttype);
		header("Content-Length: " . $file_contentlength);
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
		http_response_code(403);
		include('403.php');
	}
	
} else {
	http_response_code(404);
	include('404.php');
}