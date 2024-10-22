<?php
include('header.php');
$project_id = $_SESSION['project_id'];
global $db;
$projects = $db->select("projects", "*", "id = " . $_GET['id']);
$projects = $projects[0];
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
$projects_ahp = $projects_ahp[0];
$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$sub_sub_criterias  = unserialize($projects_ahp->sub_sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);
$_SESSION['ahp'] = array(
'objective' => $projects_ahp->objective,
'criterias' => $criterias,
'sub_criterias' => $sub_criterias,
'sub_sub_criterias' => $sub_sub_criterias,
'alternatives' => $alternatives,
'levels' => $projects->levels
);
$ahp = $_SESSION['ahp'];
?>
<!--left-->
<?php	 	 include('left.php'); ?>
<!--center-->
<div id="container" class="equal">
<?php	 	 if (!$_SESSION['user']) { ?>
<div class="row-banner clear">
<div class="moduletable">
<p><img src="includes/shop-ad-books.jpg" border="0"></p>
</div>
</div>
<?php	 	 } else { include('user_menu.php'); } ?>
<div class="clear">
<table width="100%">
<tr>
<td style="padding:0px 5px;">
<?php	 	// include('hierarchy.php'); ?>
<div align="center">
	<?php include('design_form_chart.php'); ?>
<img src="hierarchy/project_tree_<?php echo $_SESSION['project_id'] ?>.png" style="max-width: 100%;">
</div>
</td>
</tr>
</table>
</div>
</div>
<?php	 	 include('footer.php'); ?>