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
$pagetype = ($r['type']);
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
$membersonly = ($r['membersonly']);

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='leftcolumn'>
		<div class='divmain'>
		<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
		<tr>
		<td class='text1'>
		<div class='div1'>
		
		<?php
$memberid = $_SESSION['memberloggedin'];
?>
  
    <table align="left" cellpadding="0px" cellspacing="5px" border="0px" class="cart" width="100%">
    <tr>
    <td align="left" valign="middle" class="cartheaders">TRANSACTION ID</td>
    <td align="left" valign="middle" class="cartheaders">DATE</td>
    </tr>
    
    <?php
    $result1 = mysql_query("SELECT * FROM `orders` WHERE `memberid` = '$memberid' AND `paid` = '1'");
    while ($r1 = mysql_fetch_array($result1)) {
        $date = ($r1['date']);
        $orderid = ($r1['id']);

		echo"
		<tr>
		<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
		<a href=\"membersorderdetails.php?orderid=$orderid\">$orderid</a>
		</td>";
		
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
		echo"$date";
		echo"</td>";
		echo"</tr>";

    }
	echo"</table>";
    ?>		
		</div>
		</td>
		</table>
	</td>
	<td class='rightcolumn'>
	<?php require('includes/rightcolumn2.php'); ?>
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
