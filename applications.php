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
                 
        <table width="100%" class="pad2" border="0">
        	<tr>
        	  <td colspan="3" align="center" valign="top"><div style="width:509px; margin:auto; background:#f2f2f2; text-align:center; padding:10px;">
        	<font style="font-size:16px; font-weight:bold; color:#5f5f5f;">Applications</font><br />
            <font style="font-size:14px;">ADM can be successfully improve decision making in a very broad <br />range of areas, including: </font>
        </div></td>
        	  </tr>
        	<tr>
            	<td valign="top" align="left">
                <ul class="red_bullet">
                <li>Acquisition/Merger Decisions </li>
                  <li>Banking and Investment</li>
                  <li>Benefit/Cost Analysis </li>
                  <li>Business Development</li>
                  <li>Business Process Re-engineering </li>
                  <li>Conflict Resolution</li>
                  <li>Consumer Choice </li>
                  <li>Consumer Products </li>
                  <li>Customer Satisfaction </li>
                  <li>Economic Planning</li>
                  <li>Education</li>
                  <li>Energy &amp; Utilities </li>
                  <li>Engineering Design </li>
                  <li>Environmental Applications</li>
                  <li>Environmental Decision Making </li>
                  <li>Financial and Investment Decisions </li>
                  <li>Forecasting</li>
                  <li>Government Policy</li>
                  <li>Health and Safety</li>
                  <li>Hiring and Evaluation</li>
                  <li>Human Resources Development </li>
                  <li>Legal Applications</li>
                  <li>Location Problems </li>
                  <li>Marketing Decisions </li>
                  <li>Marketing Strategies</li>
                  <li>Medical Decision Making</li>
                  <li>Military Applications</li>
                  </ul>
                  </td>
                <td valign="top" align="left">
                <ul class="red_bullet">
                	<li>Negotiation and  Conflict Resolution </li>
                  <li>New Product  Development </li>
                  <li>Organisational  Development</li>
                  <li>Performance  Evaluations </li>
                  <li>Personal Applications</li>
                  <li>Pharmaceutical &amp;  Life Sciences </li>
                  <li>Planning and Policy  Decisions </li>
                  <li>Police and Security</li>
                  <li>Politics</li>
                  <li>Predicting Outcomes </li>
                  <li>Product Portfolio  Planning </li>
                  <li>Project Management</li>
                  <li>Proposal Evaluation </li>
                  <li>Public policy and  Government</li>
                  <li>Purchasing Decisions </li>
                  <li>R&amp;D Management </li>
                  <li>Recommending Policies </li>
                  <li>Recruitment and  Selection</li>
                  <li>Resource Allocation </li>
                  <li>Risk Analysis </li>
                  <li>Science and  Technology</li>
                  <li>Site Selection or  Relocation </li>
                  <li>Strategic Planning </li>
                  <li>Total Quality  Management </li>
                  <li>Transport Systems</li>
                  <li>Transportation </li>
                  <li>Vendor Selection  &amp; Procurement</li>
                  </ul>
                  </td>
                <td valign="top" align="left">
                
                <img src="includes/images/ap.jpg" />
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