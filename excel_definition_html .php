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
//writeSectionHeading($objPHPExcel, 'Project Definition',$row);


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
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Consistency');
?>