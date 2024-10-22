<div class="clear wrapper-box module-login">
			                <div class="box-title png">
                   <h3><?php	 	 if ($_SESSION['user']) { echo 'My Account'; } else { echo 'Login Form'; } ?></h3>
                </div>
                        <div class="box-indent">
                <div class="clear">
<?php	 	 
if ($_SESSION['user'])
{
	?>
    <label>
    Welcome <?php	 	 echo $_SESSION['user']->name?>!
    </label>
    <br />
	<p>
    <input type="button" value="Log out" class="button png" name="Submit" onclick="javascript:window.location='logout.php'">
    </p>
    <?php	 	
}
else
{
	?>
	<form action="login.process.php" method="post" name="login" class="form-login">
		<label for="mod_login_username">
		Email	</label>
	<input name="email" id="email" class="inputbox" alt="Username" type="text">
	<label for="mod_login_password">
		Password	</label>
	<input id="password" name="password" class="inputbox" alt="Password" type="password"><br>
	
	<div class="clear indent-button"><input name="Submit" class="button png" value="Log in" type="submit"></div>
	<div class="logform-indent">
    	<p>
            <a href="forgot-password.php">
                Forgot your password?</a>
        </p>
        
    </div>
    
		<p class="form-indent1">
		No Account Yet?		<a href="register.php">
			Create an account</a>
	</p>
		</form>
	<?php	 	
}
?>
                </div>
            </div>	 
		</div>