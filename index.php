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
		<h2>Omnomnom</h2>
		<p>Welcome to the dark side, we have cookies... </p>
		<p>- Petter, Christoffer, Kjetil og Tina</p>
	</div> <!-- End leftbar -->
	

</div> <!-- End content -->

<?php echo $gui::footer(); ?>
