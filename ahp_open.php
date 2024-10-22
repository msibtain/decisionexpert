<?php	 	
global $db;
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . @$_SESSION['project_id']);
$projects_ahp = $projects_ahp[0];

$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$sub_sub_criterias  = unserialize($projects_ahp->sub_sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);

$sub_criteria_js = $sub_sub_criteria_js = 0;

?>
<script>
	criteria = <?php echo (count($criterias) - 1); ?>;
</script>
<table width="100%" cellpadding="2" cellspacing="2" border="0">
<tr style="background:#003399; color:#FFF;">
  <td style="color:#FFF;"><strong>Criteria:</strong></td>
  <td align="right"><span><font size="1"><a href="javascript:{}" onclick="addLevel2();" style="color:#FFF;">Add Criteria</a></font></span></td>
</tr>
<tr style="background:#f4f4f4;">
  <td colspan="2" id="criterias"> <br />
    <?php	 	 
    foreach ($criterias as $c => $v1) 
    {
    	if ($c%2) $divClass = 'odd'; else $divClass = 'even'; 
    	?>
    	<div class="c_block <?=$divClass?>" id="row_<?=$c?>">
      	<input type="text" name="criteria[<?=$c?>]" value="<?=$v1?>" /> <span style="font-size:9px;">&nbsp;<a href="javascript:{};" onclick="deleteLevel2('<?=$c?>')"><img src="includes/icons/d.png" align="absmiddle" border="0" /></a> <a href="javascript:{}" onclick="addLevel3(<?=$c?>);"><img src="includes/icons/a.png" border="0" align="absmiddle" /></a></span>
      	<?php	 	 
      	if (count($sub_criterias[$c])) 
      	{
      		?>
      		<script>
      		sub_cat_count_in_criteria[<?=$c?>] = <?php echo count($sub_criterias[$c])?>;
      		</script>
      		<?php
      		foreach ($sub_criterias[$c] as $s => $v2) 
      		{
      			?>
      			<div class="sub_criteria" id="sub_row_<?=$sub_criteria_js?>">
      				<input type="text" name="sub_criteria[<?=$c?>][]" value="<?=$v2?>">&nbsp;
      				<!-- <span style="font-size: 9px;"><a onclick="deleteLevel3(<?=$sub_criteria_js?>)" href="javascript:{};"><img src="includes/icons/d.png" border="0" align="absmiddle" /></a> <a href="javascript:{}" onclick="addLevel4(<?=$sub_criteria_js?>, <?=$c?>, <?=$s?>);"><img src="includes/icons/a.png" border="0" align="absmiddle" /></a></span> -->
      				<span style="font-size: 9px;"><a onclick="deleteLevel3(<?=$sub_criteria_js?>)" href="javascript:{};"><img src="includes/icons/d.png" border="0" align="absmiddle" /></a></span>
      			<?php
      			if (count($sub_sub_criterias[$c][$s]))
				{
					foreach ($sub_sub_criterias[$c][$s] as $ss => $v3)
					{
						?>
						<div class="sub_sub_criteria" id="sub_sub_row_<?=$sub_sub_criteria_js?>">
							<input type="text" name="sub_sub_criteria[<?=$c?>][<?=$s?>][]" value="<?=$v3?>">&nbsp;
							<span style="font-size: 9px;">
							<a onclick="deleteLevel4(<?=$sub_sub_criteria_js?>)" href="javascript:{};">
								<img src="includes/icons/d.png" border="0" align="absmiddle" />
							</a>
							</span></div>
						<?php
						$sub_sub_criteria_js++;
					}
				}
				
				?>
				</div>
				<?php
				$sub_criteria_js++;
			} 
		}
		else 
		{
			?>
      		<script>
      		sub_cat_count_in_criteria[<?=$c?>] = 0;
      		</script>
      		<?php
		}
		?>
      </div>
    <?php	 	 } ?>
  </td>
</tr>
<tr style="background:#003300;">
  <td style="color:#FFF;"><strong>Alternative:</strong></td>
  <td align="right"><span><font size="1"><a href="javascript:{}" onclick="addAlternative();" style="color:#FFF;">Add Alternative</a></font></span></td>
</tr>
<tr style="background:#f4f4f4;">
  <td colspan="2" id="alternatives"> <br />
    <?php	 	 foreach ($alternatives as $key => $value) { if ($key%2) $divClass = 'odd'; else $divClass = 'even'; ?>
    <div class="a_block <?=$divClass?>" id="alt_<?php	 	 echo $key; ?>">
      <input type="text" name="alternative[]" value="<?=$value?>" /> <span style="font-size:9px;">&nbsp;<a href="javascript:{};" onclick="deleteAlternative('<?php	 	 echo $key; ?>')"><img src="includes/icons/d.png" border="0" align="absmiddle" /></a></span>
      </div>
      <?php	 	 } ?>
  </td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
</table>
<script language="javascript">

	
	criteria = <?php	 	 echo count($criterias); ?>;
	sub_criteria = <?php echo $sub_criteria_js; ?>;
	sub_sub_criteria = <?php echo $sub_sub_criteria_js; ?>;
	alternative = <?php	 	 echo count($alternatives)-1; ?>;
	
	


</script>
