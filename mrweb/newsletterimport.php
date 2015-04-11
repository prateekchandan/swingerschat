<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<?php
$dbc = mysql_connect("mrwebpage.db.2345800.hostedresource.com","mrwebpage","cC1777771"); 
if (!$dbc) { 
	die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db("mrwebpage", $dbc);

$result = mysql_query("SELECT * FROM `members`");
while ($r = mysql_fetch_array($result)) {
	$first = ($r['first']);
	$last = ($r['last']);
	$email = ($r['email']);
	
	$dbc2 = mysql_connect("mrwebpagecms.db.2345800.hostedresource.com","mrwebpagecms","cC1777771"); 
	if (!$dbc2) { 
		die('Could not connect: ' . mysql_error()); 
	} 
	mysql_select_db("mrwebpagecms", $dbc2);
	
	$sql="INSERT INTO newsletter (first, last, email, status) VALUES('$first','$last','$email','1')";
	if (!mysql_query($sql,$dbc2)) {
		die('Error: ' . mysql_error());
	}
	
}




?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




