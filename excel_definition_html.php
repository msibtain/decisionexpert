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


$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'User Name');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, $project_info[0]->user_name);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, 'Project Name');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 3, $project_info[0]->project_name);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 4, 'Version');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 4, $project_info[0]->version);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, 'Organization');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 5, $project_info[0]->organization);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, 'Department');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 6, $project_info[0]->department);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, 'Date Created');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 7, $project_info[0]->date_created);
?>