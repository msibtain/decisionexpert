<?php	 	
$for_pdf = @$_GET['for_pdf'];

if ($for_pdf)
{
	$tblWidth = 700;
	$blockWidth = 350;
}
else
{
	$tblWidth = '100%';
	$blockWidth = "50%";
}
?>
<table width="100%">
	<tr>
		<td style="padding:0px 20px;">
        
        <table width="<?=$tblWidth?>" cellpadding="2" cellspacing="2" border="0">
        <?php	 	 if (!$for_pdf) { ?>
        	<tr>
            	<td colspan="2"><h1>Dynamic Simulation</h1></td>
           	</tr>
            <?php	 	 } ?>
            
            <tr>
            	<td valign="top" width="<?=$blockWidth?>">
                <table>
                <tr>
                	<td colspan="4"><strong>Criteria and Intensities</strong></td>
                </tr>
                <?php	 	
				$left_ratio = array();
				$lr = 0;
				foreach ($criterias as $key => $value)
				{
					# get GLOBAL priority matrix,
					$global_priorities = getGlobalPriorities($_GET['id']);
						
					if (!count($sub_criterias[$key]))
					{
						$number_to_show = number_format($global_priorities[$key]*100, 3);
						
						$left_ratio[$lr]['pair_comparison_matrix'] = 'criteria_'.$key;
						$left_ratio[$lr]['value'] = $value;
						$left_ratio[$lr]['number'] = $number_to_show;
						$lr++;
						
						$this_id = strtolower(str_replace(" ", "",$value));
						$redColor = rand(0,255);
						$greenColor = rand(0,255);
						$blueColor = rand(0,255);
						
						if (!$for_pdf)
						{
						?>
                        <script language="javascript">
						criteria_result['<?=$this_id?>'] = <?php	 	 echo $number_to_show; ?>;
						</script>
						<?php	 	
						}
						?>
                        
                        <tr>
							<td><?=$value?></td>
                            <td><span id="span_<?=$this_id?>"><?=$number_to_show?></span></td>
                            <?php	 	 if (!$for_pdf) { ?>
                            <td width="30">
                            <a href="javascript:{};" onclick="javascript: DecreaseCriteria('<?=$this_id?>');"><img title="Decrease Value of <?=$value?>" alt="Decrease Value of <?=$value?>" src="includes/icons/arrow_left.png" style="border:0px;" /></a> <a href="javascript:{};" onclick="javascript: IncreaseCriteria('<?=$this_id?>');"><img title="Increase Value of <?=$value?>" alt="Increase Value of <?=$value?>" src="includes/icons/arrow_right.png" style="border:0px;" /></a>
                            </td>
                            <?php	 	 } ?>
                            <td class="criteria_bar" style="width:300px;"><div style="width:<?=$number_to_show?>%; background-color:rgb(<?=$redColor?>,<?=$greenColor?>,<?=$blueColor?>)" id="bar_<?=$this_id?>">&nbsp;</div></td>
						</tr>
						<?php	 	
					}
					else
					{
						$matrix_values = getMatrixValuesForCriteria($_GET['id'], $key);
							
						foreach ($sub_criterias[$key] as $k => $v)
						{
							
							$number_to_show = number_format(($matrix_values[$k]*$global_priorities[$key])*100, 3);
						
							$left_ratio[$lr]['pair_comparison_matrix'] = 'sub_'.$key.'_'.$k;
							$left_ratio[$lr]['value'] = $v;
							$left_ratio[$lr]['number'] = $number_to_show;
							$lr++;
							
							$this_id = strtolower(str_replace(" ", "",$v));
							
							$redColor = rand(0,255);
							$greenColor = rand(0,255);
							$blueColor = rand(0,255);
							
							if (!$for_pdf)
							{
							?>
                            <script language="javascript">
							criteria_result['<?=$this_id?>'] = <?php	 	 echo $number_to_show; ?>;
							</script>
                            <?php	 	
							}
							?>
                            <tr>
                            	<td><?php	 	 echo $v; ?></td>
                                <td><span id="span_<?=$this_id?>"><?php	 	 echo $number_to_show; ?></span></td>
                                <?php	 	 if (!$for_pdf) { ?>
                                <td>
                                <a href="javascript:{};" onclick="javascript: DecreaseCriteria('<?=$this_id?>');"><img title="Decrease Value of <?=$value?>" alt="Decrease Value of <?=$value?>" src="includes/icons/arrow_left.png" style="border:0px;" /></a> <a href="javascript:{};" onclick="javascript: IncreaseCriteria('<?=$this_id?>');"><img title="Increase Value of <?=$value?>" alt="Increase Value of <?=$value?>" src="includes/icons/arrow_right.png" style="border:0px;" /></a>
                                </td>
                                <?php	 	 } ?>
                                <td class="criteria_bar" style="width:300px;"><div style="width:<?php	 	 echo $number_to_show; ?>%; background-color:rgb(<?=$redColor?>,<?=$greenColor?>,<?=$blueColor?>)" id="bar_<?=$this_id?>">&nbsp;</div></td>
                            </tr>
                            
                            <?php	 	
						}
					}
				}
				?>
                
                <tr>
                  <td align="left"><input type="button" name="btn" onclick="javascript: resetCriteria();" value="reset" class="button" /></td>
                  <td></td>
                  <td></td>
                  <td align="left"></td>
                  </tr>
                            
                            
                </table>
              </td>
            	<td valign="top" width="<?=$blockWidth?>">
                <table width="100%">
                	<tr>
                    	<td colspan="3"><strong>Overall Rank of Choices</strong>
                        
                      </td>
                  </tr>
                    <?php	 	
					
						
					foreach ($alternatives as $altKey => $altValue)
					{
						$alternative_result = 0;
						$this_id = strtolower(str_replace(" ","",$altValue));
						
						foreach ($left_ratio as $k => $v)
						{
							$first_number = $v['number']/100;
							$n = $db->select("projects_matrix", "priorities", "project_id = " . $_GET['id'] . " AND pair_comparison_matrix = '".$v['pair_comparison_matrix']."'");
							$n = $n[0];
							$nPriorities = unserialize($n->priorities);
							$second_number = $nPriorities[$altKey];
							
							//echo $string = $v['value'] . ": $first_number * $second_number<br />";
							$alternative_result += $first_number * $second_number;
							
							$_this_id = strtolower(str_replace(" ","", $v['value']));
							if (!$for_pdf)
							{
							?>
                            <script language="javascript">
							cri_sub_result['<?=$this_id?>_<?=$_this_id?>'] = <?=$second_number?>;
							</script>
                            <?php	 	
							}
						}
						
						$number_to_show = number_format($alternative_result*100,2);
						//echo "<hr />";
						if (!$for_pdf)
						{
						?>
                        <script language="javascript">
						alternative_result['<?=$this_id?>'] = <?php	 	 echo $number_to_show; ?>;
						</script>
          				<?php	 	
						}
						?>
                        <tr>
                            <td><?php	 	 echo $altValue;
							$redColor = rand(0,255);
							$greenColor = rand(0,255);
							$blueColor = rand(0,255);
							 ?></td>
                            <td><span id="alt_span_<?=$this_id?>"><?php	 	 echo $number_to_show; ?></span></td>
                            <td class="criteria_bar" style="width:300px;"><div id="alt_bar_<?=$this_id?>" style="width:<?php	 	 echo $number_to_show; ?>%; background:rgb(<?=$redColor?>,<?=$greenColor?>,<?=$blueColor?>)">&nbsp;</div></td>
                        </tr>
                        <?php	 	
					}
					?>
                    <tr>
                    	<td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            	<td>&nbsp;</td>
            </tr>
            
        </table>
        </td>
	</tr>
	</table>