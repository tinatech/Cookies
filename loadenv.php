<?php


/**
 * Loads and defines enviroment variables
 */

/* Set root directory */
define('ROOTDIR', dirname(__FILE__) . '/');
define('CONFDIR', ROOTDIR . 'conf/');
require(CONFDIR . 'config.php');


define('LIBDIR', ROOTDIR . $lib);
define('IMGDIR', ROOTDIR . $img);
define('CSSDIR', "http://" . $_SERVER['HTTP_HOST'] . "/" . $style);


// Load gui class
include_once ("lib/webshopgui.php");
$gui = new WebshopGui;

// Load view class
include_once ("lib/view.php");
$view = new View;
?>
