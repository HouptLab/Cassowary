<?php

///////////////////////////////////////
// Basic Config of the phpCAS client //
///////////////////////////////////////

// Full Hostname of your CAS Server
//$cas_host = 'cas.fsu.edu';
//$cas_host = 'ithaca.habilis.net';
$cas_host = 'localhost';

// Context of the CAS Server
//$cas_context = '/cas';
$cas_context = '/cas-server-webapp';

// Port of your CAS server. Normally for a https server it's 443
//$cas_port = 443;
$cas_port = 8443;

// Path to the ca chain that issued the cas server certificate
//$cas_server_ca_cert_path = '/path/to/cachain.pem';

//////////////////////////////////////////
// Cassowary Setting                    //
//////////////////////////////////////////

$cassowary_users = ['thoupt', 'choupt'];

// Show or hide 19th century cassowary prints
$cassowary_show_pics = true;