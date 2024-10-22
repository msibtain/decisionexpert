<?php
include('includes.php');

$php_self = $_SERVER['PHP_SELF'];
$show_this_menu = true;
if (!isset($_SESSION['user']))
{
	$show_this_menu = false;
	# If there are password protected pages, mention those here;
	if (stristr($php_self, "assessment.php") || stristr($php_self, "import-list.php") || stristr($php_self, "proficiency-level.php"))
	{
		header("Location: login.php?redirect_url=$php_self");
		exit;
	}
}


?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" dir="ltr" lang="en-gb"><head>
<meta http-equiv="content-type" content="text/html; charset=<?=CHAR_SET?>">
<title>Alpha Decision Making Software</title>
<!--<script type="text/javascript" src="includes/caption.js"></script>-->

<link rel="stylesheet" href="includes/template.css" type="text/css">
<link rel="stylesheet" href="includes/constant.css" type="text/css">
<script language="javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
<script language="javascript" src="js/project_definition.js"></script>

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
    
</head>
<body id="body">
	<!--header-->
    <div class="tail-top-menu clear">
    	<div class="main">
        	<div class="row-top-menu clear">
            	<div class="wrapper-left clear">
                	<div class="wrapper-right">
                    	<div class="wrapper-left-top">
                        	<div class="wrapper-right-top clear">
                            	        <div class="module">				   
                                        <ul class="menu-nav">
                                        	<li class="item28"><a href="index.php"><span>Home</span></a></li>
                                            <li class="item28"><a href="about-adm.php"><span>Products</span></a></li>
                                            <li class="item29"><a href="training.php"><span>Training</span></a></li>
                                            <li class="item18"><a href="membership.php"><span>Membership</span></a></li>
                                            <!-- <li class="item30"><a href="resources.php"><span>Resources</span></a></li> -->
                                            <li class="item30"><a href="contact-us.php"><span>Contact Us</span></a></li>
                                        </ul>					
		</div>
                                       
	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tail-header clear">
    	<div class="main">
            <div class="wrapper-left clear">
                <div class="wrapper-right clear">
                    <div class="wrapper-left-top">
                        <div class="wrapper-right-top clear">
                           <div class="header">
                           	
                           		<div class="clear">
                           		  <div class="fleft"><h1><a href="index.php"></a></h1></div>
                             </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--content-->
    <div class="tail-content clear">
    	<div class="main">
        	<div class="wrapper-left clear">
                <div class="wrapper-right clear">
                	<div id="content" <?php	 	 if ($_SESSION['user']) {?> style="background:#FFF;" <?php	 	 } ?>>
                   	  <div class="clear">