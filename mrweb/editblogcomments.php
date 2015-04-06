<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<?php

$blogid = ($_GET['blogid']);

echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";
	
$result = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$blogid'");
$commentsamount = mysql_num_rows($result);

echo"
<tr>
<td class=\"editpageleft\"></td>
<td class=\"editpageright\">";

if ($commentsamount > 0) {
	echo"<table>";
	$result = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$blogid' AND `reply` = '0' ORDER BY `date` ASC ");
	$result2 = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$blogid' AND `reply` = '0'");
	$commenttotal = mysql_num_rows($result2);
	while ($r = mysql_fetch_array($result)) {
		$commentid = ($r['id']);
		$approved = ($r['approved']);
		$articlephoto = ($r['picture']);
		$title = stripslashes($r['title']);
		$title = str_replace("\n", "<br />", $title);
		$vid = stripslashes($r['video']);
		$date = ($r['date']);
		$article = stripslashes($r['article']);
		$article = str_replace("\n", "<br />", $article);
		//$article2 = substr($article, 0, 150);
		$month = date('n',"$date");
		$day = date('j',"$date");
		$year = date('Y',"$date");
		$hour = date('g',"$date");
		$minute = date('i',"$date");
		$meridiem = date('a',"$date");
		$time = $hour . ":" . $minute . " " . $meridiem;
		$time2 = $month . "/" . $day . "/" . $year;
		$author = ($r['memberid']);
		$result3 = mysql_query("SELECT * FROM `members` WHERE `id` = '$author'");
		$r3 = mysql_fetch_array($result3);
		$authorfirst = ($r3['first']);
					$authorlast = ($r3['last']);
					$authorname = $authorfirst . " " . $authorlast;
		$photo = ($r3['photo']);
		if ($photo == "") {
			$photo = "noimage.jpg";
		}
		$replybox = "reply" . $commentid;
		
		echo"<tr><td><a name='$commentid'></a></td></tr>";
		
		echo"<tr>";
		echo"<td align='left' valign='top' style='font-size:12px; font-weight:400; color:#000000; border-bottom:1px solid #cccccc;'>";
			echo"<table align='left' cellpadding='0' cellspacing='3px' border='0' style='margin:10px 0px 0px 0px;'>";
			echo"<tr>";
		
			echo"<td align='left' valign='top'>";
			//echo"<img src='members/$photo' width='60px' height='60px' />";
			echo"</td>";

			echo"<td align='left' valign='top'>";
			echo"$article <br /><br /><span style='color:#969292; font-size:12px;'>posted by $authorname on $time at $time2";
			echo"<br /><br /><a href=\"deleteblogcomment.php?blogid=$blogid&commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this comment?');\">Delete Comment</a>";
			echo"</td>";
			echo"</tr>";
			
			//Start replies
			$result5 = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$blogid'  AND `reply` = '$commentid' ORDER BY `date` ASC");
			while ($r5 = mysql_fetch_array($result5)) {
				$commentid = ($r5['id']);
				$approved = ($r5['approved']);
				$articlephoto = ($r5['picture']);
				$title = stripslashes($r5['title']);
				$title = str_replace("\n", "<br />", $title);
				$vid = stripslashes($r5['video']);
				$date = ($r5['date']);
				$article = stripslashes($r5['article']);
				$article = str_replace("\n", "<br />", $article);
				//$article = explode_wrap($article, 20, 60);
				//$article2 = substr($article, 0, 150);
				$month = date('n',"$date");
				$day = date('j',"$date");
				$year = date('Y',"$date");
				$hour = date('g',"$date");
				$minute = date('i',"$date");
				$meridiem = date('a',"$date");
				$time = $hour . ":" . $minute . " " . $meridiem;
				$time2 = $month . "/" . $day . "/" . $year;
				$author = ($r5['memberid']);
				$result6 = mysql_query("SELECT * FROM `members` WHERE `id` = '$author'");
				$r6 = mysql_fetch_array($result6);
				$authorfirst = ($r6['first']);
				$authorlast = ($r6['last']);
				$authorname = $authorfirst . " " . $authorlast;
				$photo = ($r6['photo']);
				if ($photo == "") {
					$photo = "noimage.jpg";
				}
				$replybox = "reply" . $commentid;
				
				echo"<tr>";
				echo"<td></td><td align='left' valign='top' style='font-size:12px; font-weight:400; color:#000000; border-bottom:0px solid #cccccc; border-top:0px solid #cccccc;'>";
					echo"<table style='margin:10px 0px 0px 50px; background-color:#e4e3e3; ' align='left' width='500px' cellpadding='0' cellspacing='3px' border='0'>";
					echo"<tr>";
					
					echo"<td align='left' valign='top' >";
					//echo"<img src='members/$photo' width='40px' height='40px' />";
					echo"</td>";
					
					echo"<td align='left' valign='top'>";
					echo"$article <br /><br /><span style='color:#969292; font-size:12px;'>posted by $authorname on $time at $time2";
					echo"<br /><br /><a href=\"deleteblogcomment.php?blogid=$blogid&commentid=$commentid\" onclick=\"return confirm('Are you sure you want to delete this comment?');\">Delete Comment</a>";
					echo"</td>";
					echo"</tr>";
					echo"</table>";
				echo"</td>";
				echo"</tr>";
			}
			
			echo"</table>";
			
			
		echo"</td>";
		echo"</tr>";
	}
	echo"</table>";
	
}


echo"
</td>
<td class=\"editpagehints\">
Delete comments from this blog entry.
</td>
</tr>

<tr>
<td></td>
<td align='left'>
<a href='editblogentry.php?blogid=$blogid'><-- Back to Previous Page.</a>
</td>
<td></td>
</tr>
</table>";

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




