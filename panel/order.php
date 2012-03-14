<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">
	<div id="mainbar">
		<?php
			$orderid = $_GET['order'];
			$gui::h2("Ordre ".$orderid);
			$view::showOrder($orderid); 
		?>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
