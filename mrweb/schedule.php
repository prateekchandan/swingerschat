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
    $date = time();
    
    $switchmonth = ($_GET['switchmonth']);
    
    $Tday = date('l',$date);
    $Tmonth = date('n',$date);
	$Tdate = date('j',$date);
    $Tyear = date('Y',$date);
    $Ttitle = date('F',$date);
    
    if(isset($_GET['month'])){
        $day = $_GET['date'];
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $day = date('j',$date);
        $month = date('n',$date);
        $year = date('Y',$date);
    }
    
    if ($switchmonth == "prev") {
        if ($month == 1) {
            $month = 12;
            $year -= 1;	
        } else {
            $month -= 1;
        }
    }
    
    if ($switchmonth == "next") {
        if ($month == 12) {
            $month = 1;
            $year += 1;
        } else {
            $month += 1;
        }
    }
    
    $first_day = mktime(0,0,0, $month, 1, $year);
    
    $title = date('F',$first_day);
    $day_of_week = date('D',$first_day);
    
    switch($day_of_week) {
        case "Sun": $blank=0; break;
        case "Mon": $blank=1; break;
        case "Tue": $blank=2; break;
        case "Wed": $blank=3; break;
        case "Thu": $blank=4; break;
        case "Fri": $blank=5; break;
        case "Sat": $blank=6; break;
    }
    
    $days_in_month = cal_days_in_month(0,$month,$year);
    
		echo "
		<table><tr><td valign=\"top\" align=\"center\" width=\"400px\">
		<center><strong>Please select day $daycount</strong><br />";
		
			echo "<table style=\"border:6px solid #0066FF; background-color:#ffffff; color:#000000;\">";
			echo "<tr><td align=\"left\"><a href=\"schedule.php?month=$month&year=$year&date=$day&switchmonth=prev&productid=$productid\"><img src=\"../images/calendar_arrow_left.jpg\" /></a></td><td colspan=\"5\" align=\"center\">$title $year</td><td align=\"right\"><a href=\"schedule.php?month=$month&year=$year&date=$day&switchmonth=next&productid=$productid\"><img src=\"../images/calendar_arrow_right.jpg\" /></a></td></tr>";
			echo "<tr><td class=\"Cdaytitles\">S</td><td class=\"Cdaytitles\">M</td><td class=\"Cdaytitles\">T</td><td class=\"Cdaytitles\">W</td><td class=\"Cdaytitles\">T</td><td class=\"Cdaytitles\">F</td><td class=\"Cdaytitles\">S</td></tr>";
			
			$day_count = 1;
			
			echo "<tr>";
			
			while ($blank > 0) {
				echo"<td width=\"50px\" height=\"50px\" align=\"left\" valign=\"top\"></td>";
				$blank = $blank -1 ;
				$day_count++;
			}
			
			$day_num = 1;
			
			while ($day_num <= $days_in_month) {
				echo"<td align=\"left\" valign=\"top\" width=\"50px\" height=\"50px\" style=\"background-color:#c3def5;\"><a href=\"schedule2.php?month=$month&year=$year&date=$day_num&productid=$productid\">$day_num</a></td>";
				$day_num++;
				$day_count++;
				
					if ($day_count > 7) {
						echo "</tr><tr>";
						$day_count = 1;
					}
			}
			
			while ($day_count > 1 && $day_count <= 7 ) {
				echo"<td align=\"left\" valign=\"top\" width=\"50px\" height=\"50px\"></td>";
				$day_count++;
			}
			
			echo"</tr></table>";
		?>
	
		</table>
        
	</div>
    </td>
    </tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




