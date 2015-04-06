<?
$dbhost = "mwcmssite.db.2345800.hostedresource.com"; // MySQL Hostname
$dbname = "mwcmssite"; // Mysql Database Name
$dbuser = "mwcmssite"; // MySQL User Name
$dbpass = "cC1777771"; // MySQL Password
$ppemail = "ccowan@mrwebpage.net"; // Your Paypal E-Mail 
$yourname = "Administrator"; // Your Name


$auth_token = "r6hQVdZ_GDZnfHALzbEXU_3AXnrjmatfQcqA_uhsFj7zAn20L2YgiYoWm7C";


mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
$uploadpath = $localpath."/downloads/"; 
?>