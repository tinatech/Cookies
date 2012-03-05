<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<?php 
		//Kobling til databaseklassen.
		$db = new Database;
		
		//Sjekker om ny sortBy session skal settes. Hvis ingen session er satt settes standard.
		if (isset($_GET['sortBy']) != null && isset($_GET['sortOrder']) != null) {
			$session::setSortBy("sortBy", $_GET['sortBy'], strtoupper($_GET['sortOrder']));
		}
		elseif (!isset($_SESSION['sortBy'])) { $session::setSortBy("sortBy", "sname", "ASC"); }
		
		
		//*************** EDIT ***************//
		// Skriver ut redigeringsskjema hvis $_GET['edit'] er satt og $_GET er et nummer.
		if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
			$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['edit'];
			$result = $db->dbQuery($sql);
			$gui::h2("Rediger bruker");
			$view::editAdminTable($result);
		}
		
		// Skjekker om $_GET er satt og satt til send. Skjekker i tilegg om det det er sendt inn noe informasjon for å ikke få feilmeilding hvis det ikke er det.
		elseif (isset($_GET['edit']) && $_GET['edit'] == "send" && isset($_POST['aid'])) {
			$gui::h2("Medarbeidere");
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
			$sql = "UPDATE  `Webshop`.`worker` SET  `fname` =  '".$_POST['fname']."', `sname` =  '".$_POST['sname']."', `email` =  '".$_POST['email']."', `username` =  '".$_POST['username']."'".$password.", `admin` =  '".$_POST['admin']."' WHERE  `worker`.`aID` =".$_POST['aid'];
			$db->dbQuery($sql);
			$gui::verified($_POST['fname']." ".$_POST['sname']." ble oppdatert");
			$view::showManagers($_SESSION['sortBy'], "1");
		}
		
		//*************** NEW ***************//
		elseif (isset($_GET['user']) && $_GET['user'] == "sendNew") {
			// Skjekker om alle feltene er fylt ut. Hvis ikke får man tilbakemelding på hvem som ikke er det.
			if (empty($_POST['fname']) || empty($_POST['sname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2']) ) {
				echo '<div id="error">Alle felter må fylles ut. Vennligst fyll ut:<br /><ul>';
									if (empty($_POST["fname"])) { echo "<li>Fornavn</li>"; }
									if (empty($_POST["sname"])) { echo "<li>Etternavn</li>"; }
									if (empty($_POST["email"])) { echo "<li>E-post</li>"; }
									if (empty($_POST["username"])) { echo "<li>Brukernavn</li>"; }
									if (empty($_POST["password"])) { echo "<li>Passord</li>"; }
									if (empty($_POST["password2"])) { echo "<li>Gjenta passord</li>"; }
				echo '</ul></div>';
				echo $gui::back();
			}
			
			// Skjekker om passordene er like. Hvis ikke skrives feilmelding.
			elseif ($_POST['password'] != $_POST['password2']) {
				echo $gui::error("Passordet stemmer ikke overens. Prøv på nytt.");
				echo $gui::back();
			}
			
			else {	//Hvis alt er ok, sendes data over til databasen
				$sql = "INSERT INTO `Webshop`.`worker` (`aID`, `fname`, `sname`, `email`, `username`, `password`, `admin`) 
						VALUES (NULL, '".$_POST['fname']."', '".$_POST['sname']."', '".$_POST['email']."', '".$_POST['username']."', '".md5($_POST['password'])."', '".$_POST['admin']."')";
				$db->dbQuery($sql);
				
				//Skriver ut overskrift
				$gui::h2("Medarbeidere");
			
				//Skjekker om brukeren faktisk er lagt til eller ikke. Skriver deretter ut tilbakemelding.
				$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`username` = '".$_POST['username']."'";
				$bool = $db->dbQueryExist($sql);
				if ($bool == true) { 
					echo $gui::verified($_POST['fname']." ".$_POST['sname']." ble lagt til"); 
				}
				elseif ($bool == false) { 
					echo $gui::error("Error: Noe skjedde feil. Brukeren ble ikke lagt til.");
				}
				
				$view::showManagers($_SESSION['sortBy'], "1");
			}
		}
		// Skriver ut skjema for innfylling av ny bruker.
		elseif (isset($_GET['new']) == "user") {
			$gui::h2("Legg til ny medarbeider");
			$view::NewAdminTable();
		}
		
		//************ DEACTIVATE OR ACTIVATE USER ************//
		elseif (isset($_GET['user']) && is_numeric($_GET['user']) && isset($_GET['status'])) { 
			$gui::h2("Kunder");
			$sql = "UPDATE  `Webshop`.`worker` SET  `active` =  '".$_GET['status']."' WHERE  `worker`.`aID` =".$_GET['user'];
			$db->dbQuery($sql);
			if ($_GET['status'] == "0") {
				$gui::verified("Brukeren ble deaktivert");
				$view::showManagers($_SESSION['sortBy'], "1");
			}
			elseif ($_GET['status'] == "1") {
				$gui::verified("Brukeren ble aktivert");
				$view::showManagers($_SESSION['sortBy'], "0");
			}
		}
		
		//************ SHOW INACTIVE USERS ************//
		elseif (isset($_GET['user']) && $_GET['user'] == "inactive") { 
			$gui::h2("Inaktive medarbeidere");
			$view::showManagers($_SESSION['sortBy'], "0");
		}
				
		//************ ONLY PRINT ************//
		else {
			//Skriver ut alle ansatte.	
			$gui::h2("Medarbeidere");
			$view::showManagers($_SESSION['sortBy'], "1");
		}
		?>	
	
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
