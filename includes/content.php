<?php    
if ($pagetype == "404") {
	echo"<div class='div1'>";
	echo"
	<strong>404 ERROR - Page Missing</strong><br>
	<br>
	The page you are looking for has been removed or renamed.";
	echo"</div>";
}
if ($pagetype == "Home Page") {
	echo"<div class='div1'>";
	echo"$text1";
	echo"</div>";
}

if ($pagetype == "1 Column") {
	echo"<div class='div1'>";
	echo"$text1";
	echo"</div>";
}

 if ($pagetype == "Newsletter") {
	echo"<div class='div1'>";
	echo"$text1";
	echo"</div>";
}

if ($pagetype == "2 Column") {
	echo"
	<div class='div2'>
	$text1
	</div>
	
	<div class='div3'>
	$text2
	</div>
	";
}

if ($pagetype == "3 Column") {
	echo"
	<div class='div4'>
	$text1
	</div>
	
	<div class='div5'>
	$text2
	</div>
	
	<div class='div6'>
	$text3
	</div>
	";
}

if ($pagetype == "Reviews") {
	
    $url = $_SERVER['PHP_SELF'];
    // if $_GET['page'] defined, use it as page number
    if(isset($_GET['page'])){
	$pageNum = $_GET['page'];
    } else {
	$pageNum = 1;
    }
    $rowsPerPage = "5";
    // counting the offset
    $offset = ($pageNum - 1) * $rowsPerPage;

	
	echo"<div class='div1'>";
	
	echo"$text1 <br /><br /><center><a href='reviewsform.php'>Click here to leave your review.</a></center>";
	
	
	echo"<br /><br />";
	$result5 = mysql_query("SELECT * FROM `reviews` WHERE `approved`='1' ORDER BY `date` DESC LIMIT $offset, $rowsPerPage");
	$result6 = mysql_query("SELECT * FROM `reviews` WHERE `approved`='1'");
	$rows6 = mysql_num_rows($result6);
	while ($r5 = mysql_fetch_array($result5)) {
	    $rid = ($r5['id']);
	    $review = stripslashes($r5['review']);
	    $review = str_replace("\n", "<br />", $review);
	    $name = stripslashes($r5['name']);
	    $time3 = ($r5['date']);
		$month = date('n',"$time3");
		$day = date('j',"$time3");
		$year = date('Y',"$time3");
		$hour = date('g',"$time3");
		$minute = date('i',"$time3");
		$meridiem = date('a',"$time3");
		$date = $month . "/" . $day . "/" . $year . " at " . $hour . ":" . $minute . " " . $meridiem;
	    echo"<div style='margin:20px 50px 20px 50px;'>";
	    echo"<div style='font-size:12px; color:#333333; text-align:left;'><em>~ Posted by $name on $date</em></div><br /><br />";
	    echo"\"$review\"";
	    echo"<br /><br />";
	    
	    echo"<hr color='#cccccc' /><br /><br />";
	    echo"</div>";
	}
	echo"<br />$text2";
	
		// how many pages we have when using paging?
		$maxPage = ceil($rows6/$rowsPerPage);
		$maxPage1 = ($maxPage + 1);
		echo"<div class=\"catalogfooternav\">";
		
		// print the link to access each page
		$self = $_SERVER['PHP_SELF'];
		$nav  = '';
		
		$lastpageNum = $pageNum + 10;
		$firstpageNum = $pageNum - 10;
		$maxPage2 = $maxPage1 + 1;
		
		for($page = $firstpageNum; $page < $lastpageNum; $page++){
		    if ($page == $pageNum){
			$nav .= "$page"; // no need to create a link to current page
		    } else {
			if (($page > 0) && ($page < $maxPage1)) {
				$nav .= " <a href=\"$self?page=$page&id=$pageid\">$page</a> ";
			}
		    }
		}
		
		
		// creating previous and next link
		// plus the link to go straight to
		// the first and last page
		
		if ($pageNum > 1){
		    $page  = $pageNum - 1;
		    $prev  = " <a href=\"$self?page=$page&id=$pageid\">[Prev]</a> ";
		
		    $first = " <a href=\"$self?page=1&id=$pageid\">[First Page]</a> ";
		} else {
		    $prev  = "<span>[Prev]</span>"; // we're on page one, don't print previous link
		    $first = "<span>[First Page]</span>"; // nor the first page link
		}
		
		
		if ($pageNum < $maxPage){
		    $page = $pageNum + 1;
		    $next = " <a href=\"$self?page=$page&id=$pageid\">[Next]</a> ";
		
		    $last = " <a href=\"$self?page=$maxPage&id=$pageid\">[Last Page]</a> ";
		} else {
		    $next = "<span>[Next]</span>"; // we're on the last page, don't print next link
		   $last = "<span>[Last Page]</span>"; // nor the last page link
		}
		
		// print the navigation link
		echo"
		<table align='center'>
		<tr>
		<td align='center' valign='top'>$first</td> 
		<td align='center' valign='top'>$prev</td> 
		<td align='center' valign='top'>$nav</td>
		<td align='center' valign='top'>$next</td>
		<td align='center' valign='top'>$last</td> 
		</tr>
		</table>";

	echo"</div>";
}

