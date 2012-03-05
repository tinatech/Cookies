<?php

include_once ('database.php');


$db = new Database();

if ($postLagret = $db->finnesPostnr()) {
	echo "Det finnes allerede data i tabellen zipcodes";
}
else {
	echo "All data er lagret i tabellen zipcodes";
}
	



?>