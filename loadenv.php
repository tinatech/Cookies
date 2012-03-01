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
define('CSSDIR', ROOTDIR . $style);
?>
