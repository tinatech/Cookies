<?php 
require_once("header.php"); ?>

<div id="content">
	

	<div id="mainbar">

<?php  
$db = new Database;
$sok = $_POST['keywords'];
if ($sok != NULL) {
		$var = $_POST['keywords'];
		$trimmed = trim($var); //trim whitespace from the stored variable
		// Build SQL Query
		$sql = "SELECT * FROM item WHERE name like '".$trimmed."' OR price like '".$trimmed."'";
		$result = $db->dbQuery($sql);
		if ($result != NULL) {
			echo "<strong>Resultater for ".$trimmed.":</strong><br /><br />";
			echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
			echo "<tr id=\"overskrift\"><td style='width: 50px;'></td><td id='name'>Vare</td><td>Beskrivelse</td><td>Kategori</td><td>Antall</td><td>Pris</td><td></td></tr>", "\n";
		
			$rowCount = 0;
			foreach($result as $row) {
				$sql = "SELECT * FROM  `categories` WHERE `itemID` = '".$row['itemID']."'";
				$catId = $db->dbQuery($sql);
				$sql = "SELECT * FROM  `category` WHERE `catID` = '".$catId[0][0]."'";
				$cat = $db->dbQuery($sql);
				$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
				$image = "";
				if ($row['image'] != NULL) { $image = "<img src='data:image/jpeg;base64," . base64_encode( $row['image'] ) ."' class='itemimage' />"; }
				if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
				// Skriv ut rader.
 			  
 			   	echo "<tr".$even."><td>".$image."</td><td>".$row['name']."</td><td>".$row['descr']."</td><td>".$cat[0][1]."</td><td>".$row['quantity']."</td><td>".$row['price'].",-</td><td><a href='?add=".$row['itemID']."'>Kjøp</a></td></tr>", "\n";
			}
			echo "</table>";
		}
		else { echo "Søkeordet ga ingen resultater"; }
}
else { echo "Du må sette søkeord!"; }

?>

	</div> <!-- End leftbar -->
	

</div> <!-- End content -->

<?php
//echo $gui::bodyContent();
echo $gui::footer(); 
?>
