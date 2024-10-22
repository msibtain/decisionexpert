<?php	 	 include('header.php'); ?>

<!--left-->
<?php	 	 include('left.php'); ?>  


<script language="javascript">
function SaveDefinition()
{
	var word = jQuery('#word').val();
	var abbreviation = jQuery('#abbreviation').val();
	var error = '';
	
        
	if (!word)
		error += 'Please enter word.\n';
	if (!abbreviation)
		error += 'Please enter abbreviation.';
	
	if (error)
	{
		alert(error); return false;
	}
	
	var str = jQuery('#dForm').serialize();
	
	jQuery.ajax({
	  type: "POST",
	  url: "save_definition.php",
	  data: str
	}).done(function( msg ) {
		if (msg == 'This abbreviation is already taken. Please choose another.') { alert(msg); return false; }
		jQuery('#definitions_list').html(msg);
		ClearForm();
		//setTimeout("jQuery('#show_priorities').html('')", 3000);
	});
	
}
function EditDefinition(id)
{
	jQuery.ajax({
	  type: "POST",
	  url: "save_definition.php",
	  data: "action=select&id="+id
	}).done(function( msg ) {
		//jQuery('#debug').html(msg);
		
		ar = msg.split('%%%');
		jQuery('#word').val(ar[0]);
		jQuery('#abbreviation').val(ar[1]);
		jQuery('#id').val(id);
	});
}
function DeleteDefinition(id)
{
	var c = confirm('Are you sure to delete?');
	if (!c) return false;
	
	jQuery.ajax({
	  type: "POST",
	  url: "save_definition.php",
	  data: "action=delete&id="+id
	}).done(function( msg ) {
		jQuery('#definitions_list').html(msg);
	});
}
function ClearForm()
{
	jQuery('#word').val('');
	jQuery('#abbreviation').val('');
	jQuery('#id').val('');
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
	<table>
	<tr>
		<td style="padding:0px 20px;">
        
        <h1>Definitions</h1>
        <p>&nbsp;</p>
        
        <form action="" method="post" id="dForm" onsubmit="javascript: SaveDefinition(); return false;">
        <table width="100%" class="pad2">
        	<tr>
            	<td>Element:</td>
                <td><input type="text" name="word" id="word" /></td>
                <td>Abbreviation:</td>
                <td><input type="text" name="abbreviation" id="abbreviation" /></td>
                <td>
                <input type="hidden" name="id" id="id" />
                <input type="submit" name="Save" value="Save" />
                <input type="button" name="reset" value="Clear" onclick="javascript: ClearForm();" />
                </td>
            </tr>
        </table>
        </form>
        
        <div id="definitions_list">
        <?php	 	 include('definitions_list.php'); ?>
        </div>
        
        <div id="debug"></div>
        
        <p>&nbsp;</p>
        </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>