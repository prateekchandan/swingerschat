<?php
require ('includes/dbconnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Comment</title>
<META name='description' content=''>
<META name='keywords' content=''>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="wyzz.js"></script>
<script language="JavaScript" type="text/javascript" src="javascripts/hidediv.js"></script>
<!--[if lt IE 7]>
<script src="IE7.js"></script>
<![endif]-->
<SCRIPT type="text/javascript">
function ShowMe(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   tar.className = "show";
  } else {
   tar.className = "hide";
  }
 }
}
</SCRIPT>
<!--Gallery Script -->
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<style>
.hide{display:none;}
.show{}
</style>
</head>

<body style="margin:50px 0px 0px 0px;">

<table align="center" cellpadding="0" cellspacing="0" width="1000px">
<tr>
<td class="headertable" colspan="2">
<?php
require ('includes/nav.php');
?>
</td>
</tr>


<tr>
<td class="text5">
<div class="div1">
<?php
if (isset ($_POST['submit'])) {
	$tablename = ($_POST['tablename']);
	$newtable = ($_POST['newtable']);
	$filename = ($_POST['filename']);
	$foldername = ($_POST['foldername']);
	$caption = ($_POST['caption']);
	$memberid = ($_POST['memberid']);
	$text1= ($_POST['text1']);
	$yourid =($_SESSION['memberloggedin']);
	
	$sql="INSERT INTO `$newtable` (memberid, caption) VALUES('$yourid','$text1')";
	if (!mysql_query($sql,$dbc)) {
		die('Error: ' . mysql_error());
	}

	header("Location: socialpiccomments.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid");
	exit;
	
} else {
	$tablename = ($_GET['tablename']);
	$newtable = ($_GET['newtable']);
	$filename = ($_GET['filename']);
	$foldername = ($_GET['foldername']);
	$caption = ($_GET['caption']);
	$memberid = ($_GET['memberid']);
	
	echo"<a href=\"socialpiccomments.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid\" style='font-size:10px;'><img src='images/memberprofile.jpg' /></a>";
	
	echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:3px solid #FFFFFF;\">";
	//Edit Photo Gallery
	if (!isset($_SESSION['memberloggedin'])) {
		echo"<a href='login.php'>You must login to add a comment!</a>";
	} else {
		echo"<form enctype='multipart/form-data' action='socialaddpiccomment.php' method='post'>";
		echo"
		
		<tr>
		<td>";
			echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
			echo"<tr><td align='left' colspan='6'>
				<textarea id=\"text01\" name=\"text1\"></textarea>
				<script language=\"javascript1.2\">
				make_wyzz('text01');
				</script>";
			echo"</td></tr>";
			echo"</table>";
		echo"
		</td>
		</tr>";
		
		echo"
		<tr>
		<td align=\"left\" valign=\"top\">
		<input type='hidden' name='tablename' value=\"$tablename\" />
		<input type='hidden' name='newtable' value=\"$newtable\" />
		<input type='hidden' name='filename' value=\"$filename\" />
		<input type='hidden' name='foldername' value=\"$foldername\" />
		<input type='hidden' name='caption' value=\"$caption\" />
		<input type='hidden' name='memberid' value=\"$memberid\" />
		<input type='hidden' name='photoid' value=\"$photoid\" />
		<input type=\"submit\" name=\"submit\" value=\"Add Comment\" />
		
		</form>
		</td>
		</tr>
		</table>";
	}
}

?>
</div>
</td>

<td class="text6">
<div class="div2">
	
</div>
</td>
</tr>

<tr>
<td class="footer" colspan="2">

<br />
<?php
require ('includes/footernav.php');
?>

<br />

<?php echo"$copyright"; ?>

</td>
</tr>
</table>

</body>
</html>

<?php
ob_end_flush();
?>

