<?php include('header.php'); ?>

<!--left-->
<?php include('left.php'); ?>                   
                                                           <!--center-->
                              <div id="container" class="equal">
                              
                              
<?php 
if (!$_SESSION['user']) 
{ 
    $bWidth = '100%'; 
	$bPad = '70px'; 
	
	$mLeft = 'auto';
	?>
    <div class="row-banner clear">		<div class="moduletable">
					<p class="main-p"><img src="includes/shop-ad-books.jpg" border="0"></p>		</div>
	</div>
    <?php 
} 
else 
{ 
	$bWidth = '70%'; 
	$bPad = '80px';
	$mLeft = '140px';
	 
	include('user_menu.php'); 
} 

?> 
    
                                                                                                      <div class="clear">

	<table width="100%">
    <tr>
    	<td style="padding:10px <?=$bPad?> !important;">
        
        <div style="width:485px; text-align:center; margin:auto auto auto <?=$mLeft?>; background:url(includes/images/g.jpg) no-repeat;">
        	<p style="color:#4d4d4d; font-size:14px !important; "><br />A decision-support system based on the most widely used <br />decision making approach in the world today</p>
            <p style="color:#b10023; font-size:14px !important; ">Provides a powerful approach to making complex <br />multidimensional decisions </p>
        </div>
        
        <p align="center"><br /><img src="includes/images/titles.jpg" align="absmiddle" /></p>
        
        <div align="center">
        <table width="<?=$bWidth?>" class="pad2" border="0" align="center">
        	<tr>
            	<td style="vertical-align:middle" align="left"><img src="includes/images/p1.jpg" /></td>
                <td style="vertical-align:middle" align="left"><strong>Thousands of Applications</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p4.jpg" alt="Structured Decision Process" /></td>
                <td style="vertical-align:middle" align="left"><strong>Structured Decision Process</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p7.jpg" alt="Measures of consistancy" /></td>
                <td style="vertical-align:middle" align="left"><strong>Measures of Consistancy</strong></td>
            </tr>
            <tr>
            	<td style="vertical-align:middle" align="left"><img src="includes/images/p2.jpg" alt="Group Decision Making" /></td>
                <td style="vertical-align:middle" align="left"><strong>Group Decision Making</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p5.jpg" alt="Multi Criteria Decision" /></td>
                <td style="vertical-align:middle" align="left"><strong>Multi-criteria Decisions</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p8.jpg" alt="Subjective and Objective Judgements" /></td>
                <td style="vertical-align:middle" align="left"><strong>Subjective and Objective Judgments</strong></td>
            </tr>
            <tr>
            	<td style="vertical-align:middle" align="left"><img src="includes/images/p3.jpg" alt="Systematic and Flexible" /></td>
                <td style="vertical-align:middle" align="left"><strong>Systematic and Flexible</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p6.jpg" alt="Qualitative and Quantitative Data" /></td>
                <td style="vertical-align:middle" align="left"><strong>Qualitative and Quantitative Data</strong></td>
                <td style="vertical-align:middle" align="left"><img src="includes/images/p9.jpg" alt="Technical and Educational Support" /></td>
                <td style="vertical-align:middle" align="left"><strong>Technical and Educational Support</strong></td>
            </tr>
        </table>
        </div>
        
        </td>
    </tr>
    </table>
                                  </div>
                              </div>
<?php include('footer.php'); ?>