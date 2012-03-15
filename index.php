<?php 
require_once("header.php"); ?>

<div id="content">
	<div id="sidebar"> <!--start sidebar-->	
		<?php $gui::showCart(); ?>
	</div> <!--end sidebar-->

	<div id="mainbar">
		<h2>Omnomnom</h2>
		<p><img src="./images/ds_cookie.jpg"></img></p>
	</div> <!-- End leftbar -->
	

</div> <!-- End content -->

<?php
//echo $gui::bodyContent();
echo $gui::footer(); 
?>
