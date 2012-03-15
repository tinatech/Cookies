<?php
/*
 * Cart.php
 * @project Webshop
 * @author Christoffer Hallstensen
 * @ver 0.1b
 * @descr Shopping cart object for webshop
 *
 */

require_once("./loadenv.php");


class Cart {
	
	var $expire = 3600;
	var $del_cookie = -1;

	function addItem($itemID, $qty) {
		$dbconn = new Database;
		$sql = 'SELECT (price) FROM item WHERE itemID='.$itemID.' LIMIT 0,1';
		$result = $dbconn->dbQuery($sql);
		$price = $result[0][0];

		$item = array(
			'itemID' => $itemID,
			'ItemQty' => $qty,
	       		'itemPrice' => $price);

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
