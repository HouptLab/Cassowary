---
---
<?php

///////////////////////////////////////
// Basic Config of the phpCAS client //
///////////////////////////////////////

// Full Hostname of your CAS Server
$cas_host = '{{ site.cas_host }}';

// Context of the CAS Server
$cas_context = '{{ site.cas_context }}';

// Port of your CAS server. Normally for a https server it's 443
$cas_port = 443;

$client_service_name = '{{ site.url | default: "http://localhost:8080"}}';

// Path to the ca chain that issued the cas server certificate
//$cas_server_ca_cert_path = __DIR__ . '/COMODOHigh-AssuranceSecureServerCA.crt';

//////////////////////////////////////////
// Cassowary Setting                    //
//////////////////////////////////////////

// Default list of users with global access
// note: rely on the fact that JSON string lists are PHP compatible
$cassowary_users = {{ site.administrators | jsonify }};

// PDF property used to store additional users
//$cassowary_pdf_property = 'cassowary-users';

// Show or hide 19th century cassowary prints
$cassowary_show_pics = true;

// Show or hide page debug info
$cassowary_show_debug = false;
