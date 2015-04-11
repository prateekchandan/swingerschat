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
			$memberid = ($_GET['memberid']);
			$foldername = "member_" . $memberid;
			$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r = mysql_fetch_array($result);
			$username = ($r['username']);
			$first = ($r['first']);
			$last = ($r['last']);
			$photo = ($r['photo']);
			$city = ($r['city']);
			$state = ($r['state']);
			$description = stripslashes($r['description']);
			$gender = ($r['gender']);
			$relationship = ($r['relationship']);
			$college = ($r['college']);
			$age = ($r['age']);
			$height = ($r['height']);
			$height2 = ($r['height2']);
			$status = ($r['status']);
			$kids = ($r['kids']);
			$relationship = ($r['relationship']);
			$profession = ($r['profession']);
			$ethnicity = ($r['ethnicity']);
			$faith = ($r['faith']);
			$eyes = ($r['eye']);
			$hair = ($r['hair']);
			$bodytype = ($r['body']);
			$education = ($r['education']);
			$smoking = ($r['smoking']);
			$firstdate = ($r['firstdate']);
			$feature1 = ($r['feature1']);
			$feature2 = ($r['feature2']);
			$music1 = ($r['music1']);
			$music2 = ($r['music2']);
			$book = ($r['book']);
			$movie = ($r['movie']);
			$food = ($r['food']);
			$drink = ($r['drink']);
			$establishment1 = ($r['establishment1']);
			$establishment2 = ($r['establishment2']);
			$establishment3 = ($r['establishment3']);
			$politics = ($r['politics']);
			$whoiam = wordwrap($r['whoiam'], 30, "<br />", true);
			$whoiseek = wordwrap($r['whoiseek'], 30, "<br />", true);
			?>
				<table cellpadding="0" cellspacing="0px" border="0" width="100%">
				<tr>
				<td align="left">
					<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
                    <?php
					if ($memberid == ($_SESSION['memberloggedin'])) {
						echo"
						<tr>
						<td align='left' valign='top' colspan='3' style='border-bottom:4px dotted #e7eef9;'>
						<strong>My Profile:</strong>
						<a href='socialeditprofile.php'>Edit Profile</a>
						</td>
						</tr>";
					}
					?>
                    
                    
                    
					<tr>
					<td align="left" valign="top" width="190px">
					<?php 
					if ($photo != "noimage.jpg") {
						echo"<a href=\"members/$foldername/$photo\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='members/$foldername/$photo' width='180px' height='200px'/></a>"; 
					} else {
						if ($gender == "Male") {
							echo"<img src='images/noimage_male.jpg' width='180px' height='200px'/>";
						} else {
							echo"<img src='images/noimage_female.jpg' width='180px' height='200px'/>";
						}
					}
					?>
					</td>
					
					<td align="left" valign="top" class="memberprofile">
						<table cellpadding="5px" cellspacing="0px" border="0" align="left">
						<?php
						echo"<tr>";
						echo"<td class='socialprofile'><strong>USERNAME:</strong></td>";
						echo"<td align='left' valign='top'>$username</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>NAME:</strong></td>";
						echo"<td align='left' valign='top'>$first $last</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>CITY:</strong></td>";
						echo"<td align='left' valign='top'>$city</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>STATE:</strong></td>";
						echo"<td align='left' valign='top'>$state</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>GENDER:</strong></td>";
						echo"<td align='left' valign='top'>$gender</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>AGE:</strong></td>";
						echo"<td align='left' valign='top'>$age</td>";
						echo"</tr>";   
						echo"<tr>";
						echo"<td class='socialprofile'><strong>HEIGHT:</strong></td>";
						echo"<td align='left' valign='top'>$height ft. $height2 in.</td>";
						echo"</tr>";      
						?>
						</table>
					</td>
					
					<td align="left" valign="top" width="150px">
					<img src='images/4logos.jpg' />
		
					</td>
					</tr>
                    
                    <tr>
					<td align="left" valign="top" colspan='3' style='border-bottom:4px dotted #e7eef9;'>
                    <br />
                    <strong>My Parameters</strong>
                    </td>
                    </tr>
                    
                    <tr>
					<td align="left" valign="top" colspan='3'>
                    
                    	<table cellpadding="5px" cellspacing="0" border="0" align="center" width='100%'>
                        <tr>
                        <td align='left' valign='top' width='50%'>
                            <table cellpadding="5px" cellspacing="2px" border="0" align="left">
                            <?php
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Relationship Status:</td>";
                            echo"<td class='socialprofileright2'>$relationship</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Kids:</td>";
                            echo"<td class='socialprofileright2'>$kids</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Profession:</td>";
                            echo"<td class='socialprofileright2'>$profession</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Ethnicity:</td>";
                            echo"<td class='socialprofileright2'>$relationship</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Faith:</td>";
                            echo"<td class='socialprofileright2'>$faith</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Eye Color:</td>";
                            echo"<td class='socialprofileright2'>$eyes</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Hair Color:</td>";
                            echo"<td class='socialprofileright2'>$hair</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Body Type:</td>";
                            echo"<td class='socialprofileright2'>$bodytype</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Education:</td>";
                            echo"<td class='socialprofileright2'>$education</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Smoking:</td>";
                            echo"<td class='socialprofileright2'>$smoking</td>";
                            echo"</tr>"; 
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>First Date:</td>";
                            echo"<td class='socialprofileright2'>$firstdate</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Best Physical Feature:</td>";
                            echo"<td class='socialprofileright2'>$feature1</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>2nd Best Physical Feature:</td>";
                            echo"<td class='socialprofileright2'>$feature2</td>";
                            echo"</tr>";   
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Type of Music:</td>";
                            echo"<td class='socialprofileright2'>$music1</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>2nd Favorite Type of Music:</td>";
                            echo"<td class='socialprofileright2'>$music2</td>";
                            echo"</tr>";  
                            ?>
                            </table>
                    	</td>
                        
                        <td align='left' valign='top' width='50%'>
                            <table cellpadding="5px" cellspacing="2px" border="0" align="left">
                            <?php
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Book:</td>";
                            echo"<td class='socialprofileright2'>$book</td>";
                            echo"</tr>";  
                            
                            echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Movie:</td>";
                            echo"<td class='socialprofileright2'>$movie</td>";
                            echo"</tr>";  
                            
							echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Food:</td>";
                            echo"<td class='socialprofileright2'>$food</td>";
                            echo"</tr>";   
							
							echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Drink:</td>";
                            echo"<td class='socialprofileright2'>$drink</td>";
                            echo"</tr>";  
							
							echo"<tr>";
                            echo"<td class='socialprofileleft2'>Favorite Establishment:</td>";
                            echo"<td class='socialprofileright2'>$establishment1</td>";
                            echo"</tr>";  
							
							echo"<tr>";
                            echo"<td class='socialprofileleft2'>2nd Favorite Establishment:</td>";
                            echo"<td class='socialprofileright2'>$establishment2</td>";
                            echo"</tr>";  
							
							echo"<tr>";
                            echo"<td class='socialprofileleft2'>3rd Favorite Establishment:</td>";
                            echo"<td class='socialprofileright2'>$establishment3</td>";
                            echo"</tr>";  
                            ?>
                            </table>
                    	</td>
                        </tr>
                        </table>
                        
                   	    
                        
                    <tr>
					<td align="left" valign="top" colspan='3' >
                    	
                        <table cellpadding="5px" cellspacing="0" border="0" align="center" width='100%'>
                        <tr>
                        <td align='left' valign='top' width='50%' style='border-bottom:4px dotted #e7eef9;'>
                        <strong>Who I am:</strong>
                        </td>
                        
                        <td align='left' valign='top' width='50%' style='border-bottom:4px dotted #e7eef9;'>
                        <strong>Who I seek:</strong>
                        </td>
                        </tr>
                        
                        <tr>
                        <td align='left' valign='top' width='50%' style='border-bottom:0px dotted #e7eef9;'>
                        <div style='margin:20px;'>
                        <?php echo"$whoiam"; ?>
                        </div>
                        </td>
                        
                        <td align='left' valign='top' width='50%' style='border-bottom:0px dotted #e7eef9;'>
                        <div style='margin:20px;'>
                        <?php echo"$whoiseek"; ?>
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
