<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<h2>Legg til medarbeider:</h2>
		<?php 
		if (empty($_POST['fname']) || empty($_POST['sname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) ) {
			$view::NewAdminTable();
		}
		else {	//Hvis satt, sender data over til database klassen
			$db = new Database;
			$db->NewAdmin("new", $_POST);
			echo "<br><br>". "Brukeren ble lagt til";
		}
		?>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
