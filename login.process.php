<?php	 	
include('includes.php');

if ($_POST)
{
	extract($_POST);
	
	
	$exist = $db->select("users", "*", "`email` = '$email' AND `password` = '$password'");
	
	if ($exist)
	{
		$_SESSION['user'] = $exist[0];
		
		if (!$redirect_url)
			$redirect_url = "index.php";
		//echo $redirect_url . " aaaa";
		redirect($redirect_url);
	}
	else
	{
		redirect('failed.php');
	}
}


?>