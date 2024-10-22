<?php	 	 include('header.php'); ?>

<!--left-->
<?php	 	 include('left.php'); ?>  
                 
<!--center-->

<div id="container" class="equal">
	<?php	 	 if (!$_SESSION['user']) { ?>
	<div class="row-banner clear">
    	<div class="moduletable">
			<p><img src="includes/shop-ad-books.jpg" border="0"></p>		
        </div>
	</div>
    <?php	 	 } else { include('user_menu.php'); } ?>
    
	<div class="clear">
	<table width="100%">
	<tr>
		<td style="padding:0px 20px;">
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
                <h1 class="red">Analytic Hierarchy Process </h1>
                <p>The Analytic Hierarchy Process (AHP) is a structured technique for organising and analysing complex decisions. Based on mathematics and psychology, it was developed by Thomas L. Saaty in the 1970s and has been extensively studied and refined since then. It has particular application in group decision making and is used around the world in a wide variety of decision situations, in fields such as government, business, industry, healthcare, and education.</p>
                <p>Over 1000 articles and over 100 doctoral dissertations written about AHP and thousands of actual applications.</p>
                <p><img src="includes/images/ahp.jpg" align="right" />
                The AHP is the most widely used decision making approach in the world today<br />

Simplicity<br />
Ease of Understanding<br />
Flexibility<br />
Accuracy

                </p>
                <p>
                
                It can be characterised as a multi-criteria decision technique that can combine qualitative and quantitative factors in the overall evaluation of alternatives. 
<ol>
<li>the AHP is a structured decision process quantitative process which can be documented and replicated, </li>
<li>it is applicable to decision situations involving multi-criteria,</li> 
<li>the AHP is applicable to decision situations involving subjective judgment, </li>
<li>it uses both qualitative and quantitative data, </li>
<li>it provides measures of consistency of preference, </li>
<li>there is ample documentation of AHP applications in the academic literature, </li>
<li>commercial AHP software is available with technical and educational support, and </li>
<li>the AHP is suitable for group decision-making.</li>
</ol>
</p>
                </td>
            </tr>
        </table>
        
        </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>