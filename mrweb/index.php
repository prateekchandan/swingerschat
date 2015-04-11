<?php
require ('../includes/dbconnect.php');
require ('includes/header.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<br />

<?php



if ( isset ($_POST['submit'])) {
	//Check if same IP has tried to login more than 5 times in last 5 minutes
	$allowed = 1;
	$ip=getenv("REMOTE_ADDR");
	$currenttime = time();
	$result = mysql_query("SELECT * FROM `masslogin` WHERE `ip`='$ip'");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		$r = mysql_fetch_array($result);
		$timestamp = ($r['timestamp']);
		$amount = ($r['amount']);
		$elapsedtime = ($currenttime - $timestamp);
		if ($amount > 4) {
			if ($elapsedtime < 300) {
				$allowed = 0;
			} else {
				$query = "DELETE FROM `masslogin` WHERE `ip`='$ip'";
				$results = mysql_query($query);
			}
		}
	}
	
	
	if ($allowed == 1) {
		$true = 0;
		$userpass = mysql_real_escape_string($_POST['password']);
		$username = mysql_real_escape_string($_POST['name']);
		$result = mysql_query("SELECT * FROM `members` WHERE `username`='$username' AND `admin` = '1'");
		$r = mysql_fetch_array($result);
		$realpass = ($r['password']);
		$result = mysql_query("SELECT * FROM `members` WHERE `password`='$userpass' AND `admin` = '1'");
		$r = mysql_fetch_array($result);
		$realuser = ($r['username']);
		$result = mysql_query("SELECT * FROM `members` WHERE `username`='$realuser' AND `password`='$realpass' AND `admin` = '1'");
		$true = mysql_num_rows($result);
		if ($true > 0) {
			session_start();
			$_SESSION['admin'] = "$name";
			header ('Location: adminhome.php');
			exit();
		} else {
			print '<p align="center" width="500px">The submitted username and password  do not match those on file! <br /> <a href="index.php">Go back</a> and try again.</p>';
			if ($rows > 0) {
				$amount += 1;
				mysql_query("UPDATE `masslogin` SET `amount`='$amount' WHERE `ip` = '$ip' ");	
			} else {
				$sql="INSERT INTO masslogin (ip, timestamp, amount) VALUES('$ip','$currenttime','1')";
				if (!mysql_query($sql)) {
					die('Error: ' . mysql_error());
				}	
			}
		}
	} else {
		print '<p align="center" width="500px">Admin section has been locked down. Contact the administrator.';
	}
} else {
	$message = ($_GET['message']);
	echo '<form action="index.php" method="post">
	<table align="center" width="300px">
	<tr><td colspan="2">Please Login<hr color="#CCCCCC" /></td></tr>';
	
	if ($message == 1) {
	echo"
	<tr>
	<td align=\"center\" colspan=\"2\" style=\"color:#FF0000;\">You have successfully logged out.</td>
	</tr>";
	}
	
	echo'
	<tr>
	<td align="left">Name:</td>
	<td align="left"><input type="text" name="name" size="20" /></td>
	</tr>
	<tr>
	<td align="left">Password:</td>
	<td align="left"><input type="password" name="password" size="20" /></td>
	</tr>
	<td></td>
	<td align="left"><input type="submit" name="submit" value="Log In!" />&nbsp;<input type="reset" name="reset" value="Reset" /></td>
	</tr>
	</table>
	</form>';
}
?>   

</td>
</tr>


<?php
require ('includes/footer.php');
?>




