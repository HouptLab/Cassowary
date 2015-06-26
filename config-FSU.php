<?php

///////////////////////////////////////
// Basic Config of the phpCAS client //
///////////////////////////////////////

// Full Hostname of your CAS Server
$cas_host = 'cas.fsu.edu';

// Context of the CAS Server
$cas_context = '/cas';

// Port of your CAS server. Normally for a https server it's 443
$cas_port = 443;

// Path to the ca chain that issued the cas server certificate
//$cas_server_ca_cert_path = '/path/to/cachain.pem';

//////////////////////////////////////////
// Cassowary Setting                    //
//////////////////////////////////////////

// Default list of users with global access
$cassowary_users = ['thoupt', 'bmiller2', 'rsherrod', 'dlevitan'];

// Show or hide 19th century cassowary prints
$cassowary_show_pics = true;