<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<h2>Medarbeidere:</h2>
		<?php 
		$db = new Database;
		//Hvis get remove er satt, slettes bruker.
		if (isset($_GET['remove'])) {
			$sql = "DELETE FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['remove'];
			$db->dbQuery($sql);
			
			//Skjekker om brukeren faktisk er slettet eller ikke. Skriver deretter ut tilbakemelding.
			$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['remove'];
			$bool = $db->dbQueryExist($sql);
			if ($bool == true) { echo $gui::error("Error: Noe skjedde feil. Brukeren ble ikke slettet"); }
			elseif ($bool == false) { echo $gui::verified("Brukeren ble slettet"); }
		}
		
		// Skriver ut redigeringsskjema hvis $_GET er satt og $_GET er et nummer.
		if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
			$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['edit'];
			$result = $db->dbQuery($sql);
			echo $view::editAdminTable($result);
		}
		
		else {
			// Skjekker om $_GET er satt og satt til send. Skjekker i tilegg om det det er sendt inn noe informasjon for å ikke få feilmeilding hvis det ikke er det.
			if (isset($_GET['edit']) && $_GET['edit'] == "send" && isset($_POST['aid'])) {
				if (isset($_POST['password'])) {
					if ($_POST['password'] == $_POST['password2']) {
						$password = ", `password` =  '".md5($_POST['password'])."'";
					}
					elseif ($_POST['password'] != $_POST['password2']) {
						echo $gui::error("Passordene stemte ikke med hverandre. Nytt passord ikke satt.");
						$password = ""; 
					}
				}
				else { $password = ""; }
				$sql = "UPDATE  `Webshop`.`worker` SET  `fname` =  '".$_POST['fname']."', `sname` =  '".$_POST['sname']."', `email` =  '".$_POST['email']."', `username` =  '".$_POST['username']."'".$password.", `admin` =  '".$_POST['admin']."' WHERE  `worker`.`aID` =".$_POST['aid'];
				$db->dbQuery($sql);
				echo $gui::verified($_POST['fname']." ".$_POST['sname']." ble oppdatert");
				}
			//Skriver ut alle ansatte.	
			$view::showManagers();
		}
		?>	
	
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
