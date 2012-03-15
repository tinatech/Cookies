<?php
session_start();
require("loadenv.php");
include(ROOTDIR . "functions.php");
include(LIBDIR . "DB.php");
include "lib/Session.php";
$session = new Session;

// Henter inn header informasjon
echo $gui::header("The Dark Cookie Shop");
echo $gui::menu("user");
?>
