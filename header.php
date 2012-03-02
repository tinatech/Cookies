<?php
require("loadenv.php");
include "functions.php";
include "./lib/DB.php";

// Henter inn header informasjon
echo $gui::header("The Dark Cookie Shop");
echo $gui::menu("user");
?>