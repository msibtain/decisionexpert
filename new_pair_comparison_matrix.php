<form action="" method="post" id="pc_matrix" name="pc_matrix">
        
        <p>Direct Mode&nbsp;
        
        <select name="direct_mode" id="direct_mode" onchange="javascript: swapDirectMode(this.value);">
        	<option value="0" <?php	 	 if (!$direct_mode) { echo 'selected="selected"'; } ?>>No</option>
            <option value="1" <?php	 	 if ($direct_mode) { echo 'selected="selected"'; } ?>>Yes</option>
        </select>
        
        Comparison Word &nbsp; 
        <select name="comparison_word" id="comparison_word">
        	<option value="">Select a word</option>
            <option value="important" selected="selected">important</option>
            <option value="preferable">preferable</option>
            <option value="likely">likely</option>
        </select>
        <br />
        
        </p>
        
        <?php	 	
		if ($pair_comparison_matrix=="objective")
		{
			?>
              <table width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
              <!-- Draw first row; -->
              <tr>
                  <td id="objective_box" align="center"><?php	 	 echo $ahp['objective']?></td>
                  <?php	 	 foreach ($ahp['criterias'] as $key => $value) { ?>
                  <td class="criteria_box" width="15%"><?php	 	 echo $value; ?></td>
                  <?php	 	 } ?>
                  <td id="priorities_box">Priorities</td>
              </tr>
              
              <?php	 	 $equal = 0; foreach ($ahp['criterias'] as $key => $value) { ?>
              <tr>
                  <td class="criteria_box"><?php	 	 echo $value; ?></td>
                  
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
                      <td class="gray"><input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" /></td>
                      <?php	 	 } else { ?>
                      <td class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" word1="<?=$value?>" word2="<?=$ahp['criterias'][$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$ahp['criterias'][$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$ahp['criterias'][$i]).'_'.str_replace(' ','',$value)); ?>">
                      	<input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="" size="2" style="border:0px; text-align:center;" />
                      </td>
                      <?php	 	 } ?>
                  <?php	 	 } ?>
                  
                  <td><input type="text" name="priorities[]" value="priority_<?=$equal?>" id="priority_<?=$equal?>" class="input_priority" /></td>
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
			?>
            <table width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
              <!-- Draw first row; -->
              <tr>
                  <td id="objective_box" align="center"><?php	 	 echo $ahp['criterias'][$node_index]?></td>
                  <?php	 	
				  $vertical_array = array();
                  if ($ahp['sub_criterias'][$node_index]) 
				  {
					  foreach ($ahp['sub_criterias'][$node_index] as $k => $v)
					  {
						  $vertical_array[$k] = $v;
					  	?>
                  		<td class="criteria_box" width="15%"><?php	 	 echo $v; ?></td>
                  		<?php	 	
                      }
				  }
				  else
				  {
					  foreach ($ahp['alternatives'] as $k => $v)
					  {
						  $vertical_array[$k] = $v;
					  	?>
                  		<td class="criteria_box" width="15%"><?php	 	 echo $v; ?></td>
                  		<?php	 	
                      }
				  }
				  ?>
                  <td id="priorities_box">Priorities</td>
              </tr>
              
              <?php	 	 $equal = 0; foreach ($vertical_array as $key => $value) { ?>
              <tr>
                  <td class="criteria_box"><?php	 	 echo $value; ?></td>
                  
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
                      <td class="gray"><input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" /></td>
                      <?php	 	 } else { ?>
                      <td class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" word1="<?=$value?>" word2="<?=$vertical_array[$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value)); ?>">
                        <input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="" size="2" style="border:0px; text-align:center;" />
                      </td>
                      <?php	 	 } ?>
                  <?php	 	 } ?>
                  
                  <td><input type="text" name="priorities[]" value="priority_<?=$equal?>" id="priority_<?=$equal?>" class="input_priority" /></td>
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
			?>
            <table width="100%" style="border-top:1px solid #000; border-left:1px solid #000;" class="tblBorder">
              <!-- Draw first row; -->
              <tr>
                  <td id="objective_box" align="center"><?php	 	 echo $ahp['sub_criterias'][$criteria_node_index][$node_index]?></td>
                  <?php	 	
					  foreach ($ahp['alternatives'] as $k => $v)
					  {
						  $vertical_array[$k] = $v;
					  	?>
                  		<td class="criteria_box" width="15%"><?php	 	 echo $v; ?></td>
                  		<?php	 	
                      }
				  ?>
                  <td id="priorities_box">Priorities</td>
              </tr>
              
              <?php	 	 $equal = 0; foreach ($ahp['alternatives'] as $key => $value) { ?>
              <tr>
                  <td class="criteria_box"><?php	 	 echo $value; ?></td>
                  
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
                      <td class="gray"><input class="gray" type="text" name="criteria[<?=$key?>][<?=$i?>]" value="1" size="2" style="border:0px; text-align:center;" /></td>
                      <?php	 	 } else { ?>
                      <td class="cursor <?php	 	 if ($equal==0 && $i==1) { ?>activeTd<?php	 	 } ?>" word1="<?=$value?>" word2="<?=$vertical_array[$i]?>" onclick="javascript: compare(this);" id="<?php	 	 echo strtolower(str_replace(' ','',$value).'_'.str_replace(' ','',$vertical_array[$i])); ?>" inverseid="<?php	 	 echo strtolower(str_replace(' ','',$vertical_array[$i]).'_'.str_replace(' ','',$value)); ?>">
                      <input type="text" name="criteria[<?=$key?>][<?=$i?>]" <?php	 	 if ($equal==0 && $i==1) { ?>class="activeTd"<?php	 	 } ?> value="" size="2" style="border:0px; text-align:center;" />
                      </td>
                      <?php	 	 } ?>
                  <?php	 	 } ?>
                  
                  <td><input type="text" name="priorities[]" value="priority_<?=$equal?>" id="priority_<?=$equal?>" class="input_priority" /></td>
              </tr>
              <?php	 	 $equal++; } ?>
              
              </table>
            <?php	 	
		}
		
		?>
        
        <input type="hidden" name="word1" id="word1" value="<?php	 	 echo $firstFirstWord; ?>" />
        <input type="hidden" name="word2" id="word2" value="<?php	 	 echo $firstSecondWord; ?>" />
        <input type="hidden" name="current_comparison_td" id="current_comparison_td" value="<?php	 	 echo $firstTdID; ?>" />
        <input type="hidden" name="current_comparison_td_inverse" id="current_comparison_td_inverse" value="<?php	 	 echo $firstTdIDInverse; ?>" />
        <input type="hidden" name="comparison_value" id="comparison_value" value="1" />
        <input type="hidden" name="comparison_value_inverse" id="comparison_value_inverse" value="1" />
        
        <p style="text-align:right; color:#000;"> Consistency: <input type="text" name="consistency" id="consistency" style="border:0px; width:29px;" />%</p>
        
        <p id="direct_normalise" style="text-align:right; display:none; width:100%;"><input type="button" name="btn_normalise" value="Normalise" style="display:inline-block; text-transform:capitalize !important;" class="button" onclick="javascript: CalculateDirectNormalise()" /></p>
        
        
        <div id="comparison_sentences">
        	<div id="div1">Extreme strong</div>
            <div id="div2">Very strong</div>
            <div id="div3">Strong</div>
            <div id="div4">Slightly strong</div>
            <div id="div5">Equal</div>
            <div id="div6">Slightly strong</div>
            <div id="div7">Strong</div>
            <div id="div8">Very strong</div>
            <div id="div9" style="margin-right:0px;">Extreme strong</div>
            <br clear="all" />
        </div>
        
        
        <div id="scrollbar">
        	<div id="scroller"></div>
            
            <div class="block" id="nine_to_eight" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="eight_to_seven" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="seven_to_six" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="six_to_five" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="five_to_four" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="four_to_three" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block_small" id="three_to_two" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block_small" id="two_to_one" onclick="javascript: slideScroller(this);">&nbsp;</div>
            
            <div class="block_small" id="one_to_two" onclick="javascript: slideScroller(this);">&nbsp;</div>
            
            <div class="block_small" id="two_to_three" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="three_to_four" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="four_to_five" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="five_to_six" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="six_to_seven" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="seven_to_eight" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="eight_to_nine" onclick="javascript: slideScroller(this);">&nbsp;</div>
            <div class="block" id="nine_to_nine" onclick="javascript: slideScroller(this);">&nbsp;</div>
            
        </div>
        
        <div style="padding:5px;" id="comparison_sentence">
        	&nbsp;
        </div>
        
        <div>
          <div id="div_word1"><?php	 	 echo $firstFirstWord; ?></div>
          <div id="div_compare">Important</div>
          <div id="div_word2"><?php	 	 echo $firstSecondWord; ?></div>
          <br clear="all" />
       </div> 
        
        <div style="text-align:right; padding:5px; width:100%;">
        	<input type="button" class="button" name="enter" value="&nbsp;&nbsp;Enter&nbsp;&nbsp;" onclick="javascript: EnterComparisonValue();" style="display:inline-block; margin:10px; text-transform:capitalize !important;" />
        </div>
        
        <div style="text-align:right; padding:0px 5px; width:100%;">
        	<input type="button" class="button" name="enter" value="&nbsp;&nbsp;Save Matrix&nbsp;&nbsp;" onclick="javascript: SaveMatrix();" style="display:inline-block; margin:10px; text-transform:capitalize !important;" />
        </div>
        
        
       
        <!-- for debugging -->
        <div id="show_priorities"></div>
        
        <?php	 	
		if ($_SESSION['project_mode']) $mode = $_SESSION['project_mode']; else $mode = $projects_matrix->mode;
		
		?>
        <input type="hidden" name="mode" value="<?=$mode?>" />
        
        <input type="hidden" name="project_id" value="<?=$_GET['id']?>" />
        <input type="hidden" name="pair_comparison_matrix" value="<?=$_GET['pair_comparison_matrix']?>" />
        </form>