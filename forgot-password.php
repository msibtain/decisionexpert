<?php	 	 include('header.php');
?>

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
	<table>
	<tr>
		<td style="padding:0px 20px;">
		
		
		<div style="width:300px; margin:auto; padding:20px;">
			<h1>Forgot Password</h1>
		<br><br>
<?php
if ($_POST)
{
	if ($_POST['username'])
	{
		global $db;
		$exist = $db->select("users", "*", "`email` = '".$_POST['username']."'");
		
		//p_r( $exist );
		
		if (count($exist))
		{
			$body = 'Hello ' . $exist[0]->name;
			$body .= "<br><br>Your Login detail for Decision Expert website is given below.<br>";
			$body .= "Username: " . $exist[0]->email;
			$body .= "<br>Password: " . $exist[0]->password;
			
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: Website Administrator <no-reply@decisionexpert.co.uk>' . "\r\n";

			$s = mail($exist[0]->email, 'Your Password for Decision Expert website', $body, $headers);
			if ($s)
			{
				echo "<p><font color=green>Login details sent.</font></p>";
			}
			else 
			{
				echo "<p><font color=red>Error sending email.</font></p>";
			}
		}
		else
		{
			echo "<p><font color=red>Username not found.</font></p>";
		}
		
	}
}
?>	
		<form action="" method="post">
		
		<p>Enter your email address:</p>
		
		<p><input type="text" name="username"></p>
		
		
		
		<p><input type="submit" value="Reset Password"></p>
		
		</form>
		
	
		</div>
		
		
		
		</td>
	</tr>
	</table>
	</div>
</div>
<?php	 	 include('footer.php'); ?>