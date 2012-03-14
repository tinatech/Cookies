<?php
require("loadenv.php");
include(ROOTDIR . "functions.php");
include(LIBDIR . "DB.php");
session_start();
// Henter inn header informasjon
echo $gui::header("The Dark Cookie Shop");
echo $gui::menu("user");
?>
