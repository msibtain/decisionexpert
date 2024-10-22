<?php
include('includes.php');

require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
		

$id = @$_GET['id'];

if ($_POST)
{
	$projects = $db->select("projects", "*", "id = " . $_GET['id']);
	$projects = $projects[0];

	$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
	$projects_ahp = $projects_ahp[0];
	
	$criterias = unserialize($projects_ahp->criterias);
	$sub_criterias  = unserialize($projects_ahp->sub_criterias );
	$alternatives = unserialize($projects_ahp->alternatives);
	
	$ahp = array(
		'objective' => $projects_ahp->objective,
		'criterias' => $criterias,
		'sub_criterias' => $sub_criterias,
		'alternatives' => $alternatives
	);
	
	$_SESSION['ahp'] = $ahp;
	
	//require_once('html2pdf/html2pdf.class.php');
	//$margins = array(2,2,2,2);
	
	$pdf_html = '';
	
	# Add Hierarchy HTML in PDF;
	if (in_array("hierarchy", $_POST['option']))
	{
		//$pdf_html .= '<page backtop="20mm" backbottom="18mm" backleft="0mm" backright="0mm" style="font-size: 10pt; color:#000000;">';
		
		//ob_start();
		//include('hierarchy.php');
		//$pdf_html .= ob_get_clean();
		
		$objWorksheet1 = $objPHPExcel->createSheet();
		$objWorksheet1->setTitle('Project Hierarchy');

		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Project Tree');
		$objDrawing->setDescription('Project Tree');
		$objDrawing->setPath('project_tree.png');
		$objDrawing->setHeight(156);
		
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		
		
		

		//$pdf_html .= '</page>';
	}
	
	# Add pair comparison HTMl in PDF;
	if (in_array("pair_comparison", $_POST['option']))
	{
		$objWorksheet2 = $objPHPExcel->createSheet();
		$objWorksheet2->setTitle('Pair Comparison');


		$pm = $db->select("projects_matrix", "*", "project_id = " . $_GET['id']);
		if (count($pm))
		{
			//$pdf_html .= '<page backtop="20mm" backbottom="18mm" backleft="0mm" backright="0mm" style="font-size: 10pt; color:#000000;">';
			foreach ($pm as $projects_matrix)
			{
				$pair_comparison_matrix = $projects_matrix->pair_comparison_matrix;
				if ($pair_comparison_matrix=='objective')
					$pdf_html .= '<strong>Pair Comparison of Attributes with respect to: ' . $ahp['objective'] . '</strong>';
				elseif (strpos($pair_comparison_matrix, "criteria_") !== false)
				{
					$node_index = explode("_",$pair_comparison_matrix);
					$node_index = $node_index[1];
					$pdf_html .= '<strong>Pair Comparison of Choices with respect to: ' . $ahp['criterias'][$node_index] . '</strong>';
				}
				elseif (strpos($pair_comparison_matrix, "sub_") !== false)
				{
					$node_index = explode("_",$pair_comparison_matrix);
					$criteria_node_index = $node_index[1];
					$node_index = $node_index[2];
					$pdf_html .= '<strong>Pair Comparison of Choices with respect to: ' . $ahp['sub_criterias'][$criteria_node_index][$node_index] . '</strong>';
				}
				
				ob_start();
				include('table_html.php');
				$pdf_html .= ob_get_clean();
				
				$pdf_html .= '<p>&nbsp;</p><hr />';
			}
			//$pdf_html .= '</page>';
		}
		
		
		$objRichText = new PHPExcel_RichText();
		$objRichText->createText($pdf_html);
		
		//$objRichText->createText(', unless specified otherwise on the invoice.');
		
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue($objRichText);


	}
	
	# Add Decision Chart HTML in PDF;
	if (in_array("decision_chart", $_POST['option']))
	{
		//$pdf_html .= '<page backtop="20mm" backbottom="18mm" backleft="0mm" backright="0mm" style="font-size: 10pt; color:#000000;">';
		$pdf_html .= '<strong>Criteria Intensities and Choices Rank</strong>';
		$pdf_html .= '<p>&nbsp;</p>';
		ob_start();
		include('decision.chart.php');
		include('final_result.chart.php');
		$pdf_html .= ob_get_clean();
		$pdf_html .= '<img src="criteria_weight_chart.png" /><br />';
		$pdf_html .= '<img src="final_chart.png" />';
		//$pdf_html .= '</page>';
	}
	
	# Add Contribution Chart HTML in PDF;
	if (in_array("contribution_chart", $_POST['option']))
	{
		//$pdf_html .= '<page backtop="20mm" backbottom="18mm" backleft="0mm" backright="0mm" style="font-size: 10pt; color:#000000;">';
		$pdf_html .= '<strong>Contribution Chart</strong>';
		$pdf_html .= '<p>&nbsp;</p>';
		ob_start();
		include('c_chart_html.php');
		$pdf_html .= ob_get_clean();
		$pdf_html .= '<img src="contribution_chart.png" />';
		//$pdf_html .= '</page>';
	}
	
	# Add Decision Matrix HTML in PDF;
	if (in_array("decision_matrix", $_POST['option']))
	{
		//$pdf_html .= '<page backtop="20mm" backbottom="18mm" backleft="0mm" backright="0mm" style="font-size: 10pt; color:#000000;">';
		$pdf_html .= '<strong>Decision Matrix and Consistencies</strong>';
		$pdf_html .= '<p>&nbsp;</p>';
		ob_start();
		include('decision_matrix_html.php');
		$pdf_html .= ob_get_clean();
		//$pdf_html .= '</page>';
	}
	
	
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('hierarchy.xls');
		
		echo "save";
		exit;

	# Export to Excel now;
	
	//$filename ="excelreport.xls";
	//$contents = $pdf_html;
	//header('Content-type: application/ms-excel');
	//header('Content-Disposition: attachment; filename='.$filename);
	//echo $contents;
	$pdf_html = str_replace('<tr>
                                        
                        </tr>','',$pdf_html);
	
	echo $pdf_html;
	
	header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/ms-excel");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment; filename=export.xls;");
  
	
}

?>