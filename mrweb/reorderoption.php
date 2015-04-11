<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable" >

<br />
<br />
<?php
$productid = ($_GET['productid']);
$option = ($_GET['option']);
$nametable = "product_option" . $option;
$gallerytable = "product_option" . $option . "_list";
$picstable = "product_option" . $option . "_pics";
$_SESSION['gallerytable'] = $gallerytable;
$_SESSION['cellblock'] = "picorder";




echo"<table align=\"center\" cellpadding=\"5\" cellspacing=\"10px\" width=\"95%\" style=\"border:1px solid #cccccc;\">";



$count = 1;
$result = mysql_query("SELECT * FROM `$nametable`");
$r = mysql_fetch_array($result);
$optionname = ($r['name']);
echo"
<tr>
<td class=\"editpageleft\">Option 1: <br /><i>$optionname</i></td>
<td class=\"editpageright\">";
	echo"<a href='editproduct3.php?id=$productid'>Back to Product Page</a> <br />";
	
	echo'<div id="sortlist" width="100%" style="border:0px;">';
	
	$result = mysql_query("SELECT * FROM `$gallerytable` ORDER BY `picorder` ASC");
	$rows = mysql_num_rows($result);
	if ($rows > 0) {
		while ($r = mysql_fetch_array($result)) {
			$foundit = 0;
			$option = ($r['name']);
			$id = ($r['id']);
			$spot = "option1" . $count;
			$price = ($r['price']);
			if ($price == "") { $price = "0.00"; }
			
			$photoid2 = "SpotID1_" . ($r['id']);
			
			$optionarray = explode(",", $optionslist1);
			for ($x = 0; $x < count($optionarray); $x++) {
				$currentoption = $optionarray[$x];
				if ($currentoption == $id) {
					$foundit = 1;
				}
			}
			

			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
			echo"<table width='100%' cellpadding='3px' cellspacing='0'>";
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$option";
			echo"</td>";
			echo"</tr>";
			
	
			echo"</table>";
			echo"</div>";
			$count += 1;
		}
	} else {
		echo"<br /><br />There are no options...";
	}
	
	echo"</div>";
echo"</td><td class=\"editpagehints\">
Click and drag the option boxes to change their order.
</td></tr>";



echo"</table>";

?>

</td>
</tr>


<?php
require ('includes/footer.php');
?>




