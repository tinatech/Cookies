<?php


/**
 * Loads and defines enviroment variables
 */

/* Set root directory and load config */
define('ROOTDIR', dirname(__FILE__) . '/');
define('CONFDIR', ROOTDIR . 'conf/');
require(CONFDIR . "config.php");


define('LIBDIR', ROOTDIR . $lib);
define('IMGDIR', ROOTDIR . $img);
define('CSSDIR', $style);

// Load gui class
include_once (LIBDIR . "webshopgui.php");
$gui = new WebshopGui;

// Load view class
include_once (LIBDIR . "View.php");
$view = new View;


?>
