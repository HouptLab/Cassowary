<?php

/**
 *   Cassowary - a territorial CAS client
 *
 * @author   Chuck Houpt <chuck@habilis.net>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link     http://wiki.jasig.org/display/CASC/phpCAS
 */

// Load the settings from the central config file
require_once 'config.php';
// Load the CAS lib
require_once $phpcas_path . '/CAS.php';

// Enable debugging
phpCAS::setDebug();

// Initialize phpCAS
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
phpCAS::setNoCasServerValidation();



// force CAS authentication, if not already authenticated

if ( ! phpCAS::isAuthenticated()) {
	phpCAS::forceAuthentication();
}

// logout or re-login if requested

if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
} elseif (isset($_REQUEST['login'])) {
	phpCAS::renewAuthentication();
}

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

$file = file_get_contents('../' . $_REQUEST['url']);

if ($file !== FALSE) {
	echo $file;
	echo "<pre>Cassowary Debug Info\nPath: ".$_REQUEST['url']
	."\nUser: ".phpCAS::getUser()
	."\n<a href='?logout'>Logout</a></pre>";
} else {
	header("HTTP/1.0 404 Not Found");
	echo '<html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL /'
	. $_REQUEST['url']
	. ' was not found on this server.</p></body></html>';
}

?>
