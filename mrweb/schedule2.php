<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable" >



<br />
<br />

	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="100">
    <div style="margin:0px;" align="center">
	<?php
	$productid = ($_GET['productid']);
	$date = $_GET['date'];
	$month = $_GET['month'];
	$year = $_GET['year'];
	$datestring = $month . "/" . $date . "/" . $year;
	$datestring2 = strtotime($datestring);
	$day = date('l',$datestring2);
		echo"<center><a href='schedule.php?productid=$productid'>Back to calendar.</a><br /><br /></center>";
		echo"<table cellpadding='3px' cellspacing='1px' border='0' align='center' style='background-color:#FFFFFF;'>";
		echo"<tr>";
		echo"<td colspan='6' align='center' style='font-size:20px; font-weight:bold;'>$day $datestring</td>";
		echo"</tr>";
		
		$finished = 0;
		$result = mysql_query("SELECT * FROM `hours` WHERE `day` = '$day'");
	        $r = mysql_fetch_array($result);
		$time1 = ($r['time1']);
		$time1array = explode(":", $time1);
		$time1hour = $time1array[0];
		$time1minute = $time1array[1];
		$time2 = ($r['time2']);
		$count = ($r['count']);
		
		//Create time in more readable format
		if ($time1hour > 11) {
			$meridiem = "PM";
		} else {
			$meridiem = "AM";
		}
		if ($time1hour > 12) {
			$time1hour = ($time1hour - 12);
		} 
		$time = $time1hour . ":" . $time1minute . " " . $meridiem;

		
		while ($finished < $count) {
			$result = mysql_query("SELECT * FROM `booked` WHERE `date` = '$datestring' AND `time` = '$time' AND `bartenderid` = '$productid'");
			$r = mysql_fetch_array($result);
			$rows = mysql_num_rows($result);
			if ($rows > 0) {
				$cageid = ($r['id']);
				$cage1 = "<a style='color:#ff0000;' href='scheduledelete.php?cageid=$cageid&month=$month&year=$year&date=$date&productid=$productid' onclick=\"return confirm('Are you sure you want to delete this reservation?');\">REMOVE</a>";
			} else {
				$cage1 = "<a style ='font-size:12px;' href='schedulebook.php?cageid=1&month=$month&year=$year&date=$date&time=$time&productid=$productid'>BOOK</a>";
			}
			
	
			echo"<tr>";
			echo"<td class='cagestyle2'>$time</td>";
			echo"<td class='cagestyle3'>$cage1</td>";
			echo"</tr>";
			
			//Update Time for next row
			if ($time1minute == "00") {
				$time1minute = "30";
			} else {
				$time1minute = "00";
				$time1hour = ($time1hour + 1);
			}
			//Create time in more readable format
			if ($meridiem == "AM") {
				if ($time1hour > 11) {
					$meridiem = "PM";
				} else {
					$meridiem = "AM";
				}
			}
			if ($time1hour > 12) {
				$time1hour = ($time1hour - 12);
			} 
			
			$time = $time1hour . ":" . $time1minute . " " . $meridiem;
			$finished += 1;
		}
		
		echo"</table>";
    ?>    
	</div>
    </td>
    </tr>
    </table>




</td>
</tr>


<?php
require ('includes/footer.php');
?>




