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
<!--[if lt IE 7]>
<script src="IE7.js"></script>
<![endif]-->
</head>

<body style="margin:0px 0px 0px 0px;">

<table align="center" cellpadding="0" cellspacing="5px" width="1008px">
<tr>
<td class="headertable" colspan="2">
<?php
$result = mysql_query("SELECT * FROM `logo`");
$r = mysql_fetch_array($result);
$logo = ($r['filename']); 
echo"<img src='logo/$logo' style='float:left; margin-left:20px;'/>"; 
?>
<?php
require ('includes/nav.php');
?>
</td>
</tr>

<!--Body -->
<tr>
<td class="bannertable" colspan="2">
</td>
</tr>

<tr>
<td class="text1">
<?php
$tablename = "ServiceCategories_" . $pageid;
$tablename2 = "Services_" . $pageid;
$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
    echo"<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%'>";
    while ($r = mysql_fetch_array($result)) {
        $categoryid = ($r['id']);
        $category = ($r['name']);
        $categoryorder = ($r['fieldorder']);
        echo"<tr><td align='left' valign='top' style='border-bottom:1px dotted #f6f6f6;'><strong>$category</strong></td></tr>";
        echo"<tr><td align='left' valign='top'>";	
            $result2 = mysql_query("SELECT * FROM `$tablename2` WHERE `category`='$category' ORDER BY `fieldorder` ASC");
                echo"<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%' style='margin-bottom:20px;'>";
                while ($r2 = mysql_fetch_array($result2)) {
                    $serviceid = ($r2['id']);
                    $servicename = ($r2['name']);
                    $serviceorder = ($r2['fieldorder']);
                    $serviceprice = ($r2['price']);
                    echo"<tr>";
                    echo"<td class='servicename' width='50%'>$servicename</td>";
                    echo"<td class='serviceprice' width='20%'>$serviceprice</td>";
					echo"</tr>";
                }
                echo"</table>";
        echo"</td></tr>";
    }
    echo"</table>";
	
?>
</td>

<td class="text3">
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

