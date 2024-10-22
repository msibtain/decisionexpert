<?php
session_start();
putenv('GDFONTPATH=' . realpath('.'));
$arial = 'arial.ttf';
$arialBold = 'arialbd.ttf';
$xAxis = $_SESSION['xAxis'];
$altArray = $_SESSION['altArray'];
$scale_gap = 10;
$scales = array(
0,
$scale_gap,
$scale_gap*2,
$scale_gap*3,
$scale_gap*4,
$scale_gap*5,
$scale_gap*6,
$scale_gap*7,
$scale_gap*8,
$scale_gap*9,
$scale_gap*10
);
// Create image and define colors
$imgWidth = 754;
$imgHeight = 710;	# Imagine Height as 450;
# Calculate Scale ratio;
$scale = 44/$scale_gap;		# Important, for plotting the dots;
/*
Jo value aaiy, usko 5.9 sy multiply kr ky 600 sy minus kr do;
10 => 541
20 => 482
1 = 5.9
Inversely proportional;
x = 10
y = 541
k = 10 * 541 = 5410;
y = k/x;
xy = k
10*541 = 5410
K = 5410;
y = 5410/20
*/
// Define .PNG image
if (!$_SESSION['for_pdf'])
header("Content-type: image/png");
$image = imagecreate($imgWidth, $imgHeight);
$color_White = imagecolorallocate($image, 255, 255, 255);
$color_Black = imagecolorallocate($image, 0, 0, 0);
$color_Gray = imagecolorallocate($image, 126, 126, 126);
$start_lining = 50;
//imageline($image,$start_lining,50,$start_lining,550,$color_Gray);	# Left Vertical line;
//imageline($image,730,50,730,550,$color_Black);	# Right Vertical Line;
imagettftext($image, 12, 90, 14, $imgHeight/2, $color_Gray, $arialBold, 'Contribution');
imagettftext($image, 12, 0, $imgWidth/3, 24, $color_Gray, $arialBold, 'Organisation: ' . $_SESSION['organization']);
# Now we need to allocate the horizontal line to draw the criterias and sub criterias AND then bars of alternatives;
# So we need to calculate 70% of the area for contribution chart and 30% for bar chart;
$total_width_of_line = 710;
$p_width_for_contribution = 80;
$p_width_for_bars = 20;
$area_for_contribution = ($total_width_of_line*$p_width_for_contribution) / 100;
$area_for_bar = ($total_width_of_line*$p_width_for_bars) / 100;
//imageline($image,$start_lining-5,550,$area_for_contribution+$star,550,$color_Black);	# Bottom Horizontal line;
$y1 = $y2 = 450;
for($i=0; $i<=10; $i++)
{
imagettftext($image, 9, 0, $start_lining-24, $y1+4, $color_Black, $arial, $scales[$i]);
//imagettftext($image, 9, 0, 732, $y1+4, $color_Black, $arial, $scales[$i]);
imageline($image, $start_lining-8,$y1,$area_for_contribution,$y2,$color_Gray);
//imageline($image, 705,$y1,710,$y2, $color_Black);
$y1 -= 40;
$y2 = $y1;
}
# Draw vertical lines for x Axis;
//$x1 = $x2 = 25;
$x1 = $x2 = $start_lining;
$gap = $area_for_contribution / count($xAxis);
$plots = array();
for($x=0; $x<count($xAxis); $x++)
{
imageline($image, $x1, 455, $x2, 50, $color_Gray);
imagettftext($image, 9, 270, $x1-5, 460, $color_Black, $arial, ($xAxis[$x]['label']));
$alt = 0;
foreach ($xAxis[$x]['alternative'] as $k => $a)
{
$y = 450 - ($a * 4.0);
//imagefilledarc($image, $x1, $y, 5,5,0,360,$color_Black,IMG_ARC_PIE );
$plots[$k][$x] = array($x1, $y);
}
$x1 += $gap;
$x2 = $x1;
$alt++;
}
imagesetthickness($image, 3);
/*
$plots = array(
0 = array(
0 => array(x,y),
1 => array(x,y)
),
1 => array(
0 => array(x,y),
1 => array(x,y)
)
);
*/
# Define some random colors;
$rColors = array(
array(241,110,5),
array(236,95,208),
array(26,116,0),
array(43,43,189),
array(7,230,49),
//array(111,115,8),
array(173,122,191)
);
shuffle($rColors);
# Draw contribution lines;
# This is loop throught each alternative;
$altColors = array();
$f = 0;
foreach ($plots as $p => $v)
{
$color_Rand = imagecolorallocate($image, $rColors[$f][0], $rColors[$f][1], $rColors[$f][2]);
$altColors[$p] = $color_Rand;
# This is loop throught each xAxis;
$s = 0;
foreach ($v as $kk => $vv)
{
if ($s)
{
imageline($image, $previous_x, $previous_y, $vv[0], $vv[1], $color_Rand);
}
$previous_x = $vv[0];
$previous_y = $vv[1];
$s++;
}
$alt_y[$f] = $previous_y;
$f++;
}
# Draw bars for alternatives;
$x1 = $x2+5; 		# Initialize the first rectangle position from the end of above last vertical line
$x2 = $x1;
$each_bar_width = ($area_for_bar/count($altArray)) - 5;
$static_x1 = $x1;
foreach ($altArray as $key => $value)
{
$x2 += $each_bar_width;
$y = 450 - ($value['value'] * 4.0);
//imagefilledrectangle($image, $x1, 549, $x2, $y, $altColors[$key]);
//imagettftext($image, 9, 0, $x1+($each_bar_width/4), $y - 10, $color_Black, $arial, $value['value']);
//imagettftext($image, 10, 270, $x1+($each_bar_width/2), 560, $altColors[$key], $arialBold, $value['name']);
$new_y1 = $alt_y[$key];
imageline($image, $static_x1, $new_y1, $static_x1+30, $new_y1, $altColors[$key]);
imagettftext($image, 10, 0, $static_x1+30+5, $new_y1+4, $color_Black, $arialBold, $value['name']);
$new_y1 -= 30;
$x1 = $x2 + 5;
}
if (!$_SESSION['for_pdf'])
imagepng($image);
else
imagepng($image, "contribution_chart_".$_GET['id'].".png");
imagedestroy($image);
?>