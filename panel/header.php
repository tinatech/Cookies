<?php
require("../loadenv.php");
include "../functions.php";
include "../lib/DB.php";

// Henter inn header informasjon
echo $gui::header("Employee panel");
echo $gui::menu("admin");
?>