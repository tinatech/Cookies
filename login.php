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
                        <p>Logg inn eller <a href="register.php">registrer deg</a> som ny kunde.</p>
            </div> <!--end bestsellers-->
</div>
<div id="mainbar">
<?php

/**
 * Checks if login.php is called in a form
 * If not, send the user back to index.php
 */
if(!isset($_POST['submit'])) {
	echo $gui::loginForm();
} else {
	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	$login = new Login();				// Creates a new login instance
	$login->userLogin($username,$password);         // Starts the login process
}
?>
</div>
</div>
<?php
echo $gui::footer();
?>
