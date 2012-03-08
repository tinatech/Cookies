<?php
include_once("header.php");
echo $gui::secondmenu("products");
?>
<div id="content">
	<div id="mainbar">
		<?php 
		//Kobling til databaseklassen.
		$db = new Database;
		
		//Sjekker om ny sortBy session skal settes. Hvis ingen session er satt settes standard.
		if (isset($_GET['sortBy']) != null && isset($_GET['sortOrder']) != null) {
			$session::setSortBy("sortByCategory", $_GET['sortBy'], strtoupper($_GET['sortOrder']));
		}
		elseif (!isset($_SESSION['sortByCategory'])) { $session::setSortBy("sortByCategory", "name", "ASC"); }
		
		//*************** NEW ***************//
		if(isset($_GET['cat']) && $_GET['cat'] == "newsend") {
					// Skjekker om alle feltene er fylt ut. Hvis ikke får man tilbakemelding på hvem som ikke er det.
			if (empty($_POST['name']) || empty($_POST['descr'])) {
				echo '<div id="error">Alle felter må fylles ut. Vennligst fyll ut:<br /><ul>';
									if (empty($_POST["name"])) { echo "<li>Navn</li>"; }
									if (empty($_POST["descr"])) { echo "<li>Bekrivelse</li>"; }
				echo '</ul></div>';
				echo $gui::back();
			}
			
			else {	//Hvis alt er ok, sendes data over til databasen
				$sql = "INSERT INTO `Webshop`.`category` (`catID`, `name`, `descr`) 
						VALUES (NULL, '".$_POST['name']."', '".$_POST['descr']."')";
				$db->dbQuery($sql);
				
				//Skriver ut overskrift
				$gui::h2("Kategorier");
			
				//Skjekker om kategorien faktisk er lagt til eller ikke. Skriver deretter ut tilbakemelding.
				$sql = "SELECT * FROM `Webshop`.`category` WHERE `category`.`name` = '".$_POST['name']."'";
				$bool = $db->dbQueryExist($sql);
				if ($bool == true) { 
					echo $gui::verified($_POST['name']." ble lagt til"); 
				}
				elseif ($bool == false) { 
					echo $gui::error("Error: Noe skjedde feil. Kategorien ble ikke lagt til.");
				}
				
				$view::showCategories($_SESSION['sortByCategory']);
			}
		}
		// Skriver ut skjema for innfylling av ny bruker.
		elseif (isset($_GET['cat']) && $_GET['cat'] == "new") {
			$gui::h2("Legg til ny kategori");
			$view::newCategoryTable();
		}
		
		//*************** SHOW CATEGORIES ***************//
		
		else {
		$gui::h2("Kategorier");
		$view::showCategories($_SESSION['sortByCategory']);
		}
		
		
		?>


	</div><!-- End mainbar -->	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
