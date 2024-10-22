<?php
include('includes.php');

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
	$db->update("projects", $set, "id = " . $id);
	$project_id = $id;
	
	$_SESSION['ahp']['objective'] = $_POST['objective'];
	$_SESSION['ahp']['criterias'] = $_POST['criteria'];
	$_SESSION['ahp']['sub_criterias'] = $_POST['sub_criteria'];
	$_SESSION['ahp']['alternatives'] = $_POST['alternative'];
	
	$set = "
	objective = '$objective',
	criterias = '".serialize($_POST['criteria'])."',
	sub_criterias = '".serialize($_POST['sub_criteria'])."',
	sub_sub_criterias = '".serialize($_POST['sub_sub_criteria'])."',
	alternatives = '".serialize($_POST['alternative'])."'
	";
	
	$db->update("projects_ahp", $set, "project_id = $project_id");
	
	redirect("project_structure.php?id=$project_id&time=".time());
}

?>