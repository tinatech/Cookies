<?php
require("../loadenv.php");
include "../functions.php";
include "../lib/DB.php";


// Henter inn header informasjon

echo $gui::header("Employe panel");
echo $gui::menu("admin");
?>
<div id="content">
	<div id="mainbar">
		<h2> Ordre </h2>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
