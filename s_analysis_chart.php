<?php	 	
	session_start();
	putenv('GDFONTPATH=' . realpath('.'));
	$arial = 'arial.ttf';
	$arialBold = 'arialbd.ttf';
	
	$xAxis = $_SESSION['xAxis'];
	$altArray = $_SESSION['altArray'];
	
	$xScale = array(10,20,30,40,50,60,70,80,90,100);
	//$yScale = array(5,10,15,20,25,30);
	
	$max_number = 0;
	foreach ($_SESSION['yAxis'] as $key => $value)
	{
		if ($value['start'] > $max_number) $max_number = $value['start'];
		if ($value['end'] > $max_number) $max_number = $value['end'];
	}

	if ($max_number > 30)
		$scale_gap = round($max_number / 6);
	else
		$scale_gap = 10;
	
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
	  case $scale_gap > 20:
		  $scale_gap = 30;
		  break;
	  case $scale_gap > 10:
		  $scale_gap = 20;
		  break;
	  case $scale_gap > 5:
		  $scale_gap = 10;
		  break;
	}
	$yScale = array(
		$scale_gap,
		$scale_gap*2,
		$scale_gap*3,
		$scale_gap*4,
		$scale_gap*5,
		$scale_gap*6
	);
	
	
	
	// Create image and define colors
	$imgWidth = 550;
	$imgHeight = 350;
	
	# Calculate Scale ratio;
	$scale = 5;		# Important, for plotting the dots;
	
	/*
	10 = 50
	1 = 50/10
	
	10 = 90
	20 = 140
	30 = 190
	
	
	
	
	
	*/
	
	
	
	// Define .PNG image
	header("Content-type: image/png");
	
	$image = imagecreatetruecolor($imgWidth, $imgHeight);

	$color_White = imagecolorallocate($image, 255, 255, 255);
	imagefill($image,0,0,$color_White);
	
	$color_Black = imagecolorallocate($image, 0, 0, 0);
	$color_Gray = imagecolorallocate($image, 76, 83, 92);
	$color_Purple = imagecolorallocate($image, 130, 24, 170);
	
	
	imagettftext($image, 10, 90, 12, 230, $color_Gray, $arial, 'Alternative Utility [%]');
	
	$start_line = 40;
	imagesetthickness($image, 2);
	imageline($image, $start_line, 10, $start_line, 313, $color_Gray);		# vertical line at ZERO
	imagettftext($image, 10, 0, $start_line-14, 315, $color_Gray, $arial, '0');
	imageline($image, $start_line-4,310,540,310,$color_Gray);				# horizontal line at ZERO
	imagettftext($image, 10, 0, $start_line-3, 325, $color_Gray, $arial, '0');
	
	imagesetthickness($image, 1);
	$vGap = 50;		# This is vertical gap between vertical lines;
	$x1 = $start_line;
	# Draw vertical lines;
	for ($i=0; $i<10; $i++)
	{
		$x1 += $vGap;
		$x2 = $x1;
		imageline($image, $x1, 10, $x2, 310, $color_Gray);
		if ($i<9) $d = 7; else $d = 12;
		imagettftext($image, 10, 0, $x1-$d, 325, $color_Gray, $arial, $xScale[$i]);
	}
	
	# Draw horizontal lines;
	$xGap = 49;		# This is horizontal gap between horizontal lines;
	$x1 = $start_line;
	$x2 = 540;
	$y1 = 15;
	for($i=5; $i>=0; $i--)
	{
		$y2 = $y1;
		imageline($image, $x1, $y1, $x2, $y2, $color_Gray);
		if ($i==0 && $yScale[$i] < 10) $d = 12; else $d = 18;
		imagettftext($image, 10, 0, $x1-$d, $y1+4, $color_Gray, $arial, $yScale[$i]);
		$y1 += $xGap;
	}
	
	imagesetthickness($image, 3);
	
	# Draw purple line;
	$xPlot = ($scale * $_SESSION['xAxis']) + $start_line;
	imageline($image, $xPlot, 10, $xPlot, 310, $color_Purple);
	
	$fraction = 49 / $scale_gap;
	
	/*
	
	5 = 261
	10 = 212
	
	310 = Actual figure ;)
	
	1 = 9.8
	*/
	
	$x1 = $start_line;
	$x2 = 540;
	
	imageantialias($image, true);
	# Draw horizontal lines - Alternative lines;
	foreach ($_SESSION['yAxis'] as $f => $value)
	{
		$color_Rand = imagecolorallocate($image, $value['r'], $value['g'], $value['b']);
		
		$y1 = 310 - ($value['start'] * $fraction);
		$y2 = 310 - ($value['end'] * $fraction);
		imageline($image, $x1, $y1, $x2, $y2, $color_Rand);
		imageline($image, $x1, $y1+1, $x2, $y2+1, $color_Rand);
		imageline($image, $x1, $y1+2, $x2, $y2+2, $color_Rand);
		
		//imagettftext($image, 10, 0, $x2, $y2, $color_Gray, $arial, $f);
	}
	
	imagepng($image);
	
		
	imagedestroy($image);

?>