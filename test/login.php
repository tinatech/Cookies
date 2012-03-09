<?php
	require_once("../loadenv.php");
	require_once(LIBDIR . "Login.php");

	/* Check if posted from form, if not send back to index.php */
	if(!isSET($_POST['submit'])) {
		header("Location: index.php");
		exit;
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo "Login";	
		$login = new Login();
		$login->verifyLogin($username, $password);
	}

?>
