<?php
//include('includes.php');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
/*
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(1);
*/
$id = @$_GET['id'];
$sheets = array();
if ($_POST)
{
$projects = $db->select("projects", "*", "id = " . $_GET['id']);
$projects = $projects[0];
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
$projects_ahp = $projects_ahp[0];
$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$sub_sub_criterias  = unserialize($projects_ahp->sub_sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);
$ahp = array(
'objective' => $projects_ahp->objective,
'criterias' => $criterias,
'sub_criterias' => $sub_criterias,
'sub_sub_criterias' => $sub_sub_criterias,
'alternatives' => $alternatives,
'levels' => $projects->levels
);
$_SESSION['ahp'] = $ahp;
$pdf_html = '';
######################################
######################################
$sheets[] = 'pd';
$objPHPExcel->removeSheetByIndex(0);
$objWorksheet3 = $objPHPExcel->createSheet();
$objWorksheet3->setTitle('Project Definition');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
$project_info = $db->select("projects", "*", "id = " . $_GET['id']);
include('excel_definition_html.php');
######################################
######################################
# Add Hierarchy HTML in excel;
if (in_array("hierarchy", $_POST['option']))
{
$sheets[] = 'hierarchy';
include('design_form_chart.php');
list($w, $h) = getimagesize("hierarchy/project_tree_".$_GET['id'].".png");
$objWorksheeta = $objPHPExcel->createSheet();
$objWorksheeta->setTitle('Project Hierarchy');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Project Hierarchy');
$objDrawing->setDescription('Project Hierarchy');
$objDrawing->setPath('hierarchy/project_tree_'.$_GET['id'].'.png');
$objDrawing->setHeight($h);
$objDrawing->setWidth($w);
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}
# Add pair comparison in excel;
if (in_array("pair_comparison", $_POST['option']))
{
$sheets[] = 'pc';
$objWorksheet2 = $objPHPExcel->createSheet();
$objWorksheet2->setTitle('Pair Comparison');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
//writeSectionHeading($objPHPExcel, 'Pair Comparison');
$pm = $db->select("projects_matrix", "*", "project_id = " . $_GET['id']);
if (count($pm))
{
foreach ($pm as $projects_matrix)
{
$pair_comparison_matrix = $projects_matrix->pair_comparison_matrix;
include('excel_table_html.php');
}
}
}
# Add Decision Chart HTML in excel;
if (in_array("decision_chart", $_POST['option']))
{
$sheets[] = 'dc_cw';
$objWorksheet3 = $objPHPExcel->createSheet();
$objWorksheet3->setTitle('Decision Charts - CW');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
include('decision.chart.php');
include('final_result.chart.php');
list($w, $h) = getimagesize("criteria_weight_chart_".$_GET['id'].".png");
//$pdf_html .= '<img src="'.WEB_PATH.'/criteria_weight_chart.png" height="'.$h.'" width="'.$w.'" /><br />';
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Decision Charts - CW');
$objDrawing->setDescription('Decision Charts - Criteria Weight');
$objDrawing->setPath('criteria_weight_chart_'.$_GET['id'].'.png');
$objDrawing->setHeight($h);
$objDrawing->setWidth($w);
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


$sheets[] = 'dc_fr';
$objWorksheet3 = $objPHPExcel->createSheet();
$objWorksheet3->setTitle('Decision Charts - FR');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
list($w, $h) = getimagesize("final_chart_".$_GET['id'].".png");
//$pdf_html .= '<img src="'.WEB_PATH.'/final_chart.png" height="'.$h.'" width="'.$w.'" />';
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Decision Charts - FR');
$objDrawing->setDescription('Decision Charts - Final Results');
$objDrawing->setPath('final_chart_'.$_GET['id'].'.png');
$objDrawing->setHeight($h);
$objDrawing->setWidth($w);
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}
# Add Contribution Chart HTML in PDF;
if (in_array("contribution_chart", $_POST['option']))
{
$sheets[] = 'cc';
$objWorksheet4 = $objPHPExcel->createSheet();
$objWorksheet4->setTitle('Contribution Chart');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
include('c_chart_html.php');
//list($w, $h) = getimagesize("contribution_chart_".$_GET['cid'].".png");
//$pdf_html .= '<img src="'.WEB_PATH.'/contribution_chart.png" height="'.$h.'" width="'.$w.'" />';
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Contribution Charts');
$objDrawing->setDescription('Contribution Charts');
$objDrawing->setPath('contribution_chart_'.$_GET['id'].'.png');
$objDrawing->setHeight(710);
$objDrawing->setWidth(754);
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}
# Add Decision Matrix HTML in PDF;
if (in_array("decision_matrix", $_POST['option']))
{
$sheets[] = 'dm';
$objWorksheet5 = $objPHPExcel->createSheet();
$objWorksheet5->setTitle('Decision Matrix');
$objPHPExcel->setActiveSheetIndex(count($sheets)-1);
if ($_SESSION['project_mode'])
$mode = $_SESSION['project_mode'];
elseif ($_SESSION['project_id'])
{
global $db;
$project_id = @$_SESSION['project_id'];
$mode = $db->select("projects_matrix", "mode", "project_id = " . $project_id);
$mode = $mode[0];
$mode = $mode->mode;
}
else
$mode = 'd';
if ($mode == 'i')
include('excel_decision_matrix_ideal_html.php');
else
include('excel_decision_matrix_html.php');
}
$file_name = str_replace(' ','_',$project_info[0]->project_name).'_'.trim($project_info[0]->version).'.xlsx';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($file_name);
?>
<a href="<?php echo $file_name; ?>">Download Excel File</a>
<?php
}
?>