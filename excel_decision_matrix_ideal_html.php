<?php	 	

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);	
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);		

$row = 1;

# write heading of section;
writeSectionHeading($objPHPExcel, 'Decision Matrix',$row);


$row++;
$col = 3;
foreach ($alternatives as $altKey => $altValue)
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $altValue);
	$col++;
}
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Consistency');

$row++;
$lr = 0;
$iterate = 0;

foreach ($criterias as $key => $value)
{
	$col = 1;
	
	# get GLOBAL priority matrix,
	$global_priorities = getGlobalPriorities($_GET['id']);
	
	if (!count($sub_criterias[$key]))
	{
		$number_to_show = number_format($global_priorities[$key]*100, 3);
		$criteria_vector_value = $number_to_show;
		
		$pair_comparison_matrix = 'criteria_'.$key;
		$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
		
		$left_ratio[$lr]['pair_comparison_matrix'] = 'criteria_'.$key;
		$left_ratio[$lr]['value'] = $value;
		$left_ratio[$lr]['number'] = $number_to_show;
		$lr++;
		
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
		$col++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $number_to_show);
		$col++;
		
		$temp_max = 0;
		$temp_no_to_show = array();
					
		foreach ($alternatives as $altKey => $altValue)
		{
			$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
			
			$number_to_show = $nPriorities[$altKey];
			$number_to_show = number_format($number_to_show*100,2);
			$temp_no_to_show[$altKey] = $number_to_show;
			
			if ($temp_max < $number_to_show)
				$temp_max = $number_to_show;
		}
		
		foreach ($alternatives as $altKey => $altValue)
		{
			$tmp = number_format(($temp_no_to_show[$altKey] / $temp_max), 3); 
			# Second matrix value;
			# concert with document named D_and_I_Modes_Explained.xlsx;
			//echo $tmp; # Second matrix value;
			# Third matrix value;
			$o = number_format(($tmp * $criteria_vector_value), 3);
			$overall_result[$altKey] += $o;
							
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $o);
			$col++;
		}
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $consistency_to_show->consistency.'%');
		$col++;
		$row++;
	}
	else
	{
		foreach ($sub_criterias[$key] as $k => $v)
		{
			$matrix_values = getMatrixValuesForCriteria($_GET['id'], $key);						
			$number_to_show = number_format(($matrix_values[$k]*$global_priorities[$key])*100, 3);
			$criteria_vector_value = $number_to_show;
			
			$pair_comparison_matrix = 'sub_'.$key.'_'.$k;
			$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
			
			$left_ratio[$lr]['pair_comparison_matrix'] = 'sub_'.$key.'_'.$k;
			$left_ratio[$lr]['value'] = $v;
			$left_ratio[$lr]['number'] = $number_to_show;
			$lr++;
			
			# New row;
			
			$col = 1;
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $v);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $number_to_show);
			$col++;
			
			
			$temp_max = 0;
			$temp_no_to_show = array();
						
			foreach ($alternatives as $altKey => $altValue)
			{
				$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
				
				$number_to_show = $nPriorities[$altKey];
				$number_to_show = number_format($number_to_show*100,2);
				
				$temp_no_to_show[$altKey] = $number_to_show;
				if ($temp_max < $number_to_show)
					$temp_max = $number_to_show;
			}
			
			foreach ($alternatives as $altKey => $altValue)
			{
				$tmp = number_format(($temp_no_to_show[$altKey] / $temp_max), 3); 
				# Second matrix value;
				# concert with document named D_and_I_Modes_Explained.xlsx;
				//echo $tmp; # Second matrix value;
				# Third matrix value;
				$o = number_format(($tmp * $criteria_vector_value), 3);
				$overall_result[$altKey] += $o;
							
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $o);
				$col++;
			}
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $consistency_to_show->consistency.'%');
			
			$row++;
		}
	}
	//$row++;
}

$row++;

$col = 2;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Overall');
$col++;
//$objPHPExcel->getActiveSheet()->setCellValue('C10', 'Overall');
foreach ($alternatives as $altKey => $altValue) 
{
  $alternative_result = 0;
  foreach ($left_ratio as $k => $v)
  {
	  $first_number = $v['number']/100;
	  $n = $db->select("projects_matrix", "priorities", "project_id = " . $_GET['id'] . " AND pair_comparison_matrix = '".$v['pair_comparison_matrix']."'");
	  $n = $n[0];
	  $nPriorities = unserialize($n->priorities);
	  $second_number = $nPriorities[$altKey];
	  
	  //echo $string = $v['value'] . ": $first_number * $second_number<br />";
	  $alternative_result += $first_number * $second_number;
  }
  $number_to_show = number_format($alternative_result*100,2);
  
  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $overall_result[$altKey]);
  $col++;  
}
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Consistency');
?>