<div style="">
  <div class="clear wrapper-box " style="border-bottom:1px solid #969696; padding:5px; margin-bottom:5px; background:#eaeaea;">
  	
    <div style="float:left; width:170px; background-color:#404149; margin-right:5px; background-position:15px 14px;" class="box-title png"><h3 style=" padding-left:37px; padding-top:11px; color:#FFF !important;">My Account</h3></div>
    
    <div style="float:left; widows:200px; line-height:44px; font-weight:bold;">Welcome <?php	 	 echo $_SESSION['user']->name; ?></div>
    
    <div style="float:right; width:100px;">
    	<a href="logout.php" style="" class="logout_anchor">Logout</a>
    </div>
    
  <br clear="all" />
  </div>
  
  <div class="clear wrapper-box " style="border-bottom:1px solid #969696; padding-bottom:5px;">
  	<div style="float:left; width:170px; background-color:#d7d7d8; margin:0px 5px; background-position:15px 14px;" class="box-title png"><h3 style=" padding-left:37px; padding-top:11px; color:#000 !important;">Main Menu</h3></div>
    
    <div style="float:left;">
    
    <table width="100%" cellpadding="2" cellspacing="2" border="0">
    	<tr>
        	<td><a href="new.php"><img alt="New Project" title="New Project" src="includes/icons/new.jpg" align="absmiddle" /></a></td>
            <td><a href="open.php"><img alt="Open Project" title="Open Project" src="includes/icons/open.jpg" align="absmiddle" /></a></td>
            <td><a href="javascript:{};" onclick="javascript: _doOpen('delete.php', '', 'Are you sure to delete?'); "><img alt="Delete Project" title="Delete Project" src="includes/icons/delete.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('open.php', 'action=edit'); "><img alt="Edit Project" title="Edit Project" src="includes/icons/edit.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('definitions.php'); "><img alt="Definitions" title="Definitions" src="includes/icons/definitions.png" align="absmiddle" /></a></td>
          
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          
          <td><a href="javascript:{};" onclick="javascript: _doOpen('project_structure.php'); "><img alt="Design Form" title="Design Form" src="includes/icons/design.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('pair_comparison.php', 'pair_comparison_matrix=objective'); "><img alt="Pair Comparison" title="Pair Comparison" src="includes/icons/comparison.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('d_mode.php'); ">
          <?php	 	
		  if ($_SESSION['project_mode'])
			  $mode = $_SESSION['project_mode'];
		  elseif ($_SESSION['project_id'])
		  {
			  global $db;
			  $project_id = @$_SESSION['project_id'];
			  $mode = $db->select("projects_matrix", "mode", "project_id = " . $project_id);
			  $mode = $mode[0];
			  $mode = $mode->mode;
		  }
		  else
		  	$mode = 'd';
if ($mode=='') $mode = 'd';
//echo $mode;

?>

          <img id="d_mode_image" alt="Switch for Distribution OR Ideal Mode" title="Switch for Distribution OR Ideal Mode" src="includes/icons/<?=$mode?>_mode.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('charts.php'); "><img alt="Charts" title="Charts" src="includes/icons/chart.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('s_analysis.php'); "><img alt="Sensitivity Analysis" title="Sensitivity Analysis" src="includes/icons/sac.png" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('contribution_chart.php'); "><img alt="Contribution Chart" title="Contribution Chart" src="includes/icons/ratio.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('decision_matrix.php'); "><img alt="Decision Matrix" title="Decision Matrix" src="includes/icons/dm.jpg" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('excel.php'); "><img alt="Export to Excel" title="Export to Excel" src="includes/icons/excel.gif" align="absmiddle" /></a></td>
          <td><a href="javascript:{};" onclick="javascript: _doOpen('print.php'); "><img alt="Print" title="Print" src="includes/icons/print.png" align="absmiddle" /></a></td>
          
        </tr>
    </table>
    </div>
    <br clear="all" />
    
  </div>
</div>