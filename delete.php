<?php	 	
include('includes.php');

$id = @$_SESSION['project_id'];
global $db;
$db->delete("projects_ahp", "project_id=".$id);
$db->delete("projects", "id=".$id);

redirect("open.php");
?>