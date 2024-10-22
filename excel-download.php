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
	<table>
	<tr>
		<td style="padding:0px 20px;">
        
        <p>&nbsp;</p>
        <h1>Export to Excel</h1><br />
<br />

        <?php	 	 include('excel.post.php'); ?><br />
<br />

        </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>