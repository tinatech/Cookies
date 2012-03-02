<?php
include_once("header.php");
echo $gui::secondmenu("users");
?>
<div id="content">
	<div id="mainbar">
		<h2>Brukere:</h2>
		<?php echo $view::ShowManagers(); ?>
	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>
