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


require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='text1'>
    <div class='div1'>
    <?php echo"$text1"; ?>
    </div>
    </td>
    </tr>
    
    <tr>
    <td class='text2'>
    <div class='div2'>
    <?php echo"$text2"; ?>
    </div>
    </td>
    </tr>
    
    <tr>
	<td class='text3'>
    <div class='div3'>
    <?php echo"$text3"; ?>
    </div>
    </td>
    </tr>
	</table>
</td>

<td class="bodytable2">
<div class='div4'>
<?php require ('includes/search.php'); ?>
</div>
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
