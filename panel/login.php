<?php
require_once(CONFDIR . 'config.php');
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

// if DEBUG is true, show output
if (DEBUG) echo "[i] Processing login <br>";


/* if page is not called from login form
 * send the user back to index.php */

if (!isSet($_POST['submit'])) {
	header("Location: index.php");
	exit;
}
else {
	/* TODO: create login*/
}




?>
