<?php	 	
$for_pdf = @$_GET['for_pdf'];

if ($for_pdf)
	$tdWidth = round(650 / (count($alternatives)+3));
else
	$tdWidth = round(90 / (count($alternatives)+3)) . "%";

$tdStyle = 'border-bottom:1px solid #969696; border-right:1px solid #969696;';

$left_ratio = array();
$lr = 0;
?>

<table class="pad2" width="100%" style="border-top:1px solid #969696; border-left:1px solid #969696;" align="center">
        	<tr class="heading_chart">
        		<td style="<?=$tdStyle?> background:#dddddd;" width="<?=$tdWidth?>">&nbsp;</td>
                <td style="<?=$tdStyle?> background:#dddddd;" width="<?=$tdWidth?>">&nbsp;</td>
                <?php	 	 foreach ($alternatives as $altKey => $altValue) { ?>
                	<td style="<?=$tdStyle?> background:#dddddd; color:#000099;" align="center" width="<?=$tdWidth?>"><strong><?=$altValue;?></strong></td>
                <?php	 	 } ?>
                <td style="<?=$tdStyle?> background:#dddddd; color:#000099;" align="center" width="<?=$tdWidth?>"><strong>Consistency</strong></td>
        	</tr>
            <?php	 	
			$lr = 0;
			$iterate = 0;
			foreach ($criterias as $key => $value)
			{
				?>
                <tr>
                <?php	 	
				# get GLOBAL priority matrix,
				$global_priorities = getGlobalPriorities($_GET['id']);
				
				if (!count($sub_criterias[$key]))
				{
					$number_to_show = number_format($global_priorities[$key]*100, 3);
					
					$pair_comparison_matrix = 'criteria_'.$key;
					$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
					
					$left_ratio[$lr]['pair_comparison_matrix'] = 'criteria_'.$key;
					$left_ratio[$lr]['value'] = $value;
					$left_ratio[$lr]['number'] = $number_to_show;
					$lr++;
						
					?>
                    	<td style="<?=$tdStyle?> background:#dddddd; color:#c00000;" class="heading_chart"><strong><?=$value?></strong></td>
                        <td style="<?=$tdStyle?> background:#dddddd; color:#c00000;" align="center"><strong><?=$number_to_show?></strong></td>
                    <?php	 	
					
					foreach ($alternatives as $altKey => $altValue)
					{
						$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
						
						$number_to_show = $nPriorities[$altKey];
						$number_to_show = number_format($number_to_show*100,2);
						?>
						<td style="<?=$tdStyle?> background:#e7f6ef; color:#000;" align="center"><?=$number_to_show?></td>
						<?php	 	
					}
					?>
                    <td style="<?=$tdStyle?> background:#dddddd; color:#000;" align="center"><?=$consistency_to_show->consistency?>%</td>
                    <?php	 	
				}
				else
				{
					foreach ($sub_criterias[$key] as $k => $v)
					{
						$matrix_values = getMatrixValuesForCriteria($_GET['id'], $key);						
						$number_to_show = number_format(($matrix_values[$k]*$global_priorities[$key])*100, 3);
						
						$pair_comparison_matrix = 'sub_'.$key.'_'.$k;
						$consistency_to_show = get_Consistency_For_Pair_Comparison_Matrix($_GET['id'], $pair_comparison_matrix);
						
						$left_ratio[$lr]['pair_comparison_matrix'] = 'sub_'.$key.'_'.$k;
						$left_ratio[$lr]['value'] = $v;
						$left_ratio[$lr]['number'] = $number_to_show;
						$lr++;
						
						//$iterate++;
						?>
                        </tr>
                        <tr>
                        	<td style="<?=$tdStyle?> background:#dddddd; color:#c00000;" class="heading_chart"><strong><?=$v?></strong></td>
                            <td style="<?=$tdStyle?> background:#dddddd; color:#c00000;" align="center"><strong><?=$number_to_show?></strong></td>
                        <?php	 	
						
						foreach ($alternatives as $altKey => $altValue)
						{
							$nPriorities = getPriorityMatrixOf($_GET['id'], $pair_comparison_matrix);
							
							$number_to_show = $nPriorities[$altKey];
							$number_to_show = number_format($number_to_show*100,2);
							?>
							<td style="<?=$tdStyle?> background:#e7f6ef; color:#000;" align="center"><?=$number_to_show?></td>
							<?php	 	
						}
						?>
                        <td style="<?=$tdStyle?> background:#dddddd; color:#000;" align="center"><?=$consistency_to_show->consistency?>%</td>
                        <?php	 	
					}
				}
				
				
				?>
                </tr>
                <?php	 	
			}
			
			?>
            <tr class="heading_chart">
        		<td style="<?=$tdStyle?> background:#dddddd;" width="<?=$tdWidth?>">&nbsp;</td>
                <td style="<?=$tdStyle?> background:#dddddd; color:#000;" align="center" width="<?=$tdWidth?>"><strong>Overall</strong></td>
                <?php	 	 
				foreach ($alternatives as $altKey => $altValue) 
				{
					$alternative_result = 0;
					foreach ($left_ratio as $k => $v)
					{
						$first_number = $v['number']/100;
						$n = $db->select("projects_matrix", "priorities", "project_id = " . $_GET['id'] . " AND pair_comparison_matrix = '".$v['pair_comparison_matrix']."'");
						$n = $n[0];
						$nPriorities = unserialize($n->priorities);
						$second_number = $nPriorities[$altKey];
						
						//echo $string = $v['value'] . ": $first_number * $second_number<br />";
						$alternative_result += $first_number * $second_number;
					}
					$number_to_show = number_format($alternative_result*100,2);
					
					?>
                	<td style="<?=$tdStyle?> background:#dddddd;  color:#000099;" align="center" width="<?=$tdWidth?>"><strong><?=$number_to_show;?></strong></td>
                <?php	 	 } ?>
                <td style="<?=$tdStyle?> background:#dddddd; color:#000;" align="center" width="<?=$tdWidth?>">&nbsp;</td>
        	</tr>
        </table>
