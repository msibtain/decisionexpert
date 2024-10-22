<p>&nbsp;</p>
<br clear="all" />
<table width="650" align="center">
<tr>
<td>
<div style="font-family:calibri; font-size:18pt; font-weight:bold; color:#c00000; text-align:center;">Project Definition</div>
</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt; text-align:center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt; text-align:center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt; text-align:center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt; text-align:center"><h1>MULTI CRITERIA DECISION ANALYSIS</h1></td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center"><h2><?php	 	 echo $projects->organization; ?></h2></td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center"><strong>Project: <?php	 	 echo $projects->project_name; ?></strong></td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="left"><h2>Project Definition</h2></td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="left">
  <table border="0" cellspacing="5">
  <tr>
  	<td width="120" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">Objective</td>
    <td width="120" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;"><?php	 	 echo $projects->objective; ?></td>
  </tr>
  </table>
  </td>
</tr>
<?php	 	  
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . @$_SESSION['project_id']);
$projects_ahp = $projects_ahp[0];
$arr_no_criteria = unserialize($projects_ahp->criterias);
$no_criteria = sizeof($arr_no_criteria);
$arr_no_alternatives = unserialize($projects_ahp->alternatives);
$no_alternatives = sizeof($arr_no_alternatives);
$arr_subcriteria = unserialize($projects_ahp->sub_criterias);
?>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="left">
  <table border="0" cellspacing="5">
  <tr>
  	<td width="120" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">Levels</td>
    <td width="40" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;"><?php	 	 echo $projects->levels; ?></td>
    <td width="120" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">No of Criteria</td>
    <td width="40" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;"><?php	 	 echo $no_criteria; ?></td>
    <td width="120" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">No of Alternatives</td>
    <td width="40" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;"><?php	 	 echo $no_alternatives; ?></td>
  </tr>
  </table>
  </td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">
  	<table border="0" cellspacing="5">
  <tr>
  	<td width="140" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;"><p>Criteria</p></td>
    <td width="140" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">Sub Criteria</td>
    <td width="20" align="center" style="font-family:Arial; font-size:10pt;"></td>
    <td width="140" align="center" style="font-family:Arial; font-size:10pt; background:#CCCCCC;">Alternative</td>
  </tr>
  </table>
  </td>
</tr>
<tr>
<td style="font-family:Arial; font-size:10pt;" align="left">
<table border="0">
  <tr>
      <td width="135" align="center" valign="top">
	  	<table>
        	<?php	 	 foreach($arr_no_criteria as $key=>$criteria){ ?>
            	<?php	 	 
				
					if(!empty($arr_subcriteria[$key])){
						$counter = 1;
			 		 ?>
				<?php	 	 foreach($arr_subcriteria[$key] as $subcri){
					if($counter <= sizeof($arr_subcriteria[$key])){
					if($counter == 1){ ?>
            		<tr><td width="135" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;" valign="top">
                <?php	 	 echo $criteria; ?>
                </td></tr>
                	<?php	 	 }else{ ?>
               		<tr><td width="135" align="center" valign="top">&nbsp;</td></tr>
                	<?php	 	 }$counter++; } ?>
            <?php	 	 } ?>
			<?php	 	 }else{ ?>
			
                <tr><td width="137" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;" valign="top">
                <?php	 	 echo $criteria; ?>
                </td></tr>
            <?php	 	 } }?>
        </table>
      </td>
      <td width="135" align="center"  valign="top">
	  	<table>
        	<?php	 	 
				$limit = sizeof($arr_no_criteria);
				for($i=0; $i<$limit;$i++){
					if(empty($arr_subcriteria[$i])){
			 ?>
            	<tr><td width="137" align="center"  style=" background:#ccd;font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;" valign="top">
                	No Sub Criteria
                </td></tr>
            <?php	 	 }else{?>
				<?php	 	 foreach($arr_subcriteria[$i] as $subcri){ ?>
            	<tr><td width="137" align="center" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;" valign="top">
                <?php	 	 echo $subcri; ?>
                </td></tr>
            <?php	 	 } ?>
			<?php	 	 } ?>
			<?php	 	 } ?>
        </table>
      </td>
      <td width="15" align="center" style="font-family:Arial; font-size:10pt;"></td>
      <td width="137" align="center" valign="top">
	  	<table>
        	<?php	 	 foreach($arr_no_alternatives as $alternative){ ?>
            	<tr><td width="137" align="left" style="font-family:Arial; font-size:10pt; border:1px solid #d0e7fe;" valign="top">
                <?php	 	 echo $alternative; ?>
                </td></tr>
            <?php	 	 } ?>
        </table>
      </td>
   </tr>
</table>
</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center"><?php	 	 echo date('F, d M Y'); ?></td>
</tr>
<tr>
  <td style="font-family:Arial; font-size:10pt;" align="center">&nbsp;</td>
</tr>
</table>

