<?php
include('includes.php');

/*
p_r( $_POST['criteria'] );
echo "<hr>";
p_r( $_POST['sub_criteria'] );
echo "<hr>";
p_r( $_POST['sub_sub_criteria'] );
*/

/*
foreach ($_POST['criteria'] as $c => $v1)
{
	echo $v1;
	echo "<br>";
	
	if (isset($_POST['sub_criteria'][$c]))
	{
		foreach ($_POST['sub_criteria'][$c] as $s => $v2)
		{
			echo "&nbsp  -> $v2";
			echo "<br>";
			
			if (isset($_POST['sub_sub_criteria'][$c][$s]))
			{
				foreach ($_POST['sub_sub_criteria'][$c][$s] as $v3)
				{
					echo "&nbsp; &nbsp  -> $v3";
					echo "<br>";
				}
			}
			
			
		}
	}
	
	echo "<hr>";
	
}
*/




if ($_POST)
{
	extract($_POST);
	
	global $db;
	
	$set = "
	user_id = " . $_SESSION['user']->id . ",
	project_name = '$project_name',
	version = '$version',
	organization = '$organization',
	department = '$department',
	user_name = '$user_name',
	date_created = '$date',
	objective = '$objective',
	levels = '$levels'
	";
	$db->insert("projects", $set);
	$project_id = $db->insert_id();
	
	$_SESSION['ahp']['objective'] = $_POST['objective'];
	$_SESSION['ahp']['criterias'] = $_POST['criteria'];
	$_SESSION['ahp']['sub_criterias'] = $_POST['sub_criteria'];
	$_SESSION['ahp']['alternatives'] = $_POST['alternative'];
	
	$set = "
	project_id = $project_id,
	objective = '$objective',
	criterias = '".serialize($_POST['criteria'])."',
	sub_criterias = '".serialize($_POST['sub_criteria'])."',
	sub_sub_criterias = '".serialize($_POST['sub_sub_criteria'])."',
	alternatives = '".serialize($_POST['alternative'])."'
	";
	
	$db->insert("projects_ahp", $set);
	
	# Check Credit Points
	$total_used = '10';
	$set = "
		`credit_used` = '$total_used'
		";
		
	$db->update("users", $set, "id = ". $_SESSION['user']->id);
	
	redirect("project_structure.php?id=$project_id&time=".time());
}

?>