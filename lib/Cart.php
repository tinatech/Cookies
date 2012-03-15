<?php
/*
 * Cart.php
 * @project Webshop
 * @author Christoffer Hallstensen
 * @ver 0.1b
 * @descr Shopping cart object for webshop
 *
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "loadenv.php");
require_once(LIBDIR . "DB.php");

class Cart () {
	
	var $expire = 3600;
	var $del_cookie = -1;
	$dbconn = NULL;

	function __construct() {
		session_start();
		$_SESSION['cart'] = array();
		$this->dbconn = new Database();
	}

	function addItem($itemID, $qty) {
		$sql = 'SELECT (price) FROM item WHERE itemID='$itemID' LIMIT 0,1';
		$result = $dbconn->dbQuery($sql);
		$price = $result[0][0];

		$item = array(
			$itemID => $itemID,
			$ItemQty => $qty,
	       		$itemPrice => $price);

		array_push($_SESSION['cart'], $item);
		print_r($_SESSION['cart']);
	}

	function rmItem($itemID) {
	
	}

	function calcTotalPrice () {
	
	}

	function calcTotalItems () {
	
	}	

	function checkout() {
	
	}

}


?>
