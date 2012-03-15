<?php
include_once("header.php");
echo $gui::secondmenu("orders");
?>
<div id="content">

		<?php
			$db = new Database;
			if(isset($_GET['order']) && isset($_GET['status']) && $_GET['status'] == "0") {
				$sql = "UPDATE `Webshop`.`ordr` SET `status` = '0', `pby` = NULL WHERE `ordr`.`orderID` = ".$_GET['order'];
				$db->dbQuery($sql);
				echo "<script language='javascript'>window.location.href='index.php';</script>";
			}
			elseif(isset($_GET['order']) && isset($_GET['status']) && $_GET['status'] == "2") {
				$sql = "UPDATE `Webshop`.`ordr` SET `status` = '2', `pby` = '".$_SESSION['aID']."' WHERE `ordr`.`orderID` = ".$_GET['order'];
				$db->dbQuery($sql);
				echo "<script language='javascript'>window.location.href='index.php?status=2';</script>";
			}
			else {
				
				$sql = "SELECT * FROM `ordr` WHERE `ordr`.`orderID` =".$_GET['order'];
				$exist = $db->dbQuery($sql);
			
				if( $exist[0][2] == '0') {
					$sql = "UPDATE  `Webshop`.`ordr` SET  `status` = '1', `pby` = '".$_SESSION['aID']."' WHERE  `ordr`.`orderID` =".$_GET['order'];
					$db->dbQuery($sql);
					$gui::infobox("Ordren er flyttet til under behandling");
				}
				elseif($exist[0][2] == '2') {
					$gui::infobox("Orderen er allerede sendt.");
				}
			
				$orderid = $_GET['order'];
				$gui::h2("Ordre ".$orderid);
				$view::showOrder($orderid); 
			}
		?>
			
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
