<?php
require("loadenv.php");
include "functions.php";
include "./lib/DB.php";


// Henter inn header informasjon

echo $gui::header("The Dark Cookie Shop");
echo $gui::menu("user");
?>
<div id="content">

	<div id="sidebar"> <!--start sidebar-->	
		<div id="bestsellers"> <!--start bestsellers-->
			<h3>5 på topp</h3>
			<p>hububa</p>
		</div> <!--end bestsellers-->
	</div> <!--end sidebar-->

	<div id="mainbar">	
		<h2> Våre produkter</h2>
	</div><!-- End mainbar -->
	
	
	
</div>

<?php echo $gui::footer(); ?>
