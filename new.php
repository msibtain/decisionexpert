<?php	 	 include('header.php'); ?>

<!--left-->
<?php	 	 include('left.php'); ?>  
                 
<!--center-->
<div id="container" class="equal">
	 <?php	 	 if (!$_SESSION['user']) { ?>
                            		                                   <div class="row-banner clear">		<div class="moduletable">
					<p><img src="includes/shop-ad-books.jpg" border="0"></p>		</div>
	</div>
    <?php	 	 } else { include('user_menu.php'); } ?>    
    
	<div class="clear">
    <form action="new.post.php" method="post">
	<table width="100%">
	<tr>
		<td style="padding:0px 20px;">
        
        <table width="100%" cellpadding="4" cellspacing="2" border="0">
        	<tr>
        	  <td><h2>User Information:</h2></td>
      	  </tr>
        	<tr>
        	  <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        	    <tr>
        	      <td width="20%">Project Name:</td>
        	      <td width="30%"><input type="text" name="project_name" /></td>
        	      <td width="20%">Version:</td>
        	      <td width="30%"><input type="text" name="version" /></td>
      	      </tr>
        	    <tr>
        	      <td>Organization:</td>
        	      <td><input type="text" name="organization" /></td>
        	      <td>Department:</td>
        	      <td><input type="text" name="department" /></td>
      	      </tr>
        	    <tr>
        	      <td>User Name:</td>
        	      <td><input type="text" name="user_name" /></td>
        	      <td>Date:</td>
        	      <td><input type="text" name="date" /></td>
      	      </tr>
      	    </table></td>
      	  </tr>
        	<tr>
        	  <td><h2>Project Definition</h2></td>
      	  </tr>
        	<tr>
        	  <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        	    <tr>
        	      <td width="20%">Objective:</td>
        	      <td width="30%"><input type="text" name="objective" /></td>
        	      <td width="20%">Levels:</td>
        	      <td width="30%"><input type="text" name="levels" value="3" readonly="readonly" /></td>
      	      </tr>
        	    <tr>
        	      <td colspan="4">
                  <?php	 	 include('ahp.php'); ?>
                  </td>
        	      </tr>
      	      </table></td>
      	  </tr>
        	<tr>
        	  <td><input type="submit" name="submit" value="Submit" class="button" /></td>
      	  </tr>
        	<tr>
        	  <td>&nbsp;</td>
      	  </tr>
        	<tr>
            	<td>&nbsp;</td>
            </tr>
        </table>
        
        </td>
	</tr>
	</table>
    </form>
	</div>
</div>
<?php	 	 include('footer.php'); ?>