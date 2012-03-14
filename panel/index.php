<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">
	<div id="mainbar">
<<<<<<< HEAD
		<h2>Ubehandlede ordrer:</h2>
	</div><!-- End mainbar -->
=======
		<?php
		if(isset($_GET['status']) && $_GET['status'] == "1") {
			$gui::h2("Ordre under behandling");
			$view::showOrders("1", ""); 
		}
		elseif(isset($_GET['status']) && $_GET['status'] == "2") {
			$gui::h2("Sendte ordre");
			$view::showOrders("2", ""); 
		}
		elseif(isset($_GET['status']) && $_GET['status'] == "all") {
			$gui::h2("Alle ordre");
			$view::showOrders("all", ""); 
		}
		else {
			$gui::h2("Ubehandlede ordrer");
			$view::showOrders("0", ""); 
		}
		?>
	</div><!-- End mainbar -->	
>>>>>>> e53bccab9949142d4fd9f02b4dcef8ea21d4f621
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
