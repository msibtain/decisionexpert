<?php	 	
global $db;
$list = $db->select("definitions", "*", "project_id = " . $_SESSION['project_id']);

?>
<table width="100%" class="pad2" border="1">
<tr>
	<td width="10" class="gray_heading"></td>
	<td class="gray_heading">Element</td>
    <td class="gray_heading">Abbreviation</td>
    <td class="gray_heading">&nbsp;</td>
</tr>
<?php	 	
foreach ($list as $item)
{
	?>
    <tr>
    	<td class="gray_heading"></td>
    	<td><?php	 	 echo $item->word; ?></td>
        <td><?php	 	 echo $item->abbreviation; ?></td>
        <td><a href="javascript:{};" onclick="javascript: EditDefinition('<?=$item->id?>');">Edit</a> <a href="javascript:{};" onclick="javascript: DeleteDefinition('<?=$item->id?>');">Delete</a></td>
    </tr>
    <?php	 	
}
?>
</table>