<?php
/**
 * Login.php - Authentication class
 *
 * @project	DarkCookie Shop
 * @author	Christoffer Hallstensen
 * @ver		0.2
 *
 */

require_once("../loadenv.php");
include(CONFDIR . "config.php");
require_once(LIBDIR . "DB.php");

class Login{

	private $user = NULL;
	private $pass = NULL;
	private $auth = NULL;
	private $id = NULL;
	private $dbconn = NULL;

	public function __construct () {
		
		session_start();
		
		if(!isSet($_SESSION['auth']))
			$_SESSION['auth'] = 0;

		if(!isSet($dbconn)) {
			$this->dbconn = new Database();
		}

	}
	/*
	 * Handles logins to adminpanel
	 */
	public function adminLogin($username,$password) {
		if (DEBUG) echo '[i] adminLogin () <br>';
		if (empty($username) || empty($password)) {
			throw new Exception("Empty username or password");
		} else {
			if (DEBUG) echo '[i] select <br>';
			$user = $username;
			$pass = md5($password);
			$sql = "SELECT * FROM worker WHERE 
				username = '$user' AND password = '$pass' AND active=1 LIMIT 0,1"; 
			
			if ( $this->dbconn->dbQueryExist($sql) ) {
				echo "DO LOGIN";
				$this->setUserData($sql);
				$this->sessionInit("admin");	
			
			} else {
				echo "LOGIN FAILED";
				header("Location: index.php");
			}

		}	
	}

	/*
	 * Handles userlogins
	 */
	public function userLogin($username,$password) {
		if (DEBUG) echo '[i] userLogin () <br>';
		if (empty($username) || empty($password)) {
			throw new Exception("Empty username or password");
		} else {
			$user = $username;
			$pass = md5($password);
			$sql = "SELECT * FROM user WHERE 
				username = '$user' AND password = '$pass' AND active=1 LIMIT 0,1"; 
			
			if ( $this->dbconn->dbQueryExist($sql) ) {
				echo "DO USER LOGIN";
				$this->setUserData($sql);
				$this->sessionInit("user");	
			
			} else {
				echo "LOGIN FAILED";
				header("Location: index.php");
			}

		}	
	}

	/*
	 * Initiates a new logged in session
	 */
	private function sessionInit($type) {
		
		switch($type) {
		case "admin":
			session_regenerate_id();
			$_SESSION['aID'] = $this->id;
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = $user;
			header("Location: index.php");
			break;
		case "user":
		        session_regenerate_id();
		        $_SESSION['uID'] = $this->id;
		        $_SESSION['auth'] = '1';
			$_SESSION['username'] = $user;
			header("Location: index.php");
			break;
		}
	
	}

	/*
	 * Sets the userdata in session
	 */
	private function setUserData($sql) {
		$data = $this->dbconn->dbQuery($sql);
		$this->id = $data[0][0];
	}

	
	public function getUsername() {
  		return $this->user;
 	}


	public function logout () {
		session_destroy();
	}

	public function isAuth() {
		return $this->authenticated;
	}

}
?>
