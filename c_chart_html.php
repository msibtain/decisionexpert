<?php
$xAxis = array();
$x = 0;
$left_ratio = array();
$lr = 0;
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
$pair_comparison_matrix = 'criteria_'.$key;
$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
$xAxis[$x]['label'] = $value;
foreach ($alternatives as $altKey => $altValue)
{
$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
$number_to_show = $nPriorities[$altKey];
$number_to_show = number_format($number_to_show*100,2);
$xAxis[$x]['alternative'][$altKey] = $number_to_show;
}
$x++;
}
else
{
if ($trClass=='odd') $trClass='even'; else $trClass='odd';
foreach ($sub_criterias[$key] as $k => $v)
{
$matrix_values = getMatrixValuesForCriteria($_GET['id'], $key);
$number_to_show = number_format(($matrix_values[$k]*$global_priorities[$key])*100, 3);
$left_ratio[$lr]['pair_comparison_matrix'] = 'sub_'.$key.'_'.$k;
$left_ratio[$lr]['value'] = $v;
$left_ratio[$lr]['number'] = $number_to_show;
$lr++;
$pair_comparison_matrix = 'sub_'.$key.'_'.$k;
$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
$xAxis[$x]['label'] = $v;
foreach ($alternatives as $altKey => $altValue)
{
$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
$number_to_show = $nPriorities[$altKey];
$number_to_show = number_format($number_to_show*100,2);
$xAxis[$x]['alternative'][$altKey] = $number_to_show;
}
$x++;
}
}
}
$a = 0;
$altArray = array();
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
$altArray[$a]['name'] = $altValue;
$altArray[$a]['value'] = $number_to_show;
$a++;
}
$_SESSION['xAxis'] = $xAxis;
$_SESSION['altArray'] = $altArray;
$_SESSION['organization'] = $projects->organization;
$for_pdf = @$_GET['for_pdf'];
if ($for_pdf)
{
$_SESSION['for_pdf'] = 1;
include('c_chart.php');
}
else
{
$_SESSION['for_pdf'] = 0;
?>
<p align="center">
<img src="c_chart.php?id=<?php echo $_GET['id']; ?>" />
</p>
<?php
}
?>