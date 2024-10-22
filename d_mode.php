<?php	 	 include('header.php'); 

$msg = '';

if ($_POST)
{
	$_SESSION['project_mode'] = $_POST['d_mode'];
	$msg = 'Mode has been successfully switched.';
}

if ($_SESSION['project_mode'])
	$mode = $_SESSION['project_mode'];
else
{
	global $db;
	$project_id = @$_GET['id'];
	$mode = $db->select("projects_matrix", "mode", "project_id = " . $project_id);
	$mode = $mode[0];
	$mode = $mode->mode;
}

if ($mode == 'i') $s_arrow_top = '52px;'; else $s_arrow_top = '8px;';
?>

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
		<td style="padding:0px 110px !important;">
        <p>&nbsp;</p>
        <h1>Switch between Distribution OR Ideal Mode</h1>
        
        <p>&nbsp;</p>
        <form action="" method="post">
        
        <strong>Current mode:</strong>
        <br /><br />
        <script language="javascript">
		function swapCalculationMode(mode)
		{
			if (mode == 'd')
			{
				//jQuery('#s_arrow').css('top', '8px');
				jQuery('#s_arrow').animate({
					top: '8px'
					},
				  300,
				  function(){
					  //animation complete
					  jQuery('#d_mode').val(mode);
					  ChangeInSession(mode);
					  });
			}
			else
			{
				//jQuery('#s_arrow').css('top', '52px');
				jQuery('#s_arrow').animate({
					top: '52px'
					},
				  300,
				  function(){
					  //animation complete
					  jQuery('#d_mode').val(mode);
					  ChangeInSession(mode);
					  });
			}
		}
		function ChangeInSession(mode)
		{
			jQuery.ajax({
			  type: "POST",
			  url: "update_mode.php",
			  data: 'mode='+mode+'&id=<?=@$_GET['id']?>'
				}).done(function( msg ) {
				jQuery('#success_message').html(msg);
				});
				
				jQuery('#d_mode_image').attr('src','includes/icons/'+mode+'_mode.jpg');
		}
		</script>
        <div id="s_container" style="position:relative; width:60px; height:80px;">
        
        	<div style="position:absolute; top:0px; right:0px;"><img src="includes/icons/d.jpg" style="cursor:pointer;" onclick="javascript: swapCalculationMode('d');" /></div>
            <div style="position:absolute; top:45px; right:0px;"><img src="includes/icons/i.jpg" style="cursor:pointer;" onclick="javascript: swapCalculationMode('i');" /></div>
            
            <div style="position:absolute; left:0px; top:<?=$s_arrow_top?>" id="s_arrow"><img src="includes/icons/s.jpg" /></div>
            
        </div>
        <input type="hidden" name="d_mode" id="d_mode" value="<?=$mode?>" />
        
		
<br />
<!-- <input type="submit" name="sbt" value="Switch Mode" /> -->
<div id="success_message"></div>
        </form>
        
        <p>&nbsp;</p>
        
        </td>
        
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>