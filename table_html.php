<?php	 	
$matrix_values = unserialize($projects_matrix->matrix_values);
$_priorities = unserialize($projects_matrix->priorities);
$_consistency = ($projects_matrix->consistency);

$td_style = 'style="border-right:1px solid #000; border-bottom:1px solid #000;"';

$for_pdf = @$_GET['for_pdf'];

if ($pair_comparison_matrix=="objective")
{
	if ($for_pdf)
		$tdWidth = round(600 / (count($ahp['criterias'])+2));
	else
		$tdWidth = round(90 / (count($ahp['criterias'])+2)) . "%";
	?>
	  <table cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
	  <!-- Draw first row; -->
	  <tr>
		  <td <?=$td_style?> id="objective_box" align="center" width="<?=$tdWidth?>"><?php	 	 echo $ahp['objective']?></td>
		  <?php	 	 foreach ($ahp['criterias'] as $key => $value) { ?>
		  <td <?=$td_style?> class="criteria_box"  align="center" width="<?=$tdWidth?>"><?php	 	 echo $value; ?></td>
		  <?php	 	 } ?>
		  <td <?=$td_style?> id="priorities_box"  align="center" width="<?=$tdWidth?>">Priorities</td>
	  </tr>
	  
	  <?php	 	 $equal = 0; foreach ($ahp['criterias'] as $key => $value) { ?>
	  <tr>
		  <td <?=$td_style?> class="criteria_box" align="center"><?php	 	 echo $value; ?></td>
		  
		  <?php	 	 
		  for($i=0; $i<count($ahp['criterias']); $i++) 
		  {
			  if ($equal==0 && $i==1) 
			  { 
					$isThisFirstTd = true; 
					$firstFirstWord = $value; 
					$firstSecondWord = $ahp['criterias'][$i]; 
					$firstTdID = strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$ahp['criterias'][$i]));
					$firstTdIDInverse = strtolower(str_replace(' ','',$ahp['criterias'][$i]).'_'.str_replace(' ','',$value));
				}
			  ?>
			  <?php	 	 if ($equal==$i) { ?>
			  <td <?=$td_style?> class="gray" align="center">
              <?php	 	 if ($for_pdf) { echo "1"; } else { ?>
	              <input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" />
              <?php	 	 } ?>
              </td>
			  <?php	 	 } else { ?>
			  <td <?=$td_style?> class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" align="center" word1="<?=$value?>" word2="<?=$ahp['criterias'][$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$ahp['criterias'][$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$ahp['criterias'][$i]).'_'.str_replace(' ','',$value)); ?>">
				<?php	 	 if ($for_pdf) { echo $matrix_values[$key][$i]; } else { ?>
                <input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="<?=$matrix_values[$key][$i]?>" size="2" style="border:0px; text-align:center;" />
                <?php	 	 } ?>
			  </td>
			  <?php	 	 } ?>
		  <?php	 	 } ?>
		  
		  <td <?=$td_style?> align="center">
          <?php	 	 if ($for_pdf) { echo $_priorities[$equal]; } else { ?>
          	<input type="text" name="priorities[]" value="<?=$_priorities[$equal]?>" id="priority_<?=$equal?>" class="input_priority" />
          <?php	 	 } ?>
          </td>
	  </tr>
	  <?php	 	 $equal++; } ?>
	  </table>
	<?php	 	
}

# Criteria to Sub Criteria / Alternative - Pair Comparison matrices;
if (strpos($pair_comparison_matrix, "criteria_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$node_index = $node_index[1];
	
	if ($ahp['sub_criterias'][$node_index])
	{
		if ($for_pdf)
			$tdWidth = round(600/(count($ahp['sub_criterias'][$node_index])+2));
		else
			$tdWidth = round(100/(count($ahp['sub_criterias'][$node_index])+2))."%";
	}
	else
	{
		if ($for_pdf)
			$tdWidth = round(600/(count($ahp['alternatives'])+2));
		else
			$tdWidth = round(100/(count($ahp['alternatives'])+2))."%";
	}
	?>
	<table cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
	  <!-- Draw first row; -->
	  <tr>
		  <td <?=$td_style?> id="objective_box" align="center" width="<?=$tdWidth?>"><?php	 	 echo $ahp['criterias'][$node_index]?></td>
		  <?php	 	
		  $vertical_array = array();
		  if ($ahp['sub_criterias'][$node_index]) 
		  {
			  foreach ($ahp['sub_criterias'][$node_index] as $k => $v)
			  {
				  $vertical_array[$k] = $v;
				?>
				<td <?=$td_style?> class="criteria_box" width="<?=$tdWidth?>" align="center"><?php	 	 echo $v; ?></td>
				<?php	 	
			  }
		  }
		  else
		  {
			  foreach ($ahp['alternatives'] as $k => $v)
			  {
				  $vertical_array[$k] = $v;
				?>
				<td <?=$td_style?> class="criteria_box" width="<?=$tdWidth?>" align="center"><?php	 	 echo $v; ?></td>
				<?php	 	
			  }
		  }
		  ?>
		  <td <?=$td_style?> id="priorities_box" align="center" width="<?=$tdWidth?>">Priorities</td>
	  </tr>
	  
	  <?php	 	 $equal = 0; foreach ($vertical_array as $key => $value) { ?>
	  <tr>
		  <td <?=$td_style?> class="criteria_box" align="center"><?php	 	 echo $value; ?></td>
		  
		  <?php	 	 
			for($i=0; $i<count($vertical_array); $i++) 
			{
				if ($equal==0 && $i==1) 
				{ 
					  $isThisFirstTd = true; 
					  $firstFirstWord = $value; 
					  $firstSecondWord = $vertical_array[$i]; 
					  $firstTdID = strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i]));
					  $firstTdIDInverse = strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value));
				  } 
			?>
			  <?php	 	 if ($equal==$i) { ?>
			  <td <?=$td_style?> class="gray" align="center">
              <?php	 	 if ($for_pdf) { echo "1"; } else { ?>
	              <input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" />
               <?php	 	 } ?>
               </td>
			  <?php	 	 } else { ?>
			  <td <?=$td_style?> class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" align="center" word1="<?=$value?>" word2="<?=$vertical_array[$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value)); ?>">
				<?php	 	 if ($for_pdf) { echo $matrix_values[$key][$i]; } else { ?>
                <input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="<?=$matrix_values[$key][$i]?>" size="2" style="border:0px; text-align:center;" />
                <?php	 	 } ?>
			  </td>
			  <?php	 	 } ?>
		  <?php	 	 } ?>
		  
		  <td <?=$td_style?> align="center">
          <?php	 	 if ($for_pdf) { echo $_priorities[$equal]; } else { ?>
          <input type="text" name="priorities[]" value="<?=$_priorities[$equal]?>" id="priority_<?=$equal?>" class="input_priority" />
          <?php	 	 } ?>
          </td>
	  </tr>
	  <?php	 	 $equal++; } ?>
	  
	  </table>
	<?php	 	
}

