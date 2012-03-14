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
session_start();
require("../loadenv.php");
require(LIBDIR . "Login.php");
include "../functions.php";





/* if a formsubmit is active create a Login */
if (isset($_POST['submit']) && $_POST['submit']) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$login = new Login();
	$login->adminLogin($username, $password);
}

else if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1 && isSet($_SESSION['aID'])) {

	header("Location: index.php");

} else {

	/* if page is not called from login form
 	* send the user back to index.php */
	echo $gui::login("Login");
	echo $gui::loginForm();
}
?>
