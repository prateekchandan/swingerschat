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
	
	//This applies the function to our file
	$filename = ($_FILES['pic']['name']) ; 
	
	$target = "../files/$filename";

	$sql="INSERT INTO files (name) VALUES('$filename')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	move_uploaded_file($_FILES['pic']['tmp_name'], $target);
	
	header("Location: files.php");
	exit;
	
} else {

$message = ($_GET['message']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
//Edit Photo Gallery

echo"
<tr>
<td class=\"editpageleft\">Add New File:</td>
<td class=\"editpageright\">";
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
	echo"<tr><td align='center' colspan='6'>";
	echo"<form enctype='multipart/form-data' action=\"fileuploader.php\" method='post'>
		<input name='pic' type='file' />
		<input type='submit' name='submit' value='Upload New File' />
		</form>";
	echo"</td></tr>";
	echo"<tr><td align='center' colspan='6'>";
	if ($message == 1) { echo"You can only upload image files!"; }
	echo"</td></tr>";
	echo"</table>";
echo"</td><td class=\"editpagehints\">
Upload a new file to the server.
</td></tr></table";
}

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