# Sub Criteria to Alternative - Pair Comparison matrices;
if (strpos($pair_comparison_matrix, "sub_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$criteria_node_index = $node_index[1];
	$node_index = $node_index[2];
	
	if ($for_pdf)
		$tdWidth = round(600/(count($ahp['alternatives'])+2));
	else
		$tdWidth = round(100/(count($ahp['alternatives'])+2)) . "%";
	
	?>
	<table cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
	  <!-- Draw first row; -->
	  <tr>
		  <td <?=$td_style?> id="objective_box" align="center" width="<?=$tdWidth?>"><?php	 	 echo $ahp['sub_criterias'][$criteria_node_index][$node_index]?></td>
		  <?php	 	
			  foreach ($ahp['alternatives'] as $k => $v)
			  {
				  $vertical_array[$k] = $v;
				?>
				<td <?=$td_style?> class="criteria_box" width="<?=$tdWidth?>" align="center"><?php	 	 echo $v; ?></td>
				<?php	 	
			  }
		  ?>
		  <td <?=$td_style?> id="priorities_box" width="<?=$tdWidth?>" align="center">Priorities</td>
	  </tr>
	  
	  <?php	 	 $equal = 0; foreach ($ahp['alternatives'] as $key => $value) { ?>
	  <tr>
		  <td <?=$td_style?> class="criteria_box" width="<?=$tdWidth?>" align="center"><?php	 	 echo $value; ?></td>
		  
		  <?php	 	 
		  for($i=0; $i<count($vertical_array); $i++) 
		  {
			  if ($equal==0 && $i==1) 
			  { 
					$isThisFirstTd = true; 
					$firstFirstWord = $value; 
					$firstSecondWord = $vertical_array[$i]; 
					$firstTdID = strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i]));
					$firstTdIDInverse = strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value));
				}  
		  ?>
			  <?php	 	 if ($equal==$i) { ?>
			  <td <?=$td_style?> class="gray" width="<?=$tdWidth?>" align="center">
              <?php	 	 if ($for_pdf) { echo "1"; } else { ?>
              <input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" />
              <?php	 	 } ?>
              </td>
			  <?php	 	 } else { ?>
			  <td <?=$td_style?> class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" width="<?=$tdWidth?>" align="center" word1="<?=$value?>" word2="<?=$vertical_array[$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value)); ?>">
			  <?php	 	 if ($for_pdf) { echo $matrix_values[$key][$i]; } else { ?>
              <input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="<?=$matrix_values[$key][$i]?>" size="2" style="border:0px; text-align:center;" />
              <?php	 	 } ?>
			  </td>
			  <?php	 	 } ?>
		  <?php	 	 } ?>
		  
		  <td <?=$td_style?> align="center" width="<?=$tdWidth?>">
          <?php	 	 if ($for_pdf) { echo $_priorities[$equal]; } else { ?>
          <input type="text" name="priorities[]" value="<?=$_priorities[$equal]?>" id="priority_<?=$equal?>" class="input_priority" />
          <?php	 	 } ?>
          </td>
	  </tr>
	  <?php	 	 $equal++; } ?>
	  
	  </table>
	<?php	 	
}

if ($for_pdf)
{
	?>
	<div style="text-align:right; width:650px;"> Consistency: <?=$_consistency?>%</div>
    <?php	 	
}
else
{
	?>
	<p style="text-align:right; color:#000;"> Consistency: <input type="text" name="consistency" id="consistency" style="border:0px; width:29px;" value="<?=$_consistency?>" />%</p>
    
    <p id="direct_normalise" style="text-align:right; display:none; width:100%;"><input type="button" name="btn_normalise" value="Normalise" style="display:inline-block; text-transform:capitalize !important;" class="button" onclick="javascript: CalculateDirectNormalise()" /></p>
   	<?php	 	
}
?>