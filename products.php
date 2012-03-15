<?php
include_once("header.php");

?>
<div id="content">
<div id="mainbar">	
<?php 
		//Kobling til databaseklassen.
		$db = new Database;
		
		$sql = "SELECT * FROM `category` ORDER BY name ASC";
		$sth = $db->dbQuery($sql);
		echo "<div id='secondmenu' style='margin-left: -5px'><ul>";
		foreach($sth as $row) { 
		 echo "<a href='?show=".$row['catID']."'><li class='first'>".$row['name']."</li></a>";
		}
		echo "</ul></div>";
		
		//Sjekker om ny sortBy session skal settes. Hvis ingen session er satt settes standard.
		if (isset($_GET['sortBy']) != null && isset($_GET['sortOrder']) != null) {
			$session::setSortBy("sortByItem", $_GET['sortBy'], strtoupper($_GET['sortOrder']));
		}
		elseif (!isset($_SESSION['sortByItem'])) { $session::setSortBy("sortByItem", "name", "ASC"); }
		
		//*************** SHOW ITEMS ***************//
		
		else {
		$gui::h2("Varer");
		$view::showItemsFront($_SESSION['sortByItem']);
		}
		
		
		?>		


	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>