<div class="block-wrap">
		<span class="heading">Recent Blog Posts</span>
		<div class="content">
		<?php
		$result = mysql_query("SELECT * FROM `blog` WHERE `approved` = '1' ORDER BY `date` DESC LIMIT 5");
		while ($r = mysql_fetch_array($result)) {
			$blogid = ($r['id']);
			$title = stripslashes($r['title']);
			$title = str_replace("\n", "<br />", $title);
			$title = strtoupper($title);
			echo"<div style='font-size:10px; width:200px; margin:5px 0px 20px 20px;'><a href='blog2.php?articleid=$blogid'>$title</a></div>";
		}
		?>
		</div>
		<span class="heading">Blog Archive</span>
		<div class="content">
		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" width="230px" style='margin:10px 0px 0px 10px;'>
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
			echo"<div id='$blognav' style='padding-bottom:10px;'>";
			echo"<a href=\"javascript:ShowMe('$thisyear','$blognav')\" style='color:#000000;'><span style='margin:2px 0px 2px 5px;'>$thisyear</span></a><br />";
			    echo"<div id='$thisyear' class='show' style='margin:2px;'>";
			    $result2 = mysql_query('SELECT * FROM blog ORDER BY date DESC');
			    while ($r2 = mysql_fetch_array($result2)) {
				$blogdate2 = ($r2['date']);
				$year = date('Y',$blogdate2);
				$month = date('F',$blogdate2);
				$monthnumber = date('n',$blogdate2);
				if (($year == $thisyear) && ($monthnumber < $monthcount)){
				    $bloglink = $month . $thisyear;
				    echo"<a href=\"javascript:ShowMe('$bloglink','$blognav')\" style='color:#000000;'><span style='margin:2px 0px 2px 10px;'>$month</span></a><br />";
				    $monthcount = $monthnumber;
					echo"<div id='$bloglink' class='hide' style='margin:2px;'>";
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
							echo"<div id='$bloglink' class='hide' style='margin:2px;'>";
							$result4 = mysql_query("SELECT * FROM `blog` ORDER BY date DESC");
							while ($r4 = mysql_fetch_array($result4)) {
							    $blogid = ($r4['id']);
							    $blogdate4 = ($r4['date']);
							    $title = strtoupper($r4['title']);
							    $displaydate2 = date('m',$blogdate4);
							    $displaydate2 .= "/";
							    $displaydate2 .= date('d',$blogdate4);
							    $displaydate2 .= "/";
							    $displaydate2 .= date('Y',$blogdate4);
							    if ($displaydate2 == $displaydate) {
								echo"<div style='padding:3px 0px 3px 10px; font-size:10px;'><a href=\"blog2.php?articleid=$blogid\"><strong>-</strong> $title</a></div>";
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
	</div>