<?php
/**
 * GLOBAL CONFIGURATION
 *
 * This file contain all global configuration and constants
 *
 *
 */


///////////////////////////////////////////////////////////////////////////////
// PATHS
///////////////////////////////////////////////////////////////////////////////

define('ROOT_DIR', dirname(__FILE__));
define('LIB_DIR', '');
define('CONF_DIR', '');
define('IMG_DIR', '');
define('STYLE_DIR','');

///////////////////////////////////////////////////////////////////////////////
// DEBUG AND LOGGING
///////////////////////////////////////////////////////////////////////////////

define('DEBUG', '1');		// Set to '1' or 'true' to se debug output


///////////////////////////////////////////////////////////////////////////////
// GLOBAL CONSTANTS
///////////////////////////////////////////////////////////////////////////////

/* Auth class constants  */
const AUTH_ERROR_EMPTY = "Please type in a username and password"; 
const AUTH_ERROR_VALIDATE = "Authentication failed"; 
const AUTH_ERROR_LOGIN = "Login failed" 


?>
