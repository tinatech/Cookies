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

	function __construct() {
		session_start();
		$_SESSION['cart'] = Array items;
	}

	function addItem($itemID) {
		if(isSet($_SESSION['cart']) {
		}
	}

	function rmItem($itemID) {
	}

	function checkout() {
	
	}

}


?>
