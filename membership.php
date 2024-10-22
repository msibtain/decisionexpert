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
        	<td valign="top"> <h1 class="red">Membership</h1>
            <p>There are four types of membership.</p>
        <p><span class="red"><strong>1. Individual Users<br />
        </strong></span>Individual Users.</p>
        <p><span class="red"><strong>2. Associate Members<br />
      </strong></span>Associate Members are individuals who are certified as ADM consultants and trainers. </p>
        <p><strong><span class="red">3. Corporate Members<br />
      </span></strong>Corporate memberships offer companies and government agencies the opportunity to use ADM online for their employee or customers..  </p>
<p><strong><span class="red">4. White Label <br />
</span></strong>You can brand and integrate ADM into your website. ADM can be presented to your customers as your own! With our Partner license in place you can use your logo and contact details on ADM materials.</p>
<p>For any question please <a href="contact-us.php">contact us</a></p></td>
            <td valign="top">
            <img src="includes/images/membership_side.jpg" /></td>
        </tr>
        </table>
       </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>