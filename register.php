<?php
include_once("header.php");
?>
<div id="content">
<div id="mainbar">	
<?php 
	//Kobling til databaseklassen.
		$db = new Database;	
		
	//*************** NEW ***************//
		if (isset($_GET['user']) && $_GET['user'] == "send") {
			// Skjekker om alle feltene er fylt ut. Hvis ikke får man tilbakemelding på hvem som ikke er det.
			if (empty($_POST['fname']) || empty($_POST['sname']) || empty($_POST['address']) || empty($_POST['zipcode']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2']) ) {
				echo '<div id="error">Alle felter må fylles ut. Vennligst fyll ut:<br /><ul>';
									if (empty($_POST["fname"])) { echo "<li>Fornavn</li>"; }
									if (empty($_POST["sname"])) { echo "<li>Etternavn</li>"; }
									if (empty($_POST["address"])) { echo "<li>Addresse</li>"; }
									if (empty($_POST["zipcode"])) { echo "<li>Postnummer</li>"; }
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
				$sql = "INSERT INTO `Webshop`.`user` (`uID`, `fname`, `sname`, `address`,`zipcode`,`email`, `username`, `password`) 
						VALUES (NULL, '".$_POST['fname']."', '".$_POST['sname']."', '".$_POST['address']."', '".$_POST['zipcode']."', '".$_POST['email']."', '".$_POST['username']."', '".md5($_POST['password'])."')";
				$db->dbQuery($sql);
			
				echo "Du er registrert.";
				
		
			}
		
		}
		else { $view::newusertable();
		}
		?>
		
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>