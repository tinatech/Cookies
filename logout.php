<?php
include("loadenv.php");
require(LIBDIR . "Login.php");

$logout = new Login();
$logout->logout();

?>
