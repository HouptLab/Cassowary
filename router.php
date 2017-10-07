<?php

// Report all errors in the browser, since we are debugging
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

if ( PHP_SAPI != 'cli-server' ) {
	die( "This script can only be run by php's cli-server sapi." );
}

$cas_host = 'cassid.habilis.net';
$cas_context = '/';
$cas_port = 443;

if (! isset($router_protect)) $router_protect = '/.*/';

if (! preg_match($router_protect, $_SERVER["REQUEST_URI"])
	|| preg_match('/\.(?:svg|png|jpg|jpeg|gif|css|js|php)$/', $_SERVER["SCRIPT_NAME"])) {
    return false;    // serve the requested resource as-is.
} elseif ($_SERVER["REQUEST_URI"] == '/logout/') {
    include __DIR__ . '/logout.php';
    return true;
} else {
$_SERVER["REDIRECT_URL"] = $_SERVER["SCRIPT_NAME"];
    include __DIR__ . '/cassowary.php';
    return true;
}
