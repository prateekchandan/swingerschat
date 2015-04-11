<?php
require ('includes/dbconnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Blog Page</title>
<META name='description' content='Browse through our blog entries.'>
<META name='keywords' content='blog, blog entries, visit our blog, read our articles'>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
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
<style>
.hide{display:none;}
.show{}
</style>
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
unset ($_SESSION['memberloggedin']);
?>
<br />
<br />
<center>
You have successfully logged out!
</center>
</td>

<td class="text2">
<center>

<?php
echo"<a href=\"bloglogin.php?blogid=$blogid\">Login</a> &nbsp; / &nbsp; <a href=\"blogsignup.php?blogid=$blogid\">Signup</a>";
?>	
<br />
<br />
</center>
    <table align="center" cellpadding="0px" cellspacing="5px" border="0px" width="100%">
    <?php
	$result = mysql_query('SELECT * FROM blog ORDER BY date ASC');
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
    echo"<tr>";
    echo"<td align='left' valign='top'>";
    echo"<div style='width:100%;'>";
    $blognav = 0;
    
        $r = mysql_fetch_array($result);
        $blogdate = strtotime($r['date']);
        $oldestyear = date('Y',$blogdate);
        $thisyear = strtotime($date);
        $thisyear = date('Y',$thisyear);
        while ($thisyear > ($oldestyear - 1)) {
            $blognav += 1;
            $displaydatecount = 0;
            $monthcount = 0;
            echo"<div id='$blognav' style='background-color:#202120; padding-bottom:10px;'>";
            echo"<a href=\"javascript:ShowMe('$thisyear','$blognav')\" style='color:#FFFFFF;'><span style='margin:2px 0px 2px 5px;'>$thisyear</span></a><br />";
                echo"<div id='$thisyear' class='show' style='background-color:#2e2f2e; margin:2px;'>";
                $result2 = mysql_query('SELECT * FROM blog ORDER BY date DESC');
                while ($r2 = mysql_fetch_array($result2)) {
                    $blogdate2 = strtotime($r2['date']);
                    $year = date('Y',$blogdate2);
                    $month = date('F',$blogdate2);
                    if (($year == $thisyear) && ($monthcount == 0)){
                        $bloglink = $month . $thisyear;
                        echo"<a href=\"javascript:ShowMe('$bloglink','$blognav')\" style='color:#FFFFFF;'><span style='margin:2px 0px 2px 10px;'>$month</span></a><br />";
                        $monthcount = 1;
                            echo"<div id='$bloglink' class='hide' style='background-color:#cdcbba; margin:2px;'>";
                                $result3 = mysql_query("SELECT * FROM `blog` ORDER BY date DESC");
                                while ($r3 = mysql_fetch_array($result3)) {
                                    $blogdate3 = strtotime($r3['date']);
                                    $year2 = date('Y',$blogdate3);
                                    $month2 = date('F',$blogdate3);
                                    $displaydate = date('m',$blogdate3);
                                    $displaydate .= "/";
                                    $displaydate .= date('d',$blogdate3);
                                    $displaydate .= "/";
                                    $displaydate .= date('Y',$blogdate3);
                                    if ($blogcount < 1) {$lastdate = ($blogdate3 + 1);}
                                    if (($year2 == $thisyear) && ($month2 == $month) && ($displaydate < $lastdate)) {
                                        $lastdate = $displaydate;
                                        $bloglink = $displaydate . $thisyear;
                                        $blogcount = 1;
                                        echo"<a href=\"javascript:ShowMe('$bloglink','$blognav')\" style='color:#202120;'><span style='margin:2px 0px 2px 15px;'>$displaydate</span></a><br />";
                                            echo"<div id='$bloglink' class='hide' style='background-color:#eeeed7; margin:2px;'>";
                                            $result4 = mysql_query("SELECT * FROM `blog` ORDER BY date DESC");
                                            while ($r4 = mysql_fetch_array($result4)) {
                                                $blogid = ($r4['id']);
                                                $blogdate4 = strtotime($r4['date']);
                                                $title = ($r4['title']);
                                                $displaydate2 = date('m',$blogdate4);
                                                $displaydate2 .= "/";
                                                $displaydate2 .= date('d',$blogdate4);
                                                $displaydate2 .= "/";
                                                $displaydate2 .= date('Y',$blogdate4);
                                                if ($displaydate2 == $displaydate) {
                                                    echo"<div style='padding:3px 0px 3px 10px; border-bottom:1px solid #cdcbba; color:#000000;'><a href=\"blog.php?blogid=$blogid\" style='color:#000000;'><strong>-</strong> $title</a></div>";
                                                }
                                            }
                                            echo"</div>";
                                    }
                                }
                            echo"</div>";
                    }
                }
                echo"</div>";
            $thisyear -= 1;
        }

    echo"</div>";
    echo"</td>";
    echo"</tr>";
	}
    ?>
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

