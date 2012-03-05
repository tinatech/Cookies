<?php
include_once("header.php");
echo $gui::secondmenu("customers");
?>
<div id="content">
	<div id="mainbar">
		
		<?php 
		//Kobling til databaseklassen.
		$db = new Database;
		
		//Sjekker om ny sortBy session skal settes. Hvis ingen session er satt settes standard.
		if (isset($_GET['sortBy']) != null && isset($_GET['sortOrder']) != null) {
			$session::setSortBy("sortByUser", $_GET['sortBy'], strtoupper($_GET['sortOrder']));
		}
		elseif (!isset($_SESSION['sortByUser'])) { $session::setSortBy("sortByUser", "sname", "ASC"); }
		
			
		//*************** EDIT ***************//
		// Skriver ut redigeringsskjema hvis $_GET['edit'] er satt og $_GET er et nummer.
		if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
			$sql = "SELECT * FROM `Webshop`.`user` WHERE `user`.`uID` = ".$_GET['edit'];
			$result = $db->dbQuery($sql);
			$gui::h2("Rediger kunde");
			$view::editUserTable($result);
		}
		
		// Skjekker om $_GET er satt og satt til send. Skjekker i tilegg om det det er sendt inn noe informasjon for å ikke få feilmeilding hvis det ikke er det.
		elseif (isset($_GET['edit']) && $_GET['edit'] == "send" && isset($_POST['uid'])) {
			$gui::h2("Kunder");
			if (isset($_POST['password'])) {
				if ($_POST['password'] == $_POST['password2']) {
					$password = ", `password` =  '".md5($_POST['password'])."'";
				}
				// Hvis passordene ikke er like skrives ut feilmelding.
				elseif ($_POST['password'] != $_POST['password2']) {
					echo $gui::error("Passordene stemte ikke med hverandre. Nytt passord ikke satt.");
					$password = "";
				}
			}
			$sql = "UPDATE  `Webshop`.`user` SET  `fname` =  '".$_POST['fname']."', `sname` =  '".$_POST['sname']."', `address` =  '".$_POST['address']."', `zipcode` =  '".$_POST['zipcode']."', `email` =  '".$_POST['email']."', `username` =  '".$_POST['username']."'".$password." WHERE  `user`.`uID` =".$_POST['uid'];
			$db->dbQuery($sql);
			$gui::verified($_POST['fname']." ".$_POST['sname']." ble oppdatert");
			$view::showUsers($_SESSION['sortByUser'], "1");
		}
		
		//************ DEACTIVATE OR ACTIVATE CUSTOMERS ************//
		elseif (isset($_GET['user']) && is_numeric($_GET['user']) && isset($_GET['status'])) { 
			$gui::h2("Kunder");
			$sql = "UPDATE  `Webshop`.`user` SET  `active` =  '".$_GET['status']."' WHERE  `user`.`uID` =".$_GET['user'];
			$db->dbQuery($sql);
			if ($_GET['status'] == "0") {
				$gui::verified("Brukeren ble deaktivert");
				$view::showUsers($_SESSION['sortByUser'], "1");
			}
			elseif ($_GET['status'] == "1") {
				$gui::verified("Brukeren ble aktivert");
				$view::showUsers($_SESSION['sortByUser'], "0");
			}
		}
		
		//************ SHOW INACTIVE CUSTOMERS ************//
		elseif (isset($_GET['user']) && $_GET['user'] == "inactive") { 
			$gui::h2("Inaktive kunder");
			$view::showUsers($_SESSION['sortByUser'], "0");
		}
		
		//************ SHOW CUSTOMERS ************//
		else {
			//Skriver ut alle ansatte.	
			$gui::h2("Kunder");
			$view::showUsers($_SESSION['sortByUser'], "1");
		}
		?>	
		
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
