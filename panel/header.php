<?php
session_start();
require("../loadenv.php");
include "../functions.php";
include "../lib/DB.php";
include "../lib/Session.php";

/*
 * Check if user is logged in to admin panel
 * If not logged in, send to login.php 
 */
if(($_SESSION['auth'] == 1 && isSet($_SESSION['aID']))) {
	
	// Load session class
	$session = new Session;
	
	// Henter inn header informasjon
	echo $gui::header("Administrasjons panel");
	echo $gui::menu("admin");
} else {
	header("Location: login.php");
}
?>
