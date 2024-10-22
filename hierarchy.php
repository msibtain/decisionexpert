<?php
//include('tree.php');
include('design_form_chart.php');
list($w, $h) = getimagesize('hierarchy/project_tree_'.$project_id.'.png');
if ($w > 800)
{
$iframe = true;
}
?>
<?php	 	 if (!$for_pdf) { ?>
<h1>Project Name: <?php	 	 echo $projects->project_name; ?></h1>
<p align="center">
<?php	 	 if ($iframe) { ?>
<iframe src="show_tree.php?project_id=<?php echo $project_id; ?>" width="800" height="400" style="width:800px; height:400px;" frameborder="0"></iframe>
<?php	 	 } else {
//copy('project_tree.png','project_tree_'.$_SESSION['project_id'].'.png');
?>
<img src="hierarchy/project_tree_<?php echo $_SESSION['project_id']?>.png?t=<?php echo time(); ?>" />
<?php	 	 } ?>
</p>
<?php	 	 } ?>
<?php	 	 if ($for_pdf) { ?>
<p>&nbsp;</p>
<br clear="all" />
<table width="650" align="center">
<tr>
<td>
<div style="font-family:calibri; font-size:18pt; font-weight:bold; color:#c00000; text-align:center;">Hierarchy</div>
</td>
</tr>
<tr>
<td align="center">
<?php	 	 if ($iframe) { include('reverse_tree.php'); ?>
<p align="center">
<img src="hierarchy/reverse_project_tree_<?php echo $project_id; ?>.png" height="800" />
</p>
<?php	 	 } else { ?>
<p align="center">
<img src="hierarchy/project_tree_<?php echo $project_id; ?>.png" />
</p>
<?php	 	 } ?>
</td>
</tr>
</table>
<?php	 	 } ?>