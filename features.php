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
        	  <td colspan="2" align="center" valign="top"><div style="width:509px; margin:auto; background:#f2f2f2; text-align:center; padding:10px;">
        	<font style="font-size:16px; font-weight:bold; color:#5f5f5f;">Powerful Features</font><br />
            <font style="font-size:14px;">Powerful and easy-to-use, ADM provides you with an unparalleled set <br />of features including: </font>
        </div></td>
        	  </tr>
        	<tr>
            	<td valign="top" align="left">
            	  <strong>Main Features</strong>
                  <ul class="blue_bullet">
                  <li>Rigorous Decision-Making algorithm.</li>
                  <li>Powerful Processing Engine.</li>
                  <li>Integration of both quantitative and qualitative  information into your analysis.</li>
                  <li>Powerful On-line Structure Editing.</li>
                  <li>Automatic Mouse-driven Rating Capabilities.</li>
                  <li>Breaks down decisions into manageable parts</li>
                  <li>Dynamic Value Judgment showing Priority Vectors,  Consistency with Graphics.</li>
                  <li>Makes group consensus easy.</li>
                  <li>Dynamic Simulation.</li>
                  <li>Performance Analysis Capability.</li>
                  <li>Comprehensive Reporting System.</li>
                  <li>Export data to MS Excel</li>
                  </ul><br />
                  <strong>Ease of Use</strong><br />
ADM makes the process of decision-making easy. It allows a decision-maker to:
<ul class="blue_bullet">
  <li>Enter alternatives</li>
  <li>Enter the criteria or standards on which  alternatives will be judged</li>
  <li>Enter your evaluation of each alternative on each  criterion</li>
  <li>Enter your weighting or preference on each  criterion.</li>
</ul><br />
<strong>Structuring Features</strong>
<ul class="blue_bullet">
  <li>A visual point-and-click approach to model  building </li>
  <li>Visual approach with nodes, leaves and links  showing relationships between model variables. </li>
  <li>Clearly displays the hierarchy structure, making  it easier to report, audit and maintain. </li>
  <li>Displays dynamically the prioritisation vector  values and consistency measure at every step.</li>
  <li>Automatic links of attributes and alternatives.</li>
  <li>Definition sheet for attributes and alternatives.</li>
  <li>Display the Total number of judgements.</li>
  <li>Show / Hide alternatives link lines.</li>
  <li>Levels indicator</li>
  <li>Lock / Unlock facility</li>
</ul><br />
<strong>Rating Features</strong>
<ul class="blue_bullet">
  <li>Automatic generation of all decision matrices  with list of all items.</li>
  <li> Point-and-click pair comparison and data entry</li>
  <li>Numerical, Graphical and semantic pair comparison  preferences</li>
  <li>On line change of comparison word.</li>
  <li>Colour coded grid for clear decision matrix</li>
  <li>Automatic change of matrix dimension.</li>
  <li>Dynamic report and display on inconsistency for  every rating step.</li>
  <li>Automatic calculation of the utility score for  each alternative, given a set of preference weightings</li>
  <li>Automatic recommendation of the best alternative,  and listing of best choices in order</li>
  <li>Export Judgment matrices to MS Excel</li>
</ul><br />
<strong>Analysis and Simulation Features</strong>
<ul class="blue_bullet">
  <li>Displays bar charts with values of all attributes  and alternatives</li>
  <li>Increases or decrease the value of any attribute  with dynamic change of other attributes and alternatives.</li>
  <li>Goes to the original values at any time.</li>
  <li>Contribution graph of all attributes and  alternatives with lists and values.</li>
</ul><br />
<strong>Reporting Features</strong>
<ul class="blue_bullet">
  <li>Summary  results in matrix format for all priority vectors and consistencies.</li>
  <li>Comprehensive  report generations for printing for the hierarchy, decision matrices, bar  charts, contribution chart and summary table.</li>
  <li>Full  customisation of printed report.</li>
  <li>Visually  organises complicated models as a hierarchy of simple, comprehensible modules </li>
	<li>Exports  decision matrix, consistencies and judgment matrices to MS Excel</li>
</ul>
                </td>
                <td valign="top" align="left">
                  
                  <img src="includes/images/fe.jpg" />
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