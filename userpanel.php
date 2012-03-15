<?php
require_once('header.php');
?>
<div id="content">
	        <div id="mainbar">
		                <?php
			                        if (isset($_GET['order'])) {
			                        $gui::h2("Ordre");
						            $view::showOrderUser($_GET['order']);
						            }
						            else {			                        
			                        $gui::h2("Ordre");
						            $view::showOrdersUser($_SESSION['uID']);
						            }
						                
                ?>
        </div><!-- End mainbar -->
</div><!-- End content -->


