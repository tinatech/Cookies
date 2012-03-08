<?php
/**
 * Login.php - Authentication class
 *
 * @project	DarkCookie Shop
 * @author	Christoffer Hallstensen
 * @ver		0.1
 *
 */

require_once("../loadenv.php");
include(CONFDIR . "global.php");
require_once(LIBDIR . "DB.php");

class Login{

	private $user;
	private $pass;
	$db_link;
	private $auth = 0;

	function __construct () {
		
		if (DEBUG) echo '[i] Auth loaded...<br>';	
		
		if(!isSet($db_link)) {
			$db_link = new Database();
		}
		
		session_start();
		if(!isSet($_SESSION['auth']))
			$_SESSION['auth'] = 0;

		if (DEBUG) {
			echo "Username: " , $_POST['username'] , "<br>";
			echo "Password: " , $_POST['password'] , "<br>";
			echo "Session[auth] = " , $_SESSION['auth'];
		}


	}


	public function getUsername() {
		return $this->user;
	}

	public function verifyLogin ($username,$password) {
		$sql = "SELECT * FROM user WHERE username='$password'
			and password='md5($password)'";

		if ($db_link->dbQueryExists($sql)) {
			$_SESSION['auth'] = '1';
			$_SESSION['username'] = $username;
			echo $_SESSION['auth'];
			echo $_SESSION['username'];
		} else {
			echo "<p>Login Failed!</p>";
		}
		
	}

	public function logout () {
		session_destroy();
	}

	public function isAuth() {
		return $this->authenticated;
	}

}
?>
