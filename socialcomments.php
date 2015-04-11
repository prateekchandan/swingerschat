<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$copyright = ($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo"$title"; ?></title>
<META name='description' content='<?php echo"$description"; ?>'>
<META name='keywords' content='<?php echo"$keywords"; ?>'>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<link href="highslide/highslide.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
<script src="IE7.js"></script>
<![endif]-->
<!--Gallery Script -->
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

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
$photoid = ($_GET['photoid']);
$tablename = ($_GET['tablename']);
$newtable = ($_GET['newtable']);
$filename = ($_GET['filename']);
$foldername = ($_GET['foldername']);
$caption = ($_GET['caption']);
?>
	<table cellpadding="0" cellspacing="0px" border="0" width="100%">
	<tr>
	<td colspan="4" align="left">
		<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
		<tr>
		<td align="left" valign="top" width="220px">
		<?php 
		echo"<a href=\"members/$foldername/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='members/$foldername/$photo' width='400px' /></a>"; 
	  
		?>
		</td>
		
		<td align="left" valign="top" class="memberprofile">
		<?php echo"$caption"; ?>
		</td>
		</tr>
		</table>
		
		<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
		<?php
		$result = mysql_query("SELECT * FROM `$newtable`");
		while ($r = mysql_fetch_array($result)) {
			$memberid = ($r['memberid']);
			$comment = ($r['caption']);
			$membertable = "member_" . $memberid;
			
			$result = mysql_query("SELECT * FROM `$newtable`");
			$r = mysql_fetch_array($result);
			$photo = ($r['photo']);
			$username = ($r['username']);
			
			if ($photo != "noimage.jpg") {
				echo "<tr><td class='socialgallerycell'>$username<br /><img src='members/$membertable/$photo' width='100px' height='100px'></td><td class='socialgallerycell'>$comment</td></tr>";
			} else {
				echo "<tr><td class='socialgallerycell'>$username<br /><img src='members/noimage.jpg' width='100px' height='100px'></td><td class='socialgallerycell'>$comment</td></tr>";
			}
		}

		echo"</table>";
		?>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</div>
</td>

<td class="text6">
<div class="div2">
<?php echo"$text2"; ?>
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

