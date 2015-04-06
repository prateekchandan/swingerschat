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
			if (isset ($_POST['submit'])) {
				$foldername = ($_POST['foldername']);
				$tablename = ($_POST['tablename']);
				$photoid = ($_POST['photoid']);
				$text1= ($_POST['text1']);
				
				
				mysql_query("UPDATE `$tablename` SET `caption`='$text1' WHERE `id` = '$photoid' ");
			
				header("Location: socialgallery.php");
				exit;
				
			} else {
			
				$memberid = ($_SESSION['memberloggedin']);
				$tablename = "MemberGallery_" . $memberid;
				$foldername = "member_" . $memberid;
				$photoid = ($_GET['photoid']);
				$result = mysql_query("SELECT * FROM `$tablename` WHERE `id` = '$photoid'");
				$r = mysql_fetch_array($result);
				$text1 = ($r['caption']);
				
				
				echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:0px solid #cccccc;\">";
				//Edit Photo Gallery
				echo"<form enctype='multipart/form-data' action='socialcaptions.php' method='post'>";
				echo"
				<tr>
				<td align='left' valign='top' >EDIT CAPTION:</td>
				</tr>
				
				<tr>
				<td>";
					echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\">";
					echo"<tr><td align='left' colspan='6'>";
					echo"<textarea id=\"text01\" name=\"text1\" cols='75' rows='10'>$text1</textarea>";
					echo"</td></tr>";
					echo"</table>";
				echo"
				</td>
				</tr>
				
				<tr>
				<td align=\"left\" valign=\"top\">
				<input type='hidden' name='tablename' value=\"$tablename\" />
				<input type='hidden' name='foldername' value=\"$foldername\" />
				<input type='hidden' name='photoid' value=\"$photoid\" />
				<input type=\"submit\" name=\"submit\" value='SAVE' />
				<a href=\"socialgallery.php\">Go Back without saving.</a>
				<br /><br />
				</form>
				</td>
				</tr>
				</table>";
			}
			
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
