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
                 <h1 class="red">Practical Example        </h1>
        <table width="100%" class="pad2">
          <tr>
          <td width="69%" valign="top">The following is a simplified version of a real application of the AHP method.</td>
          <td width="31%" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td valign="top">Star Investment Company received three proposals for investment projects. These projects are:</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            
            <table width="80%" align="center">
              <tr>
                <td width=""><span style="color:#B10023;"><strong>1) Publishing</strong></span></td>
                <td width="180" style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Publishing</td>
                </tr>
              <tr>
                <td><span style="color:#B10023;"><strong>2) Transport</strong></span></td>
                <td style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Transport</td>
                </tr>
              <tr>
                <td><span style="color:#B10023;"><strong>3) Farming</strong></span></td>
                <td style="border:1px solid #cc9900; background:#f6efe7; color:#000;">Farming</td>
                </tr>
            </table>          </td>
          </tr>
        <tr>
          <td colspan="2" valign="top">The company was looking to select the best project of these three. Therefore the overall goal was established as to </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="80%" align="center">
              <tr>
                <td width=""><span style="color:#B10023;"><strong>Select the Best project </strong></span></td>
                <td width="180" style="border:1px solid #cc9900; background:#f6efe7; color:#000;">Select the Best project</td>
              </tr>
              </table></td>
        </tr>
        <tr>
          <td colspan="2" valign="top">After some discussions and consultation the board has established four major criteria for the selection process, as follows: </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="80%" align="center">
              <tr>
                <td width=""><span style="color:#B10023;"><strong>Market size</strong></span></td>
                <td width="180" style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Market size</td>
                </tr>
              <tr>
                <td><span style="color:#B10023;"><strong>Available Resources</strong></span></td>
                <td style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Available Resources</td>
                </tr>
              <tr>
                <td><span style="color:#B10023;"><strong>Return on investment</strong></span></td>
                <td style="border:1px solid #cc9900; background:#f6efe7; color:#000;">Return on investment</td>
              </tr>
              <tr>
                <td><span style="color:#B10023;"><strong>Impact on environment</strong></span></td>
                <td style="border:1px solid #cc9900; background:#f6efe7; color:#000;">Impact on environment</td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" valign="top">The <font style="color:#B10023;"><strong>Resources</strong></font> criterion was broken down into three sub-criteria: </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><table width="80%" align="center">
              <tr>
                <td width=""><font style="color:#B10023;"><strong>Finance</strong></font></td>
                <td width="180" style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Finance</td>
                </tr>
              <tr>
                <td><font style="color:#B10023;"><strong>Technology</strong></font></td>
                <td style="border-top:1px solid #cc9900; border-left:1px solid #cc9900; border-right:1px solid #cc9900; background:#f6efe7; color:#000;">Technology</td>
                </tr>
              <tr>
                <td><font style="color:#B10023;"><strong>Skills</strong></font></td>
                <td style="border:1px solid #cc9900; background:#f6efe7; color:#000;">Skills</td>
                </tr>
            </table></td>
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