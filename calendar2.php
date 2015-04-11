<?php
require ('includes/dbconnect.php');
$pagetype = "Blog";
require ('includes/head.php');
?>


<div class="body_resize">
    <div class="body">
	<div class='div1'>

           <?php
		$date = $_GET['date'];
		$month = $_GET['month'];
		$year = $_GET['year'];
		$datestring = $month . "/" . $date . "/" . $year;
		$datestring2 = strtotime($datestring);
		?>
	    <table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
	    <tr>
	    <td align="center" valign="top" style="background-color:#CCCCCC; color:#000000;" colspan="3">
		<a href='calendar.php'>Back to Calendar</a><br /><br />
	    EVENTS FOR: <?php echo"$datestring"; ?>
	    <br />
		<div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF; text-align:left; color:#000000;">
		<table align="center" cellpadding="5px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
		<?php
		$result = mysql_query("SELECT * FROM `calendar` ORDER BY `time` ASC");
		while ($r = mysql_fetch_array($result)) {	
				$eventid = ($r['id']);
				$text = ($r['text']);
				$text = str_replace("\n", "<br />", $text);
				$timestamp = ($r['time']);
				$month2 = date('n',"$timestamp");
				$date2 = date('j',"$timestamp");
				$year2 = date('Y',"$timestamp");
				$hour2 = date('g',"$timestamp");
				$minute2 = date('i',"$timestamp");
				$meridiem2 = date('a',"$timestamp");
				$datestring3 = $month2 . "/" . $date2 . "/" . $year2;
				$datestring4 = strtotime($datestring3);
				$time = "$hour2" . ":" . $minute2 . "&nbsp;" . $meridiem2;
				if ($datestring2 == $datestring4) {
				    echo"<tr>";
				    echo"<td width='150px' align='left' valign='middle' style='border-bottom:1px solid #999999;'>";
				    echo"$datestring3 &nbsp; $time <br /> Pacific Standard Time";
				    echo"</td>";
				    echo"<td class='calendar' align='left' valign='middle' style='border-bottom:1px solid #999999;'>";
				    echo"$text";
				    echo"</td>";
				    echo"</tr>";   
				}
		}
		?>
		</table>
		</div>
            </td>
            </tr>
            </table>
	</div>
	
        
    <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>
</div>
<?php require('includes/footer.php'); ?>
</body>
</html>

<?php
ob_end_flush();
?>
