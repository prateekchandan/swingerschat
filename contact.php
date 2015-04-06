<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>

<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="10px" width="100%">
    <tr>
	<td class='text6'>
    <div class='div6'>
    <?php echo"$text1"; ?>
    
    <?php 
		$sentform = ($_GET['sentform']);
		if ($sentform == "1") {
			echo"$contactthankyou";
		} else {
			$tablename = "Contact_" . $pageid;
			
			echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"5px\" style=\"border:2px solid #e1e1e1; margin-bottom:20px;\">";
			if ($error == 1) {
				echo"
				<tr>
				<td class='fieldname' style='background-color:#FF0000;'>ERROR:</td>
				<td class='fieldbox'>The code you typed in was incorrect.<br /> Please read the instructions carefully.
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
			
				echo"<tr>";
				echo "<td class='fieldname'>$fieldname :</td>";
				if ($fieldtype == "text") {
					echo "<td class='fieldbox'><input type='text' name=\"$fieldid\" size='40' maxlength='40' /></td>";
				}
				if ($fieldtype == "textarea") {
					echo "<td class='fieldbox'><textarea name=\"$fieldid\" cols='31' rows='5'></textarea></td>";
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
						echo"<input type='checkbox' name='$identifier' value='1' /> $boxname <br />";
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
						echo"<option value='$boxname'>$boxname</option>";
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
						echo"<input type='radio' name='$identifier' value='$boxname' /> $boxname <br />";
					}
					echo"</td>";
				}
				echo"</tr>";
			
			}
			
			
			$code = rand(1,5);
			if ($code == 1) {$code = "er8Pie";}
			if ($code == 2) {$code = "nwvQ36";}
			if ($code == 3) {$code = "HXdrI4";}
			if ($code == 4) {$code = "793nWM";}
			if ($code == 5) {$code = "I82NBC";}
				
			echo"
			<tr>
			<td colspan='2'>Type the first 4 characters of the code below into the box.</td>
			</td>
			</tr>
			
			<tr>
			<td class='fieldname' style='color:#ff0000; font-weight:bold;'>$code</td>
			<td class='fieldbox'><input type='text' name='usercode' size='40' maxlength='40' />
			</td>
			</tr>

			<tr>
			<td class='fieldname'></td>
			<td class='fieldbox'>
			<input type=\"hidden\" name=\"code\" value=\"$code\" />
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
		?>
    </div>
    </td>

	<td class='text7'>
    <div class='div7'>
    <?php echo"$text2"; ?>
    </div>
    </td>
    </tr>
	</table>
</td>
</tr>
<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
