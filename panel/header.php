<?php
session_start();
require("../loadenv.php");
include "../functions.php";
include "../lib/DB.php";
include "../lib/Session.php";

// Load session class
$session = new Session;

// Henter inn header informasjon
echo $gui::header("Administrasjons panel");
echo $gui::menu("admin");
?>