<?php

header('Content-Type: application/javascript');

// Setup
require_once 'cassowary-setup.php';

if ( ! phpCAS::isAuthenticated()) {
	http_response_code(403);
	exit();
}

if (phpCAS::hasAttributes()) {
	$attr= json_encode(phpCAS::getAttributes(), JSON_PRETTY_PRINT);
} else {
	$attr = json_encode([ 'uid' => phpCAS::getUser() ]);
}
?>
var cassowary = <?php echo $attr ?>;
