<?php	 	

function matrixmult($m1,$m2){
	$r=count($m1);
	$c=count($m2[0]);
	$p=count($m2);
	if(count($m1[0])!=$p){throw new Exception('Incompatible matrixes');}
	$m3=array();
	for ($i=0;$i< $r;$i++){
		for($j=0;$j<$c;$j++){
			$m3[$i][$j]=0;
			for($k=0;$k<$p;$k++){
				$m3[$i][$j]+=$m1[$i][$k]*$m2[$k][$j];
			}
		}
	}
	return($m3);
}

foreach ($_POST['criteria'] as $key => $value)
{
	if (is_array($value))
	{
		foreach ($value as $k => $v) if(!$v) { $_POST['criteria'][$key][$k] = 1; } 
	}
	else
	{
		$_POST[$key] = 1;
	}
}

$Err = 0.00001;
$recursive_limit = 200;
$previous_priorities = array();
$matrix = $_POST['criteria'];
for($r=0; $r<$recursive_limit; $r++)
{
	# Square the matrix;
	$matrix = matrixmult($matrix, $matrix);
	
	# NOW, LET'S COMPUTE OUR FIRST EIGENVECTOR (TO FOUR DECIMAL PLACES)
	# FIRST, WE SUM THE ROWS
	$grand_total = 0;
	$sum_of_rows = array();
	foreach ($matrix as $key => $value)
	{
		$s = 0;
		foreach ($value as $k => $v) $s+= $v;
		
		$s = number_format($s, 4);
		$sum_of_rows[$key] = $s;
		$grand_total += $s;
	}
	
	$priorities = array();
	
	foreach ($sum_of_rows as $key => $val)
	{
		$v = $val/$grand_total;
		$priorities[$key] = number_format($v,4);
	}
	
	#check if new priorities are equal to previous priorities, then stop;
	$equal = true;
	foreach ($priorities as $key => $value)
	{
		if (($value - $previous_priorities[$key]) <= $Err) break;
		//if ($value != $previous_priorities[$key]) $equal = false;
	}
	
	if ($equal) break;
	$previous_priorities = $priorities;
}


echo implode(',',$priorities);

?>