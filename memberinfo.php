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
			$memberid = $_SESSION['memberloggedin'];
			$error = ($_GET['error']);
			$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r = mysql_fetch_array($result);
			$first = ($r['first']);
			$last = ($r['last']);
			$username = ($r['username']);
			$email = ($r['email']);
			$phone = ($r['phone']);
			$password = ($r['password']);
			$billingcountry = ($r['country']);
			$billingaddress = ($r['address']);
			$billingaddress2 = ($r['address2']);
			$billingcity = ($r['city']);
			$billingstate = ($r['state']);
			$billingzip = ($r['zip']);
			$shippingcountry = ($r['shippingcountry']);
			$shippingaddress = ($r['shippingaddress']);
			$shippingaddress2 = ($r['shippingaddress2']);
			$shippingcity = ($r['shippingcity']);
			$shippingstate = ($r['shippingstate']);
			$shippingzip = ($r['shippingzip']);
			
			echo"
			<div style='text-align:right; margin-right:20px;'><a href='membersedit.php'>Edit Profile Information</a></div>
			<table align=\"center\" cellpadding=\"5\" cellspacing=\"2px\" width=\"95%\" style=\"border:2px solid #c0c1c3;\">
			
			<tr>
			<td class='blogleft'>First Name:</td>
			<td>
			$first
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Last Name:</td>
			<td>
			$last
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Username:</td>
			<td>
			$username
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>E-mail:</td>
			<td>
			$email
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing Country:</td>
			<td>
			$billingcountry
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing Address:</td>
			<td>
			$billingaddress
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing Address 2:</td>
			<td>
			$billingaddress2
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing City:</td>
			<td>
			$billingcity
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing State:</td>
			<td>
			$billingstate
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Billing Zip:</td>
			<td>
			$billingzip
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping Country:</td>
			<td>
			$shippingcountry
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping Address:</td>
			<td>
			$shippingaddress
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping Address 2:</td>
			<td>
			$shippingaddress2
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping City:</td>
			<td>
			$shippingcity
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping State:</td>
			<td>
			$shippingstate
			</td>
			</tr>
			
			<tr>
			<td class='blogleft'>Shipping Zip:</td>
			<td>
			$shippingzip
			</td>
			</tr>
			</table>";
			
			
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
