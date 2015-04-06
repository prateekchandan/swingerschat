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
if (isset ($_POST['submit'])) {
	$name = ($_POST['name']);
	$place = ($_POST['place']);
	$month = ($_POST['month']);
	$day = ($_POST['day']);
	$year = ($_POST['year']);
	$hour = ($_POST['hour']);
	$minute = ($_POST['minute']);
	$meridiem = ($_POST['meridiem']);
	$id = ($_POST['id']);
	
	$time = $month . "/" . $day . "/" . "$year" . " $hour" . ":" . $minute . " $meridiem";
	$time = strtotime($time);
	
	$returnvalues = "&name=$name&place=$place&month=$month&day=$day&year=$year&id=$id&hour=$hour&minute=$minute&meridiem=$meridiem";
	
	if ( (empty($_POST['name'])) ) {
		header("Location: editevent.php?error=1 $returnvalues");
		exit;
	}

	mysql_query("UPDATE `events` SET `name`='$name', `place`='$place', `time`='$time' WHERE `id` = '$id' ");

	header("Location: editevent.php?error=2 $returnvalues");
	exit;

} else {

$id = ($_GET['id']);

if (isset($_GET['error'])) {
	$error = ($_GET['error']);
	$name = ($_GET['name']);
	$place = ($_GET['place']);
	$month = ($_GET['month']);
	$day = ($_GET['day']);
	$year = ($_GET['year']);
	$hour = ($_GET['hour']);
	$minute = ($_GET['minute']);
	$meridiem = ($_GET['meridiem']);
} else {
	$result = mysql_query("SELECT * FROM `events` WHERE `id` = '$id'");
	$r = mysql_fetch_array($result);
	$name = ($r['name']);
	$place = ($r['place']);
	$time = ($r['time']);
	$month = date('n',"$time");
	$day = date('j',"$time");
	$year = date('Y',"$time");
	$hour = date('g',"$time");
	$minute = date('i',"$time");
	$meridiem = date('a',"$time");
}

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";

if ($error == 1) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
<td class=\"editpageright\">You must fill in all *required fields.
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}

if ($error == 2) {
echo"
<tr>
<td class=\"editpageleft\" style='background-color:#0aaa0a;'>Success:</td>
<td class=\"editpageright\">You successfully updated this event.
</td>
<td class=\"editpagehints\">
</td>
</tr>";
}
	
echo"<form enctype='multipart/form-data' action=\"editevent.php\" method='post'>";

echo"
<tr>
<td class=\"editpageleft\">*Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"50\" />";
echo"</td><td class=\"editpagehints\">
This is the name of the product.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*Place:</td>
<td class=\"editpageright\">
<select name='place'>";
$result = mysql_query('SELECT * FROM `events_places`');
while ($r = mysql_fetch_array($result)) {
	$name = ($r['name']);
	$placeid = ($r['id']);
	if ($placeid == $place) {
		echo"<option value='$placeid' selected='selected'>$name</option>";
	} else {
		echo"<option value='$placeid'>$name</option>";
	}
}

echo"</select>";
echo"</td><td class=\"editpagehints\">
This is the place the event will be hosted at.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*Date <br /> MM/DD/YYYY:</td>
<td class=\"editpageright\">";
echo"
<select name='month'>";
$count = 1;
while ($count < 13) {
	if ($month == $count) {
		echo"<option value='$count' selected='selected'>$count</option>";
	} else {
		echo"<option value='$count'>$count</option>";
	}
	$count += 1;
}
echo"</select>";

echo"
<select name='day'>";
$count = 1;
while ($count < 32) {
	if ($day == $count) {
		echo"<option value='$count' selected='selected'>$count</option>";
	} else {
		echo"<option value='$count'>$count</option>";
	}
	$count += 1;
}
echo"</select>";

echo"
<select name='year'>";
$count = date('Y');
$lastyear = ($count + 5);
while ($count < $lastyear) {
	if ($year == $count) {
		echo"<option value='$count' selected='selected'>$count</option>";
	} else {
		echo"<option value='$count'>$count</option>";
	}
	$count += 1;
}
echo"</select>";

echo"</td><td class=\"editpagehints\">
This is the day the event will take place.
</td></tr>";

echo"
<tr>
<td class=\"editpageleft\">*Time:</td>
<td class=\"editpageright\">";
echo"
<select name='hour'>";
$count = 1;
while ($count < 13) {
	if ($hour == $count) {
		echo"<option value='$count' selected='selected'>$count</option>";
	} else {
		echo"<option value='$count'>$count</option>";
	}
	$count += 1;
}
echo"</select>";

echo"
<select name='minute'>";
$count = 00;
while ($count < 60) {
	$count = str_pad($count, 2, "0", STR_PAD_LEFT); 
	if ($minute == $count) {
		echo"<option value='$count' selected='selected'>$count</option>";
	} else {
		echo"<option value='$count'>$count</option>";
	}
	$count += 1;
}
echo"</select>";

echo"
<select name='meridiem'>";
echo"<option value='am' "; if ($meridiem == "am") { echo"selected='selected'"; } echo">am</option>";
echo"<option value='pm' "; if ($meridiem == "pm") { echo"selected='selected'"; } echo">pm</option>";
echo"</select>";

echo"</td><td class=\"editpagehints\">
This is the time the event will take place.
</td></tr>";

echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type='hidden' name='id' value='$id' />
<input type=\"submit\" name=\"submit\" value=\"SAVE CHANGES\" />
<a href=\"events.php\">Go Back to Events</a>
<br /><br />
</form>
</td>
</tr>
</table>";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




