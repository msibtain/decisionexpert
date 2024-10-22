<?php	 	
	session_start();
	putenv('GDFONTPATH=' . realpath('.'));
	$fontTimes = 'calibri.ttf';
	$numberFont = 'arial.ttf';
	
	$T1 = round($_SESSION['T1']);
	$T2 = round($_SESSION['T2']);
	$T3 = round($_SESSION['T3']);
	$T4 = round($_SESSION['T4']);
	
	$S1 = round($_SESSION['S1']);
	$S2 = round($_SESSION['S2']);
	$S3 = round($_SESSION['S3']);
	$S4 = round($_SESSION['S4']);
	
	# For direct testing;
	//$T1 = round(50.41095890411);
	//$T2 = round(35.8447488584475);
	//$T3 = round(53.8447488584475);
	//$T4 = round(33.5616438356164);
	
	
	
	$max_value = max(array($T1, $T2, $T3, $T4, $S1, $S2, $S3, $S4));
	
	if ($max_value > 100)
		$scale_gap = round($max_value / 4);
	else
		$scale_gap = 25;
	
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
			$scale_gap*4);
	
	
	function imageSmoothAlphaLine ($image, $x1, $y1, $x2, $y2, $r, $g, $b, $alpha=0) {
	  $icr = $r;
	  $icg = $g;
	  $icb = $b;
	  $dcol = imagecolorallocatealpha($image, $icr, $icg, $icb, $alpha);
	  
	  if ($y1 == $y2 || $x1 == $x2)
		imageline($image, $x1, $y2, $x1, $y2, $dcol);
	  else {
		$m = ($y2 - $y1) / ($x2 - $x1);
		$b = $y1 - $m * $x1;
	  
		if (abs ($m) <2) {
		  $x = min($x1, $x2);
		  $endx = max($x1, $x2) + 1;
	  
		  while ($x < $endx) {
			$y = $m * $x + $b;
			$ya = ($y == floor($y) ? 1: $y - floor($y));
			$yb = ceil($y) - $y;
	  
			$trgb = ImageColorAt($image, $x, floor($y));
			$tcr = ($trgb >> 16) & 0xFF;
			$tcg = ($trgb >> 8) & 0xFF;
			$tcb = $trgb & 0xFF;
			imagesetpixel($image, $x, floor($y), imagecolorallocatealpha($image, ($tcr * $ya + $icr * $yb), ($tcg * $ya + $icg * $yb), ($tcb * $ya + $icb * $yb), $alpha));
	  
			$trgb = ImageColorAt($image, $x, ceil($y));
			$tcr = ($trgb >> 16) & 0xFF;
			$tcg = ($trgb >> 8) & 0xFF;
			$tcb = $trgb & 0xFF;
			imagesetpixel($image, $x, ceil($y), imagecolorallocatealpha($image, ($tcr * $yb + $icr * $ya), ($tcg * $yb + $icg * $ya), ($tcb * $yb + $icb * $ya), $alpha));
	  
			$x++;
		  }
		} else {
		  $y = min($y1, $y2);
		  $endy = max($y1, $y2) + 1;
	  
		  while ($y < $endy) {
			$x = ($y - $b) / $m;
			$xa = ($x == floor($x) ? 1: $x - floor($x));
			$xb = ceil($x) - $x;
	  
			$trgb = ImageColorAt($image, floor($x), $y);
			$tcr = ($trgb >> 16) & 0xFF;
			$tcg = ($trgb >> 8) & 0xFF;
			$tcb = $trgb & 0xFF;
			imagesetpixel($image, floor($x), $y, imagecolorallocatealpha($image, ($tcr * $xa + $icr * $xb), ($tcg * $xa + $icg * $xb), ($tcb * $xa + $icb * $xb), $alpha));
	  
			$trgb = ImageColorAt($image, ceil($x), $y);
			$tcr = ($trgb >> 16) & 0xFF;
			$tcg = ($trgb >> 8) & 0xFF;
			$tcb = $trgb & 0xFF;
			imagesetpixel ($image, ceil($x), $y, imagecolorallocatealpha($image, ($tcr * $xb + $icr * $xa), ($tcg * $xb + $icg * $xa), ($tcb * $xb + $icb * $xa), $alpha));
	  
			$y ++;
		  }
		}
	  }
	} // end of 'imageSmoothAlphaLine()' function
	
	// Define .PNG image
	header("Content-type: image/png");
	
	// Create image and define colors
	$imgWidth = 546;
	$imgHeight = 546;
	$diff = 124;
	$center = $imgHeight / 2;
	
	# Calculate Scale ratio;
	$scale = 44/$scale_gap;		# Important, for plotting the dots;

	/*
	25 => 44
	1  => 44/25 = 1.76
	
	
	*/
	
	
	$image=imagecreate($imgWidth, $imgHeight);

	$color_White = imagecolorallocate($image, 255, 255, 255);
	$color_Black = imagecolorallocate($image, 0, 0, 0);
	
	#Yellow Strips;
	$color_Yellow_1 = imagecolorallocate($image, 255, 255, 204);
	$color_Yellow_2 = imagecolorallocate($image, 255, 255, 153);
	$color_Yellow_3 = imagecolorallocate($image, 255, 255, 102);
	$color_Yellow_4 = imagecolorallocate($image, 255, 255, 0);
	#Pink Strips
	$color_Pink_1 = imagecolorallocate($image, 255, 204, 204);
	$color_Pink_2 = imagecolorallocate($image, 255, 124, 128);
	$color_Pink_3 = imagecolorallocate($image, 255, 80, 80);
	$color_Pink_4 = imagecolorallocate($image, 255, 0, 51);
	#Blue Strips
	$color_Blue_1 = imagecolorallocate($image, 204, 236, 255);
	$color_Blue_2 = imagecolorallocate($image, 153, 204, 255);
	$color_Blue_3 = imagecolorallocate($image, 51, 153, 255);
	$color_Blue_4 = imagecolorallocate($image, 0, 102, 255);
	#Green Strips
	$color_Green_1 = imagecolorallocate($image, 204, 255, 204);
	$color_Green_2 = imagecolorallocate($image, 153, 255, 153);
	$color_Green_3 = imagecolorallocate($image, 102, 255, 102);
	$color_Green_4 = imagecolorallocate($image, 51, 204, 51);
	# GrayLine;
	$color_Gray = imagecolorallocate($image, 95, 95, 95);
	$color_Cyan = imagecolorallocate($image, 0, 255, 255);
	
	$color_Gray_fifty = imagecolorallocate($image, 140, 70, 210);
	
	# bool imagefilledarc ( resource $image , int $cx , int $cy , int $width , int $height , int $start , int $end , int $color , int $style )
	# cx - X co ordinate of the center;
	# cy - Y co ordinate of the center;
	
	///imagefilledarc($image, 250, 250, 500, 500,  0, 360, $color_Black, IMG_ARC_PIE);
	
	imagefilledarc($image, $center, $center, 500, 500,  0, 90, $color_Pink_4, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 500, 500,  90, 180, $color_Blue_4, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 500, 500,  180, 270, $color_Green_4, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 500, 500,  270, 360, $color_Yellow_4, IMG_ARC_PIE);
	
	# Black border;
	///imagefilledarc($image, 250, 250, 373, 373,  0, 360, $color_Black, IMG_ARC_PIE);
	
	imagefilledarc($image, $center, $center, 370, 370,  0, 90, $color_Pink_3, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 370, 370,  90, 180, $color_Blue_3, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 370, 370,  180, 270, $color_Green_3, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 370, 370,  270, 360, $color_Yellow_3, IMG_ARC_PIE);
	
	# Black border;
	///imagefilledarc($image, 250, 250, 249, 249,  0, 360, $color_Black, IMG_ARC_PIE);
	
	imagefilledarc($image, $center, $center, 246, 246,  0, 90, $color_Pink_2, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 246, 246,  90, 180, $color_Blue_2, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 246, 246,  180, 270, $color_Green_2, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 246, 246,  270, 360, $color_Yellow_2, IMG_ARC_PIE);
	
	# Small black border - first level
	///imagefilledarc($image, 250, 250, 127, 127,  0, 360, $color_Black, IMG_ARC_PIE);
	
	imagefilledarc($image, $center, $center, 124, 124,  0, 90, $color_Pink_1, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 124, 124,  90, 180, $color_Blue_1, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 124, 124,  180, 270, $color_Green_1, IMG_ARC_PIE);
	imagefilledarc($image, $center, $center, 124, 124,  270, 360, $color_Yellow_1, IMG_ARC_PIE);
	
	imagesetthickness($image, 2);
	
	# bool imagearc ( resource $image , int $cx , int $cy , int $width , int $height , int $start , int $end , int $color )
	imagearc($image, $center, $center, 500, 500,  0, 360, $color_Black);
	imagearc($image, $center, $center, 371, 371,  0, 360, $color_Black);
	imagearc($image, $center, $center, 247, 247,  0, 360, $color_Gray_fifty);
	imagearc($image, $center, $center, 125, 125,  0, 360, $color_Black);
	
	# bool imageline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
	
	imageline($image, 23, $center, $imgWidth - 23, $center, $color_Gray);	# Horizontal full line;
	imageline($image, $center, 23, $center, $imgHeight - 23, $color_Gray);	# Vertical full line;
	
	imageline($image, $imgWidth/5.6, $imgHeight/5.6, $imgWidth/5.6*4.62, $imgHeight/5.6*4.62,$color_Gray); # Line from Q4 to Q2;
	imageline($image, $imgWidth/5.6, $imgHeight/5.6*4.62, $imgWidth/5.6*4.62, $imgHeight/5.6,$color_Gray); # Line from Q3 to Q1;
	
	
	
	# Write Q1, Q2, Q3 and Q4;
	# array imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
	imagettftext($image, 14, 0, $imgWidth/5.6 - 35, $imgWidth/5.6, $color_Gray, $numberFont, 'Q4');
	imagettftext($image, 14, 0, $imgWidth/5.6*4.7 , $imgHeight/5.6*4.7, $color_Gray, $numberFont, 'Q2');
	imagettftext($image, 14, 0, $imgWidth/6.7 - 30, $imgHeight/5.6*4.8, $color_Gray, $numberFont, 'Q3');
	imagettftext($image, 14, 0, $imgWidth/5.6*4.62 , $imgHeight/5.6 , $color_Gray, $numberFont, 'Q1');
	
	# Write scales, i.e., 25, 50, 75, 100;
	imagettftext($image, 11, 0, $center-21, 210, $color_Gray, $numberFont, $scales[0]);
	imagettftext($image, 11, 0, $center-21, 147, $color_Gray, $numberFont, $scales[1]);
	imagettftext($image, 11, 0, $center-21, 84, $color_Gray, $numberFont, $scales[2]);
	imagettftext($image, 11, 0, $center-21, 21, $color_Gray, $numberFont, $scales[3]);
	
	# Draw plot / small circle for T1;
	$position_of_t1 = $T1 * $scale;
	$position_of_s1 = $S1 * $scale;
	
	# Draw plot/small circle for T2;
	$position_of_t2 = $T2 * $scale;
	$position_of_s2 = $S2 * $scale;
	
	# Draw plot/small circle for T3;
	$position_of_t3 = $T3 * $scale;
	$position_of_s3 = $S3 * $scale;
	
	# Draw plot/small circle for T4;
	$position_of_t4 = $T4 * $scale;
	$position_of_s4 = $S4 * $scale;
	
	# Draw line between T1 and T2;
	$xT1 = $center + $position_of_t1;
	$yT1 = $center - $position_of_t1;
	$xT2 = $center + $position_of_t2;
	$yT2 = $center + $position_of_t2;
	//imageline($image, $xT1, $yT1, $xT2, $yT2, $color_Black);
	imageSmoothAlphaLine($image, $xT1, $yT1, $xT2, $yT2, 0,0,0,0);
	$xS1 = $center + $position_of_s1;
	$yS1 = $center - $position_of_s1;
	$xS2 = $center + $position_of_s2;
	$yS2 = $center + $position_of_s2;
	imagesetthickness($image, 1);
	imageline($image, $xS1, $yS1, $xS2, $yS2, $color_Black);	# a line from S1 to S2;
	imagesetthickness($image, 3);
	
	# Draw line between T2 and T3;
	$xT3 = $center - $position_of_t3;
	$yT3 = $center + $position_of_t3;
	imageline($image, $xT2, $yT2, $xT3, $yT3, $color_Black);
	$xS3 = $center - $position_of_s3;
	$yS3 = $center + $position_of_s3;
	imagesetthickness($image, 1);
	imageline($image, $xS2, $yS2, $xS3, $yS3, $color_Black);	# dotted line from S2 to S3;
	imagesetthickness($image, 3);
	
	# Draw line between T3 and T4;
	$xT4 = $center - $position_of_t4;
	$yT4 = $center - $position_of_t4;
	imageline($image, $xT3, $yT3, $xT4, $yT4, $color_Black);
	$xS4 = $center - $position_of_s4;
	$yS4 = $center - $position_of_s4;
	imagesetthickness($image, 1);
	imageline($image, $xS3, $yS3, $xS4, $yS4, $color_Black);	# dotted line from S3 to S4;
	imagesetthickness($image, 3);
	
	# Draw line between T4 and T1;
	imageline($image, $xT4, $yT4, $xT1, $yT1, $color_Black);
	imagesetthickness($image, 1);
	imageline($image, $xS4, $yS4, $xS1, $yS1, $color_Black);	# dotted line from S3 to S4;
	imagesetthickness($image, 3);
	
	# Draw small circle for T1;
	imagefilledarc($image, $xT1, $yT1, 7, 7,  0, 360, $color_Cyan, IMG_ARC_PIE);
	imagearc($image, $xT1, $yT1, 10, 10,  0, 360, $color_Black);
	
	# Draw small circle for T2;
	imagefilledarc($image, $xT2, $yT2, 7, 7,  0, 360, $color_Cyan, IMG_ARC_PIE);
	imagearc($image, $xT2, $yT2, 10, 10,  0, 360, $color_Black);
	
	# Draw small circle for T3;
	imagefilledarc($image, $xT3, $yT3, 7,7,  0, 360, $color_Cyan, IMG_ARC_PIE);
	imagearc($image, $xT3, $yT3, 10, 10,  0, 360, $color_Black);
	
	# Draw small circle for T4;
	imagefilledarc($image, $xT4, $yT4, 7, 7,  0, 360, $color_Cyan, IMG_ARC_PIE);
	imagearc($image, $xT4, $yT4, 10, 10,  0, 360, $color_Black);
	
	
	imagepng($image);
	imagedestroy($image);

?>