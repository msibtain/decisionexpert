<?php	 	

if (!function_exists('toFraction')) :
function toFraction($number){
	if ($number==1) return $number;
	
    $numerator = 1;
    $denominator = 0;
    for(; $numerator < 1000; $numerator++){
        $temp = $numerator / $number;
        if(ceil($temp) - $temp == 0){
            $denominator = $temp;
            break;
        }
    }
    return ($denominator > 0) ? $numerator . '/' . $denominator : false;
} 
endif;


foreach ($_POST['criteria'] as $key => $value)
{
	if (is_array($value))
	{
		foreach ($value as $k => $v) if(!$v) { $_POST['criteria'][$key][$k] = 1; } else { 
			$_POST['criteria'][$key][$k] = toFraction($v);	
		}
	}
	else
	{
		$_POST[$key] = 1;
	}
}


global $db;
$set = "
project_id = '".$_POST['project_id']."',
pair_comparison_matrix = '".$_POST['pair_comparison_matrix']."',
matrix_values = '".serialize($_POST['criteria'])."',
priorities = '".serialize($_POST['priorities'])."',
consistency = '".$_POST['consistency']."',
`mode` = '".$_POST['mode']."',
`direct_mode` = '".$_POST['direct_mode']."'
";

# Check if this matrix is already there in the table, then udpate, else save;
$c = $db->select("projects_matrix", "COUNT(*) AS c", "project_id = " . $_POST['project_id'] . " AND pair_comparison_matrix = '" . $_POST['pair_comparison_matrix'] ."'");
if ($c[0]->c)
{
	# update
	$db->update("projects_matrix",$set, "project_id = " . $_POST['project_id'] . " AND pair_comparison_matrix = '" . $_POST['pair_comparison_matrix'] ."'");
}
else
{
	$db->insert("projects_matrix",$set);
}

echo "<font color=green><strong>Pair comparison matrix saved successfully.</strong></font>";
?>