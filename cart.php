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
	
	
	if(isset($_POST['checkout']) && isset($_SESSION['uID'])) { 

		$sql = "INSERT INTO  `Webshop`.`ordr` (`orderID` ,`uid` ,`status` ,`time` ,`pby`)
				VALUES ( NULL ,  '".$_SESSION['uID']."',  '0', NOW(), NULL )";
		$db->dbQuery($sql);
		$sql = "SELECT LAST_INSERT_ID()";
		$id = $db->dbQuery($sql);
		
		while($i < $count) {
		$sql = "INSERT INTO  `Webshop`.`orderlines` (`orderLineID` ,`itemID` ,`orderID` ,`price` ,`quantity`)
				VALUES (NULL ,  '".$cart[$i]['itemID']."',  '".$id[0][0]."',  '".$cart[$i]['itemPrice']."',  '".$cart[$i]['ItemQty']."')";
		$db->dbQuery($sql);
		$i++;
		}
		$_SESSION['cart'] = NULL;
	}
	if(isset($_POST['checkout']) && !isset($_SESSION['uID'])) { $gui::error("Du må logge inn for å betille varer"); }
	
	if(isset($_POST['delete'])) { 
		$i = $_POST['count'];
		unset($_SESSION['cart'][$i]);

		$_SESSION['cart'] = array_values($_SESSION['cart']);
		echo "<script language='javascript'>window.location.href='cart.php';</script>";
	}
	
	/*if(isset($_POST['update'])) { 
		$i = $_POST['count'];
		$item = array(
			'itemID' => $_SESSION['cart'][$i]['itemID'],
			'ItemQty' => $_POST['quantity'],
	       	'itemPrice' => $_SESSION['cart'][$i]['itemPrice']);
	    $item2 = array(
			'itemID' => $_SESSION['cart'][$i]['itemID'],
			'ItemQty' => $_SESSION['cart'][$i]['ItemQty'],
	       	'itemPrice' => $_SESSION['cart'][$i]['itemPrice']);
		$_SESSION['cart'][$i][$item2] > $_SESSION['cart'][$i][$item];
   		echo "<script language='javascript'>window.location.href='cart.php';</script>";
	}*/
	
	
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
			echo ",-</td><td style='width: 120px;'><input type='hidden' name='count' value='".$i."'><input type='submit' name='delete' value='Slett' /></td></tr></form>";
			$totalprice = $totalprice + ($cart[$i]['itemPrice'] * $cart[$i]['ItemQty']);
			$i++;
		}
	echo "<tr style='background-color: #efefef;'><td></td><td><strong>Totalpris</strong></td><td>".$totalprice.",-</td><td></td></table>";
	
	//<input type='submit' name='update' value='Oppdater' />
	
	
		
	?>
	<span class='orderbutton' id='finish2' style='margin-right: -303px;'><form action='' method='POST'><input type='submit' name='checkout' value='Send ordre' /></form></span>
	</div><!-- End mainbar -->	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
