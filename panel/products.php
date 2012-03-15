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
			$session::setSortBy("sortByItem", $_GET['sortBy'], strtoupper($_GET['sortOrder']));
		}
		elseif (!isset($_SESSION['sortByItem'])) { $session::setSortBy("sortByItem", "name", "ASC"); }
		
		//*************** NEW ***************//
		if(isset($_GET['item']) && $_GET['item'] == "newsend") {
					// Skjekker om alle feltene er fylt ut. Hvis ikke får man tilbakemelding på hvem som ikke er det.
			if (empty($_POST['name']) || empty($_POST['descr']) || empty($_POST['cat']) || empty($_POST['quantity']) || empty($_POST['price']) || empty($_FILES['image'])) {
				echo '<div id="error">Alle felter må fylles ut. Vennligst fyll ut:<br /><ul>';
									if (empty($_POST["name"])) { echo "<li>Navn</li>"; }
									if (empty($_POST["descr"])) { echo "<li>Bekrivelse</li>"; }
									if (empty($_POST["cat"])) { echo "<li>Kategori</li>"; }
									if (empty($_POST["quantity"])) { echo "<li>Antall</li>"; } 
									if (empty($_POST["price"])) { echo "<li>Pris</li>"; }
									if (empty($_POST["image"])) { echo "<li>Bilde</li>"; }
				echo '</ul></div>';
				echo $gui::back();
			}
			
			else {	//Hvis alt er ok, sendes data over til databasen
				$tmpName  = $_FILES['image']['tmp_name'];  
       
      			// leser bilde fil 
      				$fp      = fopen($tmpName, 'r');
      				$data = fread($fp, filesize($tmpName));
      				$data = addslashes($data);
      				fclose($fp);
				
				$sql = "INSERT INTO `Webshop`.`item` (`itemID`, `name`, `quantity`, `descr`, `price`, `image`) 
						VALUES (NULL, '".$_POST['name']."', '".$_POST['quantity']."', '".$_POST['descr']."', '".$_POST['price']."', '".$data."')";
				$db->dbQuery($sql);
				//Kobler item til kategori
				$sql = "INSERT INTO `Webshop`.`categories` (`catID`, `itemID`)
						VALUES ('".$_POST['cat']."', LAST_INSERT_ID())";
				$db->dbQuery($sql);
				//Skriver ut overskrift
				$gui::h2("Kategorier");
			
				//Skjekker om kategorien faktisk er lagt til eller ikke. Skriver deretter ut tilbakemelding.
				$sql = "SELECT * FROM `Webshop`.`item` WHERE `item`.`name` = '".$_POST['name']."'";
				$bool = $db->dbQueryExist($sql);
				if ($bool == true) { 
					echo $gui::verified($_POST['name']." ble lagt til"); 
				}
				elseif ($bool == false) { 
					echo $gui::error("Error: En feil har oppstått. Varen ble ikke lagt til. Vennligst prøv igjen!");
				}
				
				$view::showItems($_SESSION['sortByItem']);
			}
		}
		// Skriver ut skjema for innfylling av ny bruker.
		elseif (isset($_GET['item']) && $_GET['item'] == "new") {
			$gui::h2("Legg til ny vare");
			$view::newItemTable();
		}
		
		//*************** UPDATE ***************//
		elseif(isset($_GET['edit']) && $_GET['edit'] == is_numeric($_GET['edit']) && isset($_GET['update']) && $_GET['update'] == "quantity") {
			$gui::h2("Legg til varer på lager");
			echo "<p>Regisrer antall nye varer motatt (antall varer på lager fra før blir automatisk plusset på):<p>";
			$view::updateItemQuantity($_GET['edit']);
		}
		
		elseif(isset($_GET['item']) && $_GET['item'] == "updatesend") {
			if (empty($_POST['quantity'])) {
				$gui::error("Antall må fylles inn");
				echo $gui::back();
			}
			
			elseif (isset($_POST['quantity'])) {
				$gui::h2("Varer");
				
				//Finner gammelt antall og pluss på nytt.
				$sql = "SELECT * FROM `Webshop`.`item` WHERE `item`.`itemID` =".$_POST['itemid'];
				$item = $db->dbQuery($sql);
				$quantity = $item[0][2] + $_POST['quantity'];
				
				//Oppdaterer antall
				$sql = "UPDATE  `Webshop`.`item` SET  `quantity` =  '".$quantity."' WHERE  `item`.`itemID` =".$_POST['itemid'];
				$db->dbQuery($sql);
				echo $gui::verified("Antall ble oppdatert");
				$view::showItems($_SESSION['sortByItem']);
			}
		}
		
		elseif(isset($_GET['edit']) && $_GET['edit'] == is_numeric($_GET['edit'])) {
			$sql = "SELECT * FROM `Webshop`.`item` WHERE `item`.`itemID` =".$_GET['edit'];
			$result = $db->dbQuery($sql);
			$gui::h2("Rediger vare");
			$view::editItem($result);
		}
		
		elseif(isset($_GET['item']) && $_GET['item'] == "editsend") {
			$sql = "UPDATE  `Webshop`.`item` SET  `name` =  '".$_POST['name']."', `quantity` =  '".$_POST['quantity']."', `descr` =  '".$_POST['descr']."', `price` =  '".$_POST['price']."' WHERE  `item`.`itemID` =".$_POST['itemid'];
			$db->dbQuery($sql);
			$sql = "UPDATE  `Webshop`.`categories` SET  `catID` =  '".$_POST['cat']."' WHERE  `categories`.`catID` =".$_POST['oldCatId']." AND  `categories`.`itemID` =".$_POST['itemid']." LIMIT 1";
			$db->dbQuery($sql);
			$gui::h2("Varer");
			echo $gui::verified("Varen ble oppdatert");
			$view::showItems($_SESSION['sortByItem']);
		}
		//*************** SHOW CATEGORIES ***************//
		
		else {
		$gui::h2("Varer");
		$view::showItems($_SESSION['sortByItem']);
		}
		
		
		?>


	</div><!-- End mainbar -->	
</div><!-- End content -->

<?php
echo $gui::footer();
?>