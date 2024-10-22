<?php	 	 include('header.php'); ?>

<!--left-->
<?php	 	 include('left.php'); ?>  
                 
<!--center-->
<div id="container" class="equal">
	<?php	 	 if (!$_SESSION['user']) { $bPad = '20px';  ?>
	<div class="row-banner clear">
    	<div class="moduletable">
			<p><img src="includes/shop-ad-books.jpg" border="0"></p>		
        </div>
	</div>
    <?php	 	 } else { $bPad = '110px';  include('user_menu.php'); } ?>
    
	<div class="clear">
	<table width="100%">
	<tr>
		<td style="padding:0px <?=$bPad?>!important;">
        <table width="100%">
        <tr>
        	<td valign="top"> <h1 class="red">Training</h1>
        <p><span class="red"><strong>Become a  Certified ADM Consultant</strong></span></p>
        <p>The ADM Qualifying  Programme is an opportunity for trainers and consultants to add a new dimension  to their training toolkit. The programme has been designed to prepare you for a  rewarding career in training and consulting. </p>
        <p><span class="red"><strong>ADM  Training Course</strong></span></p>
        <p>In this certification  course you will experience and learn how to deliver ADM workshops for diverse  groups and topics. You will learn about the theory and practice, as well as the  benefits, applications and features of the system and the ethical considerations  for using the model appropriately.</p>
        <p>Experiencing both  classroom and hands-on, interactive learning you will learn practical skills  and knowledge of ADM system, and learn about its applications.</p>
        <p>Participants will be  provided with training and related materials, promote themselves as an ADM  Consultants both inside and outside their organisation, organise and conduct  Introductory and Applications training and charge for their services.</p>
        <p>For fee and schedule  please <a href="contact-us.php">contact us</a></p></td>
            <td valign="top">
            <img src="includes/images/training_side.jpg" />
            <p align="center">
            <span class="red">This 3 day training qualifies<br /> you as an ADM Consultant</span>
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