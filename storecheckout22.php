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
	<td class='text5'>
    <div class='div4'>
	 <?php
$memberid = ($_SESSION['memberloggedin']);
$tablename = "member_" . $memberid;
$error = ($_GET['error']);

$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
$r = mysql_fetch_array($result);
$shippingcountry = ($r['shippingcountry']);
$shippingaddress = ($r['shippingaddress']);
$shippingaddress2 = ($r['shippingaddress2']);
$shippingcity = ($r['shippingcity']);
$shippingstate = ($r['shippingstate']);
$shippingzip = ($r['shippingzip']);

$ounces = 0;

$result = mysql_query("SELECT * FROM `$tablename`");
while ($r = mysql_fetch_array($result)) {
	$productid = ($r['productid']);
	$quantity = ($r['quantity']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
	$r2 = mysql_fetch_array($result2);
	$productweight = ($r2['ounces']);
	$ounces += ($quantity * $productweight);
}
$ounces += 1;

//Get Shipping Prices
function USPSParcelRate($service, $ounces, $shippingzip, $postagetype) {  

 
// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.    

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========  

$userName = '235SUPER6761'; // Your USPS Username  
$orig_zip = '78124'; // Zipcode you are shipping FROM  
 
// =============== DON'T CHANGE BELOW THIS LINE ===============  
 
$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";  
$ch = curl_init();  
 
// set the target url  
curl_setopt($ch, CURLOPT_URL,$url);  
curl_setopt($ch, CURLOPT_HEADER, 1);  
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
 
// parameters to post  
curl_setopt($ch, CURLOPT_POST, 1);  


$shippingarea = "RATEV3RESPONSE";
$rate = "RATE";
$data = "API=RateV3&XML=<RateV3Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>$service</Service><FirstClassMailType>PARCEL</FirstClassMailType><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$shippingzip</ZipDestination><Pounds>0</Pounds><Ounces>$ounces</Ounces><Size>REGULAR</Size><Machinable>False</Machinable></Package></RateV3Request>";  


 
// send the POST values to USPS  
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  
 
$result=curl_exec ($ch);  
$data = strstr($result, '<?');  
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments  
$xml_parser = xml_parser_create();  
xml_parse_into_struct($xml_parser, $data, $vals, $index);  
xml_parser_free($xml_parser);  
$params = array();  
$level = array();  
foreach ($vals as $xml_elem) {  
    if ($xml_elem['type'] == 'open') {  
        if (array_key_exists('attributes',$xml_elem)) {  
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);  
        } else {  
        $level[$xml_elem['level']] = $xml_elem['tag'];  
        }  
    }  
    if ($xml_elem['type'] == 'complete') {  
    $start_level = 1;  
    $php_stmt = '$params';  
    while($start_level < $xml_elem['level']) {  
        $php_stmt .= '[$level['.$start_level.']]';  
        $start_level++;  
    }  
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';  
    eval($php_stmt);  
    }  
}  
curl_close($ch);  
//echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags  
return $params["$shippingarea"]['1ST']["$postagetype"]["$rate"];  
}  
//End USPS SHIPPING


if (isset ($_POST['submit'])) {
	$shippingtype = $_POST['shippingtype'];
	if (empty ($_POST['shippingtype'])) {
		header("Location: storecheckout2.php?error=1");
		exit;
	}
	if ($shippingtype == "FIRST CLASS") {
		$postagetype = 0;
	}
	if ($shippingtype == "PRIORITY") {
		$postagetype = 1;
	}
	
	$shippingprice = USPSParcelRate($shippingtype, $ounces, $shippingzip, $postagetype);
	
	$_SESSION['shippingprice'] = "$shippingprice";
	$_SESSION['shippingtype'] = "$shippingtype";
	
	header("Location: storecheckout3.php");
	exit;


	
} else {

if ($ounces < 13) {
	$firstclassprice = USPSParcelRate('FIRST CLASS', $ounces, $shippingzip, 0);
}
$priorityprice = USPSParcelRate('PRIORITY', $ounces, $shippingzip, 1);

if (($priorityprice > 4.95) && ($ounces < 35)) {
	$priorityprice = 4.95;
}
if (($priorityprice > 10.70) && ($ounces < 165)) {
	$priorityprice = 10.70;
}
if (($priorityprice > 14.50) && ($ounces < 245)) {
	$priorityprice = 14.50;
}
if ($ounces > 320) {
	$priorityprice = 0;
}
$priorityprice = number_format($priorityprice, 2);





?>



	<form method="post" action="storecheckout22.php">
	
	<table align="left" cellspacing="0px" cellpadding="0px" class='checkout' width="100%">
    <tr>
	<td align="left" colspan="2" valign="top" class='storebreadcrumbs'>
    <a href='storecheckout.php'>Edit Personal Info</a> - <a href='storecheckout2.php'>Edit Payment Info</a> - Select Your Shipping Method
	</td>
	</tr>
    
	<?php
	if ($error == 1) {
	?>
	<tr>
    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
	<td align="left" valign="top" class="checkoutcellright">
	Please select a shipping method.
	</td>
	</tr>
	<?php
	}
	?>



	
    <tr>
    <td align="right" valign="top" class='checkoutcellleft' width="150px">
    3-5 Days:
    </td>
    <td align="left" valign="top" class='checkoutcellright'>
    <?php
    if ($ounces < 13) {
    ?>
    <input type="radio" name="shippingtype" value="FIRST CLASS"/><?php echo"$$firstclassprice"; ?>
     <?php
	} else {
		echo"Not Available";
	}
	?>
    </td>
    </tr>
   
    
    <tr>
	<td align="right" valign="top" class='checkoutcellleft'>
	2-3 Days:      
	</td>
	<td align="left" valign="top"  class='checkoutcellright'>
	<input type="radio" name="shippingtype" value="PRIORITY"/><?php if ($priorityprice == "0") {echo"FREE!"; } else {echo"$$priorityprice"; } ?>
	</td>
	</tr>


	<tr>
	<td align="center" valign="top" colspan="2" class='checkoutheader'>
	<input type="submit" name="submit" value="Continue" />
	</td>
	</tr>
    </table>
	
	</form>



	
<?php
}
?>
    </div>
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
