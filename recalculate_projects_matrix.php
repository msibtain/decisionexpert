<?php	 	

$_SESSION['ahp'] = array(
	'objective' => $projects_ahp->objective,
	'criterias' => $criterias,
	'sub_criterias' => $sub_criterias,
	'alternatives' => $alternatives
);

$ahp = $_SESSION['ahp'];



$pcm = $db->select("projects_matrix", "*", "project_id = " . $_POST['id']);
foreach ($pcm as $projects_matrix)
{
	$_POST['criteria'] =  array();
	
	$pair_comparison_matrix = $projects_matrix->pair_comparison_matrix;
	$_POST['pair_comparison_matrix'] = $pair_comparison_matrix;
	$_POST['project_id'] = $projects_matrix->project_id;
	$_POST['mode'] = $_SESSION['project_mode'];
	$_POST['direct_mode'] = $projects_matrix->direct_mode;
	
	
	$matrix_values = unserialize($projects_matrix->matrix_values);
	$_priorities = unserialize($projects_matrix->priorities);
	$_consistency = ($projects_matrix->consistency);

	if ($pair_comparison_matrix=="objective")
	{
            
		  $equal = 0; 
		  foreach ($ahp['criterias'] as $key => $value) 
		  {
			  for($i=0; $i<count($ahp['criterias']); $i++) 
			  {
					if ($equal==$i) 
					{  
						$_POST['criteria'][$key][$i] = 1;
					}
					else
					{
						$_POST['criteria'][$key][$i] = $matrix_values[$key][$i];
					}
			  }
			  $equal++;	
			  
		  }
	}		# end if pair comparison matrix == objective;
	
	# Criteria to Sub Criteria / Alternative - Pair Comparison matrices;
	if (strpos($pair_comparison_matrix, "criteria_") !== false)
	{
		$node_index = explode("_",$pair_comparison_matrix);
		$node_index = $node_index[1];
		
		$vertical_array = array();
		if ($ahp['sub_criterias'][$node_index]) 
		{
			foreach ($ahp['sub_criterias'][$node_index] as $k => $v)
			{
				$vertical_array[$k] = $v;
			}
		}
		else
		{
			foreach ($ahp['alternatives'] as $k => $v)
			{
				$vertical_array[$k] = $v;
			}
		}
		$equal = 0; 
		
		foreach ($vertical_array as $key => $value) 
		{
			
				for($i=0; $i<count($vertical_array); $i++) 
				{
					if ($equal==$i) 
					{ 
						$_POST['criteria'][$key][$i] = 1; 
					}
					else 
					{ 
						$_POST['criteria'][$key][$i] = $matrix_values[$key][$i]; 
					} 
				}
				$equal++;
				
		}
	}		# end if pair comparison matrix == criteria_;
	
	# Sub Criteria to Alternative - Pair Comparison matrices;
	if (strpos($pair_comparison_matrix, "sub_") !== false)
	{
		$node_index = explode("_",$pair_comparison_matrix);
		$criteria_node_index = $node_index[1];
		$node_index = $node_index[2];
		
				  foreach ($ahp['alternatives'] as $k => $v)
				  {
					  $vertical_array[$k] = $v;
				  }
		$equal = 0; 
		foreach ($ahp['alternatives'] as $key => $value) 
		{
			for($i=0; $i<count($vertical_array); $i++) 
			{
					if ($equal==$i) 
					{ 
						$_POST['criteria'][$key][$i] = 1; 
					} 
					else 
					{ 
						$_POST['criteria'][$key][$i] = $matrix_values[$key][$i]; 
					} 
			}
			$equal++;
		}
		
	}		# end if pair comparison matrix == sub_;
	
	ob_start();
	include('calculate_priorities.php');
	$priorities = ob_get_clean();
	$_POST['priorities'] = explode(',',$priorities);
	# remove last element;
	$le = count($_POST['priorities']) - 1;
	unset($_POST['priorities'][$le]);
	
	$_POST['consistency'] = $_consistency;
	
	# Save in database;
	ob_start();
	include('save_matrix_saved.php');
	ob_get_clean();
	
	
	
}	# end foreach;






?>