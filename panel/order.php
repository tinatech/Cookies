<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">
	<div id="mainbar">
		<?php
			$db = new Database;
			$sql = "SELECT * FROM `order` WHERE `order`.`orderID` =".$_GET['order'];
			$exist = $db->dbQuery($sql);
			if( $exist[0][2] == '0') {
			$sql = "UPDATE  `Webshop`.`order` SET  `status` =  '1' WHERE  `order`.`orderID` =".$_GET['order'];
			$db->dbQuery($sql);
			$gui::infobox("Ordren er flyttet til under behandling");
			}
			elseif($exist[0][2] == '2') {
				$gui::infobox("Orderen er ferdigbehandlet.");
			}
			
			$orderid = $_GET['order'];
			$gui::h2("Ordre ".$orderid);
			$view::showOrder($orderid); 
		?>
			<span class="orderbutton">Marker som ubehandlet</span><span class="orderbutton">Behandlet ferdig</span>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
