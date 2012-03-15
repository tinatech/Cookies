<?php
/**
 * Login.php - Authentication class
 *
 * @project	DarkCookie Shop
 * @author	Christoffer Hallstensen
 * @ver		0.2
 *
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/loadenv.php");
require_once(LIBDIR . "DB.php");

class Login{

	private $user = NULL;   // Username
	private $pass = NULL;   // Password
	private $auth = NULL;   // BOOL is authenticated
	private $fname = NULL;	// First name
	private $sname = NULL;	// Surname
	private $id = NULL;	// aID or uID
	private $admin = NULL;	// BOOL is admin
	private $email = NULL;	// email
	private $dbconn = NULL;	// Database link reference
	
	public function __construct () {
		if(isSet($_SESSION['auth']))
			$_SESSION['auth'] = 0;

		if(!isSet($dbconn)) {
			$this->dbconn = new Database();
		}

	}
	/*
	 * Handles logins to adminpanel
	 */
	public function adminLogin($username,$password) {
		
		if (empty($username) || empty($password)) {
			throw new Exception("Empty username or password");
		} else {

			$user = $username;
			$pass = md5($password);
			$sql = "SELECT * FROM worker WHERE 
				username = '$user' AND password = '$pass' AND active=1 LIMIT 0,1"; 
			
			if ( $this->dbconn->dbQueryExist($sql) ) {
				$this->setUserData($sql,'1');
				$this->sessionInit("admin");	
			
			} else {
				header("Location: index.php");
			}

		}	
	}

	/*
	 * Handles userlogins
	 */
	public function userLogin($username,$password) {
		
		if (empty($username) || empty($password)) {
			throw new Exception("Empty username or password");
		} else {
			$user = $username;
			$pass = md5($password);
			$sql = "SELECT * FROM user WHERE 
				username = '$user' AND password = '$pass' AND active=1 LIMIT 0,1"; 
			
			if ( $this->dbconn->dbQueryExist($sql) ) {
				$this->setUserData($sql,0);
				$this->sessionInit("user");	
			
			} else {
				echo "LOGIN FAILED";
				header("refresh: 2; login.php");
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
			$_SESSION['username'] = $this->user;
			$_SESSION['admin'] = $this->admin;
			header("Location: index.php");
			break;
		case "user":
		        session_regenerate_id();
		        $_SESSION['uID'] = $this->id;
		        $_SESSION['auth'] = '1';
			$_SESSION['username'] = $this->user;
			$_SESSION['fname'] = $this->fname;
			$_SESSION['sname'] = $this->sname;
			header("Location: index.php");
			break;
		}
	
	}

	/*
	 * Sets the userdata in session
	 */
	private function setUserData($sql,$a) {
		$data = $this->dbconn->dbQuery($sql);
		$this->id = $data[0][0];
		$this->fname = $data[0][1];
		$this->sname = $data[0][2];
		if($a == 1) {
			$this->user = $data[0][4];
			$this->admin = $data[0][6];
		} else {
			$this->email = $data[0][5];
			$this->user = $data[0][6];
		}

	}

	public function logout () {
		session_start();
		
		if ($_SESSION['auth'] == '1') {
			$_SESSION['auth'] = 0;
			session_destroy();
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}

	}

}
?>
