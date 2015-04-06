<?php

require ('includes/dbconnect.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}
$memberid = ($_SESSION['memberloggedin']);


$username = ($_POST['username']);
$first = mysql_real_escape_string($_POST['first']);
$last = mysql_real_escape_string($_POST['last']);
$email = ($_POST['email']);
$phone = mysql_real_escape_string($_POST['phone']);
$password = ($_POST['password']);
$password2 = ($_POST['password2']);
$billingcountry = $_POST['billingcountry'];
$billingaddress = $_POST['billingaddress'];
$billingaddress2 = $_POST['billingaddress2'];
$billingcity = $_POST['billingcity'];
$billingstate = $_POST['billingstate'];
$billingzip = $_POST['billingzip'];
$shippingcountry = $_POST['shippingcountry'];
$shippingaddress = $_POST['shippingaddress'];
$shippingaddress2 = $_POST['shippingaddress2'];
$shippingcity = $_POST['shippingcity'];
$shippingstate = $_POST['shippingstate'];
$shippingzip = $_POST['shippingzip'];
$originalemail = $_POST['originalemail'];
$originalusername = $_POST['originalusername'];
$company = mysql_real_escape_string($_POST['company']);
$description = mysql_real_escape_string($_POST['description']);
$age = ($_POST['age']);
$type = ($_POST['type']);
$sex = ($_POST['sex']);
$bio = mysql_real_escape_string($_POST['bio']);

if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
header("Location: members.php?location=2&error=5");
exit;
}

$result = mysql_query('SELECT * FROM members WHERE email = "'.$email.'"');
$rows = mysql_num_rows($result);
if ($rows > 0) {
if ($email != $originalemail) {
header("Location: members.php?location=2&error=3");
exit;
}
}

$result = mysql_query('SELECT * FROM members WHERE username = "'.$username.'"');
$rows = mysql_num_rows($result);
if ($rows > 0) {
if ($username != $originalusername) {
header("Location: members.php?location=2&error=4");
exit;
}
}


if (($_POST['password']) != ($_POST['password2'])) {
header("Location: members.php?location=2&error=2");
exit;
}

mysql_query("UPDATE `members` SET `age`='$age', `type`='$type', `first`= '$first', `last`= '$last',`phone`= '$phone', `email`='$email', `country`='$billingcountry', `address`='$billingaddress', `address2`='$billingaddress2', `city`= '$billingcity', `state`= '$billingstate', `zip`= '$billingzip', `shippingcountry`= '$shippingcountry', `shippingaddress`= '$shippingaddress', `shippingaddress2`= '$shippingaddress2', `shippingcity`= '$shippingcity', `shippingstate`= '$shippingstate', `shippingzip`= '$shippingzip', `password`='$password', `username`='$username', `sex`='$sex', `bio`='$bio' WHERE `id` = '$memberid' ");



if (empty($_POST['email'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['sex'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['username'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['billingcountry'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['billingcity'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['billingstate'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['password'])) {
header("Location: members.php?location=2&error=1");
exit;
}

if (empty($_POST['password2'])) {
header("Location: members.php?location=2&error=1");
exit;
}



mysql_query("UPDATE `members` SET `setup`='1' WHERE `id` = '$memberid' ");


header("Location: members.php");
exit;

ob_end_flush();
?>

