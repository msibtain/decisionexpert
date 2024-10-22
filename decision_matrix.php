<?php	 	 
include('header.php'); 

global $db;
$projects = $db->select("projects", "*", "id = " . $_GET['id']);
$projects = $projects[0];
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
$projects_ahp = $projects_ahp[0];



$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);


# recalculate the matrix value;
//include('recalculate_projects_matrix.php');


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
	<table width="100%">
	<tr>
		<td style="padding:0px 110px !important;">
        <h1>Decision Matrix</h1>
        <p>&nbsp;</p>
        <?php	 	
		
		if ($_SESSION['project_mode'])
			  $mode = $_SESSION['project_mode'];
		  elseif ($_SESSION['project_id'])
		  {
			  global $db;
			  $project_id = @$_SESSION['project_id'];
			  $mode = $db->select("projects_matrix", "mode", "project_id = " . $project_id);
			  $mode = $mode[0];
			  $mode = $mode->mode;
		  }
		  else
		  	$mode = 'd';
			
			if ($mode == 'i')
				include('decision_matrix_html_ideal.php');
			else
				include('decision_matrix_html.php');
				
		?>
        
        
        <?php	 	 //include('decision_matrix_html.php'); ?>
        
        </td>
	</tr>
	</table>
    <p>&nbsp;</p>
	</div>
</div>
<?php	 	 include('footer.php'); ?>