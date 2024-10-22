<?php
session_start();

global $arialFont;
global $arialBFont;
global $boxWidth;
global $boxMargins_X;
global $boxHeight;
global $boxMargins_Y;
global $image;
global $color_Black;
global $words_characters;


$arialFont = './ARIALN.TTF';
$arialBFont = './ARIALNB.TTF';

/*
# Dummy data;
$_SESSION['ahp'] = array(
	
	'objective' => 'Best Project',
	'criterias' => array(
		'0' => 'Market Size', 
		'1' => 'Resources', 
		'2' => 'Return on Investment', 
		'3' => 'Impact on Environment',
	),
	'sub_criterias' => array(
		'1' => array('Finance', 'Technology', 'Skills', 'Test'),
	),
	'alternatives' => array('Publishing', 'Transport', 'Farming'),
	'levels' => 4
	
);
##
*/

$counts = array(
	count(@$_SESSION['ahp']['criterias'], COUNT_RECURSIVE),
	count(@$_SESSION['ahp']['sub_criterias'], COUNT_RECURSIVE),
	count(@$_SESSION['ahp']['alternatives'], COUNT_RECURSIVE)
);

# This is required to calculate the width of the chart;
$maximum = max($counts);

$words_characters = 12;

# Calculate chart width;
$boxWidth = 80;
$boxMargins_X = 8;
$boxTotalArea_X = (int)$boxWidth + ((int)$boxMargins_X * 2);
$imgWidth = (int)$boxTotalArea_X * (int)$maximum;

# Calculate chart height;
$boxHeight = 26;
$boxMargins_Y = 30;
$boxTotalArea_Y = (int)$boxHeight + ((int)$boxMargins_Y * 2);
$imgHeight = (int)$boxTotalArea_Y * (int)$_SESSION['ahp']['levels'];


$image = imagecreate($imgWidth, $imgHeight);
# Define colors;
$color_White = imagecolorallocate($image, 255, 255, 255);
$color_Black = imagecolorallocate($image, 0, 0, 0);
$color_Yellow = imagecolorallocate($image, 254, 254, 215);
$color_Green = imagecolorallocate($image, 212, 254, 215);

function count_recursive($array) 
{
    if (!is_array($array)) {
       return 1;
    }

    $count = 0;
    foreach($array as $sub_array) {
        $count += count_recursive($sub_array);
    }

    return $count;
}

function drawBox($x1, $y1, $x2 = '', $y2 = '', $boxColor = '', $text = '', $bgColor = '')
{
	global $arialFont;
	global $arialBFont;
	global $boxWidth;
	global $boxMargins_X;
	global $boxHeight;
	global $boxMargins_Y;
	global $image;
	global $color_Black;
	global $words_characters;

	if (!$x2) $x2 = (int)$x1 + (int)$boxWidth;
	if (!$y2) $y2 = (int)$y1 + (int)$boxHeight;
	if (!$boxColor) $boxColor = $color_Black;
	
	if ($bgColor)
			imagefilledrectangle($image, $x1, $y1, $x2, $y2, $bgColor);
	
	imagerectangle($image, $x1, $y1, $x2, $y2, $boxColor);
	
	if ($text)
	{
		
		$bbox = imagettfbbox(11,0, $arialFont, $text);
		$stringWidth = $bbox[2];
		
		# if text is too long, then trim it;
		if ($stringWidth > $boxWidth)
		{
			$text = substr($text, 0, $words_characters) . "..";
			
			$bbox = imagettfbbox(11,0, $arialFont, $text);
			$stringWidth = $bbox[2];
		}
		
		
		$freeAreaLeftRight = ((int)$boxWidth - (int)$stringWidth) / 2;
		
		imagettftext($image, 11, 0, $x1+$freeAreaLeftRight, $y1+18, $boxColor, $arialFont, $text);
	}
	
	return array( 'x' => $x2, 'y' => $y2);
		
}

