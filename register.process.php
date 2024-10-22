<?php	 	 

   include('header.php'); 

   include('left.php');

if (isset($_POST['submit']))

{

	extract($_POST);

	

	# Check for email duplication;

	if (!$user_id)

	{
		$exist = $db->select("users", "id", "email = '$email'");

		if ($exist)

		{

			echo "Email already exist";

		}

		else

		{

			# Insert;
			 $name = $_POST['name'];
			 $email = $_POST['email'];
			 $phone = $_POST['phone'];
			 $password = $_POST['password'];
			 $country = $_POST['country'];

			$query = "INSERT into `users` SET
					`name` = '{$name}',	
					`email` = '{$email}', 
					`phone` = '{$phone}', 
					`password` = '{$password}', 
					`country` = '{$country}', 
					`gender` = '{$gender}', 
					`create_date` = NOW(), 
					`type` = 'demo', 
					`import_items` = '1' ";

			

			if ($db->query($query))
				{
					echo "USER SUCCESSFULLY REGISTERED";
				}
			else
			{
				echo $db->error();
			}

		}
	}
}



?>





<?php	 	 include('footer.php'); ?>