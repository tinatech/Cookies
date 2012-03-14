<?php
require("loadenv.php");
include "functions.php";
include "./lib/DB.php";
session_start();
// Henter inn header informasjon
echo $gui::header("The Dark Cookie Shop");
echo $gui::menu("user");
?>
