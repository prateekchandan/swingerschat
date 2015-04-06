<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="1px" border="0px" width="75%" style="border:1px solid #cccccc;">
    <tr>
    <td align="left" valign="top" style="background-color:#CCCCCC;">
    PAGE NAME
    </td>
    <td align="left" valign="top" style="background-color:#CCCCCC;">
    REFERRING URL
    </td>
    <td align="left" valign="top" style="background-color:#CCCCCC;">
    HITS TODAY
    </td>
    <td align="left" valign="top" style="background-color:#CCCCCC;">
    TOTAL HITS
    </td>
    </tr>
<?php
$day = date('l');

$result = mysql_query('SELECT * FROM pages');
while ($r=mysql_fetch_array($result)) {
	$pageid = ($r['id']);
	$pagename = ($r['name']);
	$tablename = "HitCounter_" . $pageid;
	$tablename2 = "HitCounterRef_" . $pageid;
	$result2 = mysql_query("SELECT * FROM $tablename");
	$r2 = mysql_fetch_array($result2);
	$id = ($r2['id']);
	$today = ($r2['today']);
	$hits_today = ($r2['hits_today']);
	$totalhits = ($r2['totalhits']);
	
	if ($today == $day) {
	} else {
		$hits_today = 0;
		$query2 = mysql_query("UPDATE `$tablename` SET `hits_today`='$hits_today' WHERE `id` = '$id' ");
	}
	
	echo"<tr>";
	echo"<td align='left' valign='top' style='background-color:#EFEFEF;'>$pagename</td>";
	echo"<td align='left' valign='top' style='background-color:#EFEFEF;'></td>";
	echo"<td align='left' valign='top' style='background-color:#EFEFEF;'>$hits_today</td>";
	echo"<td align='left' valign='top' style='background-color:#EFEFEF;'>$totalhits</td>";
	echo"</tr>";
	
	$result3 = mysql_query("SELECT * FROM $tablename2");
	$rows3 = mysql_num_rows($result3);
	while ($r3 = mysql_fetch_array($result3)) {
		$referrerid = ($r3['id']);
		$referrer = ($r3['referrer']);
		$totalhits = ($r3['totalhits']);
		if ($referrer == "") {$referrer = "<span style='color:#cccccc;'>No Referring URL</span>"; }
		echo"<tr>";
		echo"<td align='right' valign='top' style='border-bottom:1px solid #EFEFEF;border-right:1px solid #EFEFEF;'><a href=\"deletereferrer.php?tablename=$tablename2&referrerid=$referrerid\"><img src=\"images/trashcan.jpg\"></a></td>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #EFEFEF;'>$referrer</td>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #EFEFEF;'></td>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #EFEFEF;'>$totalhits</td>";
		echo"</tr>";
	}
	if ($rows3 > 0) {
		echo"<tr>";
		echo"<td align='left' valign='top' style='border-right:1px solid #EFEFEF;'></td>";
		echo"<td align='left' valign='top' colspan='3'><a href=\"deleteallreferrers.php?tablename=$tablename2\">Delete All Referring URLs</a></td>";
		echo"</tr>";
	}
}
?>
	</table>
<br />
<br />



</td>
</tr>


<?php
require ('includes/footer.php');
?>




