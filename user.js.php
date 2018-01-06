<?php

header('Content-Type: application/javascript');

// Setup
require_once 'cassowary-setup.php';

$user = [];

if (phpCAS::isAuthenticated()) {
	if (phpCAS::hasAttributes()) $user += phpCAS::getAttributes();
	else $user += ['uid' => strtolower(phpCAS::getUser())];	
}

?>
var cas_user = <?php echo json_encode( $user, JSON_PRETTY_PRINT ) ?>;
