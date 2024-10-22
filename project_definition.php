<?php	 	
global $db;
$project = $db->select("projects", "*", "id = " . @$_SESSION['project_id']);
$project = $project[0];


?>
<form action="open.post.php" method="post">
<table width="100%" cellpadding="4" cellspacing="2" border="0">
        	<tr>
        	  <td><h2>User Information:</h2></td>
      	  </tr>
        	<tr>
        	  <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        	    <tr>
        	      <td width="20%">Project Name:</td>
        	      <td width="30%"><input type="text" name="project_name" value="<?php	 	 echo $project->project_name; ?>" /></td>
        	      <td width="20%">Version:</td>
        	      <td width="30%"><input type="text" name="version" value="<?php	 	 echo $project->version; ?>" /></td>
      	      </tr>
        	    <tr>
        	      <td>Organization:</td>
        	      <td><input type="text" name="organization" value="<?php	 	 echo $project->organization; ?>" /></td>
        	      <td>Department:</td>
        	      <td><input type="text" name="department" value="<?php	 	 echo $project->department; ?>" /></td>
      	      </tr>
        	    <tr>
        	      <td>User Name:</td>
        	      <td><input type="text" name="user_name" value="<?php	 	 echo $project->user_name; ?>" /></td>
        	      <td>Date:</td>
        	      <td><input type="text" name="date" value="<?php	 	 echo $project->date_created; ?>" /></td>
      	      </tr>
      	    </table></td>
      	  </tr>
        	<tr>
        	  <td><h2>Project Definition</h2></td>
      	  </tr>
        	<tr>
        	  <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
        	    <tr>
        	      <td width="20%">Objective:</td>
        	      <td width="30%"><input type="text" name="objective" value="<?php	 	 echo $project->objective; ?>" /></td>
        	      <td width="20%">Levels:</td>
        	      <td width="30%">
        	      	<input type="text" name="levels" value="<?php echo $project->levels; ?>" readonly="readonly" />
        	      	<script>
        	      		levels = <?php	 	 echo $project->levels; ?>;
        	      	</script>
        	      </td>
      	      </tr>
        	    <tr>
        	      <td colspan="4">
                  <?php	 	 include('ahp_open.php'); ?>
                  </td>
        	      </tr>
      	      </table></td>
      	  </tr>
        	<tr>
        	  <td>
              <input type="hidden" name="id" value="<?php	 	 echo @$_SESSION['project_id']?>" />
              <input type="submit" name="submit" class="button" value="Submit" /></td>
      	  </tr>
        	<tr>
        	  <td>&nbsp;</td>
      	  </tr>
        	<tr>
            	<td>&nbsp;</td>
            </tr>
        </table>
        </form>