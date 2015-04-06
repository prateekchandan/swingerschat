<?php
require ('includes/dbconnect.php');
$pagetype = "Blog";
require ('includes/head.php');
?>


<div class="body_resize">
    <div class="body">
	<div class='div1'>

                   <?php
                        $date = time();

                        $Tday = date('l', $date);
                        $Tmonth = date('n', $date);
                        $Tdate = date('j', $date);
                        $Tyear = date('Y', $date);
                        $Ttitle = date('F', $date);

                        if (isset($_GET['month'])) {
                            $day = $_GET['date'];
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                        } else {
                            $day = date('j', $date);
                            $month = date('n', $date);
                            $year = date('Y', $date);
                        }

                        $switchmonth = ($_GET['switchmonth']);

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

                        $first_day = mktime(0, 0, 0, $month, 1, $year);

                        $title = date('F', $first_day);
                        $day_of_week = date('D', $first_day);

                        switch ($day_of_week) {
                            case "Sun": $blank = 0;
                                break;
                            case "Mon": $blank = 1;
                                break;
                            case "Tue": $blank = 2;
                                break;
                            case "Wed": $blank = 3;
                                break;
                            case "Thu": $blank = 4;
                                break;
                            case "Fri": $blank = 5;
                                break;
                            case "Sat": $blank = 6;
                                break;
                        }

                        $days_in_month = cal_days_in_month(0, $month, $year);

                        echo "
		<table align='center'><tr><td valign=\"top\" align=\"center\" width=\"800px\">";

                        echo "<table style=\"border:6px solid #2f1e0e; background-color:#ffffff; color:#000000;\">";
                        echo "<tr><td align=\"left\"><a href=\"calendar.php?month=$month&year=$year&date=$day&switchmonth=prev\"><img src=\"images/calendar_arrow_left.jpg\" /></a></td><td colspan=\"5\" align=\"center\">$title $year</td><td align=\"right\"><a href=\"calendar.php?month=$month&year=$year&date=$day&switchmonth=next\"><img src=\"images/calendar_arrow_right.jpg\" /></a></td></tr>";
                        echo "<tr><td class=\"Cdaytitles\">S</td><td class=\"Cdaytitles\">M</td><td class=\"Cdaytitles\">T</td><td class=\"Cdaytitles\">W</td><td class=\"Cdaytitles\">T</td><td class=\"Cdaytitles\">F</td><td class=\"Cdaytitles\">S</td></tr>";

                        $day_count = 1;

                        echo "<tr>";

                        while ($blank > 0) {
                            echo"<td width=\"100px\" height=\"100px\" align=\"left\" valign=\"top\"></td>";
                            $blank = $blank - 1;
                            $day_count++;
                        }

                        $day_num = 1;


                        while ($day_num <= $days_in_month) {
                            $eventstoday = 0;
                            $style = "background-color:#dbd8d1;";
                            //Check if there are events today.
                            $datestring = $month . "/" . $day_num . "/" . $year;
                            $datestring2 = strtotime($datestring);

                            $count = 0;
                            $events = array();
                            $result = mysql_query("SELECT * FROM `calendar` ORDER BY `time` ASC");
                            while (($r = mysql_fetch_array($result)) && ($eventstoday == 0)) {
                                $timestamp = ($r['time']);
                                $month2 = date('n', "$timestamp");
                                $date2 = date('j', "$timestamp");
                                $year2 = date('Y', "$timestamp");
                                $hour2 = date('g', "$timestamp");
                                $minute2 = date('i', "$timestamp");
                                $meridiem2 = date('a', "$timestamp");
                                $datestring3 = $month2 . "/" . $date2 . "/" . $year2;
                                $datestring4 = strtotime($datestring3);
                                if ($datestring2 == $datestring4) {
                                    $eventstoday = 1;
                                    $style = "background-color:#8c2725";
                                    $text = stripslashes($r['text']);
                                    $text = strip_tags($text);
                                    $text = str_replace("\n", "<br />", $text);
                                    $text = substr($text, 0, 70);
                                    $text .= "...";
                                    $events[$count] = $text;
                                    $count += 1;
                                }
                            }

                            //DONE

                            echo"<td class='calendar' align=\"left\" valign=\"top\" width=\"100px\" height=\"100px\" style=\"$style\"><a style='color:#ffffff;' href=\"calendar2.php?month=$month&year=$year&date=$day_num\">$day_num</a>";
                            if ($count > 0) {
                                for ($i = 0; $i < $count; $i++) {
                                    $title = $events[$i];
                                    echo"<br />";

                                    echo"<a style='color:#ffffff;' href=\"calendar2.php?month=$month&year=$year&date=$day_num\">$title</a>";
                                }
                            }
                            echo"</td>";
                            $day_num++;
                            $day_count++;

                            if ($day_count > 7) {
                                echo "</tr><tr>";
                                $day_count = 1;
                            }
                        }

                        while ($day_count > 1 && $day_count <= 7) {
                            echo"<td align=\"left\" valign=\"top\" width=\"100px\" height=\"100px\"></td>";
                            $day_count++;
                        }

                        echo"</tr></table>";
                        ?>
            </tr>
    </td>
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
