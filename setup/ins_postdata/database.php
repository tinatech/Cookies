<?php
include_once ('config.php');

class Database {

	private $db;
		
	function __construct() {
		$this->db = mysql_connect(server, bruker, passord);
		$this->db = mysql_select_db(database);
	}

	function finnesPostnr() {
		//Teller antall poster fra tabell sted for å se om vi skal legge inn data
		$finnesData = "SELECT zipcode FROM zipcodes";
		$finnesDataRes = mysql_query ($finnesData);
	
		//Sjekker om det finnes data
		if (mysql_num_rows($finnesDataRes) > 0) {
			return true;
		}
		//Hvis det ikke finnes data i tabellen sted så legger vi de inn.
		else {
			//laster inn fil
			$fil = "post.txt";
			$fo = fopen($fil, "r");
			$data = fread($fo, filesize($fil));
			fclose($fo);

			//deler opp data til en array
			$ut = str_replace("\t\t", " ", $data);
			//fo
			$ut = explode("\n" , $ut);
		
			foreach ($ut as $input) {
				//Deler opp data i array hver gang tab finnes
				$temp = explode("\t" , $input);		
			
				$insertData = "INSERT INTO zipcodes 
									(zipcode, city) 
									VALUES ('$temp[0]', '$temp[1]')";
				echo "Inserting $temp[0] , $temp[1] <br>";	
				mysql_query("set names utf8;");
				mysql_query ($insertData) or die (mysql_error());
			}
		return false;
		}
	}
}

?>
