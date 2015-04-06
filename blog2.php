<?php
require ('includes/dbconnect.php');
$pagetype = "Blog";
require ('includes/head.php');
?>

<div id="main">
    <div id="content" class="left">
        <div class='div1'>
        <!-- Start Template -->
       
       <table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='text10'>
	<div class='div2'>
	<?php
	$error = ($_GET['error']);
		$articleid = ($_GET['articleid']);
		$_SESSION['currentarticle'] = $articleid;
		
		$result = mysql_query("SELECT * FROM `blog` WHERE `id`='$articleid' AND `approved` = '1'");
		$r = mysql_fetch_array($result);
		$rows20 = mysql_num_rows($result);
		
		$approved = ($r['approved']);
		$picby = stripslashes($r['picby']);
		$articlephoto = ($r['picture']);
		$title = stripslashes($r['title']);
		$title = str_replace("\n", "<br />", $title);
		$title = strtoupper($title);
		$ref = stripslashes($r['ref']);
		$ref = str_replace("\n", "<br />", $ref);
		$vid = stripslashes($r['video']);
		$date = ($r['date']);
		$article = stripslashes($r['text']);
		$description = $article;
		$month = date('n',"$date");
		$day = date('j',"$date");
		$year = date('Y',"$date");
		$hour = date('g',"$date");
		$minute = date('i',"$date");
		$meridiem = date('a',"$date");
		$time = $hour . ":" . $minute . " " . $meridiem;
		$time2 = $month . "/" . $day . "/" . $year;
		$author = ($r['authorid']);
		$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$author'");
		$r2 = mysql_fetch_array($result2);
		$authorname = ($r2['username']);
		$photo = ($r2['photo']);
		if ($photo == "") {
			$photo = "noimage.jpg";
		}
		
			echo"<table cellpadding='0' cellspacing='0' border='0' width='600px'  style='font-size:12px; margin-left:5px;'>";
			echo"<tr>";
			echo"<td align='left' valign='top' style='font-size:16px; font-weight:bold; color:#000000; border-top:0px solid #cccccc;'><a href='index.php?id=75'>Back to main page</a><br /></td>";
			echo"</tr>";
			
			if ($rows20 < 1) {
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:16px; font-weight:bold; color:#000000; border-top:0px solid #cccccc;'><br /><br />This article is no longer here.<br /><br /></td>";
				echo"</tr>";
				
			} else {
		
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:18px; font-weight:bold; color:#000000; border-top:0px solid #cccccc;'><br />$title</td>";
				echo"</tr>";
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:12px; font-weight:400; color:#969292;'><div style='margin-bottom:16px;'>posted at $time on $time2</div></td>";
				echo"</tr>";
				if ($articlephoto != "") {
					echo"<tr>";
					echo"<td align='left' valign='top' style='font-size:12px; font-weight:bold; color:#000000;'><img src='articlepictures/$articlephoto' width='425px' style='margin-bottom:20px;'/>";
					echo"</tr>";
				}
				
				if ($vid != "") {
					echo"<tr>";
					echo"<td align='left' valign='top' style='font-size:12px; font-weight:bold; color:#000000;'><div style='margin-bottom:16px;'>$vid</div></td>";
					echo"</tr>";
				}
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:16px; font-weight:400; color:#000000; border-bottom:0px solid #cccccc;'><br /> $article <br /><br /></td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:16px; font-weight:bold; color:#cccccc; border-bottom:0px solid #cccccc;'>";
				?>
				 <!-- AddThis Button BEGIN -->
				<a href="http://www.addthis.com/bookmark.php" 
				  class="addthis_button"
				  addthis:url="<?php echo"$baseurl/blog2.php?articleid=$articleid"; ?>"
				  addthis:title="<?php echo"$sitename"; ?>"
				  addthis:description="<?php echo"$title"; ?>"></a>
		  
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4dc1dbef06b533a9" var addthis_config = {
			  services_compact: 'email, facebook, twitter',
			  services_exclude: 'print'}></script>
				<!-- AddThis Button END -->
                <br /><br />

				<?php
				echo"</td>";
				echo"</tr>";
				
				$tablename = "article_" . $articleid;
				$result = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$articleid'");
				$rows = mysql_num_rows($result);
				
				
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:16px; font-weight:600; color:#000000; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc;'>$rows Comments";
				if ($error == 1) {
					echo"<span style='color:#ff0000; font-size:10px;'>  you can't post empty comments.</span>";
				}
				echo"<br />";
				echo"<span style='font-size:12px; color:#969292;'>";
				
				echo"<a name='commentbox'></a>";
				if (isset($_SESSION['memberloggedin'])) {
					echo"<a href='#commentbox' onclick=\"document.getElementById('button').style.display='block'\">post a comment</a>";
				} else {
					echo"<a href='login.php'>post a comment</a>";
				}
				echo"<div align='left' id='button' style='display:none; margin-right:0px; margin-top:7px;'>";
				echo"<form enctype='multipart/form-data' action='blogcommentpost.php' method='post'>";
				echo"<textarea id=\"text01\" name=\"text1\" style='width:425px; height:150px; color:#cccccc;' onfocus=\"this.style.color='#000000', this.value=''\">write something...</textarea>";
				echo"<input type='hidden' name='articleid' value='$articleid' />";
				echo"<br /><input type='submit' name='submit' value='Post Comment' style='margin-top:7px;'/>";
				echo"</form>";
				echo"</div>";
				
				if (isset($_SESSION['memberloggedin'])) {
					echo"<div style='float:right; margin-bottom:20px;'><a href='logout.php'>logout here.</a></div>";
				} else {
					echo"<div style='float:right; margin-bottom:20px;'>Must <a href='login.php'>login</a> or <a href='signup.php'>signup</a> to post comments.</div>";
				}

				echo"</span>";
				echo"</td>";
				echo"</tr>";
				
				if (isset($_GET['commentnumber'])) {
					$commentnumber = ($_GET['commentnumber']);
				} else {
					$commentnumber = 6;
				}
				
				$result = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$articleid' AND `reply` = '0' ORDER BY `date` ASC LIMIT 0, $commentnumber");
				$result2 = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$articleid' AND `reply` = '0'");
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
					//$article = explode_wrap($article, 20, 160);
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
					$first = ($r3['first']);
					$last = ($r3['last']);
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
						echo"$article <br /><br /><span style='color:#969292; font-size:12px;'>posted by $first $last on $time at $time2";
						if (isset($_SESSION['memberloggedin'])) {
							echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#replybox' onclick=\"document.getElementById('$commentid').style.display='block'\">reply</a></span>";
						} else {
							echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='login.php'>reply</a></span>";
						}
						
						echo"<div align='left' id='$commentid' style='display:none; margin-right:0px; margin-top:7px;'>";
						echo"<form enctype='multipart/form-data' action='blogcommentreply.php' method='post'>";
						echo"<textarea id=\"text01\" name=\"text1\" style='width:425px; height:150px; color:#cccccc;' onfocus=\"this.style.color='#000000', this.value=''\">write something...</textarea>";
						echo"<input type='hidden' name='articleid' value='$articleid' />";
						echo"<input type='hidden' name='commentid' value='$commentid' />";
						echo"<br /><input type='submit' name='submit' value='Post Reply' style='margin-top:7px;' />";
						echo"</form>";
						echo"</div>";
						echo"</td>";
						echo"</tr>";
						
						//Start replies
						$result5 = mysql_query("SELECT * FROM `blogcomments` WHERE `blogid` = '$articleid'  AND `reply` = '$commentid' ORDER BY `date` ASC");
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
							$first = ($r6['first']);
							$last = ($r6['last']);
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
								echo"$article <br /><br /><span style='color:#969292; font-size:12px;'>posted by $first $last on $time at $time2";
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
				
				
		
				echo"<tr>";
				echo"<td align='left' valign='top' style='font-size:12px; font-weight:bold; color:#000000;'><a name='commentbox2'></a></td>";
				echo"</tr>";
				
				$self = $_SERVER['PHP_SELF'];
				if ($commenttotal > $commentnumber) {
					$commentsleft = ($commenttotal - $commentnumber);
					if ($commentsleft > 6) {
						$commentsleft = 6;
					}
					$commentnumber += 6;
					echo"<tr>";
					echo"<td align='center' valign='top' style='font-size:14px; font-weight:bold; color:#969292;'><br /><a href='blog2.php?articleid=$articleid&commentnumber=$commentnumber' style='color:#969292; font-size:14px;' onmouseover=\"this.style.color='#3399cc'\" onmouseout=\"this.style.color='#969292'\">Show $commentsleft More Comments</a><br /><br /></td>";
					echo"</tr>";
				}
				
			}
			echo"</table>";
	?>
	</div>
	</td>
	
	<td class='text11'>
	<div class='div2'>
	<?php
	require ('includes/blogcolumn.php');
	?>
	</div>
	</td>
	</tr>
	</table>
       
       
        <!-- End Template -->
        </div>
        <div class='cl'></div>
        <?php require('includes/blogbottom.php') ?>
    </div>

    <div class="cl">&nbsp;</div>
</div>
<div class="shadow-l"></div>
<div class="shadow-r"></div>
<div class="shadow-b"></div>
</div>


</div>
<div class="cl">&nbsp;</div>
<?php require('includes/footer.php') ?>
</body>
</html>

<?php
ob_end_flush();
?>
