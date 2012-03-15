<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/loadenv.php");
include(ROOTDIR. "functions.php");
include(LIBDIR. "DB.php");
include(LIBDIR. "/Session.php");

/*
 * Check if user is logged in to admin panel
 * If not logged in, send to login.php 
 */
if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1 && isSet($_SESSION['aID'])) {
	
	// Load session class
	$session = new Session;
	
	// Henter inn header informasjon
	echo $gui::headerh("Administrasjons panel");
	echo $gui::menu("admin");
} else {
	header("Location: login.php");
}
?>
