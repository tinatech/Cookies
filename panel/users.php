<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<h2>Medarbeidere:</h2>
		<?php 
		//Hvis get remove er satt, slettes bruker.
		if (isset($_GET['remove'])) {
			$db = new Database;
			$sql = "DELETE FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['remove'];
			$db->dbQuery($sql);
			
			//Skjekker om brukeren faktisk er slettet eller ikke. Skriver deretter ut tilbakemelding.
			$sql = "SELECT * FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$_GET['remove'];
			$bool = $db->dbQueryExist($sql);
			if ($bool == true) { echo $gui::error("Error: Noe skjedde feil. Brukeren ble ikke slettet"); }
			elseif ($bool == false) { echo $gui::verified("Brukeren ble slettet"); }
		}

		$view::ShowManagers();
		?>	
	
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
