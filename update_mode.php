<?php	 	
@session_start();
//ob_start();
include('includes.php');

$_SESSION['project_mode'] = $_POST['mode'];


global $db;
$projects = $db->select("projects", "*", "id = " . $_POST['id']);
$projects = $projects[0];
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_POST['id']);
$projects_ahp = $projects_ahp[0];



$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);


# recalculate the matrix value;
include('recalculate_projects_matrix.php');

//ob_get_clean();

echo $msg = 'Mode has been successfully switched.';
//echo $_SESSION['project
	
?>