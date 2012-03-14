<?php

/* DB.php - Database handling
 *
 * Description:
 *
 * Class that handles all database transactions and assure that
 * the webapplication support all databases that is supported
 * by standard PHP libraries.
 *
 *
 * @project Webshop
 * @author Kjetil Høyme, Christoffer Hallstensen <christoffer@netcrawlr.net>
 * @version 0.1b
*/

require_once CONFDIR.'dbconf.php';

class Database {
		
	private static $db_link;
	/*
	private $db_host = DB_HOST;
	private $db_driver = DB_DRIVER;
	private $db = DB_USE;
	$connect = "$db_driver':host='$db_host';dbname='$db";

	function __construct () {

		if(!isSet(Database::$db_link)) {
			try {
				Database::$db_link = new PDO($connect, $db_user, $db_pass, 
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
			catch (PDOExeption $e) {
				die ('Kan ikke koble til databasen: ' . $e->getmessage());	
			}
		} 
	}

	
	function __destruct () {
		
	}


	private function dbParseConfig() {
		
	
	}
	
 */

	function __construct () {
		$db_user = DB_USER;
		$db_pass = DB_PASS;

		if(Database::$db_link == false) {
			$connect = 'mysql:host=localhost;dbname=Webshop';
			try {
				Database::$db_link = new PDO($connect, $db_user, $db_pass,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                        }
                        catch (PDOExeption $e) {
				die ('Kan ikke koble til databasen: ' . $e->getmessage());
                        }
                }
        }





	/* Function that receives a SQL string and returns the result to requestor in
	 * an array 
	 *
	 * Returns:
	 * array[row][colum]
	 *
	 * example:
	 * $qry = 'SELECT aID, fname FROM worker';
	 * $result = $db->dbQuery($sql);
	 *
	 *
	 * result[0][0];  // aID
	 * result[0][1];  // fname
	 *
	 * TODO: rewrite to support variable names
	 *
	 */

	function dbQuery ($sql) {
		$sth = Database::$db_link->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();

		return $result;
	}


	/* Function that process a SQL query and return BOOL true or false */
	
	function dbQueryExist ($sql) {
		$sth = Database::$db_link->prepare($sql);
		$sth->execute();
		$result = ($sth->rowCount() > 0) ? true : false;

		return $result;
	}
	
//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ INPUT ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤
	
		// **Ny medarbeider
	function NewWorker($input) {
		$sql ='INSERT INTO worker (aID, fname, sname, email, username, password, admin, active) 
				  VALUES (0, ?, ?, ?, ?, ?, ?, ?)';
			
		$sth = Database::$this->DB->prepare($sql);
			
			//Setter inn data
		$arr = array(
			$_POST['fname']	,
			$_POST['sname']	,
			$_POST['email']	,
			$_POST['username']	,
			$_POST['password'] ,
			$_POST['admin'],
			$_POST['active']
		);
		
		$sth->execute($arr);
			
			// Fjerner variabel fra minnet
		unset ($sql);
		unset ($arr);
	}
	
	function NewUser ($input) {
		$sql = 'INSERT INTO user (uID, fname, sname, address, zipcode, email, username, password, active)
					VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?)';
					
		$sth = Database::$this->DB->prepare($sql);
		
		$arr = array(
			$_POST['fname'] ,
			$_POST['sname'] ,
			$_POST['address'] ,
			$_POST['zipcode'] ,
			$_POST['email'] ,
			$_POST['username'] ,
			$_POST['password'] ,
			$_POST['active']
		);
		
		$sth->execute($arr);
		
		unset ($sql);
		unset ($arr);
	}
	
	function NewItem ($input) {
				
		$sql = 'INSERT INTO item (itemID, name, quantity, descr, price, image) 
					VALUES (0, ?, ?, ?, ?, ?)';

		$sth = Database::$this->DB->prepare($sql);
		
		$arr = array(
			$_POST['name'] ,
			$_POST['quantity'] ,
			$_POST['descr'] ,
			$_POST['price'] ,
				// Vet ikke helt hvordan image(blob) sendes med til databasen
			$_POST['image']
		);
		
		$sth->execute($arr);
		
		unset ($sql);
		unset ($arr);	
	}
	
	
	function NewCategory ($input) {
		
		$sql = 'INSERT INTO category (catID, name, descr)
					VALUES (0, ?, ?)';
					
		$sth = Database::$this->DB->prepare($sql);
		
		$arr = array( 
			$_POST['name'] ,
			$_POST['descr']
		);
		
		$sth->execute($arr);
		
		unset ($sql);
		unset ($arr);
	}

	
	function NewOrder ($input) {
	
		$sql = 'INSERT INTO ordr (orderID, uid, status, time)
					VALUES (0, ?, ?, NOW())';
	
		$sth = Database::$this->DB->prepare($sql);
		
		$arr = array(
			$_POST['uid'] ,
			$_POST['status']
		);
		
		$sth->execute($arr);
		
		unset($sql);
		unset($arr);
	}

}
//end-Class-Database

	


?>
