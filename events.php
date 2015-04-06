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
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');
require ('includes/head.php');
?>




<!--Body -->
<tr>
<td class="bodytable">
	<table align="center" cellpadding="5px" cellspacing="0px" width="100%" style='margin-top:10px;'>
    <tr>
	<td class='search'>
    <?php require ('includes/search.php'); ?>
    </td>
    
	<td class='maincell'>
    
    	<table align="center" cellpadding="5px" cellspacing="0px" width="100%">
        <tr>
        <td class='text1'>
        <div class='div1'>
        	<table align="center" cellpadding="0px" cellspacing="0px" border="0" class='bodycontenttable'>
            <tr>
            <td class='bodycontenttop1'></td>
            </tr>
            
            <tr>
            <td class='bodycontentmiddle1'>
            <div class='div3'>
            	<table align='center' cellpadding='3px' cellspacing='1px' border='0' width='697px' style="background-image:url(images/events_header.jpg); background-repeat:no-repeat; background-position:top center;">
                <tr>
                <td colspan='5' style='height:78px;'></td>
                </tr>
                
                <tr>
                <td style='text-align:left; valign:top; color:#FFFFFF; font-weight:bold;'>EVENT</td>
                <td style='text-align:left; valign:top; color:#FFFFFF; font-weight:bold;'>WHERE</td>
                <td style='text-align:left; valign:top; color:#FFFFFF; font-weight:bold; width:170px;'>WHEN</td>
                <td style='text-align:left; valign:top; color:#FFFFFF; font-weight:bold; width:100px;'>ATTENDEES</td>
                <td style='text-align:left; valign:top; color:#FFFFFF; font-weight:bold; width:80px;'></td>
                </tr>
                
       		<?php 
			$memberid == ($_SESSION['memberloggedin']);
			$count = 0;
			$result = mysql_query("SELECT * FROM `events` ORDER BY `time` ASC");
			$rows = mysql_num_rows($result);
			if ($rows > 0) {
				while ($r = mysql_fetch_array($result)) {	
					$eventid = ($r['id']);
					$name = ($r['name']);
					$time = ($r['time']);
					$rsvp = ($r['rsvp']);
					$month = date('n',"$time");
					$day = date('j',"$time");
					$year = date('Y',"$time");
					$hour = date('g',"$time");
					$minute = date('i',"$time");
					$meridiem = date('a',"$time");
					$time = $month . "/" . $day . "/" . $year . " " . $hour . ":" . $minute . $meridiem;;
					
					$place = ($r['place']);
					$result2 = mysql_query("SELECT `name` FROM `events_places` WHERE `id` = '$place'");
					$r2 = mysql_fetch_array($result2);
					$placename = ($r2['name']);	
					
					$tablename = "Events_" . $eventid;
					$result2 = mysql_query("SELECT * FROM `$tablename` WHERE `memberid` = '$memberid'");
					$rows2 = mysql_num_rows($result2);
					
					if ($count ==0) {
						echo"<tr>";
						echo"<td class='eventname'>$name</td>";
						echo"<td class='eventname'><a href='eventsplace.php?id=$place'>$placename</a></td>";
						echo"<td class='eventname'>$time</td>";
						echo"<td class='eventname'>$rsvp</td>";
						echo"<td class='eventname'>";
						if ($rows2 > 0) {
							echo"<img src='images/rsvp2.png' />";
						} else {
							echo"<a href='eventrsvp.php?id=$eventid'><img src='images/rsvp.png' /></a>";
						}
						echo"</td>";
						echo"</tr>";
						$count += 1;
					} else {
						echo"<tr>";
						echo"<td class='eventname2'>$name</td>";
						echo"<td class='eventname2'><a href='eventsplace.php?id=$place'>$placename</a></td>";
						echo"<td class='eventname2'>$time</td>";
						echo"<td class='eventname2'>$rsvp</td>";
						echo"<td class='eventname2'>";
						if ($rows2 > 0) {
							echo"<img src='images/rsvp2.png' />";
						} else {
							echo"<a href='eventrsvp.php?id=$eventid'><img src='images/rsvp.png' /></a>";
						}
						echo"</td>";
						echo"</tr>";
						$count = 0;
					}
				}
			} else {
				echo"<tr>";
				echo"<td align='center' colspan='5'>";
				echo"<br /><br />There are no upcoming events.";
				echo"</td>";
				echo"</tr>";
			}
			?>
            	<tr>
                <td colspan='5' style='height:50px;'></td>
                </tr>
				</table>
            </div>
        	</td>
            </tr>
            
            <tr>
            <td class='bodycontentbottom1'></td>
            </tr>
            </table>
        </div>
        </td>
        </tr>
        
        <tr>
        <td class='text2'>
        <div class='div2'>
        <?php echo"$text2"; ?>
        </div>
        </td>
        </tr>
        </table>
    
    </td>
    </tr>
    </table>
    
</td>
</tr>
</table>

<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
