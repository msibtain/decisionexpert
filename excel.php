<?php	 	 
include('header.php'); 

$id = @$_GET['id'];


?>

<!--left-->
<?php	 	 include('left.php'); ?>  

<script language="javascript">
function toggleOptions(chk)
{
	var opt = jQuery('.options');
	jQuery.each(opt, function(){
		if (chk)
		this.checked = true;
	else
		this.checked = false;
		
	});
	
}
</script>               
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
		<td style="padding:0px 110px !important;">
        <h1>Export to Excel</h1>
        <p>&nbsp;</p>
        <p>ADM allows you to export six different reports. You may select to export any combination of these reports, <br />or export all of them at once.</p>
        
        <form action="excel-download.php?id=<?=$id?>&for_pdf=1" method="post">
        <table width="400" class="pad2" border="1">
        	<tr>
            	<td valign="bottom" width="25"><img src="thumb.php?src=includes/icons/design.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="hierarchy" /> Hierarchy</td>
                <td width="25" valign="bottom"><img src="thumb.php?src=includes/icons/comparison.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="pair_comparison" /> Pair Comparison</td>
            </tr>
            <tr>
              	<td valign="bottom" width="25"><img src="thumb.php?src=includes/icons/chart.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="decision_chart" /> Decision Chart</td>
                <td width="25" valign="bottom"><img src="thumb.php?src=includes/icons/ratio.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="contribution_chart" /> Contribution Chart</td>
            </tr>
            <tr>
              	<td valign="bottom" width="25"><img src="thumb.php?src=includes/icons/dm.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="decision_matrix" /> Decision Matrix</td>
                <td width="25" valign="bottom"><img src="thumb.php?src=includes/icons/edit.jpg&w=23&zc=1" /></td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="option[]" class="options" value="edit" /> Definitions</td>
            </tr>
            <tr>
              	<td valign="bottom" width="25">&nbsp;</td>
                <td valign="bottom" width="150"><input type="checkbox" checked="checked" name="p_options[]" value="print_all" onclick="javascript: toggleOptions(this.checked);" /> Export all</td>
                <td width="25" valign="bottom">&nbsp;</td>
                <td valign="bottom" width="150"><!--<input type="checkbox" name="p_options[]" value="print_cover_sheet" /> Print cover sheet-->&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" valign="bottom" align="right"><input type="submit" name="sbt" value="Export to Excel" /></td>
              </tr>
            </table>
        </form>
            
        </td>
	</tr>
	</table>
    <p>&nbsp;</p>
    
	</div>
</div>
<?php	 	 include('footer.php'); ?>