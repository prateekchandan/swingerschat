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

if (isset ($_POST['submit'])) {
	$pageid = $_POST['pageid'];
	$name = ($_POST['name']);
	$title = ($_POST['title']);
	$description = ($_POST['description']);
	$keywords = ($_POST['keywords']);
	$nav1 = ($_POST['nav1']);
	$nav2 = ($_POST['nav2']);
	$nav3 = ($_POST['nav3']);
	$mobile = ($_POST['mobile']);
	$text1= ($_POST['text1']);
	$text2= ($_POST['text2']);
	$text3= ($_POST['text3']);
	$text4= ($_POST['text4']);
	$text5= ($_POST['text5']);
        $dropdownpageid = ($_POST['dropdownpageid']);
	$copyright = mysql_real_escape_string($_POST['copyright']);
	$contactemail = ($_POST['contactemail']);
	$contactthankyou = ($_POST['contactthankyou']);
	$membersonly = ($_POST['membersonly']);
	if ($membersonly != 1) {
		$membersonly = 0;
	}
	
	if (empty($_POST['name'])) {
		header("Location: editpage?pageid=$pageid&message=1");
		exit;
	}
	
	mysql_query("UPDATE `pages` SET `name`='$name', `title`='$title', `description`='$description', `keywords`='$keywords', `nav1`='$nav1', `nav2`='$nav2', `nav3`='$nav3', `mobile`='$mobile', `text1`='$text1', `text2`='$text2', `text3`='$text3', `text4`='$text4', `text5`='$text5', `copyright`='$copyright', `contactemail`='$contactemail', `contactthankyou`='$contactthankyou', `membersonly`='$membersonly', `target`='$dropdownpageid' WHERE `id` = '$pageid' ");
	
	require('includes/smarturls.php');
	
	header("Location: adminhome.php?message=1");
	exit;

} else {

$message = ($_GET['message']);
$pageid = ($_GET['pageid']);
$result = mysql_query("SELECT * FROM pages WHERE id = $pageid");
$r = mysql_fetch_array($result);
$pagetype = ($r['type']);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$nav1 = ($r['nav1']);
$nav2 = ($r['nav2']);
$nav3 = ($r['nav3']);
$mobile = ($r['mobile']);
$text1= ($r['text1']);
$text2= ($r['text2']);
$text3= ($r['text3']);
$text4= ($r['text4']);
$text5= ($r['text5']);
$copyright = ($r['copyright']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);
$target = ($r['target']);


echo"
	<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">
	<form enctype=\"multipart/form-data\" action=\"editpage.php\" method=\"post\">";
	
	if ($message == 1) {
		echo"
		<tr>
		<td class=\"editpageleft\" style='background-color:#FF0000;'>Error:</td>
		<td class=\"editpageright\">You must have a name for the page!
		</td>
		<td class=\"editpagehints\">
		</td>
		</tr>";
	}
	
	//Edit Dropdown Menu
	if ($pagetype == "Dropdown Menu") {
		echo"
		<tr>
		<td class=\"editpageleft\">Page Name:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
		<input type=\"hidden\" name=\"nav1\" value=\"1\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the name users will see in the page navigation butons.
		</td>
		</tr>";
                
                echo"
		<tr>
		<td class=\"editpageleft\">Target Page:</td>
		<td class=\"editpageright\">";
                echo"<select name='dropdownpageid'>";
                $result = mysql_query("SELECT * FROM `pages` WHERE `type` != 'Dropdown Menu'");
                while ($r = mysql_fetch_array($result)) {
                    $dropdownpageid = ($r['id']);
                    $dropdownpagename = ($r['name']);
                    echo"<option value=\"$dropdownpageid\""; if ($target == $dropdownpageid) {echo"selected='selected'";} echo">$dropdownpagename</option>";
                }
                echo"</select>";
                echo"
		</td>
		<td class=\"editpagehints\">
		This is the page users will be directed to when they click this page name directly.
		</td>
		</tr>";
		
		$tablename = "Dropdown_" . $pageid;
		echo"
		<tr>
		<td class=\"editpageleft\">Edit Dropdown Pages:</td>
		<td class=\"editpageright\">
			<table cellpadding='2px' cellspacing='2px' border='0px' align='left'>";
			$result = mysql_query("SELECT * FROM `$tablename` ORDER BY pageorder ASC");
			while ($r = mysql_fetch_array($result)) {
				$dropdowntableid = ($r['id']);
				$dropdownpageid = ($r['pageid']);
				$dropdownpageorder = ($r['pageorder']);
				$dropdownpagetype = ($r['type']);
				$result2 = mysql_query("SELECT * FROM `pages` WHERE `id` = '$dropdownpageid'");
				$r2 = mysql_fetch_array($result2);
				$dropdownpagename = ($r2['name']);
				echo"<tr>";
				echo"<td class='formname'>$dropdownpagename</td>";
				echo"<td class='formtype'>$dropdownpagetype</td>";
				echo"<td class='formright' valign='middle'>";
					echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
					echo"
					<a href=\"dropdownpageorderup.php?pageid=$pageid&dropdowntableid=$dropdowntableid&dropdownpageorder=$dropdownpageorder&tablename=$tablename\"><img src=\"images/arrowup.jpg\" /></a>";
					echo"</td></tr><tr><td>";
					echo"<a href=\"dropdownpageorderdown.php?pageid=$pageid&dropdownpageorder=$dropdownpageorder&tablename=$tablename&dropdowntableid=$dropdowntableid\"><img src=\"images/arrowdown.jpg\" /></a>";
					echo"</td></tr></table>";
					echo"</td>";
					echo"<td class='formright' valign='middle'><a href=\"deletedropdownpage.php?pageid=$pageid&tablename=$tablename&dropdowntableid=$dropdowntableid\"><img src=\"images/trashcan.jpg\" /></a></td>";
					echo"</tr>";
			}
				echo"<tr>";
				echo"<td colspan='4' align='center'><a href='adddropdownpage.php?pageid=$pageid&tablename=$tablename'>Add New Page to Dropdown Menu</a></td>";
				echo"</tr>";
			echo"</table>
		</td>
		<td class=\"editpagehints\">
		This will edit the pages in your dropdown menu.
		</td>
		</tr>";

	} else {
		
		//Edit Album Page
		if ($pagetype == "Album Page") {
			$tablename = "Album_" . $pageid;
			echo"
			<tr>
			<td class=\"editpageleft\">Edit Album:</td>
			<td class=\"editpageright\" align='center'>";
			
				echo"<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
				echo"<tr><td align='left'>";
				echo"<br /><a href=\"addalbum.php?tablename=$tablename&pageid=$pageid\">Add New Photo Gallery</a><br />";
				echo"</td></tr>";
				
				echo"<tr><td align='left'>";
				$count = 0;
				$result = mysql_query("SELECT * FROM $tablename ORDER BY `id` ASC");
				$rows = mysql_num_rows($result);
				if ($rows < 1) {
					echo"<br />There are no galleries in your album.<br />Add one using the tool above.";
				}  else {
					echo"<br /><strong>Current Gallery Pages</strong><br />";
					while ($r = mysql_fetch_array($result)) {
						$spotid = ($r['id']);
						$galleryid = ($r['pageid']);
						$result2 = mysql_query("SELECT * FROM `pages` WHERE `id` = '$galleryid'");
						$r2 = mysql_fetch_array($result2);
						$galleryname = ($r2['name']);
						echo"<a href=\"deletealbum.php?pageid=$pageid&tablename=$tablename&galleryid=$spotid\" onclick=\"return confirm('Are you sure you want to remove this gallery from this album?');\" style='font-size:10px; color:#ff0000;'>DELETE</a> &nbsp;&nbsp;";
						echo"$galleryname <br />";
					}
				}
				
				echo"</td></tr>";
				
				echo"</table>";

			
			echo"
			</td>
			<td class=\"editpagehints\">
			Edit the galleries which display in this photo album.
			</td>
			</tr>";
		}
	
		//Edit Photo Gallery
		if (($pagetype == "Photo Gallery") || ($pagetype == "Photo Gallery 2")) {
			$tablename = "Gallery_" . $pageid;
			$_SESSION['gallerytable'] = "Gallery_" . $pageid;
			$_SESSION['cellblock'] = "picorder";
			echo"
			<tr>
			<td class=\"editpageleft\">Edit Photo Gallery:</td>
			<td class=\"editpageright\" align='center'>";
			
				echo"<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
				echo"<tr><td align='center'>";
				echo"<br /><a href=\"addphoto.php?tablename=$tablename&pageid=$pageid\">Add New Photo</a>";
				echo"</td></tr>";
				echo"</table>";

				echo'<div id="sortlist" width="100%" style="border:0px;">';
				
				$count = 0;
				$result = mysql_query("SELECT * FROM $tablename ORDER BY `picorder` ASC");
				while ($r = mysql_fetch_array($result)) {
					$photoid = ($r['id']);
					$photoid2 = "pictureId_" . ($r['id']);
					$filename = ($r['filename']);
					$caption = ($r['caption']);
	
					echo "<div class='sorting' id='$photoid2'><img src=\"../$tablename/thumbs/$filename\" style='width:160px; height:110px;'/><br /><table><tr><td><a href=\"captions.php?tablename=$tablename&photoid=$photoid&filename=$filename&pageid=$pageid\"><img src='images/caption.png' /></a></td><td><a href=\"../$tablename/$filename\" style='border:0px;' class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='images/zoom.png' style='border:0px;'/></a><div class=\"highslide-caption\" style='color:#000000;'>$caption</div></td><td><a href=\"deletephoto.php?tablename=$tablename&photoid=$photoid&filename=$filename&pageid=$pageid\" onclick=\"return confirm('Are you sure you want to delete this photo?');\" ><img src='images/delete.png' /></a></td></tr></table></div>";
					

				}
				
				echo"</div>";
				
				
			
			echo"
			</td>
			<td class=\"editpagehints\">
			Edit the images which display in your photo gallery.
			</td>
			</tr>";
		}
		
		// Edit Contact Form
		if ($pagetype == "Contact Form" || $pagetype == "Contact Form 2") {
			$tablename = "Contact_" . $pageid;
			$_SESSION['gallerytable'] = "Contact_" . $pageid;
			$_SESSION['cellblock'] = "fieldorder";
			echo"
			<tr>
			<td class=\"editpageleft\">Edit Contact Form:</td>
			<td class=\"editpageright\">
				
				<div id='sortlist' width='100%' style='border:0px;'>";
				$result = mysql_query("SELECT * FROM $tablename ORDER BY fieldorder ASC");
				while ($r = mysql_fetch_array($result)) {
					$fieldid = ($r['id']);
					$photoid2 = "pictureId_" . ($r['id']);
					$fieldname = ($r['name']);
					$fieldorder = ($r['fieldorder']);
					$fieldtype = ($r['type']);
					$plain = ($r['plaintext']);
					$plain = substr($plain, 0, 150);
					$plain .= "...";
					echo"<div class='sorting' id='$photoid2' style='width:500px;' >";
					if ($fieldtype == "plaintext") {
						echo "<div class='formname' style='color:#cccccc;'>$plain <br />";
					} else {
						echo"<div class='formname'>$fieldname <br />";
					}
					//checkbox
					if ($fieldtype == "checkbox") {
						$tablename2 = $tablename . "_" . $fieldid;
						$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
						while ($r2 = mysql_fetch_array($result2)) {
							$boxid = ($r2['id']);
							$boxname = ($r2['name']);
							$boxorder = ($r2['fieldorder']);
							echo"<br /><div style='padding:2px; margin-left:25px;'>";
							echo"<table><tr><td>";
								echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
								echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowup.jpg\" width='15px'/></a>";
								echo"</td></tr><tr><td>";
								echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowdown.jpg\" width='15px'/></a>";
								echo"</td></tr></table>";
							echo"</td>";
							echo"<td><a href=\"editcheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/edit.jpg\" width='15px'/></a></td>";
							echo"<td><a href=\"deletecheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\" onclick=\"return confirm('Are you sure you want to delete this checkbox?');\"><img src=\"images/trashcan.jpg\" width='15px'/></a></td>";
							echo"<td style='background-color:#eaf8fc; width:300px;'>$boxname</td>";
							echo"</tr></table>";
							echo"</div>";
						}
						echo"<br /><div style='margin-left:25px;'><a href='addfieldcheckbox.php?tablename=$tablename2&pageid=$pageid&fieldid=$fieldid'>Add New Checkbox</a></div>";
					}
					
					//checkbox
					if ($fieldtype == "dropdown") {
						$tablename2 = $tablename . "_" . $fieldid;
						$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
						while ($r2 = mysql_fetch_array($result2)) {
							$boxid = ($r2['id']);
							$boxname = ($r2['name']);
							$boxorder = ($r2['fieldorder']);
							echo"<br /><div style='padding:2px; margin-left:25px;'>";
							echo"<table><tr><td>";
								echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
								echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowup.jpg\" width='15px'/></a>";
								echo"</td></tr><tr><td>";
								echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowdown.jpg\" width='15px'/></a>";
								echo"</td></tr></table>";
							echo"</td>";
							echo"<td><a href=\"editcheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/edit.jpg\" width='15px'/></a></td>";
							echo"<td><a href=\"deletecheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\" onclick=\"return confirm('Are you sure you want to delete this option?');\"><img src=\"images/trashcan.jpg\" width='15px'/></a></td>";
							echo"<td style='background-color:#eaf8fc; width:300px;'>$boxname</td>";
							echo"</tr></table>";
							echo"</div>";
						}
						echo"<br /><div style='margin-left:25px;'><a href='addfieldcheckbox.php?tablename=$tablename2&pageid=$pageid&fieldid=$fieldid'>Add New Dropdown Item</a></div>";
					}
					
					//checkbox
					if ($fieldtype == "radio") {
						$tablename2 = $tablename . "_" . $fieldid;
						$result2 = mysql_query("SELECT * FROM $tablename2 ORDER BY fieldorder ASC");
						while ($r2 = mysql_fetch_array($result2)) {
							$boxid = ($r2['id']);
							$boxname = ($r2['name']);
							$boxorder = ($r2['fieldorder']);
							echo"<br /><div style='padding:2px; margin-left:25px;'>";
							echo"<table><tr><td>";
								echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
								echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowup.jpg\" width='15px'/></a>";
								echo"</td></tr><tr><td>";
								echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$boxorder&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/arrowdown.jpg\" width='15px'/></a>";
								echo"</td></tr></table>";
							echo"</td>";
							echo"<td><a href=\"editcheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\"><img src=\"images/edit.jpg\" width='15px'/></a></td>";
							echo"<td><a href=\"deletecheckboxfield.php?pageid=$pageid&tablename=$tablename2&fieldid=$boxid\" onclick=\"return confirm('Are you sure you want to delete this option?');\"><img src=\"images/trashcan.jpg\" width='15px'/></a></td>";
							echo"<td style='background-color:#eaf8fc; width:300px;'>$boxname</td>";
							echo"</tr></table>";
							echo"</div>";
						}
						echo"<br /><div style='margin-left:25px;'><a href='addfieldcheckbox.php?tablename=$tablename2&pageid=$pageid&fieldid=$fieldid'>Add New Radio Option</a></div>";
					}
					
					echo"</div>";
					
					echo"<div class='formtype'>$fieldtype</div>";
					echo"<div class='formright' valign='middle'><a href=\"editfield.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/edit.jpg\" /></a></div>";
					echo"<div class='formright' valign='middle'><a href=\"deletefield.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\" onclick=\"return confirm('Are you sure you want to delete this field?');\"><img src=\"images/trashcan.jpg\" /></a></div>";
					echo"</div>";
				}
				echo"<div style='clear:both;'></div>";
				echo"</div>";
				
				echo"<div style='clear:both;'></div>";
				echo"<div align='center'><a href='addfield.php?pageid=$pageid&tablename=$tablename'>Add New Field</a></div>";
				echo"
				
			</td>
			<td class=\"editpagehints\">
			This will edit the fields in your contact form.
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class=\"editpageleft\">Contact Form E-mail:</td>
			<td class=\"editpageright\">
			<input type=\"text\" name=\"contactemail\" value=\"$contactemail\" size=\"75\" maxlength=\"70\"/>
			</td>
			<td class=\"editpagehints\">
			This is the e-mail address your form results will be sent to.
			</td>
			</tr>
			
			<tr>
			<td class=\"editpageleft\">Thank You Text:</td>
			<td class=\"editpageright\">
			<textarea id=\"contactthankyou\" name=\"contactthankyou\">$contactthankyou</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'contactthankyou' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This is the text that will display after a user submits the form.
			</td>
			</tr>";
		}
		
		// Edit Service and FAQ Page
		if (($pagetype == "Service Page") || ($pagetype == "FAQ Page")) {
			$tablename = "ServiceCategories_" . $pageid;
			echo"
			<tr>
			<td class=\"editpageleft\">Service Categories:</td>
			<td class=\"editpageright\">
				<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%'>";
				$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
				while ($r = mysql_fetch_array($result)) {
					$fieldid = ($r['id']);
					$fieldname = ($r['name']);
					$fieldorder = ($r['fieldorder']);
					echo"<tr>";
					echo"<td class='formname'>$fieldname</td>";
					echo"<td class='formright' valign='middle'>";
						echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
						echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$fieldorder&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/arrowup.jpg\" /></a>";
						echo"</td></tr><tr><td>";
						echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$fieldorder&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/arrowdown.jpg\" /></a>";
						echo"</td></tr></table>";
					echo"</td>";
					echo"<td class='formright' valign='middle'><a href=\"editservicecategory.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/edit.jpg\" /></a></td>";
					echo"<td class='formright' valign='middle'><a href=\"deletefield.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/trashcan.jpg\" /></a></td>";
					echo"</tr>";
				}
					echo"<tr>";
					echo"<td colspan='4' align='left'><a href='addservicecategory.php?pageid=$pageid&tablename=$tablename'>Add New Category</a></td>";
					echo"</tr>";
				echo"</table>
			</td>
			<td class=\"editpagehints\">
			This will edit the available categories for this page.
			</td>
			</tr>";
			
			echo"
			<tr>
			<td class=\"editpageleft\">Services:</td>
			<td class=\"editpageright\">";
			$tablename2 = "Services_" . $pageid;
			$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
				echo"<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%'>";
				while ($r = mysql_fetch_array($result)) {
					$categoryid = ($r['id']);
					$category = ($r['name']);
					$categoryorder = ($r['fieldorder']);
					echo"<tr><td align='left' valign='top' style='background-color:#f6f6f6;'><strong>$category</strong></td></tr>";
					echo"<tr><td align='left' valign='top'>";	
						$result2 = mysql_query("SELECT * FROM `$tablename2` WHERE `category`='$categoryid' ORDER BY `fieldorder` ASC");
							echo"<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%'>";
							while ($r2 = mysql_fetch_array($result2)) {
								$serviceid = ($r2['id']);
								$servicename = stripslashes($r2['name']);
								$serviceorder = ($r2['fieldorder']);
								$serviceprice = ($r2['price']);
								echo"<tr>";
								echo"<td class='formname' width='50%'>$servicename</td>";
								echo"<td class='formname' width='20%'>$serviceprice</td>";
								echo"<td class='formright' valign='middle' width='8%'>";
									echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
									echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$serviceorder&tablename=$tablename2&fieldid=$serviceid\"><img src=\"images/arrowup.jpg\" /></a>";
									echo"</td></tr><tr><td>";
									echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$serviceorder&tablename=$tablename2&fieldid=$serviceid\"><img src=\"images/arrowdown.jpg\" /></a>";
									echo"</td></tr></table>";
								echo"</td>";
								echo"<td class='formright' valign='middle' width='8%'><a href=\"editservice.php?pageid=$pageid&tablename=$tablename2&fieldid=$serviceid\"><img src=\"images/edit.jpg\" /></a></td>";
								echo"<td class='formright' valign='middle' width='8%'><a href=\"deletefield.php?pageid=$pageid&tablename=$tablename2&fieldid=$serviceid\"><img src=\"images/trashcan.jpg\" /></a></td>";
								echo"</tr>";
							}
							echo"</table>";
					echo"</td></tr>";
				}
				echo"<tr><td align='left' valign='top'><a href=\"addnewservice.php?pageid=$pageid&tablename=$tablename2\">Add New Service</a></td></tr>";	
				echo"</table>";
			
			echo"		
			</td>
			<td class=\"editpagehints\">
			This will edit the current services for this page.
			</td>
			</tr>";
		}
		
		// END edit Service page
		
		// Edit Profile Page
		if ($pagetype == "Profile Page") {
			$tablename = "Profile_" . $pageid;
			echo"
			<tr>
			<td class=\"editpageleft\">Edit Profile's:</td>
			<td class=\"editpageright\">
				<table cellpadding='2px' cellspacing='2px' border='0px' align='left' width='100%'>";
				$result = mysql_query("SELECT * FROM `$tablename` ORDER BY `fieldorder` ASC");
				while ($r = mysql_fetch_array($result)) {
					$fieldid = ($r['id']);
					$fieldname = ($r['name']);
					$fieldorder = ($r['fieldorder']);
					echo"<tr>";
					echo"<td class='formname'>$fieldname</td>";
					echo"<td class='formright' valign='middle' width='10%'>";
						echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
						echo"<a href=\"fieldorderup.php?pageid=$pageid&fieldorder=$fieldorder&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/arrowup.jpg\" /></a>";
						echo"</td></tr><tr><td>";
						echo"<a href=\"fieldorderdown.php?pageid=$pageid&fieldorder=$fieldorder&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/arrowdown.jpg\" /></a>";
						echo"</td></tr></table>";
					echo"</td>";
					echo"<td class='formright' valign='middle' width='10%'><a href=\"editprofile.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\"><img src=\"images/edit.jpg\" /></a></td>";
					echo"<td class='formright' valign='middle' width='10%'><a href=\"deletefield.php?pageid=$pageid&tablename=$tablename&fieldid=$fieldid\" onclick=\"return confirm('Are you sure you want to delete this profile?');\"><img src=\"images/trashcan.jpg\" /></a></td>";
					echo"</tr>";
				}
					echo"<tr>";
					echo"<td colspan='4' align='left'><a href='addprofile.php?pageid=$pageid&tablename=$tablename'>Add New Profile</a></td>";
					echo"</tr>";
				echo"</table>
			</td>
			<td class=\"editpagehints\">
			This will edit the profiles on this page.
			</td>
			</tr>";
		}
			
		// END Profile Page
		
		echo"
		<tr>
		<td class=\"editpageleft\">Members Only:</td>
		<td class=\"editpageright\">
		<input type=\"checkbox\" name=\"membersonly\" value=\"1\""; if ($membersonly == 1) {echo"checked='checked'";} echo"/>
		</td>
		<td class=\"editpagehints\">
		Only members who are logged in will be able to access this page.
		</td>
		</tr>
		";
		
		echo"
		<tr>
		<td class=\"editpageleft\">Page Name:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"name\" value=\"$name\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the name users will see in the page navigation butons.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Page Title:</td>
		<td class=\"editpageright\">
		<input type=\"text\" name=\"title\" value=\"$title\" size=\"75\" maxlength=\"70\"/>
		</td>
		<td class=\"editpagehints\">
		This is the title of the page. This text will appear in the browser tab.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Page Description:</td>
		<td class=\"editpageright\">
		<textarea id=\"description\" name=\"description\" cols=\"62\" rows=\"10\">$description</textarea>
		</td>
		<td class=\"editpagehints\">
		This is the description of the page. User's will not see this on your site, but sometimes this text will be used by search engines to describe your site.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">SEO URL:</td>
		<td class=\"editpageright\">
		<textarea id=\"keywords\" name=\"keywords\" cols=\"62\" rows=\"5\">$keywords</textarea>
		</td>
		<td class=\"editpagehints\">
		This will be the SEO safe URL for this page.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Main Navigation:</td>
		<td class=\"editpageright\">";
		if ($nav1 == 1) { 
			echo"<input type=\"checkbox\" name=\"nav1\" value=\"1\" checked=\"checked\"/>";
		} else {
			echo"<input type=\"checkbox\" name=\"nav1\" value=\"1\" />";
		}
		echo"
		</td>
		<td class=\"editpagehints\">
		Check this box if you want this page to display in the main navigation of the site.
		</td>
		</tr>
		
		<tr>
		<td class=\"editpageleft\">Footer Navigation:</td>
		<td class=\"editpageright\">";
		if ($nav3 == 1) { 
			echo"<input type=\"checkbox\" name=\"nav3\" value=\"1\" checked=\"checked\"/>";
		} else {
			echo"<input type=\"checkbox\" name=\"nav3\" value=\"1\" />";
		}
		echo"
		</td>
		<td class=\"editpagehints\">
		Check this box if you want this page to display in the footer navigation of the site.
		</td>
		</tr>";
		
		/*
		 echo"
		 <tr>
		<td class=\"editpageleft\">Mobile Navigation:</td>
		<td class=\"editpageright\">";
		if ($mobile == 1) { 
			echo"<input type=\"checkbox\" name=\"mobile\" value=\"1\" checked=\"checked\"/>";
		} else {
			echo"<input type=\"checkbox\" name=\"mobile\" value=\"1\" />";
		}
		echo"
		</td>
		<td class=\"editpagehints\">
		Check this box if you want this page to display in the mobile website.
		</td>
		</tr>";
		*/
		
		
		// If RSS Feed
		
		if ($pagetype == "RSS Page") {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 1:</td>
			<td class=\"editpageright\">
			<input type=\"text\" name=\"text1\" value=\"$text1\" size=\"75\" maxlength=\"70\"/>
			</td>
			<td class=\"editpagehints\">
			This is the link to the RSS Feed page.
			</td>
			</tr>";
		}
		
		
		
		// Edit Text Section 1
		if (($pagetype != "Blog") && ($pagetype != "Store") && ($pagetype != "RSS Page") && ($pagetype != "External Link")) {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 1:</td>
			<td class=\"editpageright\">
			<textarea id=\"text1\" name=\"text1\">$text1</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text1' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This text will appear in the main content section of your page.
			</td>
			</tr>";
		}
		
		
		// Edit Text Section 2
		if (($pagetype != "Blog") && ($pagetype != "Store") && ($pagetype != "RSS Page") && ($pagetype != "External Link")) {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 2:</td>
			<td class=\"editpageright\">
			<textarea id=\"text2\" name=\"text2\">$text2</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text2' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This text will appear in the secondary content section of your page.
			</td>
			</tr>";
		}
		
		// Edit Text Section 3
		if (($pagetype != "Blog") && ($pagetype != "Store") && ($pagetype != "RSS Page") && ($pagetype != "External Link")) {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 3:</td>
			<td class=\"editpageright\">
			<textarea id=\"text3\" name=\"text3\">$text3</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text3' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This text will appear in the third content section of your page.
			</td>
			</tr>";
		}
		
		// Edit Text Section 4
		if (($pagetype != "Blog") && ($pagetype != "Store") && ($pagetype != "RSS Page") && ($pagetype != "External Link")) {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 4:</td>
			<td class=\"editpageright\">
			<textarea id=\"text4\" name=\"text4\">$text4</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text4' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This text will appear in the fourth content section of your page.
			</td>
			</tr>";
		}
		
		// Edit Text Section 5
		if (($pagetype != "Blog") && ($pagetype != "Store") && ($pagetype != "RSS Page") && ($pagetype != "External Link")) {
			echo"
			<tr>
			<td class=\"editpageleft\">Text Section 5:</td>
			<td class=\"editpageright\">
			<textarea id=\"text5\" name=\"text5\">$text5</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'text5' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This text will appear in the fifth content section of your page.
			</td>
			</tr>";
		}
		
		if ($pagetype == "External Link") {
			echo"
			<tr>
			<td class=\"editpageleft\">URL:</td>
			<td class=\"editpageright\">
			<input type=\"text\" name=\"copyright\" value=\"$copyright\" size=\"75\" maxlength=\"70\"/>
			</td>
			<td class=\"editpagehints\">
			This is the URL that the user will be directed to.
			</td>
			</tr>";
		} else {
			/*
			 echo"
			<tr>
			<td class=\"editpageleft\">Copyright Text:</td>
			<td class=\"editpageright\">
			<textarea id=\"copyright\" name=\"copyright\">$copyright</textarea>
			<script type='text/javascript'>
			CKEDITOR.replace( 'copyright' );
			</script>
			</td>
			<td class=\"editpagehints\">
			This is the text that will show up at the very bottom of the page.
			</td>
			</tr>";
			*/
		}
		

	}
	echo"
	<tr>
	<td></td>
	<td align=\"left\" valign=\"top\">
	<input type=\"hidden\" name=\"pageid\" value=\"$pageid\" />
	<input type=\"submit\" name=\"submit\" value=\"Save Changes\" />
	<a href=\"adminhome.php?message=3\">Go back without saving.</a>
	<br /><br />
	</form>
	</td>
	</tr>
    </table>";
}
?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