if ($pagetype == "Album Page") {
	echo"
	<div class='div1'>
	$text1";

	$tablename = "Album_" . $pageid;
	
	echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\"><tr>";
	$count = 0;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `pageorder` ASC");
	while ($r = mysql_fetch_array($result)) {
		$galleryid = ($r['pageid']);
		$tablename2 = "Gallery_" . $galleryid;
		$result2 = mysql_query("SELECT * FROM `$tablename2` ORDER BY `picorder` ASC");
		$rows2 = mysql_num_rows($result2);
		$result4 = mysql_query("SELECT name FROM `pages` WHERE `id` = '$galleryid'");
		$r4 = mysql_fetch_array($result4);
		$gallerytitle = ($r4['name']);
		if ($rows2 < 1) {
			echo "<td style='margin:5px; text-align:center; width:200px; height:125px; color:#000000;'><strong>$gallerytitle</strong><br /><a href='index.php?id=$galleryid&albumid=$pageid'><img src='productpics/noimage.jpg' style='margin:5px; border:1px solid #bfbcbc; width:150px;' /></a></td>";
		} else {
			$r2 = mysql_fetch_array($result2);
			$photoid = ($r2['id']);
			$filename = ($r2['filename']);
			$caption = ($r2['caption']);
			
			$thumb = "thumb" . $galleryid . ".jpg";
			
			square_crop("$tablename2/thumbs/$filename", "$thumb", 150);
		
			echo "<td style='margin:5px; text-align:center; width:200px; height:125px; color:#000000;'><strong>$gallerytitle</strong><br /><a href='index.php?id=$galleryid&albumid=$pageid'><img src=\"$thumb\" style='margin:5px; border:1px solid #bfbcbc; width:150px;' /></a></td>";
		}
		
		$count += 1;
		if ($count > 3) {
			echo"</tr><tr>";
			$count = 0;
		}
	}
	while ($count < 4) {
		echo"<td class='gallerycell' align=\"center\" width=\"200px\"></td>";
		$count += 1;
	}
	echo"</tr>";
	echo"</table>

	</div>

	<div class='div1'>
	$text2
	</div>
	";
}

if ($pagetype == "Photo Gallery") {
	echo"
	<div class='div2'>";
	if (isset($_GET['albumid'])) {
		$albumid = $_GET['albumid'];
		echo"<a href='index.php?id=$albumid'>Back to Album</a><br /><br />";
	}
	echo"$text1";
	echo"</div>";
	
	$tablename = "Gallery_" . $pageid;
	
	echo"<div class='div3'>";
	echo"$text2";
	$tablename = "Gallery_" . $pageid;
	
	$count = 0;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `picorder` ASC");
	while ($r = mysql_fetch_array($result)) {
		$photoid = ($r['id']);
		$filename = ($r['filename']);
		$caption = ($r['caption']);
		
		//$thumb = "thumb" . $pageid . $photoid . ".jpg";
		
		//square_crop("$tablename/thumbs/$filename", "$thumb", 150);
	
		echo "<div style='float:left; margin-right:24px;'><a href=\"$tablename/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"$tablename/$filename\" style='margin:5px; border:1px solid #bfbcbc; width:200px;' alt=\"Click to view larger image.\" /></a><div class=\"highslide-caption\" style='color:#000000; font-size:12px; text-align:center; width:100%; '>$caption</div></div>";
		
		$count +=1;
	}
	
	echo"</div>";
	echo"<div class='clear'></div>";
}

