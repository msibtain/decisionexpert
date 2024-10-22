<?php	 	 



include('header.php'); 



if ($_POST)

{

	extract($_POST);

	

	# Check for email duplication;

	if (!$user_id)

	{

		$exist = $db->select("users", "id", "email = '$email'");

		if ($exist)

		{

			echo EMAIL_EXIST;

		}

		else

		{

			# Insert;

			$set = "

			`name` = '$name',

			`email` = '$email',

			`phone` = '$phone',

			`password` = '$password',

			`create_date` = NOW(),

			`type` = '$type',

                            `category_permission` = '$category_permission',
                            `import_items` = '0',

                        `cats_allowed` = '".serialize($cats_allowed)."'

			";

			

			if ($db->insert("users", $set))

				echo USER_SUCCESSFULLY_REGISTERED;

			else

				echo $db->error();

			

			if ($type == 'employee')

			{

				# Associate newly added user to this logged in manager;

				$new_user_id = $db->insert_id();

				$set = "

				`user_id` = '$new_user_id',

				`manager_id` = '".$_SESSION['user']->id."'

				";

				$db->insert("users_to_manager", $set);

				

				# Email login details to this newly added user;

				$message = "

				Dear $name<br />

				<br />

				

				You have been registered for Training Needs Assessment System (TNAS). Find below your login details.<br />

				<br />

				

".WEB_PATH."<br>

				<strong>Email:</strong> $email<br />

				<strong>Password:</strong> $password

				

				";

				$headers = "MIME-Version: 1.0" . "\r\n";

				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

				$headers .= 'From: Alpha TNAS <admin@alpha-tnas.com>' . "\r\n";

				//$headers .= 'Cc: myboss@example.com' . "\r\n";

				mail($email, "You have been registerd for TNAS", $message, $headers);

				

			}

			

			if ($type == 'demo')

			{

				#Notify to admin;

				$to = 'info@eiliasolutions.com';

				$message = "

				Hello,

				<br />

<br />

A new demo user has been registered on Alpha TNAS. Please find below his details.<br />

<br />

<strong>Name:</strong> $name<br />

<strong>Email:</strong> $email<br />

<strong>Phone:</strong> $phone<br />

<strong>Organisation:</strong> $organization<br />

<strong>Password:</strong> $password.



				";

				$headers = "MIME-Version: 1.0" . "\r\n";

				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

				$headers .= 'From: <admin@tnas.com>' . "\r\n";

				//$headers .= 'Cc: myboss@example.com' . "\r\n";

				mail($email, "New Demo User registered at TNAS website", $message, $headers);

				

			}

                }

	}

	

	# Update;

	if ($user_id)

	{

		if (!$password) $password = $password_hidden;

		

		$set = "

		`name` = '$name',

		`email` = '$email',

		`phone` = '$phone',

		`password` = '$password',

                    `category_permission` = '$category_permission',

                        `cats_allowed` = '".serialize($cats_allowed)."'

		";

		

		if ($db->update("users", $set, "id = '$user_id'"))

			echo USER_SUCCESSFULLY_REGISTERED;

		else

			echo $db->error();

		

		if ($type == 'employee' && $password != $password_hidden)

		{

				

				

				# Email login details to this newly added user;

				$message = "

				Dear $name<br />

				<br />

				

				You information have been updated in TNAS. Find below your login details.<br />

				<br />

				

				<strong>Email:</strong> $email<br />

				<strong>Password:</strong> $password

				

				";

				$headers = "MIME-Version: 1.0" . "\r\n";

				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

				$headers .= 'From: <admin@tnas.com>' . "\r\n";

				//$headers .= 'Cc: myboss@example.com' . "\r\n";

				mail($email, "You have been registerd for TNAS", $message, $headers);

				

			}

	}

	

	

	

	

	

	// associate is adding an employee, we need to check for allowed categories;

                        if ($type == "employee" && $_SESSION['user']->type == "member")

                        {

                            

                            if ($category_permission == "Yes")

                            {

                                # save assigned categories and redirect to select questions page;

                                if ($user_id)

                                    redirect("choose-questions.php?user_id=".$user_id);

                                if ($new_user_id)

                                    redirect("choose-questions.php?user_id=".$new_user_id);

                            }

                        }

                        

	

	

}



if ($type == 'demo')

{

	echo "<br /><br />" . LOGIN_NOW;

}



?>





<?php	 	 include('footer.php'); ?>