<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<h2>Legg til medarbeider:</h2>
		<?php 
		if (isset($_GET['p']) == "sendNew") {
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
				$db = new Database;
				$sql = "INSERT INTO `Webshop`.`worker` (`aID`, `fname`, `sname`, `email`, `username`, `password`, `admin`) 
						VALUES (NULL, '".$_POST['fname']."', '".$_POST['sname']."', '".$_POST['email']."', '".$_POST['username']."', '".md5($_POST['password'])."', '".$_POST['admin']."')";
				$db->dbQuery($sql);
			
				//Skjekker om brukeren faktisk er lagt til eller ikke. Skriver deretter ut tilbakemelding.
				$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`username` = '".$_POST['username']."'";
				$bool = $db->dbQueryExist($sql);
				if ($bool == true) { echo $gui::verified($_POST['fname']." ".$_POST['sname']." ble lagt til"); }
				elseif ($bool == false) { echo $gui::error("Error: Noe skjedde feil. Brukeren ble ikke lagt til."); }
			}
		}
		else {
			$view::NewAdminTable();
		}
			
		?>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
