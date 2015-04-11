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
			$memberid = ($_SESSION['memberloggedin']);
			$membergallery = "MemberGallery_" . $memberid;
			$foldername = "member_" . $memberid;
			$_SESSION['gallerytable'] = "$membergallery";
			
			echo"<table width=\"100%\" align=\"center\" cellpadding=\"0px\" cellspacing=\"0px\">";
			echo"<tr><td align='center'>";
			echo"PHOTO GALLERY";
			echo"</td></tr>";
			
			echo"<tr>";
			echo"<td align='center' valign='top'>";
				
			echo'<div id="sortlist" width="100%" style="border:0px;">';
				
			$result = mysql_query("SELECT * FROM $membergallery ORDER BY `order` ASC");
			while ($r = mysql_fetch_array($result)) {
				$photoid = ($r['id']);
				$photoid2 = "pictureId_" . ($r['id']);
				$filename = ($r['filename']);
				$caption = ($r['caption']);
				$caption = str_replace("\r\n", "<br />", $caption);

				echo "<div class='sorting' id='$photoid2'><img src=\"members/$foldername/thumbs/$filename\" style='width:160px; height:110px;'/><br /><table><tr><td><a href=\"socialcaptions.php?photoid=$photoid\"><img src='images/caption.jpg' /></a></td><td><a href=\"members/$foldername/$filename\" style='border:0px;' class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='images/zoom.jpg' style='border:0px;'/></a><div class=\"highslide-caption\" style='color:#000000;'>$caption</div></td><td><a href=\"socialremovephoto.php?photoid=$photoid&filename=$filename\" onclick=\"return confirm('Are you sure you want to delete this photo?');\" ><img src='images/delete.jpg' /></a></td></tr></table></div>";
			}
				
			echo"</div>";
			
			echo"</td>";
			echo"</tr>";
			
			echo"<tr><td align='center' colspan='3' style=\"border-top:0px solid #202120;\">";
				echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"5px\">";
				echo"<tr><td align='center'>";
				echo"<form enctype='multipart/form-data' action=\"socialaddphoto.php\" method='post'>
					<input name='pic' type='file' />
					<input type='hidden' name='tablename' value=\"$membergallery\" />
					<input type='hidden' name='foldername' value=\"$foldername\" />
					<input type='submit' name='submit' value='Upload New Photo' />
					</form>";
				echo"</td></tr>";
				echo"<tr><td align='center'>";
				if ($message == 1) { echo"You can only upload image files!"; }
				echo"</td></tr>";
				echo"</table>";
			echo"</td></tr>";
			echo"<tr><td align='center' colspan='3'>";
			if ($error == 6) { echo"You can only upload image files!"; }
			echo"</td></tr>";
			echo"</table>";
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
        
        <tr>
        <td class='text2'>
        <div class='div2'>
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
