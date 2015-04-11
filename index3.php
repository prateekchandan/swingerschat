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
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='search'>
    <?php require ('includes/search.php'); ?>
    </td>
    </tr>
	</table>
</td>
</tr>

<tr>
<td class="bodytable2">   
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='maincell'>
    	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
        
        <tr>
        <td class='text2'>
        <div class='div2'>
        <?php
		$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
		$r = mysql_fetch_array($result);
		$policylinks = ($r['shippingaddress']);
		echo"<img src='images/customerservice.jpg' />";
		echo"$policylinks";
		?>
        </div>
        </td>
        <td class='text3'>
        <div class='div3'>
        <?php echo"$text1"; ?>
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
