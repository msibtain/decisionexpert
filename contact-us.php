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
        	<td valign="top"> <h1 class="red">Contact Us</h1>
            <script language="javascript">
			function checkForm()
			{
				var error = false;
				
				jQuery('.required').each(function(){
					if (!jQuery(this).val()) 
					{
						jQuery(this).css('background-color', '#b10023');
						jQuery(this).css('color', '#FFFFFF');
						error = true;
					}
					else
					{
						jQuery(this).css('background-color', 'white');
						jQuery(this).css('color', '#000000');
					}
				});
				return (!error)
					
			}
			</script>
            <form action="contact.post.php" name="contactFrm" method="post" onsubmit="javascript: return checkForm();">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td colspan="3"><p>Please fill in the  following form and we'll get back to you as soon as possible. </p></td>
                  </tr>
                <tr>
                  <td colspan="3" align="center"><p><span class="red">All fields are required</span> </p></td>
                  </tr>
                <tr>
                  <td align="right">Name</td>
                  <td><input type="text" name="name" style="width:200px;" class="required" /></td>
                  <td rowspan="5" valign="top"><img src="includes/images/phone.jpg" align="absmiddle" /></td>
                </tr>
                <tr>
                  <td><div align="right">Organisation</div></td>
                  <td><input type="text" name="organisation" style="width:200px;" class="required" /></td>
                  </tr>
                <tr>
                  <td><div align="right">Job Title</div></td>
                  <td><input type="text" name="job_title" style="width:200px;" class="required" /></td>
                  </tr>
                <tr>
                  <td><div align="right">Country</div></td>
                  <td><input type="text" name="country" style="width:200px;" class="required" /></td>
                  </tr>
                <tr>
                  <td><div align="right">Telephone</div></td>
                  <td><input type="text" name="telephone" style="width:200px;" class="required" /></td>
                  </tr>
                <tr>
                  <td align="right" valign="top">Message</td>
                  <td colspan="2" valign="top">
                    <textarea rows="5" cols="40" name="message" class="required"></textarea>
                  </td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                      <input type="submit" name="sbt" value="Submit" class="button" />
                      <input type="hidden" id="gcaptcha-token" name="gcaptcha-token" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </form>
              <p>&nbsp;</p></td>
            <td valign="top">&nbsp;</td>
        </tr>
        </table>
       </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>