if ($pagetype == "Contact Form") {
	echo"
	<div class='div2'>";
	
	$sentform = ($_GET['sentform']);
	$error = ($_GET['error']);
	if ($sentform == "1") {
		echo"$contactthankyou";
	} else {
		echo"$text1";
		$tablename = "Contact_" . $pageid;
		
		echo"<table width=\"400px\" align=\"left\" cellpadding=\"0px\" cellspacing=\"5px\" style=\"border:2px solid #e1e1e1; margin-bottom:20px;\">";
		if ($error == 1) {
			echo"
			<tr>
			<td class='fieldname' style='background-color:#FF0000;'>ERROR:</td>
			<td class='fieldbox'>Your answer to the security question at the bottom of the form was incorrect.
			</td>
			</tr>";
		}
		if ($error == 2) {
			echo"
			<tr>
			<td class='fieldname' style='background-color:#FF0000;'>ERROR:</td>
			<td class='fieldbox'>You must fill in all *Required fields
			</td>
			</tr>";
		}

		echo"<form enctype='multipart/form-data' action=\"formmail.php\" method='post'>";
		$count = 0;
		$result = mysql_query("SELECT * FROM $tablename ORDER BY fieldorder ASC");
		while ($r = mysql_fetch_array($result)) {
			$fieldid = ($r['id']);
			$fieldname = ($r['name']);
			$fieldtype = ($r['type']);
			$plain = ($r['plaintext']);
			
			$formid = "form" . $fieldid;
			$value = stripslashes($_SESSION["$formid"]);
		
			echo"<tr>";
			if ($fieldtype == "plaintext") {
				echo "<td colspan='2'><div style='margin:20px 0px 20px 0px;'>$plain</div></td>";
			} else {
				echo "<td class='fieldname'>$fieldname :</td>";
			}
			
			if ($fieldtype == "text") {
				echo "<td class='fieldbox'><input type='text' name=\"$fieldid\" value='$value' size='40' maxlength='40' /></td>";
			}
			if ($fieldtype == "textarea") {
				echo "<td class='fieldbox'><textarea name=\"$fieldid\" cols='31' rows='5'>$value</textarea></td>";
			}
			if ($fieldtype == "checkbox") {
				echo "<td class='fieldbox'>";
				$tablename2 = $tablename . "_" . $fieldid;
				$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$boxid = ($r2['id']);
					$boxname = ($r2['name']);
					$boxorder = ($r2['fieldorder']);
					$identifier = $fieldid . "_" . $boxid;
					echo"<input type='checkbox' name='$identifier' value='1'"; if ($_SESSION["$identifier"] == $boxname) {echo"checked='checked'";} echo"/> $boxname <br />";
				}
				echo"</td>";
			}
			if ($fieldtype == "dropdown") {
				echo "<td class='fieldbox'>";
				$identifier = "dropdown_" . $fieldid;
				echo"<select name='$identifier'>";
				$tablename2 = $tablename . "_" . $fieldid;
				$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$boxid = ($r2['id']);
					$boxname = ($r2['name']);
					$boxorder = ($r2['fieldorder']);
					echo"<option value='$boxname'"; if ($_SESSION["$identifier"] == $boxname) {echo"selected='selected'";} echo">$boxname</option>";
				}
				echo"</select>";
				echo"</td>";
			}
			if ($fieldtype == "radio") {
				echo "<td class='fieldbox'>";
				$tablename2 = $tablename . "_" . $fieldid;
				$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
				while ($r2 = mysql_fetch_array($result2)) {
					$boxid = ($r2['id']);
					$boxname = ($r2['name']);
					$boxorder = ($r2['fieldorder']);
					$identifier = "radio_" . $fieldid;
					echo"<input type='radio' name='$identifier' value='$boxname' "; if ($_SESSION["$identifier"] == $boxname) {echo"checked='checked'";} echo"/> $boxname <br />";
				}
				echo"</td>";
			}
			echo"</tr>";
		
		}
		
			
		echo"
		<tr>
		<td colspan='2'><p style='text-align:center; margin-top:8px; font-size: 12px; color:#000000;'>This is a security question. Please answer.</p></td>
		</td>
		</tr>
		
		<tr>
		<td class='fieldname' style='color:#ff0000; font-weight:bold;'>2 + 2</td>
		<td class='fieldbox'><input type='text' name='usercode' size='40' maxlength='40' />
		</td>
		</tr>

		<tr>
		<td class='fieldname'></td>
		<td class='fieldbox'>
		<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
		<input type=\"hidden\" name=\"contactemail\" value=\"$contactemail\" />
		<input type=\"hidden\" name=\"tablename\" value=\"$tablename\" />
		<input type=\"submit\" name=\"submit\" value=\"Submit\" />
		<input type=\"reset\" name=\"reset\" value=\"Reset\" />
		</form>
		</td>
		</tr>
		</table>";
	}
		
	echo"    
	</div>
	
	<div class='div3'>
	$text2
	</div>
	";
}

