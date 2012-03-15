<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">
	<div id="mainbar">
	<?php 
	if (!isset($_SESSION['cart'])) {
		die("Ingen varer");
	}
		
	$db = new Database;
	$cart = $_SESSION['cart'];
	$count = count($cart);
	$i = 0;
	
	
	if(isset($_POST['checkout'])) { 

	$sql = "INSERT INTO  `Webshop`.`ordr` (`orderID` ,`uid` ,`status` ,`time` ,`pby`)
			VALUES ( NULL ,  '".$_SESSION['uID']."',  '0',  'CURDATE()', NULL )";
	$db->dbQuery($sql);
	
	
	echo "wee"; 
	
	
	
	}
	
	
	$totalprice = 0;
	echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
	echo "<tr id=\"overskrift\"><td id='name'>Artikkel</td><td>Antall</td><td>Stk pris</td><td>Handlinger</td></tr>", "\n";
		while($i < $count) {
			echo "<form action='' method='POST'><tr><td>";
			$sql = "SELECT * FROM item WHERE itemID =".$cart[$i]['itemID'];
			$name = $db->dbQuery($sql);
			echo $name[0][1];
			echo "</td><td><input type='number' value='".$cart[$i]['ItemQty']."' name='quantity' style='width: 30px;'></td><td>";
			echo $cart[$i]['itemPrice'];
			echo ",-</td><td style='width: 120px;'><input type='submit' name='submit' value='Oppdater' /><input type='submit' name='delete' value='Slett' /></td></tr></form>";
			$totalprice = $totalprice + $cart[$i]['itemPrice'];
			$i++;
		}
	echo "<tr style='background-color: #efefef;'><td></td><td><strong>Totalpris</strong></td><td>".$totalprice.",-</td><td></td></table>";
	
	
	
	
		
	?>
	<span class='orderbutton' id='finish2' style='margin-right: -303px;'><form action='' method='POST'><input type='submit' name='checkout' value='Send ordre' /></form></span>
	</div><!-- End mainbar -->	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
