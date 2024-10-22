<?php
session_start();
putenv('GDFONTPATH=' . realpath('.'));
$arial = 'arial.ttf';
$arialBold = 'arialbd.ttf';
extract($_SESSION['ahp']);
$yAxis = $left_ratio = array();
$lr = 0;
$y = 0;
$max_number = 0;
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
$yAxis[$y]['label'] = $value;
$yAxis[$y]['number'] = $number_to_show;
$y++;
if ($number_to_show > $max_number) $max_number = $number_to_show;
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
$yAxis[$y]['label'] = $v;
$yAxis[$y]['number'] = $number_to_show;
$y++;
if ($number_to_show > $max_number) $max_number = $number_to_show;
}
}
}
# Now calculate Final result;
$final_result = array();
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
$final_result[$altValue] = $number_to_show;
}
$_SESSION['final_result'] = $final_result;
# Final result calculate ends;
if ($max_number > 40)
$scale_gap = ceil($max_number / 8);
else
$scale_gap = 5;
# you may need to add some cases here, if value of T will increase;
switch ($scale_gap)
{
case $scale_gap > 70:
$scale_gap = 80;
break;
case $scale_gap > 60:
$scale_gap = 70;
break;
case $scale_gap > 50:
$scale_gap = 60;
break;
case $scale_gap > 40:
$scale_gap = 50;
break;
case $scale_gap > 30:
$scale_gap = 40;
break;
case $scale_gap > 25:
$scale_gap = 30;
break;
}
$scales = array(
$scale_gap,
$scale_gap*2,
$scale_gap*3,
$scale_gap*4,
$scale_gap*5,
$scale_gap*6,
$scale_gap*7,
$scale_gap*8
);
// Create image and define colors
$imgWidth = 550;
$imgHeight = count($yAxis) * 35 + 80;
//$imgHeight = 500;
# Calculate Scale ratio;
$scale = 45/$scale_gap;		# Important, for plotting the dots;
/*
5 => 45
1  => 45/5 = 1.76
*/
//header("Content-Type: image/png");
$image = @imagecreate($imgWidth, $imgHeight)
or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($image, 255, 255, 255);
$color_Purple = imagecolorallocate($image, 80, 55, 109);
$color_Gray = imagecolorallocate($image, 176, 171, 168);
$color_Black = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 14, 0, 220, 17, $color_Purple, $arialBold, 'Criteria Weight');
$x1 = 100;
$y1 = 45;
$x2 = 100;
$y2 = $y1 + (count($yAxis) * 35);
imageline($image, $x1, $y1, $x2, $y2 + 5, $color_Gray);		# Draw y Axis line (vertical line);
imagettftext($image, 8, 0, $x2 - 9, $y2 + 15, $color_Black, $arial, number_format(0,1));
imageline($image, $x2-5, $y2, 470, $y2, $color_Gray);		# Draw x Axis line (horizontal line);
# Draw vertical scale lines;
$gap_between_bars = 370 / count($scales);
for($i=0; $i<count($scales); $i++)
{
$x1 += $gap_between_bars;
$x2 += $gap_between_bars;
imageline($image, $x1, $y1, $x2, $y2 + 5, $color_Gray);
imagettftext($image, 8, 0, $x2 - 9, $y2 + 15, $color_Black, $arial, number_format($scales[$i],1));
}
$bar_width = 25;
$bar_distance = 10;
$x1 = 100;
$y1 = 50;
foreach ($yAxis as $key => $value)
{
$x2 = $x1 + ($scale * $value['number']);
$y2 = $y1 + $bar_width;
$random_Color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
imagefilledrectangle($image, $x1, $y1, $x2, $y2, $random_Color);
imagettftext($image, 9, 0, $x2 + 5, $y1 + 17, $color_Black, $arial, number_format($value['number'],1));
# x for the label;
$dimensions = imagettfbbox(10, 0, $arial, $value['label']);
$textWidth = abs($dimensions[4] - $dimensions[0]);
$xLabel = 100 - $textWidth;
imagettftext($image, 10, 0, $xLabel - 5, $y1 + 17, $color_Black, $arial, $value['label']);
$y1 = $y2 + $bar_distance;
}
//imagestring($image, 1, 5, 5,  "A Simple Text String", $text_color);
imagepng($image, 'criteria_weight_chart_'.$_GET['id'].'.png');
//imagepng($image);
imagedestroy($image);
?>