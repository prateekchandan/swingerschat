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
			$placeid = ($_GET['id']);
			$result = mysql_query("SELECT * FROM `events_places` WHERE `id` = '$placeid'");
			$r = mysql_fetch_array($result);
			$name = ($r['name']);
			$photo = ($r['photo']);
			$city = ($r['city']);
			$state = ($r['state']);
			$zip = ($r['zip']);
			$address = ($r['address']);
			$phone = ($r['phone']);
			$text = ($r['text']);
			?>
				<table cellpadding="0" cellspacing="0px" border="0" width="100%">
				<tr>
				<td align="left">
					<table cellpadding="5px" cellspacing="0px" border="0" width='100%'>
                    <?php
					echo"
					<tr>
					<td align='left' valign='top' colspan='2' style='border-bottom:4px dotted #e7eef9;'>
					<a href='events.php'>Back to Events</a>
					</td>
					</tr>";
					?>
                    
					<tr>
					<td align="left" valign="top" width="190px">
					<?php 
					if ($photo != "noimage.jpg") {
						echo"<a href=\"eventplaces/$photo\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src='eventplaces/$photo' width='180px'/></a>"; 
					} else {
						echo"<img src='eventplaces/noimage.jpg' width='180px' height='200px'/>";
					}
					?>
					</td>
					
					<td align="left" valign="top" class="memberprofile">
						<table cellpadding="5px" cellspacing="0px" border="0" align="left">
						<?php
						echo"<tr>";
						echo"<td class='socialprofile'><strong>NAME:</strong></td>";
						echo"<td align='left' valign='top'>$name</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>ADDRESS:</strong></td>";
						echo"<td align='left' valign='top'>$address <br /> $city, $state $zip</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>PHONE:</strong></td>";
						echo"<td align='left' valign='top'>$phone</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td class='socialprofile'><strong>DESCRIPTION:</strong></td>";
						echo"<td align='left' valign='top'>$text</td>";
						echo"</tr>";

						?>
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
