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
	$pagetype = $_POST['pagetype'];
	$name = ($_POST['name']);
	$title = ($_POST['title']);
	$description = ($_POST['description']);
	$keywords = ($_POST['keywords']);
	$copyright = ($_POST['copyright']);
	$pageorder = ($_POST['pageorder']);
	$membersonly = ($_POST['membersonly']);
	if ($membersonly != 1) {
		$membersonly = 0;
	}
	if ($pagetype == "Dropdown Menu") {
		$footernav = 0;
	} else {
		$footernav = 1;
	}
	$sql="INSERT INTO pages (deletable, type, pageorder, name, title, description, keywords, nav1, nav3, copyright, membersonly) VALUES('1','$pagetype','$pageorder','$name','$title','$description','$keywords','1','$footernav','$copyright','$membersonly')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}
	
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder DESC");
	$r = mysql_fetch_array($result);
	$pageid = ($r['id']);
	
	if ($pagetype == "Album Page") {
		$tablename = "Album_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, pageid int, pageorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	
	
	if ($pagetype == "Dropdown Menu") {
		$tablename = "Dropdown_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, pageid int, type varchar(200), pageorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	
	if ($pagetype == "Photo Gallery") {
		$tablename = "Gallery_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, filename varchar(200),caption varchar(1000), picorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		mkdir("../$tablename");
		mkdir("../$tablename/thumbs");
	}
	if ($pagetype == "Contact Form") {
		$tablename = "Contact_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, name varchar(200), type varchar(200), plaintext varchar(1000), fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		$sql="INSERT INTO $tablename (name, type, fieldorder) VALUES('Name','text','1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		$sql="INSERT INTO $tablename (name, type, fieldorder) VALUES('E-mail','text','2')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		$sql="INSERT INTO $tablename (name, type, fieldorder) VALUES('Phone','text','3')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		$sql="INSERT INTO $tablename (name, type, fieldorder) VALUES('Comments','textarea','4')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	if (($pagetype == "Service Page") || ($pagetype == "FAQ Page")) {
		$tablename = "ServiceCategories_" . $pageid;
		$tablename2 = "Services_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, name text, fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
		$sql = "CREATE TABLE $tablename2 (id int AUTO_INCREMENT, category text, name text, price varchar(1000), fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	if ($pagetype == "Profile Page") {
		$tablename = "Profile_" . $pageid;
		$sql = "CREATE TABLE $tablename (id int AUTO_INCREMENT, name varchar(200), bio varchar(1000), pic varchar(200), fieldorder int, PRIMARY KEY (id))";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	}
	
	require('includes/smarturls.php');
	
	header("Location: adminhome.php?message=2");
	exit;

} else {

$pagetype = ($_GET['pagetype']);
$result = mysql_query("SELECT * FROM pages");
$pageorder = mysql_num_rows($result);
$pageorder += 1;
$r = mysql_fetch_array($result);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$copyright = ($r['copyright']);

echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"addpage.php\" method=\"post\">";
	
	if ($pagetype == "Dropdown Menu") {
		echo"
		<tr>
		<td class=\"editpageleft\">Page Name:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the name users will see in the page navigation butons.
		</td>
		</tr>
		
		<tr>
		<td></td>
		<td align='left' valign='top'>This will not be an actual page. This will display in the main navigation area of the site and drop down a menu of other pages when hovered over.</td>
		<td>
		</td>
		</tr>";
	} else {
		
		echo"
		<tr>
		<td class=\"editpageleft\">Members Only:</td>
		<td class=\"editpageright\">
		<input type=\"checkbox\" name=\"membersonly\" value=\"1\" />
		</td>
		<td class=\"editpagehints\">
		If you check this box, only members who are logged in will be able to access this page.
		</td>
		</tr>";
		
		echo"
		<tr>
		<td class=\"editpageleft\">Page Name:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the name users will see in the page navigation butons.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Page Title:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the title of the page. This text will appear in the browser tab.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Page Description:</td>
		<td class=\"editpageright\">
		<textarea id=\"description\" name=\"description\" cols=\"62\" rows=\"10\">$description</textarea>
		</td>
		<td class=\"editpagehints\">
		This is the description of the page. User's will not see this on your site, but sometimes this text will be used by search engines to describe your site.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">SEO URL:</td>
		<td class=\"editpageright\">
		<textarea id=\"keywords\" name=\"keywords\" cols=\"62\" rows=\"5\">$keywords</textarea>
		</td>
		<td class=\"editpagehints\">
		This will be the SEO safe URL for this page.
		</td>
		</tr>";
		
		if ($pagetype == "External Link") {
			echo"
			<tr>
			<td class=\"editpageleft\">URL:</td>
			<td class=\"editpageright\">
			<input type=\"text\" name=\"copyright\" value=\"$copyright\" size=\"75\" maxlength=\"70\"/>
			</td>
			<td class=\"editpagehints\">
			This is the URL that the user will be directed to.
			</td>
			</tr>";
		} else {
			/*
			 echo"
			<tr>
			<td class=\"editpageleft\">Copyright Text:</td>
			<td class=\"editpageright\">
			<textarea id=\"copyright\" name=\"copyright\">$copyright</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'copyright' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This is the text that will show up at the very bottom of the page.
			</td>
			</tr>";
			*/
		}
	}
	echo"
	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"hidden\" name=\"pagetype\" value=\"$pagetype\" />
	<input type=\"hidden\" name=\"pageorder\" value=\"$pageorder\" />
	<input type=\"submit\" name=\"submit\" value=\"Add Page\" />
	<input type=\"reset\" name=\"reset\" value=\"Reset\" />
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




