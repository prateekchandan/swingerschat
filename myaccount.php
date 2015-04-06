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
        		<div id='main' style='margin:0px 0px 0px 0px;'>
                <div id='benefits' class='show'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Registration Benefits
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('requirements','main')">Registration Requirements</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('myaccount','main')">Managing My Account</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('recent','main')">Recently Viewed Items</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['description']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                <div id='requirements' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('benefits','main')">Registration Benefits</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Registration Requirements
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('myaccount','main')">Managing My Account</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('recent','main')">Recently Viewed Items</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['gender']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                <div id='myaccount' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('benefits','main')">Registration Benefits</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('requirements','main')">Registration Requirements</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Managing My Account
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('recent','main')">Recently Viewed Items</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['relationship']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                
                <div id='recent' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('benefits','main')">Registration Benefits</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('requirements','main')">Registration Requirements</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('myaccount','main')">Managing My Account</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Recently Viewed Items
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['college']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>


                </div>
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
