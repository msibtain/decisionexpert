<?php	 	 if (!$_SESSION['user']) { ?>
<div id="left" class="equal">
                                    <div class="clear">		
                                    
                                    
                                    <?php	 	 include('login.box.php'); ?>
			<div class="clear wrapper-box module_menu">
            <?php	 	
			$php_self = $_SERVER['PHP_SELF'];
			$pageArray = explode("/",$php_self);
			$page = $pageArray[count($pageArray)-1];
			$product_pages = array(
			'products.php',
			'about-adm.php',
			'benefits.php',
			'applications.php',
			'features.php',
			'example.php',
			'ahp-page.php'
			);
			
			if (in_array($page, $product_pages))
			{
				include('products_left.php');	
			} ?>
		</div>
		
		
		<div class="clear wrapper-box module_menu">
			<a href="http://decisionexpert.co.uk/Best_Car_v1.pdf" target="_blank" class="button_red">Sample Report</a>
		</div>
                                    </div>
                                </div>
<?php	 	 } ?>