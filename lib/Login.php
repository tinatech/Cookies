<?php
/**
 * Login.php - Authentication class
 *
 * @project	DarkCookie Shop
 * @author	Christoffer Hallstensen
 * @ver		0.1
 *
 */

include "./conf/global.php";
include "DB.php";

class Login{

	private $user;
	private $pass;

	function __construct () {
	if (DEBUG) echo '[i] Auth loaded...<br>';	
		
		session_start();
		if(!isSet($_SESSION['auth']))
			$_SESSION['auth'] = 0;
		if (DEBUG) {
			echo "Username: " , $_POST['username'] , "<br>";
			echo "Password: " , $_POST['password'] , "<br>";
			echo "Session[auth] = " , $_SESSION['auth'];
		}

	}

	private function __destruct () {
	}


	public function getUser() {
		return $this->user;
	}

	public function verify ($username,$password) {
		
	}

	public function logout () {
		session_destroy();
	}

	public function isAuth() {
		return $this->authenticated;
	}
}
?>
