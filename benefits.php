<?php	 	 include('header.php'); ?>

<!--left-->
<?php	 	 include('left.php'); ?>  
                 
<!--center-->
<div id="container" class="equal">
	<?php	 	 if (!$_SESSION['user']) { 
	$bPadding = '10px';
	?>
	<div class="row-banner clear">
    	<div class="moduletable">
			<p><img src="includes/shop-ad-books.jpg" border="0"></p>		
        </div>
	</div>
    <?php	 	 } else { 
	$bPadding = '10px';
	include('user_menu.php'); } ?>
    
	<div class="clear">
	<table width="100%">
	<tr>
		<td style="padding:10px <?=$bPadding?> !important;">
        
        <table width="100%">
        	<tr>
            	<?php	 	 if ($_SESSION['user']) { ?>
            	<td width="25%">
				<div class="clear wrapper-box module_menu">
             
                
                
                        <div class="box-indent">
                <div class="clear">
                <?php	 	 include('products_left.php'); ?>
                
                </div>
            </div>		</div>
				</td>
                <?php	 	 } ?>
                <td>
                <h1 class="red">Benefits</h1>
        
        <table width="100%" class="pad2" border="0">
        	<tr>
            	<td valign="top" align="left">
                <ul class="red_bullet">
                	<li>Structured and systematic decision making </li>
                  <li>Measures consistency in judgements</li>
                  <li>Simple, easy to-use front end with powerful processing engine </li>
                  <li>Support group decision making for perfect consensus</li>
                  <li>Providing integrated analysis and reporting capabilities </li>
                  <li>Value for money </li>
                  <li>Vast research and applications literature </li>
                  <li>Powerful, reliable, secure and accurate </li>
                  <li>Training and certification </li>
                  <li>Proven and effective methodology </li>
                  <li>Simplification and automation of essential decision process </li>
                  <li>Technology that is constantly evolving  </li>
                  </ul>
                  
                  <p>&nbsp;</p>
                  
                  </td>
                <td valign="top" align="left">
                <img src="includes/images/benefits.jpg" align="absmiddle" />
                </td>
            </tr>
        </table>
                </td>
            </tr>
        </table>
        
		
        </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>