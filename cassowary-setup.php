<?php

/**
 *   Cassowary - a territorial CAS client
 *
 * @author   Chuck Houpt <chuck@habilis.net>
 * @license  http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */

// Load the settings
require_once 'config.php';

$cassowary_dir = dirname($_SERVER['SCRIPT_NAME']);
$cassowary_parent = dirname($cassowary_dir);
$cassowary_parent = $cassowary_parent == '/' ? '' : $cassowary_parent;

// Load the CAS lib and any other dependencies
require_once 'vendor/autoload.php';
	
// Enable debugging
//phpCAS::setDebug();

// Initialize phpCAS
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

if (isset($cas_server_ca_cert_path)) {
	// For production use set the CA certificate that is the issuer of the cert
	// on the CAS server and uncomment the line below
	phpCAS::setCasServerCACert($cas_server_ca_cert_path);
} else {
	// For quick testing you can disable SSL validation of the CAS server.
	// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
	// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
	phpCAS::setNoCasServerValidation();
}