<?php include('header.php'); 


if ($_POST)
{
    $error = false;
	

	
	if (is_bot($_POST['gcaptcha-token']))
	{
		$_SESSION['post'] = $_POST;
		
		$error = true;
	}
        
        if (!$error)
        {
            extract($_POST);
	
            $to = "sib@alphatraining.co.uk";
            $subject = "Contact Us form filled at Decision Expert";
	
            $body = "
            Name: $name <br>
            Organisation: $organisation <br>
            Job Title: $job_title <br>
            Country: $country <br>
            Telephone: $telephone <br>
            Message: $message
            ";
	
            $s = sendEmail($to, $subject, $body);
        }

}

?>

<!--left-->
<?php include('left.php'); ?>  
                 
<!--center-->
<div id="container" class="equal">
	<?php if (!$_SESSION['user']) { $bPad = '20px';  ?>
	<div class="row-banner clear">
    	<div class="moduletable">
			<p><img src="includes/shop-ad-books.jpg" border="0"></p>		
        </div>
	</div>
    <?php } else { $bPad = '110px';  include('user_menu.php'); } ?>
    
	<div class="clear">
	<table width="100%">
	<tr>
		<td style="padding:0px <?=$bPad?>!important;">
        <table width="100%">
        <tr>
        	<td valign="top"> <h1 class="red">Contact Us</h1>
 			
            <?php
			if (!$error)
				echo "Email successfully sent.";
                        else
                            echo "Unauthorized access.";
			?>
            
            <p>&nbsp;</p></td>
            <td valign="top">&nbsp;</td>
        </tr>
        </table>
       </td>
	</tr>
	</table>
	</div>
</div>
<?php include('footer.php'); ?>