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
<td class="text7">
<div class="div3">
<?php
	$photoid = ($_GET['photoid']);
	$tablename = ($_GET['tablename']);
	$newtable = ($_GET['newtable']);
	$filename = ($_GET['filename']);
	$foldername = ($_GET['foldername']);
	$caption = ($_GET['caption']);
	$memberid = ($_GET['memberid']);
	$myid =($_SESSION['memberloggedin']);
    ?>
        <table cellpadding="0" cellspacing="0px" border="0" width="100%">
        <tr>
        <td colspan="4" align="left">
            <table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
            <?php
			echo"<tr><td align='left' colspan='2'>";
			echo"<a href=\"socialprofile.php?memberid=$memberid\" style='font-size:10px;'><img src='images/memberprofile.jpg' /></a>";
			echo"</td></tr>";
			echo"<tr>";
			?>
            <tr>
            <td align="left" valign="top" width="220px">
            <?php 
            echo"<a href=\"members/$foldername/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='members/$foldername/$filename' width='400px' /></a>"; 
          
            ?>
            </td>
            
            <td align="left" valign="top" class="memberprofile">
			<?php echo"<strong>CAPTION:</strong> <br /><br /> $caption"; ?>
            </td>
            </tr>
            </table>
            
            
        </td>
        </tr>
        </table>
</div>
</td>
</tr>

<tr>
<td class="commentsbar" colspan="2">
	<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
	<?php
    echo"<tr><td align='left' colspan='2' >";
    echo"<div style='float:right; margin-right:30px;'><a href=\"socialaddpiccomment.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid\" style='font-size:10px;'>ADD COMMENT</a></div>";
    echo"</td></tr>";
    ?>
    </table>
</td>
</tr>

<tr>
<td class="text7" colspan="2">
	<table cellpadding="0px" cellspacing="0px" border="0" width='971px' align="center">
    <tr>
    <td style="background-image:url(images/messagetop.jpg); background-repeat:no-repeat; height:19px;">
    </td>
    </tr>
    
    <tr>
    <td style="background-image:url(images/messagemiddle.jpg); background-repeat:repeat-y; height:100px;">
		<table cellpadding="5px" cellspacing="0px" border="0" width='100%' align="center">
	<?php
    echo"<tr>";
    $result = mysql_query("SELECT * FROM `$newtable`");
    while ($r = mysql_fetch_array($result)) {
		$commentid = ($r['id']);
        $userid = ($r['memberid']);
        $comment = ($r['caption']);
        $memberfolder = "member_" . $userid;
        
        $result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$userid'");
        $r2 = mysql_fetch_array($result2);
        $rows2 = mysql_num_rows($result2);
        $photo = ($r2['photo']);
        $username = ($r2['username']);
        
        if ($rows2 > 0) {
        
            if ($photo != "noimage.jpg") {
                echo "<tr><td class='socialcommentcell'>$username<br /><a href=\"socialprofile.php?memberid=$userid\"><img src='members/$memberfolder/$photo' width='100px' height='100px' style='border:3px solid #FFFFFF;'></a></td><td class='socialcommentcell2'><br /> $comment";
				if (($myid == $memberid) || ($myid == $userid)) {
					echo"<br /><div style='float:right; '><a href=\"socialremovepiccomment.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid&commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this comment?');\"><img src='images/delete.jpg' /></a></div>";
				}
				echo"</td></tr>";
            } else {
                echo "<tr><td class='socialcommentcell'>$username<br /><a href=\"socialprofile.php?memberid=$userid\"><img src='members/noimage.jpg' width='100px' height='100px' style='border:3px solid #FFFFFF;'></a></td><td class='socialcommentcell2'><br /> $comment";
				if (($myid == $memberid) || ($myid == $userid)) {
					echo"<br /><div style='float:right; '><a href=\"socialremovepiccomment.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid&commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this comment?');\"><img src='images/delete.jpg' /></a></div>";
				}
				echo"</td></tr>";
            }
        } else {
            echo "<tr><td class='socialcommentcell'>PROFILE <br />DELETED<br /></td><td class='socialcommentcell2'><br /> $comment";
			if (($myid == $memberid) || ($myid == $userid)) {
					echo"<br /><div style='float:right; '><a href=\"socialremovepiccomment.php?photoid=$photoid&tablename=$tablename&newtable=$newtable&filename=$filename&foldername=$foldername&caption=$caption&memberid=$memberid&commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this comment?');\"><img src='images/delete.jpg' /></a></div>";
				}
			echo"</td></tr>";
        }
    }

    ?>
    	</table>
    </td>
    </tr>
    
    <tr>
    <td style="background-image:url(images/messagebottom.jpg); background-repeat:no-repeat; height:19px;">
    </td>
    </tr>
    </table>
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

