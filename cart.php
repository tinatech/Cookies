<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">
	<div id="mainbar">
	<?php 

	$cart = $_SESSION['cart'];
	$count = count($cart);
	$i = 0;
	$totalprice = 0;
	echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
	echo "<tr id=\"overskrift\"><td id='name'>id</td><td>Antall</td><td>Stk pris</td><td>Handlinger</td></tr>", "\n";
		while($i < $count) {
			print($cart[$i]['itemID']);
			$i++;
		}
	echo "</talbe>";
	
	
	?>
	</div><!-- End mainbar -->	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
