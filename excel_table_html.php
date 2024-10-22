<?php	 	
$matrix_values = unserialize($projects_matrix->matrix_values);
$_priorities = unserialize($projects_matrix->priorities);
$_consistency = ($projects_matrix->consistency);

$td_style = 'style="border-right:1px solid #000; border-bottom:1px solid #000;"';

$for_pdf = @$_GET['for_pdf'];

if ($pair_comparison_matrix=="objective")
{
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);		
	
	# write heading of section;
	 writeSectionHeading($objPHPExcel, 'Pair Comparison of Attributes with respect to: ' . $ahp['objective'],2);
	 
	 
	
	
	# Draw first row;
	$row = 4;
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $ahp['objective']);
	$col = 2;
	foreach ($ahp['criterias'] as $key => $value) 
	{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
        $col++;
	}
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Priorities');
	
	
	
	$equal = 0;
	$row++;
	foreach ($ahp['criterias'] as $key => $value) 
	{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value);
		$col = 2;
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
			  
			if ($equal==$i)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
			}
			else
			{
				$vArray = explode('/',$matrix_values[$key][$i]);
					if (count($vArray) == 2)
					$matrix_values[$key][$i] = (int)$vArray[0] / (int)$vArray[1]; 
				else
					$matrix_values[$key][$i] = (int)$vArray[0];
					
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, number_format($matrix_values[$key][$i],3));
			}
			$col++;
		}
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $_priorities[$equal]);
		
		$row++;
		$equal++;
	}
	
	$row--;
}

# Add one row gap;
$row++;


# Criteria to Sub Criteria / Alternative - Pair Comparison matrices;
if (strpos($pair_comparison_matrix, "criteria_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$node_index = $node_index[1];
	
	# write heading of section;
	writeSectionHeading($objPHPExcel, 'Pair Comparison of Choices with respect to ' . $ahp['criterias'][$node_index],$row);
	
	$row++;
	# Write first row;
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $ahp['criterias'][$node_index]);
	
	$col = 2;
	$vertical_array = array();
	if ($ahp['sub_criterias'][$node_index]) 
	{
		foreach ($ahp['sub_criterias'][$node_index] as $k => $v)
		{
			$vertical_array[$k] = $v;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $v);
			$col++;
		}
	}
	else
	{
		foreach ($ahp['alternatives'] as $k => $v)
		{
			$vertical_array[$k] = $v;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $v);
			$col++;
		}
	}
	
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Priorities');
	# End first row;
	
	$row++;
	$equal = 0; 
	foreach ($vertical_array as $key => $value) 
	{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value);
		$col = 2;
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
			 
			 if ($equal==$i) 
			 {
				 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
			 }
			 else
			 {
				 $vArray = explode('/',$matrix_values[$key][$i]);
					if (count($vArray) == 2)
					$matrix_values[$key][$i] = (int)$vArray[0] / (int)$vArray[1]; 
				else
					$matrix_values[$key][$i] = (int)$vArray[0];
					
				 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, number_format($matrix_values[$key][$i], 3));
			 }
			 
			 $col++;
	  	}
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $_priorities[$equal]);
		  
		$row++;
		$equal++;
	}
	
	
}

# Add one row gap;
//$row++;

# Sub Criteria to Alternative - Pair Comparison matrices;
if (strpos($pair_comparison_matrix, "sub_") !== false)
{
	$node_index = explode("_",$pair_comparison_matrix);
	$criteria_node_index = $node_index[1];
	$node_index = $node_index[2];
	
	# write heading of section;
	writeSectionHeading($objPHPExcel, 'Pair Comparison of Choices with respect to: ' . $ahp['sub_criterias'][$criteria_node_index][$node_index],$row);
	
	$row++;
	
	# Write first row;
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $ahp['sub_criterias'][$criteria_node_index][$node_index]);
	$col = 2;
	foreach ($ahp['alternatives'] as $k => $v)
	{
		$vertical_array[$k] = $v;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $v);
		$col++;
	}
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Priorities');
	# End first row;
	
	$row++;
	$equal = 0; 
	foreach ($ahp['alternatives'] as $key => $value) 
	{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value);
		
		$col = 2;
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
			if ($equal==$i) 
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
			}
			else
			{
				$vArray = explode('/',$matrix_values[$key][$i]);
					if (count($vArray) == 2)
					$matrix_values[$key][$i] = (int)$vArray[0] / (int)$vArray[1]; 
				else
					$matrix_values[$key][$i] = (int)$vArray[0];
					
				 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, number_format($matrix_values[$key][$i], 3));
			}
			$col++;
		}
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $_priorities[$equal]);
		
		$row++;
		$equal++;
	}
}

//$row--;
$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':G'.$row);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, 'Consistency: ' . $_consistency . '%');

$objRichText = new PHPExcel_RichText();
$objPayable = $objRichText->createTextRun('Consistency: ' . $_consistency . '%');
$objPayable->getFont()->setBold(true);
$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
$objPHPExcel->getActiveSheet()->getCell('B'.$row)->setValue($objRichText);
	
$row++;

?>