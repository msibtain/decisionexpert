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
                <h1 class="red">ADM Decision Making System</h1>
        
        <table width="100%" class="pad2" border="0">
        	<tr>
            	<td valign="top" align="left"><p>Auto Decision Maker (ADM) is a multi-criteria decision-support  software tool based on the world's most popular decision-making methodology:  the Analytic Hierarchy Process (AHP). It  is designed specifically to help individuals and groups enhance the quality of  their decisions by bringing structure to their decision making process.</p>
                  <p>ADM provides a powerful approach to  making complex multidimensional decisions in organisations. It uses  state-of-the-art method based on Multi-Attribute Decision-Making where you can  identify the criteria and alternatives, and evaluate key trade-offs in an easy  and straightforward manner. </p>
                  <p>ADM helps you define the objectives,  goals, criteria and alternatives and then organise them into a hierarchical  structure. It allows you to compare and prioritise the relative importance of  the decision variables. ADM then synthesizes your judgments to arrive at a  conclusion and allows you to examine how changing the weighting of your  criteria affects your outcome.</p>
                  <p>ADM provides many results displays  designed to give you insights and to make you feel comfortable making a final  choice.. </p></td>
                <td valign="top" align="left">
                <img src="includes/images/ab.jpg" align="absmiddle" />
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