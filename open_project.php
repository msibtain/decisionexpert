<?php	 	
include('includes.php');
global $db;

if ($_POST['a'] =='c')
{
	$project_id = $_SESSION['project_id'];
	if ($project_id)
	{	
		$pid = $db->select("projects", "COUNT(*) AS c", "id = " . $project_id);
		$pid = $pid[0];
		if ($pid->c)
			echo $project_id;
		else
			echo 'Please open the project first.';
	}
	else
	{
		echo 'Please open the project first.';
	}
}
else
	$_SESSION['project_id'] = $_POST['project_id'];
?>