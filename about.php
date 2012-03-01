<?php
require_once("./conf/config.php");
include "functions.php";
include "./lib/db.php";

// Henter inn header informasjon
include_once("header.php");
?>
<div id="content">

	<div id="sidebar"> <!--start sidebar-->	
		<div id="bestsellers"> <!--start bestsellers-->
			<h3>5 på topp</h3>
			<p>hububa</p>
		</div> <!--end bestsellers-->
	</div> <!--end sidebar-->
	
	<div id="mainbar">
		<h2> The Dark Cookie Shop </h2>
		<p>Nettbutikken The Dark Cookie Shop er basert på "Welcome to the dark side, we have cookies..." </p>
		<p>- Petter, Christoffer, Kjetil og Tina</p>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
include_once("footer.php");
?>
