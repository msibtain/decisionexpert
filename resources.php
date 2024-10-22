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
        	<td valign="top"> <h1 class="red">Resources</h1>
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