<?php	 	 include('header.php'); ?>

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
		<td style="padding:0px 20px;">
        <?php	 	 if (@$_GET['action']=='edit') { include('project_definition.php'); } else { ?>
        <table width="100%" cellpadding="2" cellspacing="2" border="0" style="width:100%;">
        <tr class="heading">
          <td >&nbsp;</td>
        	<td width="30%"><strong>Project Name</strong></td>
            <td width="10%"><strong>Version</strong></td>
            <td width="30%"><strong>Objective</strong></td>
            <td width="30%"><strong>Date</strong></td>
        </tr>
        <?php	 	
		global $db;
		$projects = $db->select("projects","*", "user_id = " . $_SESSION['user']->id, "id DESC");
		$i = 0;
		foreach ($projects as $project)
		{
			if (++$i%2==0) $trClass = 'odd'; else $trClass = 'even';
			?>
            <tr class="<?=$trClass?>">
              <td align="center"><input type="radio" name="project_id" <?php	 	 if ($_SESSION['project_id'] == $project->id) { echo 'checked="checked"'; } ?> value="<?php	 	 echo $project->id; ?>" onclick="javascript: OpenProject('<?php	 	 echo $project->id; ?>');" /></td>
            	<td><?php	 	 echo $project->project_name?></td>
                <td><?php	 	 echo $project->version?></td>
                <td><?php	 	 echo $project->objective?></td>
                <td><?php	 	 echo $project->date_created; ?></td>
            </tr>
            <?php	 	
		}
		?>
        
        <tr>
        	<td colspan="4">&nbsp;</td>
        </tr>
        </table>
        <?php	 	 } ?>
        </td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>