<?php	 	

session_start();

if (!function_exists('matrixmult')) :
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
endif;


# This is to check if any of the element in the matrix has no value, then assign 1 to it,
# Also check if any value is in fraction, then remove the fraction and calculate its decimal value;
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

$Cons_Array = array(
1 => 0.00,
2 => 0.00,
3 => 0.52,
4 => 0.89,
5 => 1.11,
6 => 1.25,
7 => 1.35,
8 => 1.4,
9 => 1.45,
10 => 1.49,
11 => 1.51,
12 => 1.45,
13 => 1.56,
14 => 1.57,
15 => 1.58
);

$Err = 0.00001;
$recursive_limit = 5;
$previous_priorities = array();
$original_matrix = $matrix = $_POST['criteria'];

$SizeOfMatrix = count($original_matrix);


$consistency = 0;
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
		
		$s = $s;
		$sum_of_rows[$key] = $s;
		$grand_total += $s;
	}
	
	$priorities = array();
	$max = max($sum_of_rows);
	
	if ($_SESSION['project_mode'] == "i") $grand_total = $max;
	
	foreach ($sum_of_rows as $key => $val)
	{
		$v = $val/$grand_total;
		$priorities[$key] = number_format($v, 4);
	}
	
	
	
}


# Now calculate lamda Max;
$cons_array = array();
foreach ($original_matrix as $key => $value)
{
	$string = "";
	$temp_priority = 0;
	foreach ($value as $k => $v)
	{
		$v = number_format($v,4);
		$priorities[$k] = number_format($priorities[$k],3);
		$string .= "($v * $priorities[$k]) + ";
		
		$temp_priority += ($v * $priorities[$k]);
	}
	$cons_array[$key] = $temp_priority;
	
	//echo $string;
	//echo "<br />";
}

//echo "<pre>";
//print_r( $cons_array );
//echo "</pre>";

foreach ($cons_array as $key => $value)
{
	$temp_value += $value / $priorities[$key];
}
$lamda_max = $temp_value / count($original_matrix);

# Now calculate Consistency Index;
# (λmax‐n)/(n‐1)
$CI = ($lamda_max - $SizeOfMatrix ) / ($SizeOfMatrix - 1);
# The final step is to calculate the Consistency Ratio for this set of judgments using the CI 
/*
    If ConsistencyRatio < 0 Then ConsistencyRatio = 0
    Consistency(ThisSet) = 100 * (1 - ConsistencyRatio)

*/

//echo "$CI / " . $Cons_Array[$SizeOfMatrix];
//echo "<br />";
$CR = $CI / $Cons_Array[$SizeOfMatrix];
if ($CR < 0) $CR = 0;
$consistency = 100 * (1 - $CR);
//echo "<br />";
$priorities[] = number_format($consistency,1);


echo implode(',',$priorities);

?>