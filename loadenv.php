<?php


/**
 * Loads and defines enviroment variables
 */

/* Set global paths */
if ( !defined('ROOTDIR')) { define('ROOTDIR', $_SERVER['DOCUMENT_ROOT']  . '/'     ); }
if ( !defined('CONFDIR')) { define('CONFDIR', $_SERVER['DOCUMENT_ROOT']  . '/conf/'); }
if ( !defined('LIBDIR' )) { define('LIBDIR' , $_SERVER['DOCUMENT_ROOT']  . '/lib/' ); }
if ( !defined('IMGDIR' )) { define('IMGDIR' , $_SERVER['DOCUMENT_ROOT']  . '/img/' ); }
if ( !defined('CSSDIR' )) { define('CSSDIR' , './css/'); }
// Load view class



require(CONFDIR . "config.php");


// Load gui class
include_once (LIBDIR . "webshopgui.php");
$gui = new WebshopGui;

// Load view class
include_once (LIBDIR . "View.php");
$view = new View;

include_once (LIBDIR . "Cart.php");
$cart = new Cart();

?>
