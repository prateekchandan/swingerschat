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
	$adminonly = ($_POST['adminonly']);
	if ($adminonly != 1) {
		$adminonly = 0;
	}
	
	$result = mysql_query('SELECT * FROM F_Categories WHERE name = "'.$name.'"');
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		header("Location: addforumcategory.php?error=1");
		exit;
	}
	
	$sql="INSERT INTO `F_Categories` (name, adminonly) VALUES('$name','$adminonly')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
		
	$result = mysql_query("SELECT * FROM `F_Categories` ORDER BY `id` DESC LIMIT 0,1");
	$r = mysql_fetch_array($result);
	$categoryid = ($r['id']);
	
	
	$tablename = "F_" . $categoryid;
	
	$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, memberid int, category varchar(200), comment varchar(1000), lastpost varchar(200), PRIMARY KEY (id))";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: forum.php?message=1");
	exit;
	
} else {


echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery
echo"<form enctype='multipart/form-data' action=\"addforumcategory.php\" method='post'>";

if ($error == 1) {
	echo"
	<tr>
	<td class=\"editpageleft\" style='background-color:#FF0000;'>ERROR:</td>
	<td class=\"editpageright\">";
	echo"There is already a category with that name.";
	echo"</td><td class=\"editpagehints\">
	</td></tr>";
}


echo"
<tr>
<td class=\"editpageleft\">Forum Admin Only?</td>
<td class=\"editpageright\">
<input type=\"checkbox\" name=\"adminonly\" value=\"1\" />
</td><td class=\"editpagehints\">
Check this if it only Forum Administrators can post in this section.
</td></tr>";
		
		
echo"
<tr>
<td class=\"editpageleft\">Category Name:</td>
<td class=\"editpageright\">";
echo"<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>";
echo"</td><td class=\"editpagehints\">
This is the name of the category.
</td></tr>";


echo"
<tr>
<td></td>
<td align=\"left\" valign=\"top\">
<input type=\"submit\" name=\"submit\" value=\"Add Category\" />
<a href=\"forum.php\">Cancel</a>
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




