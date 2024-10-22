<?php
include('includes.php');

require __DIR__.'/html2pdf-library/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$id = @$_GET['id'];
$for_pdf = @$_GET['for_pdf'];
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
$page_start = '<page backtop="22mm" backbottom="12mm" backleft="5mm" backright="5mm" style="font-size: 10pt; color:#000000;">';
$page_end = '</page>';
//require_once('html2pdf/html2pdf.class.php');
$margins = array(6,6,6,6);
$pdf_html = '';
# Add cover sheet;
if (in_array("print_cover_sheet", $_POST['option']))
{
$pdf_html = '<page backtop="5mm" backbottom="0mm" backleft="5mm" backright="5mm" style="font-size: 10pt; color:#000000;">';
ob_start();
include('cover_sheet.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add Content list;
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
include('content_list.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
# Add Introduction;
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
include('introduction.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
# Add Project Definition HTML in PDF;
if (in_array("definitions", $_POST['option']))
{
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
include('pdf_project_definition.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add Hierarchy HTML in PDF;
if (in_array("hierarchy", $_POST['option']))
{
$pdf_html .= $page_start;
$project_id = $_GET['id'];
ob_start();
include('pdf_header_footer.php');
include('hierarchy.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add Decision Chart HTML in PDF;
if (in_array("decision_chart", $_POST['option']))
{
$pdf_html .= $page_start;
ob_start();
include('decision.chart.php');
include('final_result.chart.php');
include('pdf_header_footer.php');
include('decision_scores.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
include('criteria_weight.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add Contribution Chart HTML in PDF;
if (in_array("contribution_chart", $_POST['option']))
{
$pdf_html .= $page_start;
ob_start();
include('c_chart_html.php');
include('pdf_header_footer.php');
include('pdf_contribution_chart.php');
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add Decision Matrix HTML in PDF;
if (in_array("decision_matrix", $_POST['option']))
{
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
?>
<p>&nbsp;</p>
<br clear="all" />
<table width="650" align="center">
<tr>
<td>
<div style="font-family:calibri; font-size:18pt; font-weight:bold; color:#c00000; text-align:center;">Decision Matrix</div>
</td>
</tr>
<tr>
<td align="center">
<?php
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
include('decision_matrix_html_ideal.php');
else
include('decision_matrix_html.php');
//include('decision_matrix_html.php'); ?>
</td>
</tr>
</table>
<?php
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
# Add pair comparison HTMl in PDF;
if (in_array("pair_comparison", $_POST['option']))
{
$pm = $db->select("projects_matrix", "*", "project_id = " . $_GET['id']);
$pdf_html .= $page_start;
ob_start();
include('pdf_header_footer.php');
?>
<p>&nbsp;</p>
<br clear="all" />
<table width="650" align="center">
<tr>
<td>
<div style="font-family:calibri; font-size:18pt; font-weight:bold; color:#c00000; text-align:center;">Judgement Matrices</div>
</td>
</tr>
</table>
<div>
<?php
if (count($pm))
{
foreach ($pm as $projects_matrix)
{
$pair_comparison_matrix = $projects_matrix->pair_comparison_matrix;
if ($pair_comparison_matrix=='objective')
{
?>
<strong>Pair Comparison of Attributes with respect to: <?php echo $ahp['objective']?></strong>
<?php
}
elseif (strpos($pair_comparison_matrix, "criteria_") !== false)
{
$node_index = explode("_",$pair_comparison_matrix);
$node_index = $node_index[1];
?>
<strong>Pair Comparison of Choices with respect to: <?php echo $ahp['criterias'][$node_index] ?></strong>
<?php
}
elseif (strpos($pair_comparison_matrix, "sub_") !== false)
{
$node_index = explode("_",$pair_comparison_matrix);
$criteria_node_index = $node_index[1];
$node_index = $node_index[2];
?>
<strong>Pair Comparison of Choices with respect to: <?php echo $ahp['sub_criterias'][$criteria_node_index][$node_index] ?></strong>
<?php
}
include('table_html.php');
?><p>&nbsp;</p><hr /><?php
}
}
?>
</div>
<?php
$pdf_html .= ob_get_clean();
$pdf_html .= $page_end;
}
$file_name = $projects->project_name . '_' . $projects->version . '.pdf';
# Print PDF now;
try
{

$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', $margins);
//		$html2pdf->setModeDebug();
//$html2pdf->pdf->IncludeJS($script);
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($pdf_html);
$html2pdf->Output($file_name, 'D');
}
catch(HTML2PDF_exception $e) { echo $e; }
}
?>