<?php
include_once("loadenv.php");
require_once(ROOTDIR . "header.php");


/*
 * KOMMENTAR: 
 * defined trenger en string for å fjerne feilmeldinger.
 *
 */

/**
 * Checks if login.php is called in a form
 * If not, send the user back to index.php
 */
if(!isset($_POST['submit'])) {

} else {
	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	$login = new Login();				// Creates a new login instance
	$login->userLogin($username,$password);         // Starts the login process
}
?>
