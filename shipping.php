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
                <div id='eta' class='show'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Estimated Shipping Time
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('domestic','main')">Domestic Shipping Rates</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('international','main')">International Shipping Information</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('PObox','main')">Shipping to a PO Box</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc; width:0px;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['country']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                <div id='domestic' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('eta','main')">Estimated Shipping Time</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Domestic Shipping Rates
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('international','main')">International Shipping Information</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('PObox','main')">Shipping to a PO Box</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc; width:0px;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['address']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                <div id='international' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('eta','main')">Estimated Shipping Time</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('domestic','main')">Domestic Shipping Rates</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                International Shipping Information
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('PObox','main')">Shipping to a PO Box</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc; width:0px;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['address2']);
				echo"$content";
				?>
                </td>
                </tr>
                </table>
                </div>
                
                
                <div id='PObox' class='hide'>
				<table cellpadding="5px" cellspacing="0px" border="0" width="100%" align="left">
                <tr>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('eta','main')">Estimated Shipping Time</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('domestic','main')">Domestic Shipping Rates</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border:1px solid #cccccc; background-color:#eae6e6;'>
                <a href="javascript:ShowMe2('international','main')">International Shipping Information</a>
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc;'>
                </td>
                <td align="left" valign="top" style='border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-right:1px solid #cccccc;'>
                Shipping to a PO Box
                </td>
                <td align="left" valign="top" style='border-bottom:1px solid #cccccc; width:0px;'>
                </td>
                </tr>
                
                <tr>
                <td colspan='8' align="left" valign="top" style='height:100px; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>
                <?php
				$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
				$r = mysql_fetch_array($result);
				$content = ($r['city']);
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
