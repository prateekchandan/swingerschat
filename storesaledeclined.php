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




<!--Body -->
<tr>
<td class="bodytable">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='search'>
    <?php require ('includes/search.php'); ?>
    </td>
    
	<td class='maincell' colspan='2'>
		
        <table align="center" cellpadding="0" cellspacing="0px" width="751px">
        <tr>
        <td class='bodytabletop2'>
        </td>
        </tr>
        
        <tr>
        <td class='bodytablemiddle2'>
        <div class='div1'>
		<?php
$memberid = ($_SESSION['memberloggedin']);
$tablename = "member_" . $memberid;

$declinereason = ($_GET['decline_reason']);

echo"<br /><br />I'm sorry, but your transaction was declined.Please read below.";
echo"<br /><br />Declined Reason: $declinereason";

?>

        </div>
        </td>
        </tr>
        
        <tr>
        <td class='bodytablebottom2'>
        </td>
        </tr>
        </table>
    
    </td>
    </tr>
    
    <tr>
	<td class='disclaimer' colspan='3'>
    <?php require ('includes/disclaimer.php'); ?>
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
