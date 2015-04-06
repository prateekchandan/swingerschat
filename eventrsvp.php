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
			$id = ($_GET['id']);
			$result = mysql_query("SELECT * FROM `events` WHERE `id` = '$id'");
			$r = mysql_fetch_array($result);
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
			$result2 = mysql_query("SELECT * FROM `events_places` WHERE `id` = '$place'");
			$r2 = mysql_fetch_array($result2);
			$placename = ($r2['name']);	
			$photo = ($r2['photo']);
			$address = ($r2['address']);
			$city = ($r2['city']);
			$state = ($r2['state']);
			$zip = ($r2['zip']);
			
			?>
				<table cellpadding="0" cellspacing="0px" border="0" width="100%">
				<tr>
				<td align="left">
					<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
                    <?php
					echo"
					<tr>
					<td align='left' valign='top' colspan='2' style='border-bottom:4px dotted #e7eef9;'>
					<a href='events.php'>Back to Events</a>
					</td>
					</tr>";
					?>
                    
					<tr>
					<td align="left" valign="top" class="memberprofile" width='300px'>
						<table cellpadding="5px" cellspacing="0px" border="0" align="left">
						<?php
						echo"<tr>";
						echo"<td class='socialprofile'><strong>EVENT:</strong></td>";
						echo"<td align='left' valign='top'>$name</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>WHEN:</strong></td>";
						echo"<td align='left' valign='top'>$time</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>WHERE:</strong></td>";
						echo"<td align='left' valign='top'>$placename <br />$address <br /> $city, $state $zip</td>";
						echo"</tr>";

						?>
						</table>
					</td>
                    
                    <td align="left" valign="top" width="300px">
                        
                        <table align='left' width='260px' cellpadding="0" cellspacing="0" border="0" style="background-image:url(images/rsvp_back.jpg); background-repeat:no-repeat; width:260px; height:313px;">
                        <tr>
                        <td align="center" valign="top">
                        <div style='margin-top:200px; font-size:10px;'>
                        <form action="eventsrsvpform.php" method="post">
                        <input type="checkbox" name='private' value='1' />Make attendance private.<br /><br />
                        <input type='hidden' name='eventid' value='<?php echo"$id"; ?>' />
                        <input type="submit" value="Sign me up!" class="formfields">
                        </form>
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