function drawLine($x1, $y1, $x2, $y2, $color='')
{
	global $arialFont;
	global $arialBFont;
	global $boxWidth;
	global $boxMargins_X;
	global $boxHeight;
	global $boxMargins_Y;
	global $image;
	global $color_Black;
	
	if (!$color) $color = $color_Black;
	
	imageline($image,$x1,$y1,$x2,$y2,$color);
}

# write Objective / level1;
$objectiveCenter = $imgWidth / 2;
$objectiveX1 = $objectiveCenter - ($boxWidth/2);
$objectiveY1 = 15;
$first_level = drawBox($objectiveX1, $objectiveY1,'','','', $_SESSION['ahp']['objective'], $color_Yellow);

# calculate margin between boxes of second level;
$boxesArea = (int)$boxWidth * count($_SESSION['ahp']['criterias']);
$difference = $imgWidth - $boxesArea;
$boxMargin_Level2 = $difference / (count($_SESSION['ahp']['criterias'])+1);
$startX_Level2 = $boxMargin_Level2;
$startY_Level2 = $first_level['y'] + ($boxMargins_Y*2);

# calculate margin between boxes of third level;
$boxesArea = (int)$boxWidth * count_recursive(@$_SESSION['ahp']['sub_criterias']);
$difference = $imgWidth - $boxesArea;
$boxMargin_Level3 = $difference / (count_recursive(@$_SESSION['ahp']['sub_criterias'])+1);	
$startX_Level3 = $boxMargin_Level3;

$sub_criteria_array = false;

if (count($_SESSION['ahp']['criterias']))
{
	foreach ($_SESSION['ahp']['criterias'] as $k => $v)
	{
		# see if this criteria is parent;
		$bgColor = "";
		if (isset($_SESSION['ahp']['sub_criterias'][$k]))
		{
			$bgColor = $color_Yellow;
		}
		
		$second_level = drawBox($startX_Level2, $startY_Level2, '', '', '', $v, $bgColor);
		
		drawLine(
			((int)$startX_Level2+(int)($boxWidth/2)), 
			$startY_Level2, 
			(int)$first_level['x']-(int)($boxWidth/2), 
			$first_level['y']
		);
		$startX_Level2 = (int)$startX_Level2 + (int)$boxWidth + (int)$boxMargin_Level2;
		
		# loop through sub criterias;
		if (isset($_SESSION['ahp']['sub_criterias'][$k]))
		{
			$sub_criteria_array = true;
			
			$startY_Level3 = $second_level['y'] + ($boxMargins_Y*2);
	
			foreach ($_SESSION['ahp']['sub_criterias'][$k] as $kk => $v2)
			{
				$third_level = drawBox($startX_Level3, $startY_Level3, '', '', '', $v2);
				drawLine(
					((int)$startX_Level3+(int)($boxWidth/2)), 
					$startY_Level3, 
					(int)$second_level['x']-(int)($boxWidth/2), 
					$second_level['y']
				);
				$startX_Level3 = (int)$startX_Level3 + (int)$boxWidth + (int)$boxMargin_Level3;
			}
		}
	}
}

# draw Level 4 boxes;

if (!$sub_criteria_array)
{
	$third_level = $second_level;
}

$boxesArea = (int)$boxWidth * count($_SESSION['ahp']['alternatives']);
$difference = $imgWidth - $boxesArea;
$boxMargin_Level4 = $difference / (count($_SESSION['ahp']['alternatives'])+1);
$startX_Level4 = $boxMargin_Level4;
$startY_Level4 = $third_level['y'] + ($boxMargins_Y*2);

if (count($_SESSION['ahp']['alternatives']))
{
	foreach ($_SESSION['ahp']['alternatives'] as $a => $v3)
	{
		$fourth_level = drawBox($startX_Level4, $startY_Level4, '', '', '', $v3, $color_Green);
		$startX_Level4 = (int)$startX_Level4 + (int)$boxWidth + (int)$boxMargin_Level4;
	}
}

//header("Content-type: image/png");
//imagepng($image);

imagepng($image,'hierarchy/project_tree_'.$_SESSION['project_id'].'.png');
imagedestroy($image);
?>