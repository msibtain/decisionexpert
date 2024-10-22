<?php	 	 
include('header.php'); 

$pair_comparison_matrix = @$_GET['pair_comparison_matrix'];

global $db;

//if ($pair_comparison_matrix)
//{
	$projects = $db->select("projects", "*", "id = " . $_GET['id']);
	$projects = $projects[0];
	$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
	$projects_ahp = $projects_ahp[0];
	$projects_matrix = $db->select("projects_matrix", "*", "project_id = " . $_GET['id'] . " AND pair_comparison_matrix = '$pair_comparison_matrix'");
	$projects_matrix = $projects_matrix[0];
	
	$criterias = unserialize($projects_ahp->criterias);
	$sub_criterias  = unserialize($projects_ahp->sub_criterias );
	$alternatives = unserialize($projects_ahp->alternatives);
	
	$_SESSION['ahp'] = array(
		'objective' => $projects_ahp->objective,
		'criterias' => $criterias,
		'sub_criterias' => $sub_criterias,
		'alternatives' => $alternatives
	);
	
	$ahp = $_SESSION['ahp'];
//}
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
    <div style="width:700px; margin:auto auto auto 120px;">
	<table width="100%">
	<tr>
		<td style="padding:0px 20px;">
        <h1>Project Name: <?php	 	 echo $projects->project_name; ?></h1>
        <p>&nbsp;</p>
        
        <div style="float:left; width:330px;">
        <form action="" method="get" name="pc" id="pc">
        <p>Select Criterion:
        	<select name="pair_comparison_matrix" onchange="javascript:document.forms['pc'].submit();">
            	<option value="">Select Criterion</option>
                <?php	 	 
				foreach ($ahp['criterias'] as $key => $value) 
				{ 
					if (!count($ahp['sub_criterias'][$key])) :
					$_row = $db->select("definitions", "word,abbreviation", "`abbreviation` = '$value'");
					$_row = $_row[0];
					if ($_row->abbreviation == $value && $_row->abbreviation != '') { $value = $_row->word." - ".$value; }
					?>
                	<option value="criteria_<?=$key?>" <?php	 	 if ($pair_comparison_matrix=='criteria_'.$key) { echo 'selected="selected"'; } ?>><?php	 	 echo $value; ?></option>
                <?php	 	 
					endif;
					
				} 
				
				foreach ($ahp['sub_criterias'] as $key => $value)
				{
					foreach ($value as $k => $v)
					{
						$_row = $db->select("definitions", "word,abbreviation", "`abbreviation` = '$v'");
						$_row = $_row[0];
						if ($_row->abbreviation == $v && $_row->abbreviation != '') { $v = $_row->word." - ".$v; }
						?>
						<option value="sub_<?=$key?>_<?=$k?>" <?php	 	 if ($pair_comparison_matrix=='sub_'.$key.'_'.$k) { echo 'selected="selected"'; } ?>><?php	 	 echo $v;?></option>
						<?php	 	
					}
				}
				?>
            </select>&nbsp;
            <input type="hidden" name="id" value="<?=$_GET['id']?>" />
        </p>
        </form>
        </div>
        
        <br clear="all">
        
        <?php	 	 if ($pair_comparison_matrix) { include('calculate_sensitivity_analysis.php'); ?>
        <div align="center">
        	<img src="s_analysis_chart.php" />
        </div>
        
        <div align="center" style="width:550px; margin:auto;">
        <table align="center" cellpadding="2" cellspacing="2" border="0">
        <tr>
        <?php	 	
		foreach ($_SESSION['yAxis'] as $key => $value)
		{
			?>
            <td valign="top"><div style=" width:16px; height:16px; background-color:rgb(<?=$value['r']?>,<?=$value['g']?>,<?=$value['b']?>);">&nbsp;</div></td>
            <td valign="top"><?=$value['name']?></td>
            <?php	 	
		}
		?>
        </tr>
        </table>
        </div>
        <?php	 	 
		
		
		
		} ?>
        
        <p>&nbsp;</p>
        
        </td>
	</tr>
	</table>
    </div>
	</div>
</div>
<?php	 	 include('footer.php'); ?>