// FAQ page type 2 column
if ($pagetype == "FAQ Page") {
	echo"
	<div class='div2'>
	$text1";
	
	$tablename = "ServiceCategories_" . $pageid;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
	while ($r = mysql_fetch_array($result)) {
		$categoryid = ($r['id']);
		$category = ($r['name']);
		$categoryorder = ($r['fieldorder']);
		echo"<a href='index.php?serviceid=$categoryid&id=$pageid'>$category</a> <br />";
	}

	echo"    
	</div>
	
	<div class='div3'>";
		$tablename2 = "Services_" . $pageid;

		if (isset($_GET['serviceid'])) {
			$serviceid = ($_GET['serviceid']);
			$result2 = mysql_query("SELECT * FROM `$tablename2` WHERE `category`='$serviceid' ORDER BY `fieldorder` ASC");	
		} else {
			$result2 = mysql_query("SELECT * FROM `$tablename2` ORDER BY `fieldorder` ASC LIMIT 1");	
		}
		
		
		while ($r2 = mysql_fetch_array($result2)) {
			$serviceid = ($r2['id']);
			$servicename = ($r2['name']);
			$servicecategory = ($r2['category']);
			$serviceorder = ($r2['fieldorder']);
			
			$result = mysql_query("SELECT * FROM `$tablename` WHERE `id`='$servicecategory'");
			$r = mysql_fetch_array($result);
			$category = ($r['name']);
			echo"<strong>$category</strong> <br /><br /> $servicename";
			
		}
	echo"
	</div>
	";
}

/*FAQ page type VERTICAL
if ($pagetype == "FAQ Page") {
	echo"
	<div class='div2'>";
	echo"$text1";
	echo"<div id='listmain'>";
	$listcount = 1;
	$tablename = "ServiceCategories_" . $pageid;
	$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
	while ($r = mysql_fetch_array($result)) {
		$categoryid = ($r['id']);
		$category = ($r['name']);
		$categoryorder = ($r['fieldorder']);
		$listitem = "list_" . $listcount;
		echo"<a href=\"javascript:ShowMe2('$listitem','listmain')\">$category</a> <br />";
		echo"<div id='$listitem' class='hide' style='margin:5px 0px 5px 0px; width:500px; min-height:200px; background-color:#afabb1; padding:5px;'>";
		$tablename2 = "Services_" . $pageid;
		$result2 = mysql_query("SELECT * FROM `$tablename2` WHERE `category`='$categoryid' ORDER BY `fieldorder` ASC");
		$r2 = mysql_fetch_array($result2);
		$servicename = ($r2['name']);
		echo"$servicename";
		echo"</div>";
		$listcount += 1;
	}
	echo"</div>";
	echo"
	</div>
	
	<div class='div3'>";
	echo"$text2";
	echo"
	</div>
	";
}
*/

if ($pagetype == "RSS Page") {
	echo"<div class='div1'>
	$text1";
		require_once 'magpie/rss_fetch.inc'; 
		/* If running my own rss feed
		$rss_file = '/home/yoursite/public_html/path_to_your_feed/yourfeed.xml'; 
		$rss_string = read_file($rss_file); 
		$rss = new MagpieRSS( $rss_string ); 
		*/
		
		/* Calling RSS from other site */
		$url = "$text1";
		$rss = fetch_rss($url);
		
		if ( $rss and !$rss->ERROR) {     
			foreach ($rss->items as $item ) {         
				echo '<a href="' . $item[link] . '" target="_blank">' . $item[title] . '</a><br/>';         
				echo 'Publish Date: ' . $item[pubdate] . '<br /><br />'; 
				$item = str_replace("div", "p", $item[ description ]);        
				echo $item;   
			} 
		} else {     
			echo "RSS Error: " . $rss->ERROR . "<br /><br />" ; 
		} 
	echo"</div>";
}
?>