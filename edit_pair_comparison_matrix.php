<?php	 	
$matrix_values = unserialize($projects_matrix->matrix_values);

/*
foreach ($matrix_values as $key => $value)
{
	if (is_array($value))
	{
		foreach ($value as $k => $v) if($v=='1') { $matrix_values[$key][$k] = ''; } 
	}
	else
	{
		$matrix_values[$key] = '';
	}
}
*/
?>
<form action="" method="post" id="pc_matrix" name="pc_matrix">
        <div style="float:right;">
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
        </div>
        <br clear="all" />
        
        
        <?php	 	 include('table_html.php'); ?>
        
        <input type="hidden" name="word1" id="word1" value="<?php	 	 echo $firstFirstWord; ?>" />
        <input type="hidden" name="word2" id="word2" value="<?php	 	 echo $firstSecondWord; ?>" />
        <input type="hidden" name="current_comparison_td" id="current_comparison_td" value="<?php	 	 echo $firstTdID; ?>" />
        <input type="hidden" name="current_comparison_td_inverse" id="current_comparison_td_inverse" value="<?php	 	 echo $firstTdIDInverse; ?>" />
        <input type="hidden" name="comparison_value" id="comparison_value" value="1" />
        <input type="hidden" name="comparison_value_inverse" id="comparison_value_inverse" value="1" />
        
        
        
        
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
        
        <input type="hidden" name="project_id" value="<?=$_GET['id']?>" />
        <?php	 	
		if ($_SESSION['project_mode']) $mode = $_SESSION['project_mode']; else $mode = $projects_matrix->mode;
		
		?>
        <input type="hidden" name="mode" value="<?=$mode?>" />
        <input type="hidden" name="pair_comparison_matrix" value="<?=$_GET['pair_comparison_matrix']?>" />
        </form>