<?php
require ('includes/dbconnect.php');
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
			<?php
			echo"
			<table width='100%'>
			<tr>
			<td align='left' valign='top' colspan='2' style='border-bottom:4px dotted #e7eef9;'>
			<a href='events.php'>Back to Events</a>
			</td>
			</tr>
			</table>";
			
			$private = ($_POST['private']);
			$eventid = ($_POST['eventid']);
			$memberid == ($_SESSION['memberloggedin']);
			
			$result = mysql_query("SELECT * FROM `events` WHERE `id`='$eventid'");
			$r = mysql_fetch_array($result);
			$rsvp = ($r['rsvp']);
			$rsvp += 1;
			
			$tablename = "Events_" . $eventid;
			$sql="INSERT INTO `$tablename` (memberid, private) VALUES('$memberid','$private')";
			if (!mysql_query($sql,$dbc)) {
				die('Error: ' . mysql_error());
			}
			
			mysql_query("UPDATE `events` SET `rsvp` = '$rsvp' WHERE `id` = '$eventid' ");
			
			echo"<center><br /><br /><strong>Thank you!</strong><br /><br />You have succesfully signed up to attend this event.<br /><br /></center>";
			?>
            
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
