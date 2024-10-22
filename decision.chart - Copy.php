<?php	 	
session_start();
putenv('GDFONTPATH=' . realpath('.'));
$arial = 'arial.ttf';
$arialBold = 'arialbd.ttf';


	

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
				
	
	
	
if ($max_number > 40)
	$scale_gap = round($max_number / 8);
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
	0,
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
	$imgWidth = 485;
	//$imgHeight = count($yAxis) * 15 + 80;
	$imgHeight = 500;

	
header("Content-Type: image/png");
$im = @imagecreate(110, 20)
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 0, 0, 0);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
imagepng($im);
imagedestroy($im);

?>