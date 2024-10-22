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
		foreach ($value as $k => $v) 
		{
			if(!$v)
			{ 
				$_POST['criteria'][$key][$k] = 1; 
			}
			else
			{
				$vArray = explode('/',$v);
				if (count($vArray) == 2)
					$_POST['criteria'][$key][$k] = (int)$vArray[0] / (int)$vArray[1]; 
				else
					$_POST['criteria'][$key][$k] = (int)$vArray[0];
				
			}	
		}
	}
	else
	{
		$_POST[$key] = 1;
	}
}

# Square the matrix;
$result_array = matrixmult($_POST['criteria'], $_POST['criteria']);


# NOW, LET'S COMPUTE OUR FIRST EIGENVECTOR (TO FOUR DECIMAL PLACES)
# FIRST, WE SUM THE ROWS
$grand_total = 0;
$sum_of_rows = array();
foreach ($result_array as $key => $value)
{
	$s = 0;
	foreach ($value as $k => $v) $s+= $v;
	
	$sum_of_rows[$key] = $s;
	$grand_total += $s;
}

$priorities = array();
foreach ($sum_of_rows as $key => $val)
{
	$v = $val/$grand_total;
	$priorities[$key] = number_format($v,3);
}
echo implode(',',$priorities);

?>