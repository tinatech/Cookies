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
			$db->DeleteAdmin($_GET['remove']);
		}

		$view::ShowManagers();
		?>	
	
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
