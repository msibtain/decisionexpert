<?php	 	
$left_ratio = array();
$lr = 0;

$_SESSION['xAxis'] = array();
$_SESSION['yAxis'] = array();

if (strpos($pair_comparison_matrix, "criteria_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$node_index = $node_index[1];
	
	$criteria_matrix_section = true;
}

if (strpos($pair_comparison_matrix, "sub_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$criteria_node_index = $node_index[1];
	$node_index = $node_index[2];
	
	$sub_criteria_matrix_section = true;
}

$criteria_result = array();
foreach ($criterias as $key => $value)
{
	# get GLOBAL priority matrix,
	$global_priorities = getGlobalPriorities($_GET['id']);
		
	if (!count($sub_criterias[$key]))
	{
		$number_to_show = number_format($global_priorities[$key]*100, 3);
		
		$left_ratio[$lr]['pair_comparison_matrix'] = 'criteria_'.$key;
		$left_ratio[$lr]['value'] = $value;
		$left_ratio[$lr]['number'] = $number_to_show;
		$lr++;
		
		$this_id = strtolower(str_replace(" ", "",$value));
		
		if ($criteria_matrix_section && $node_index == $key)
		{
			$_SESSION['xAxis'] = $number_to_show;
			$new_value_of_criterion = $number_to_show + 10;
			$criteria_result[$this_id] = $new_value_of_criterion;
		}
		else
		{
			$criteria_result[$this_id] = (100/110)*$number_to_show;
		}
	}
	else
	{
		$matrix_values = getMatrixValuesForCriteria($_GET['id'], $key);
			
		foreach ($sub_criterias[$key] as $k => $v)
		{
			
			$number_to_show = number_format(($matrix_values[$k]*$global_priorities[$key])*100, 3);
		
			$left_ratio[$lr]['pair_comparison_matrix'] = 'sub_'.$key.'_'.$k;
			$left_ratio[$lr]['value'] = $v;
			$left_ratio[$lr]['number'] = $number_to_show;
			$lr++;
			
			$this_id = strtolower(str_replace(" ", "",$v));
			
			if ($sub_criteria_matrix_section && $criteria_node_index == $key && $node_index == $k)
			{
				$_SESSION['xAxis'] = $number_to_show;
				$new_value_of_criterion = $number_to_show + 10;
				$criteria_result[$this_id] = $new_value_of_criterion;
			}
			else
			{
				$criteria_result[$this_id] = (100/110)*$number_to_show;
			}
		}
	}
}

# Define some random colors;
$rColors = array(
	array(241,110,5),
	array(236,95,208),
	array(26,116,0),
	array(43,43,189),
	array(7,230,49),
	//array(111,115,8),
	array(173,122,191)
);

$cri_sub_result = array();
foreach ($alternatives as $altKey => $altValue)
{
	$alternative_result = 0;
	$this_id = strtolower(str_replace(" ","",$altValue));
	
	foreach ($left_ratio as $k => $v)
	{
		$first_number = $v['number']/100;
		$n = $db->select("projects_matrix", "priorities", "project_id = " . $_GET['id'] . " AND pair_comparison_matrix = '".$v['pair_comparison_matrix']."'");
		$n = $n[0];
		$nPriorities = unserialize($n->priorities);
		$second_number = $nPriorities[$altKey];
		
		//echo $string = $v['value'] . ": $first_number * $second_number<br />";
		$alternative_result += $first_number * $second_number;
		
		$_this_id = strtolower(str_replace(" ","", $v['value']));
		
		$cri_sub_result[$this_id.$_this_id] = $second_number;
	}
	
	$number_to_show = number_format($alternative_result*100,2);
	
	$_SESSION['yAxis'][$altKey]['start'] = $number_to_show;
	$_SESSION['yAxis'][$altKey]['name'] = $altValue;
	
	$_SESSION['yAxis'][$altKey]['r'] = $rColors[$altKey][0];
	$_SESSION['yAxis'][$altKey]['g'] = $rColors[$altKey][1];
	$_SESSION['yAxis'][$altKey]['b'] = $rColors[$altKey][2];
}



$alternative_new_values = array();
# Calculate the second value of alternatives - to draw on chart;
foreach ($alternatives as $altKey => $altValue)
{
	$this_id = strtolower(str_replace(" ","",$altValue));
	$ar = 0;
	foreach ($criteria_result as $key => $value)
	{
		$_this_id = strtolower(str_replace(" ","",$key));
		
		$first_number = $value;
		$second_number = $cri_sub_result[$this_id.$_this_id];
		$ar += $first_number * $second_number;
	}
	
	$_SESSION['yAxis'][$altKey]['end'] = $ar;
	//$alternative_new_values[$altKey] = $ar;
}



?>