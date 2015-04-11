<ul>
<?php
$file = $_SERVER['PHP_SELF'];
$file = explode('/', $file);
$file = $file[count($file) - 1];

if ((isset($_SESSION['memberloggedin'])) && ($file != "logout.php")) {
	$memberid = ($_SESSION['memberloggedin']);
	echo"<li><a href='profile.php?userid=$memberid'>MY PROFILE</a></li>";
	echo"<li><a href='members.php'>MY ACCOUNT</a></li>";
	echo"<li><a href='memberssearch.php'>FIND OTHER MEMBERS</a></li>";
} else {
	echo"<li><a href='signup.php'>CREATE ACCOUNT</a></li>";
	echo"<li><a href='login.php'>LOGIN</a></li>";
}
?>
<li class="cs_bg"><a href="index.php?id=75">CUSTOMER SERVICE</a></li>
</ul>