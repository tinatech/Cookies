<?php
/**
 * Login processing for employee portal
 * This is the engine that process login requests for the admin panel
 * at the webshop.
 * 
 * @project Webshop
 * @author Christoffer V. Hallstensen
 * @version 0.1b
 *
 */

require("../loadenv.php");
require(LIBDIR . "Login.php");
include "../functions.php";
session_start();


// if DEBUG is true, show output
if (DEBUG) { 
	echo "[i] Processing login <br> [i] Debug enabled.. <br>";
}

/* if a formsubmit is active create a Login */
if ($_POST['submit']) {
	if (DEBUG) {
		echo "[i] Submitted <br> ";
		echo "Username: " . $_POST['username'] . '<br>';
		echo "Password: " . $_POST['password'];
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

	$login = new Login();
	$login->adminLogin($username, $password);
}

else if($_SESSION['auth'] == 1 && isSet($_SESSION['aID'])) {

	header("Location: index.php");

} else {

	/* if page is not called from login form
 	* send the user back to index.php */
	echo $gui::login("Login");
	echo $gui::loginForm();
}
?>
