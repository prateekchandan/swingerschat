<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
    <tr>
    <td colspan="3" align="center" valign="top">
    <?php
	$memberssection = 0;
	$blogsection = 0;
	$memberslogo = 0;
	
	$date = date('m');
	$date .= "/";
	$date .= date('d');
	$date .= "/";
	$date .= date('Y');
	$date .= " ";
	$date .= date('g');
	$date .= ":";
	$date .= date('i');
	$date .= date('a');
			
	$message = ($_GET['message']);
	if ($message == 1) {
		echo"Successfully edited page!";
	}
	if ($message == 2) {
		echo"Successfully added new page!";
	}
	if ($message == 3) {
		echo"Your changes have been discarded!";
	}
	if ($message == 4) {
		echo"Successfully posted new blog entry!";
	}
	if ($message == 5) {
		echo"Successfully edited blog entry!";
	}
	if ($message == 6) {
		echo"That page cannot be deleted!";
	}
	if ($message == 7) {
		echo"Successfully updated your admin account!";
	}
	if ($message == 8) {
		echo"Successfully deleted member!";
	}
	?>
    </td>
    </tr>
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    CURRENT WEBSITE PAGES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
        $result = mysql_query('SELECT * FROM pages ORDER BY pageorder ASC');
        while ($r = mysql_fetch_array($result)) {	
			$pageid = ($r['id']);
			$pageorder = ($r['pageorder']);
			$name = ($r['name']);
			$pagetype = ($r['type']);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"editpage.php?pageid=$pageid\">$name</a>";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
				echo"<a href=\"orderup.php?pageid=$pageid&pageorder=$pageorder\"><img src=\"images/arrowup.jpg\" /></a>";
				echo"</td></tr><tr><td>";
				echo"<a href=\"orderdown.php?pageid=$pageid&pageorder=$pageorder\"><img src=\"images/arrowdown.jpg\" /></a>";
				echo"</td></tr></table>";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"deletepage.php?pageid=$pageid&pagetype=$pagetype\" onclick=\"return confirm('Are you sure you want to delete this Page?');\"><img src=\"images/trashcan.jpg\" /></a>";
			echo"</td>";
			echo"</tr>";
        }
        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	ADD NEW PAGE
    <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
        $result = mysql_query('SELECT * FROM pagetypes ORDER BY id ASC');
        while ($r = mysql_fetch_array($result)) {
			$pagetype = ($r['name']);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"addpage.php?pagetype=$pagetype\">$pagetype</a>";
			echo"</td>";
			echo"</tr>";
        }
        ?>
        </table>
    </div>
    	
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    EDIT SLIDESHOW
    <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">

	<a href='addad.php'>Add New Slide --></a> <br />
    
	
	<?php
	$_SESSION['gallerytable'] = "ads";
	$_SESSION['cellblock'] = "picorder";
	echo'<div id="sortlist" width="100%" style="border:0px;">';
	$result = mysql_query("SELECT * FROM `ads` ORDER BY `picorder` ASC");
	while ($r = mysql_fetch_array($result)) {	
	    $adid = ($r['id']);
	    $addomain = ($r['domain']);
	    $photo = ($r['photo']);
	    $photoid2 = "pictureId_" . ($r['id']);
	    echo"<div style='width:80%; text-align:left' class='sorting' id='$photoid2'>";
	     echo"<a href=\"deletead.php?adid=$adid&photo=$photo\" onclick=\"return confirm('Are you sure you want to delete this ad?');\"><img src=\"images/trashcan.jpg\" /></a> &nbsp;ID: $adid &nbsp;&nbsp; ";
	    echo"<a href=\"ad.php?adid=$adid\">$addomain</a>";
	    echo"</div>";
	}
	?>
    </div>
    </td>
    </tr>
    <?php
	/*
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
   EDIT BLOG
    <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
        <td align="center" valign="top">
        <a href="addblogentry.php">Add New Entry</a>
        </td>
        </tr>
        <?php
$result = mysql_query('SELECT * FROM blog ORDER BY date ASC');
$rows = mysql_num_rows($result);
if ($rows > 0) {
echo"<tr>";
echo"<td align='left' valign='top'>";
echo"<div style='width:100%;'>";
    $blognav = 0;
    $r = mysql_fetch_array($result);
    $blogdate = ($r['date']);
    $oldestyear = date('Y',$blogdate);
    $date = time();
    $thisyear = date('Y',$date);
    $lasttimestamp = $date;
    while ($thisyear > ($oldestyear - 1)) {
        $blognav += 1;
        $displaydatecount = 0;
        $monthcount = 13;
        echo"<div id='$blognav' style='background-color:#202120; padding-bottom:10px;'>";
        echo"<a href=\"javascript:ShowMe('$thisyear','$blognav')\" style='color:#FFFFFF;'><span style='margin:2px 0px 2px 5px;'>$thisyear</span></a><br />";
            echo"<div id='$thisyear' class='show' style='background-color:#2e2f2e; margin:2px;'>";
            $result2 = mysql_query('SELECT * FROM blog ORDER BY date DESC');
            while ($r2 = mysql_fetch_array($result2)) {
                $blogdate2 = ($r2['date']);
                $year = date('Y',$blogdate2);
                $month = date('F',$blogdate2);
                $monthnumber = date('n',$blogdate2);
                if (($year == $thisyear) && ($monthnumber < $monthcount)){
                    $bloglink = $month . $thisyear;
                    echo"<a href=\"javascript:ShowMe('$bloglink','$blognav')\" style='color:#FFFFFF;'><span style='margin:2px 0px 2px 10px;'>$month</span></a><br />";
                    $monthcount = $monthnumber;
                        echo"<div id='$bloglink' class='hide' style='background-color:#cdcbba; margin:2px;'>";
                            $result3 = mysql_query("SELECT * FROM `blog` ORDER BY date DESC");
                            while ($r3 = mysql_fetch_array($result3)) {
                                $blogdate3 = ($r3['date']);
                                $year2 = date('Y',$blogdate3);
                                $month2 = date('F',$blogdate3);
                                $displaydate = date('m',$blogdate3);
                                $displaydate .= "/";
                                $displaydate .= date('d',$blogdate3);
                                $displaydate .= "/";
                                $displaydate .= date('Y',$blogdate3);
                                if ($blogcount < 1) {$lastdate = ($blogdate3 + 1);}
                                if (($year2 == $thisyear) && ($month2 == $month) && ($blogdate3 < $lasttimestamp)) {
				    $lastdate = $displaydate;
				    $lasttimestamp = $blogdate3;
                                    $bloglink = $displaydate . $thisyear;
                                    $blogcount = 1;
                                    echo"<a href=\"javascript:ShowMe('$bloglink','$blognav')\" style='color:#202120;'><span style='margin:2px 0px 2px 15px;'>$displaydate</span></a><br />";
                                        echo"<div id='$bloglink' class='hide' style='background-color:#eeeed7; margin:2px;'>";
                                        $result4 = mysql_query("SELECT * FROM `blog` ORDER BY date DESC");
                                        while ($r4 = mysql_fetch_array($result4)) {
                                            $blogid = ($r4['id']);
                                            $blogdate4 = ($r4['date']);
                                            $title = ($r4['title']);
                                            $displaydate2 = date('m',$blogdate4);
                                            $displaydate2 .= "/";
                                            $displaydate2 .= date('d',$blogdate4);
                                            $displaydate2 .= "/";
                                            $displaydate2 .= date('Y',$blogdate4);
                                            if ($displaydate2 == $displaydate) {
                                                echo"<div style='padding:3px 0px 3px 10px; border-bottom:1px solid #cdcbba; color:#000000;'><a href=\"editblogentry.php?blogid=$blogid\" style='color:#000000;'><strong>-</strong> $title</a></div>";
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
    </div>
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
      SITE MEMBERS  - <a href='addmember.php'>ADD NEW MEMBER</a>
    <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
    <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
    <?php
    $result = mysql_query("SELECT * FROM `members` WHERE `admin` = '0' ORDER BY username ASC");
    while ($r = mysql_fetch_array($result)) {	
        $memberid = ($r['id']);
        $username = ($r['username']);
	$first = ($r['first']);
	$last = ($r['last']);
	if (($first == "") && ($last == "")) {
	    $first = "Member ID: " . $memberid;
	}
        echo"<tr>";
        echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
        echo"<a href=\"members.php?memberid=$memberid\">$first $last</a>";
        echo"</td>";
        echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
        echo"<a href=\"deletemember.php?memberid=$memberid\" onclick=\"return confirm('Are you sure you want to delete this member?');\"><img src=\"images/trashcan.jpg\" /></a>";
        echo"</td>";
        echo"</tr>";
    }
    ?>
    </table>
    </div>
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    
    PROMO STATS
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; background-color:#eeecec;'>";
			echo"SALESMAN";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;  background-color:#eeecec;width:100px;'>";
			echo"SIGN UPS";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; background-color:#eeecec;'>";
			echo"PAID";
			echo"</td>";
			echo"</tr>";
		
        $result = mysql_query("SELECT * FROM `promocodes` ORDER BY `id` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$id = ($r['id']);
			$code = ($r['code']);
			$name = ($r['name']);
			$result2 = mysql_query("SELECT * FROM `members` WHERE `promocode` = '$code'");
            $rows2 = mysql_num_rows($result2);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$name";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; width:100px;'>";
			echo"$rows2";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"</td>";
			echo"</tr>";
        }

		
        ?>
        </table>
        </div>
	*/
	?>
    </td>
    </tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




