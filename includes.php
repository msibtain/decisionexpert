<?php
@session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
//error_reporting(1);
ini_set("display_errors",1 );


require_once("config/config.php");
include("pagination.php");
//include('image.class.php');

require_once("db/db.php");
global $db;
$db = new db();
require_once("functions.php");


# Fusion Chart includes;
//include("FusionCharts_PHP/App/Includes/Connection_inc.php");
//include("FusionCharts_PHP/App/Includes/FusionCharts.php");
//include("FusionCharts_PHP/App/Includes/PageLayout.php");
//include("FusionCharts_PHP/App/DataGen.php");


#require_once('recaptchalib.php');
#$publickey = "6LdvArwSAAAAACMRi_0O7zDUov_rPY_nGSoauGp6";
#$privatekey = "6LdvArwSAAAAAKi3c4jGdEsTim8ML116lCrroMc7";

/*
global $isAdmin;	
global $usercheck;
if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == ADMIN_LEVEL)
{
	$isAdmin = true;
	$usercheck = "1";
}
else
{
	$usercheck = "tbl_orders.`user_id` = " . $_SESSION['user']['id'];
}
*/

//date_default_timezone_set  ('America/New_York');


?>