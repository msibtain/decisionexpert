<?php	 	
include('includes.php');

if ($_POST)
{
	global $db;
	
	extract($_POST);

	
	if  (@$action == 'select')
	{
		# Select the record for edit;
		$row = $db->select("definitions", "*", "id=".$id);
		$row = $row[0];
		echo $row->word."%%%".$row->abbreviation;
	}
	
	elseif  (@$action == 'delete')
	{
		# delete the record;
		$db->delete("definitions", "id=".$id);
		ob_start();
		include('definitions_list.php');
		$r = ob_get_clean();		
		echo $r;
	}
	else
	{
		# add or edit the record;
		$set = "`project_id` = '".$_SESSION['project_id']."', `word` = '$word', `abbreviation` = '$abbreviation'";
		if ($id)
		{
			# update;
			$db->update("definitions", $set, "id=".$id);
		}
		else
		{
			# insert;
			
			#check if this abbreviation is already taken;
			$row = $db->select("definitions", "abbreviation", "`abbreviation` = '$abbreviation'");
			$row = $row[0];
			if ($row->abbreviation)
			{
				echo "This abbreviation is already taken. Please choose another.";
				exit;
			}
			$db->insert("definitions", $set);
		}
		
		ob_start();
		include('definitions_list.php');
		$r = ob_get_clean();
		echo $r;
	}
	
}
?>