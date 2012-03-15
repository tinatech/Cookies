<?php
/**
 * Login page for users/customers.
 *
 * @project Webshop
 * @author Christoffer Hallstensen
 * @version 0.1b
 *
 */

require("loadenv.php");
require("header.php");
require(LIBDIR . "Login.php");
?>
<div id="content">
<div id="sidebar">
            <div id="bestsellers"> <!--start bestsellers-->
                        <h3>Logg inn</h3>
                        <p><a href="login.php">Logg inn</a> eller <a href="register.php">registrer deg</a> som ny kunde.</p>
            </div> <!--end bestsellers-->
</div>
<div id="mainbar">
<?php

/**
 * Checks if login.php is called in a form
 * If not, send the user back to index.php
 */
if(!isset($_POST['submit'])) {
	if(isSet($_SESSION['auth']) == '1') {
		header("Location: index.php");
	} else {
		echo $gui::loginForm();
	}
} else {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$login = new Login();				// Creates a new login instance
	$login->userLogin($username,$password);         // Starts the login process
}
?>
</div>
</div>
<?php
echo $gui::footer();
?>
