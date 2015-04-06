<?php
require ('includes/dbconnect.php');
$pagetype = "Store";
require ('includes/head.php');
?>

<div class="main">
    <div id="main">

        

        <div id="content">
            <div class='cl'><br /><br /></div>   
            <!-- Start Template -->
            
         <table align="center" cellpadding="0px" cellspacing="0px" width="95%" >
		<tr>
		<td class='text7'>
		<div class='div7'>
			
			<?php
	$ounces = 0;
	$ready = ($_GET['ready']);
	$revcart = ($_GET['revcart']);
	$shippingprice = $_SESSION['shippingprice'];
	if (isset($_GET['same'])) {
		$same = ($_GET['same']);
	} else {
		$same = 1;
	}
	
	if (isset($_SESSION['memberloggedin'])) {
		$memberid = ($_SESSION['memberloggedin']);
		
		$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
			$r2 = mysql_fetch_array($result2);
			$productweight = ($r2['ounces']);
			$ounces += ($quantity * $productweight);
		}
		$ounces += 1;
	} else if (isset($_SESSION['guestloggedin'])) {
		$memberid = ($_SESSION['guestloggedin']);
		
		$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
			$r2 = mysql_fetch_array($result2);
			$productweight = ($r2['ounces']);
			$ounces += ($quantity * $productweight);
		}
		$ounces += 1;
	} else {
		$ip=getenv("REMOTE_ADDR");
                $result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
			$r2 = mysql_fetch_array($result2);
			$productweight = ($r2['ounces']);
			$ounces += ($quantity * $productweight);
		}
		$ounces += 1;
		
		$memberid = ($_SESSION['guestloggedin']);
	}
	
	
	if (isset($_GET['error'])) {
		$error = ($_GET['error']);
		$first = ($_GET['first']);
		$last = ($_GET['last']);
		$username = ($_GET['username']);
		$phone = ($_GET['phone']);
		$billingcountry = ($_GET['billingcountry']);
		$billingaddress = ($_GET['billingaddress']);
		$billingaddress2 = ($_GET['billingaddress2']);
		$billingcity = ($_GET['billingcity']);
		$state = ($_GET['billingstate']);
		$billingzip = ($_GET['billingzip']);
		$email = ($_GET['email']);
		$same = ($_GET['same']);
		if ($same == 0) {
			$shippingcountry = ($_GET['shippingcountry']);
			$shippingaddress = ($_GET['shippingaddress']);
			$shippingaddress2 = ($_GET['shippingaddress2']);
			$shippingcity = ($_GET['shippingcity']);
			$shippingstate = ($_GET['shippingstate']);
			$shippingzip = ($_GET['shippingzip']);
		} else {
			$shippingcountry = ($_GET['billingcountry']);
			$shippingaddress = ($_GET['billingaddress']);
			$shippingaddress2 = ($_GET['billingaddress2']);
			$shippingcity = ($_GET['billingcity']);
			$shippingstate = ($_GET['billingstate']);
			$shippingzip = ($_GET['billingzip']);
		}
	} else {
		$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
		$r = mysql_fetch_array($result);
		$first = ($r['first']);
		$last = ($r['last']);
		$username = ($r['username']);
		$phone = ($r['phone']);
		$billingcountry = ($r['country']);
		$billingaddress = ($r['address']);
		$billingaddress2 = ($r['address2']);
		$billingcity = ($r['city']);
		$state = ($r['state']);
		$billingzip = ($r['zip']);
		$shippingcountry = ($r['shippingcountry']);
		$shippingaddress = ($r['shippingaddress']);
		$shippingaddress2 = ($r['shippingaddress2']);
		$shippingcity = ($r['shippingcity']);
		$shippingstate = ($r['shippingstate']);
		$shippingzip = ($r['shippingzip']);
		$email = ($r['email']);
		if ($email == "noaccount") {
			$email = "";
		}
	}
	
	if ($billingcountry == "") {
		$billingcountry = "United States";
	}
	if ($shippingcountry == "") {
		$shippingcountry = "United States";
	}
	?>
	
	
	
		<form method="post" action="storecheckoutform.php">
		
		<table align="center" cellspacing="0px" cellpadding="0px" class='checkout' width="250px">
	    <tr>
		<td align="left" colspan="2" valign="top" class='checkoutheader'>
	    <strong>Customer Information:</strong> <?php if (!isset($_SESSION['memberloggedin'])) {echo"<a href='login.php' style='font-size:10px;'>Already have an account?</a>";} ?>
		</td>
		</tr>
	    
		<?php
		if ($error == 1) {
		?>
		<tr>
	    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
		<td align="left" valign="top" class="checkoutcellright">
		Please fill in all fields.
		</td>
		</tr>
		<?php
		}
		?>
	    
	    <?php
		if ($error == 2) {
		?>
		<tr>
	    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
		<td align="left" valign="top" class="checkoutcellright">
		Your passwords did not match.
		</td>
		</tr>
		<?php
		}
		?>
	    
	    <?php
		if ($error == 3) {
		?>
		<tr>
	    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
		<td align="left" valign="top" class="checkoutcellright">
		That e-mail is already being used.
		</td>
		</tr>
		<?php
		}
		?>
	    
	    <?php
		if ($error == 4) {
		?>
		<tr>
	    <td align="right" valign="top" style=" background-color:#FF0000; color:#FFFFFF; padding:5px;">Error:</td>
		<td align="left" valign="top" class="checkoutcellright">
		That username is already being used.
		</td>
		</tr>
		<?php
		}
		?>
	
		
		<tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*First Name:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="first" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')";  value="<?php echo"$first"; ?>" />
		</td>
		</tr>
	    
		<tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Last Name:      
		</td>
		<td align="left" valign="top"  class='checkoutcellright'>
		<input type="text" name="last" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$last"; ?>" />
		</td>
		</tr>
		
		<tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Phone:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="phone" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$phone";?>" />
		</td>
		</tr>
		
	
	    
	    
		<tr>
		<td align="left" colspan="2" valign="top" class='checkoutheader'>
		<strong>Billing Information:</strong> 
		</td>
		</tr>
	    
		<tr> 
	    <td align="right" valign="top" class='checkoutcellleft'>
	    *Country:
	    </td>
	    <td align="left" valign="top" class='checkoutcellright'>
	      
	      <select name="billingcountry" onchange="changebutton('updatebutton','checkoutbuttontype')";>
		<?php
		$result = mysql_query("SELECT * FROM `countries`");
		while ($r = mysql_fetch_array($result)) {
		    $name = ($r['name']);
		    $name2 = substr($name, 0, 30);
		    echo"<option value='$name'"; 
			    if ($billingcountry == "$name") {
				    echo"selected='selected'";
			    } 
			    echo">$name2 </option>";
		    }
		    ?>
		</select>
	    </td>
	    </tr>
	
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Address:    
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="billingaddress" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$billingaddress";?>" />
		</td>
		</tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		Optional 2nd line: 
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="billingaddress2" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$billingaddress2";?>" />
		</td>
		</tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*City:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="billingcity" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$billingcity";?>" />
		</td>
		</tr>
		
		<tr> 
	    <td align="right" valign="top" class='checkoutcellleft'>
	    *State/Province:
	    </td>
	    <td align="left" valign="top" class='checkoutcellright'>
		<select name="billingstate" size="1" class="formfields" style="width: 49; height: 19" onchange="changebutton('updatebutton','checkoutbuttontype')";>
					<option value="AL" <?php if ($state == "AL") { echo"selected='selected'"; } ?> >AL</option>
					<option value="AK" <?php if ($state == "AK") { echo"selected='selected'"; } ?> >AK</option>
					<option value="AZ" <?php if ($state == "AZ") { echo"selected='selected'"; } ?> >AZ</option>
					<option value="AR" <?php if ($state == "AR") { echo"selected='selected'"; } ?> >AR</option>
					<option value="CA" <?php if ($state == "CA") { echo"selected='selected'"; } ?> >CA</option> 
					<option value="CO" <?php if ($state == "CO") { echo"selected='selected'"; } ?> >CO</option> 
					<option value="CT" <?php if ($state == "CT") { echo"selected='selected'"; } ?> >CT</option> 
					<option value="DE" <?php if ($state == "DE") { echo"selected='selected'"; } ?> >DE</option> 
					<option value="DC" <?php if ($state == "DC") { echo"selected='selected'"; } ?> >DC</option> 
					<option value="FL" <?php if ($state == "FL") { echo"selected='selected'"; } ?> >FL</option> 
					<option value="GA" <?php if ($state == "GA") { echo"selected='selected'"; } ?> >GA</option> 
					<option value="HI" <?php if ($state == "HI") { echo"selected='selected'"; } ?> >HI</option> 
					<option value="ID" <?php if ($state == "ID") { echo"selected='selected'"; } ?> >ID</option> 
					<option value="IL" <?php if ($state == "IL") { echo"selected='selected'"; } ?> >IL</option> 
					<option value="IN" <?php if ($state == "IN") { echo"selected='selected'"; } ?> >IN</option> 
					<option value="IA" <?php if ($state == "IA") { echo"selected='selected'"; } ?> >IA</option> 
					<option value="KS" <?php if ($state == "KS") { echo"selected='selected'"; } ?> >KS</option> 
					<option value="KY" <?php if ($state == "KY") { echo"selected='selected'"; } ?> >KY</option> 
					<option value="LA" <?php if ($state == "LA") { echo"selected='selected'"; } ?> >LA</option> 
					<option value="ME" <?php if ($state == "ME") { echo"selected='selected'"; } ?> >ME</option> 
					<option value="MD" <?php if ($state == "MD") { echo"selected='selected'"; } ?> >MD</option> 
					<option value="MA" <?php if ($state == "MA") { echo"selected='selected'"; } ?> >MA</option> 
					<option value="MI" <?php if ($state == "MI") { echo"selected='selected'"; } ?> >MI</option> 
					<option value="MN" <?php if ($state == "MN") { echo"selected='selected'"; } ?> >MN</option> 
					<option value="MS" <?php if ($state == "MS") { echo"selected='selected'"; } ?> >MS</option> 
					<option value="MO" <?php if ($state == "MO") { echo"selected='selected'"; } ?> >MO</option> 
					<option value="MT" <?php if ($state == "MT") { echo"selected='selected'"; } ?> >MT</option> 
					<option value="NE" <?php if ($state == "NE") { echo"selected='selected'"; } ?> >NE</option> 
					<option value="NV" <?php if ($state == "NV") { echo"selected='selected'"; } ?> >NV</option> 
					<option value="NH" <?php if ($state == "NH") { echo"selected='selected'"; } ?> >NH</option> 
					<option value="NJ" <?php if ($state == "NJ") { echo"selected='selected'"; } ?> >NJ</option> 
					<option value="NM" <?php if ($state == "NM") { echo"selected='selected'"; } ?> >NM</option> 
					<option value="NY" <?php if ($state == "NY") { echo"selected='selected'"; } ?> >NY</option> 
					<option value="NC" <?php if ($state == "NC") { echo"selected='selected'"; } ?> >NC</option> 
					<option value="ND" <?php if ($state == "ND") { echo"selected='selected'"; } ?> >ND</option> 
					<option value="OH" <?php if ($state == "OH") { echo"selected='selected'"; } ?> >OH</option> 
					<option value="OK" <?php if ($state == "OK") { echo"selected='selected'"; } ?> >OK</option> 
					<option value="OR" <?php if ($state == "OR") { echo"selected='selected'"; } ?> >OR</option> 
					<option value="PA" <?php if ($state == "PA") { echo"selected='selected'"; } ?> >PA</option> 
					<option value="RI" <?php if ($state == "RI") { echo"selected='selected'"; } ?> >RI</option> 
					<option value="SC" <?php if ($state == "SC") { echo"selected='selected'"; } ?> >SC</option> 
					<option value="SD" <?php if ($state == "SD") { echo"selected='selected'"; } ?> >SD</option> 
					<option value="TN" <?php if ($state == "TN") { echo"selected='selected'"; } ?> >TN</option> 
					<option value="TX" <?php if ($state == "TX") { echo"selected='selected'"; } ?>>TX</option> 
					<option value="UT" <?php if ($state == "UT") { echo"selected='selected'"; } ?> >UT</option> 
					<option value="VT" <?php if ($state == "VT") { echo"selected='selected'"; } ?> >VT</option> 
					<option value="VA" <?php if ($state == "VA") { echo"selected='selected'"; } ?> >VA</option> 
					<option value="WA" <?php if ($state == "WA") { echo"selected='selected'"; } ?> >WA</option> 
					<option value="WV" <?php if ($state == "WV") { echo"selected='selected'"; } ?> >WV</option> 
					<option value="WI" <?php if ($state == "WI") { echo"selected='selected'"; } ?> >WI</option> 
					<option value="WY" <?php if ($state == "WY") { echo"selected='selected'"; } ?> >WY</option>
					</select>
	    </td>
	    </tr>
	    
	    <?php
	    if ($same == 0) {
		?>
		<tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Postal Code:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="billingzip" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$billingzip";?>" />
		</td>
		</tr>
		<?php
	    } else {
		?>
		<tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Postal Code:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="billingzip" size='30' onkeyup="changeshipping(this.value,<?php echo"$ounces"; ?>), changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$billingzip";?>" />
		</td>
		</tr>
		<?php
	    }
	    ?>
	    
	    
		 <tr>
		<td align="left" colspan="2" valign="top" class='checkoutheader'>
		<strong>Shipping Information:</strong> 
		</td>
		</tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		Same as above:   
	
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<div id='samediv'>
		<?php
		if ($same == 0) {
			?>
			<input type="radio" name="same" value="0" checked="checked" />No
			<input type="radio" name="same" value="1" onclick="ShowMe('studentfields','main'), changebutton('updatebutton','checkoutbuttontype'),changeshipping(this.value,<?php echo"$ounces"; ?>), changesame('0')";/>Yes
			<?php
		} else {
			?>
			<input type="radio" name="same" value="0" onclick="ShowMe('studentfields','main'), changebutton('updatebutton','checkoutbuttontype'),changeshipping(this.value,<?php echo"$ounces"; ?>), changesame('1')";/>No
			<input type="radio" name="same" value="1" checked="checked" />Yes
			<?php
		}
		?>
		</div>
		</td>
		</tr>
	    
	    <tr>
	    <td colspan="2" style='text-align:left;'>
	    
	    <div id="main" style='width:200px; text-align:left; margin:0px; padding:0px;'>
	    <div id="studentfields" style='width:200px;  margin:0px; padding:0px;text-align:left;' <?php if ($same == 0) { echo"class='show'"; } else { echo"class='hide'";} ?>>
	    <table align='left' cellpadding="0px" cellspacing="0px" border="0px" width="100%">
	    <tr> 
	    <td align="right" valign="top" class='checkoutcellleft'>
	    *Country:
	    </td>
	    <td align="left" valign="top" class='checkoutcellright'>
		<select name="shippingcountry" onchange="changebutton('updatebutton','checkoutbuttontype')";>
		<?php
		$result = mysql_query("SELECT * FROM `countries`");
		while ($r = mysql_fetch_array($result)) {
		    $name = ($r['name']);
		    $name2 = substr($name, 0, 30);
		    echo"<option value='$name'"; 
			    if ($shippingcountry == "$name") {
				    echo"selected='selected'";
			    } 
			    echo">$name2 </option>";
		    }
		    ?>
		</select>
		
	    </td>
	    </tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Address:    
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="shippingaddress" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$shippingaddress";?>" onclick="ShowMe(studentfields','main')";/>
		</td>
		</tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		Optional 2nd line: 
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="shippingaddress2" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$shippingaddress2";?>" />
		</td>
		</tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*City:     
		</td>
		<td align="left" valign="top" class='checkoutcellright' >
		<input type="text" name="shippingcity" size='30' onkeyup="changebutton('updatebutton','checkoutbuttontype')"; value="<?php echo"$shippingcity";?>" />
		</td>
		</tr>
		
		<tr> 
	    <td align="right" valign="top" class='checkoutcellleft'>
	    *State/Province:
	    </td>
	    <td align="left" valign="top" class='checkoutcellright'>
	    <select name="shippingstate" size="1" class="formfields" style="width: 49; height: 19" onchange="changebutton('updatebutton','checkoutbuttontype')";>
					<option value="AL" <?php if ($shippingstate == "AL") { echo"selected='selected'"; } ?> >AL</option>
					<option value="AK" <?php if ($shippingstate == "AK") { echo"selected='selected'"; } ?> >AK</option>
					<option value="AZ" <?php if ($shippingstate == "AZ") { echo"selected='selected'"; } ?> >AZ</option>
					<option value="AR" <?php if ($shippingstate == "AR") { echo"selected='selected'"; } ?> >AR</option>
					<option value="CA" <?php if ($shippingstate == "CA") { echo"selected='selected'"; } ?> >CA</option> 
					<option value="CO" <?php if ($shippingstate == "CO") { echo"selected='selected'"; } ?> >CO</option> 
					<option value="CT" <?php if ($shippingstate == "CT") { echo"selected='selected'"; } ?> >CT</option> 
					<option value="DE" <?php if ($shippingstate == "DE") { echo"selected='selected'"; } ?> >DE</option> 
					<option value="DC" <?php if ($shippingstate == "DC") { echo"selected='selected'"; } ?> >DC</option> 
					<option value="FL" <?php if ($shippingstate == "FL") { echo"selected='selected'"; } ?> >FL</option> 
					<option value="GA" <?php if ($shippingstate == "GA") { echo"selected='selected'"; } ?> >GA</option> 
					<option value="HI" <?php if ($shippingstate == "HI") { echo"selected='selected'"; } ?> >HI</option> 
					<option value="ID" <?php if ($shippingstate == "ID") { echo"selected='selected'"; } ?> >ID</option> 
					<option value="IL" <?php if ($shippingstate == "IL") { echo"selected='selected'"; } ?> >IL</option> 
					<option value="IN" <?php if ($shippingstate == "IN") { echo"selected='selected'"; } ?> >IN</option> 
					<option value="IA" <?php if ($shippingstate == "IA") { echo"selected='selected'"; } ?> >IA</option> 
					<option value="KS" <?php if ($shippingstate == "KS") { echo"selected='selected'"; } ?> >KS</option> 
					<option value="KY" <?php if ($shippingstate == "KY") { echo"selected='selected'"; } ?> >KY</option> 
					<option value="LA" <?php if ($shippingstate == "LA") { echo"selected='selected'"; } ?> >LA</option> 
					<option value="ME" <?php if ($shippingstate == "ME") { echo"selected='selected'"; } ?> >ME</option> 
					<option value="MD" <?php if ($shippingstate == "MD") { echo"selected='selected'"; } ?> >MD</option> 
					<option value="MA" <?php if ($shippingstate == "MA") { echo"selected='selected'"; } ?> >MA</option> 
					<option value="MI" <?php if ($shippingstate == "MI") { echo"selected='selected'"; } ?> >MI</option> 
					<option value="MN" <?php if ($shippingstate == "MN") { echo"selected='selected'"; } ?> >MN</option> 
					<option value="MS" <?php if ($shippingstate == "MS") { echo"selected='selected'"; } ?> >MS</option> 
					<option value="MO" <?php if ($shippingstate == "MO") { echo"selected='selected'"; } ?> >MO</option> 
					<option value="MT" <?php if ($shippingstate == "MT") { echo"selected='selected'"; } ?> >MT</option> 
					<option value="NE" <?php if ($shippingstate == "NE") { echo"selected='selected'"; } ?> >NE</option> 
					<option value="NV" <?php if ($shippingstate == "NV") { echo"selected='selected'"; } ?> >NV</option> 
					<option value="NH" <?php if ($shippingstate == "NH") { echo"selected='selected'"; } ?> >NH</option> 
					<option value="NJ" <?php if ($shippingstate == "NJ") { echo"selected='selected'"; } ?> >NJ</option> 
					<option value="NM" <?php if ($shippingstate == "NM") { echo"selected='selected'"; } ?> >NM</option> 
					<option value="NY" <?php if ($shippingstate == "NY") { echo"selected='selected'"; } ?> >NY</option> 
					<option value="NC" <?php if ($shippingstate == "NC") { echo"selected='selected'"; } ?> >NC</option> 
					<option value="ND" <?php if ($shippingstate == "ND") { echo"selected='selected'"; } ?> >ND</option> 
					<option value="OH" <?php if ($shippingstate == "OH") { echo"selected='selected'"; } ?> >OH</option> 
					<option value="OK" <?php if ($shippingstate == "OK") { echo"selected='selected'"; } ?> >OK</option> 
					<option value="OR" <?php if ($shippingstate == "OR") { echo"selected='selected'"; } ?> >OR</option> 
					<option value="PA" <?php if ($shippingstate == "PA") { echo"selected='selected'"; } ?> >PA</option> 
					<option value="RI" <?php if ($shippingstate == "RI") { echo"selected='selected'"; } ?> >RI</option> 
					<option value="SC" <?php if ($shippingstate == "SC") { echo"selected='selected'"; } ?> >SC</option> 
					<option value="SD" <?php if ($shippingstate == "SD") { echo"selected='selected'"; } ?> >SD</option> 
					<option value="TN" <?php if ($shippingstate == "TN") { echo"selected='selected'"; } ?> >TN</option> 
					<option value="TX" <?php if ($shippingstate == "TX") { echo"selected='selected'"; } ?>>TX</option> 
					<option value="UT" <?php if ($shippingstate == "UT") { echo"selected='selected'"; } ?> >UT</option> 
					<option value="VT" <?php if ($shippingstate == "VT") { echo"selected='selected'"; } ?> >VT</option> 
					<option value="VA" <?php if ($shippingstate == "VA") { echo"selected='selected'"; } ?> >VA</option> 
					<option value="WA" <?php if ($shippingstate == "WA") { echo"selected='selected'"; } ?> >WA</option> 
					<option value="WV" <?php if ($shippingstate == "WV") { echo"selected='selected'"; } ?> >WV</option> 
					<option value="WI" <?php if ($shippingstate == "WI") { echo"selected='selected'"; } ?> >WI</option> 
					<option value="WY" <?php if ($shippingstate == "WY") { echo"selected='selected'"; } ?> >WY</option>
					</select>
	    </td>
	    </tr>
	    
	    <tr>
		<td align="right" valign="top" class='checkoutcellleft'>
		*Postal Code:     
		</td>
		<td align="left" valign="top" class='checkoutcellright'>
		<input type="text" name="shippingzip" size='30' onkeyup="changeshipping(this.value,<?php echo"$ounces"; ?>)" value="<?php echo"$shippingzip";?>" />
		</td>
		</tr>
	    </table>
	    </div>
	    </div>
	    
	    <?php
		if (!isset($_SESSION['memberloggedin'])) {
			echo"
			<tr>
			<td align='left' colspan='2' valign='top' class='checkoutheader'>
			<strong>Create New Account - <em>OPTIONAL</em></strong> 
			</td>
			</tr>";
			
			echo"
			<tr>
			<td align='right' valign='top' class='checkoutcellleft'>
			E-mail:     
			</td>
			<td align='left' valign='top' class='checkoutcellright'>
			<input type='text' name='email' size='30' onkeyup=\"changebutton('updatebutton','checkoutbuttontype')\"; value='$email' />
			</td>
			</tr>";
			
		}
		
		echo"
		<tr>
		<td align='left' colspan='2' valign='top' class='checkoutheader'>
		<strong>Continue Checkout Process</strong> 
		</td>
		</tr>";
		
		echo"
		<tr>
		<td align='left' valign='top' class='checkoutcellright' colspan='2'>
		<br />To continue, click <em>Update Order Information</em> on the right hand side of this page.<br /><br />
		</td>
		</tr>";
		?>
	    
	    </td>
	    </tr>
	    </table>

	</div>
	</td>
	
	<td class='text8'>
	<div class='div8' id='shippingdiv'>
		<?php
		
		if ($shippingcountry != "United States") {
			$firstclassprice = "Not Available";
			$priorityprice = "Not Available";
			$intprice = USPSParcelRate('INTERNATIONAL', $ounces, $shippingzip, 2, $shippingcountry);
			$intprice = number_format($intprice, 2);
		} else {
			$intprice = "Not Available";
			if ($ounces < 13) {
				$firstclassprice = USPSParcelRate('FIRST CLASS', $ounces, $shippingzip, 0, $shippingcountry);
				$firstclassprice = number_format($firstclassprice, 2);
			} else {
				$firstclassprice = "Not Available";
			}
			$priorityprice = USPSParcelRate('PRIORITY', $ounces, $shippingzip, 1, $shippingcountry);
	
			$priorityprice = number_format($priorityprice, 2);
			}
		if ($priorityprice == 0) {
			$priorityprice = "Not Available";
			$firstclassprice = "Not Available";
		}
		
		
		
		?>
		
		<table align="center" cellspacing="0px" cellpadding="0px" class='checkout' width="280px">
		<tr>
		<td align='left' colspan='2' valign='top' class='checkoutheader'>
		<strong>Shipping Information:</strong>
		</td>
		</tr>
		
		<?php
		if ($error == 5) {
		?>
		<tr>
		<td colspan='2' align="left" valign="top" style=" background-color:#1f9e19; color:#FFFFFF; padding:5px;">
		Please select a shipping method. 
		</td>
		</tr>
		<?php
		}
		?>
		
		
		<?php
		if ($firstclassprice != "Not Available") {
			?>
			<tr>
			<td align="right" valign="top" class='checkoutcellleft'>
			3-5 Days:
			</td>
			<td align="left" valign="top" class='checkoutcellright'>
			<?php
			    if ($firstclassprice == "0") {
				echo"Zipcode not found.";
			    } else {
				?>
				<input type="radio" <?php if ($shippingprice == $firstclassprice) {echo"checked='checked'";} ?> name="shippingtype" value="FIRST CLASS" onclick="changebutton('updatebutton','checkoutbuttontype')";/><?php echo"$$firstclassprice";
			    }
			?>
			</td>
			</tr>
			<?php
		}
		?>
		
		<?php
		if ($priorityprice != "Not Available") {
			?>
			<tr>
			<td align="right" valign="top" class='checkoutcellleft'>
			2-3 Days:      
			</td>
			<td align="left" valign="top"  class='checkoutcellright'>
			<input type="radio" name="shippingtype" <?php if ($shippingprice == $priorityprice) {echo"checked='checked'";} ?> value="PRIORITY" onclick="changebutton('updatebutton','checkoutbuttontype')"; /><?php echo"$$priorityprice"; ?>
			</td>
			</tr>
			<?php
		}
		
		if ($intprice != "Not Available") {
			?>
			<tr>
			<td align="right" valign="top" class='checkoutcellleft'>
			6-10 Days:      
			</td>
			<td align="left" valign="top"  class='checkoutcellright'>
			<input type="radio" name="shippingtype" <?php if ($shippingprice == $intprice) {echo"checked='checked'";} ?> value="INTERNATIONAL" onclick="changebutton('updatebutton','checkoutbuttontype')"; /><?php echo"$$intprice"; ?>
			</td>
			</tr>
			<?php
		}
		
		if (($priorityprice == "Not Available") && ($firstclassprice == "Not Available") && ($intprice == "Not Available")) {
			echo"<tr><td align='left' valign='top' colspan='2' class='checkoutcellleft'>We cannot find the shipping zipcode you have entered. Please enter your shipping zipcode and then update the order with the button on the right to see our available shipping prices.</td></tr>";
		}
		?>
		</table>
	
	
	</div>
	</td>
	
	<td class='text9'>
	<div class='div9'>
		<?php
		//3rd Div - Order Review Div
		?>
		<table align='left' cellpadding="0px" cellspacing="2px" border="0px" width="300px" class='cart'>
		
		<tr>
		<td align="left" valign="top" width="170px" class='checkoutheader'>
		<strong>ITEM</strong>
		</td>
		<td align="right" valign="top" width='20px' class='checkoutheader'>
		<strong>QTY</strong>
		</td>
		<td align="right" valign="top" width="80px" class='checkoutheader'>
		<strong>PRICE</strong>
		</td>
		</tr>
		
		<?php
			
			$ccnumber = ($_SESSION['ccnumber']);
			$cctype = ($_SESSION['cctype']);
			$ccexpirationmonth = ($_SESSION['ccexpirationmonth']);
			$ccexpirationyear = ($_SESSION['ccexpirationyear']);
			$cccvv = ($_SESSION['cccvv']);
			
			$totalounces = 0;
			if (isset($_SESSION['memberloggedin'])) {
				$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
			} else if (isset($_SESSION['guestloggedin'])) {
				$memberid = ($_SESSION['guestloggedin']);
				$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
			} else {
				$result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
			}
			
			while ($r = mysql_fetch_array($result)) {
				$cartid = ($r['id']);
				$productid = ($r['productid']);
				$quantity = ($r['quantity']);
				$option1 = ($r['option1']);
				$option2 = ($r['option2']);
				$option3 = ($r['option3']);
				$option4 = ($r['option4']);
			
				
				$result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
				$r2 = mysql_fetch_array($result2);
				$category = ($r2['category']);
				$name = ($r2['name']);
				$price = ($r2['price']);
				$ounces = ($r2['ounces']);
				$price2 = ($price * $quantity);
				$totalounces += ($ounces * $quantity);
				
				$packagedetails .= "$name X $quantity, ";
				?>
				<tr>
				<td align="left" valign="middle" class="cartitem">
				<?php
				echo"$name";
				if (($option1 != "")) {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option1name: $option1 $chargedisplay</div>";
					}
					if ($option2 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option2name: $option2 $chargedisplay</div>";
					}
					if ($option3 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option3name: $option3 $chargedisplay</div>";
					}
					if ($option4 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option4name: $option4 $chargedisplay</div>";
					}
			
				?>
				</td>
				<?php
				$price = number_format($price, 2,'.','');
				$price2 = number_format($price2, 2,'.','');
				$total += $price2;
				?>
				<td align="right" valign="middle" class="cartitem"><?php echo"$quantity"; ?></td>
				<td align="right" valign="middle" class="cartitem"><?php echo"$$price2"; ?></td>
				</tr>
			<?php
			}
			$total = number_format($total, 2,'.','');
			$result5 = mysql_query('SELECT * FROM members WHERE id = "'.$memberid.'"');
			$r5 = mysql_fetch_array($result5);
			$first = stripslashes($r5['first']);
			$last = ($r5['last']);
			$billingcountry = ($r5['country']);
			$address = ($r5['address']);
			$address2 = ($r5['address2']);
			$city = ($r5['city']);
			$state= ($r5['state']);
			$zip = ($r5['zip']);
			$shippingcountry = ($r5['shippingcountry']);
			$shippingaddress = ($r5['shippingaddress']);
			$shippingaddress2 = ($r5['shippingaddress2']);
			$shippingcity = ($r5['shippingcity']);
			$shippingstate= ($r5['shippingstate']);
			$shippingzip = ($r5['shippingzip']);
			
			//Calculate Promo Code
	
			 if (isset($_SESSION['promocode'])) {
				$discount = ($_SESSION['promocode']);
				$discount2 = ($discount * .01);
				$discountamount = ($total * $discount2);
				$total -= $discountamount;
				$total = number_format($total, 2,'.','');
				$discountamount = number_format($discountamount, 2,'.','');
			} 
	
			
			// Calculate Tax
			$tax = 0;

			if ($shippingstate == 'CA') {
				$tax = ($total * .0825);
				$tax = round($tax, 2);
				$total = ($total + $tax);
				$tax = number_format($tax, 2,'.','');
				$total = number_format($total, 2,'.','');
			}

			$_SESSION['ordertax'] = "$tax";
			
			//Calculate Shipping
			$total = ($total + $shippingprice);
			$total = number_format($total, 2,'.','');
	
			?>
		
		<tr>
		<td colspan="3" align="right" valign="top" class="cartitem"><br /></td>
		</tr>
		
		<tr>
		<td colspan="2" align="right" valign="top"><?php if (isset($_SESSION['promocode'])) { echo"DISCOUNT:"; } else { echo"PROMO CODE:"; } ?></td>
		<td align="right" valign="top" class="cartitem">
		<?php
		 if (isset($_SESSION['promocode'])) {
			echo"$$discountamount";
		} else {
		}	
		 ?>
		</td>
		</tr>
		


		<tr>
		<td colspan="2" align="right" valign="top">TAX:</td>
		<td align="right" valign="top" class="cartitem"><?php echo"$$tax"; ?></td>
		</tr>
	
		
		<tr>
		<td colspan="2" align="right" valign="top">SHIPPING:</td>
		<td align="right" valign="top" class="cartitem"><?php echo"$$shippingprice"; ?></td>
		</tr>
		
		<tr>
		<td colspan="2" align="right" valign="top">TOTAL:</td>
		<td align="right" valign="top" class="cartitem"><?php echo"$$total"; ?></td>
		</tr>
		
	       
		
		<tr>
		<td colspan="3" align="right" valign="top"><br /></td>
		</tr>
		
		<tr>
		<td colspan="3" align="right" valign="top">
		<div id='checkoutbuttontype'>
			<div id='updatebutton' <?php if ($ready != 2) {echo"class='show'";} else { echo"class='hide'";} ?>>
			<input type='submit' name='submit' value='Update Order Information' />
			</form>
			</div>
		
			<div id='paypalbutton' <?php if ($ready == 2) {echo"class='show'";} else { echo"class='hide'";} ?>>

			<div style="float:left; text-align:left; font-size:10px; margin:10px;">
			<strong>READ ME:</strong><br />
				When you click the purchase button, you will be directed to Paypal to complete your purchase. This is the safest way to complete a purchase over the internet because your information does not have to be sent over unsecured lines. We do not personally see your credit card information at any point during your purchase with us.
				
				<?php
				if ($revcart == 1) {
					echo"<br /><br /><span style='color:#ff0000;'>Some items in your cart have been removed due to limited supply.</span>";
				}
				?>
			</div>
		
		
			<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="custom" value="<?php echo"$memberid"; ?>">
			<input type='hidden' name='business' value='ccowan@mrwebpage.net'>
			<?php
			$itemcount = 1;
			$tablename = "member_" . $memberid;
			$result = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r = mysql_fetch_array($result);
			if (isset($_SESSION['memberloggedin'])) {
				$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
			}  else if (isset($_SESSION['guestloggedin'])) {
				$memberid = ($_SESSION['guestloggedin']);
				$result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
			} else {
				$result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
			}
			while ($r = mysql_fetch_array($result)) {
				$cartid = ($r['id']);
				$productid = ($r['productid']);
				$quantity = ($r['quantity']);
				$option1 = ($r['option1']);
				$option2 = ($r['option2']);
				$option3 = ($r['option3']);
				$option4 = ($r['option4']);
				
				
				$result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
				$r2 = mysql_fetch_array($result2);
				$category = ($r2['category']);
				$name = ($r2['name']);
				$price = ($r2['price']);
				$price2 = ($price * $quantity);
				
				if (($option1 != "")) {
					//Get Option Extra Charges
					$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
					$r7 = mysql_fetch_array($result7);
					$extracharge = ($r7['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {
						$chargedisplay .= " - $" . $extracharge . " extra";
						$price += $extracharge;
					}
					$name .= "-" . $option1name . ": " . $option1 . $chargedisplay . "-";
				}
				if ($option2 != "") {
					//Get Option Extra Charges
					$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
					$r7 = mysql_fetch_array($result7);
					$extracharge = ($r7['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {
						$chargedisplay .= " - $" . $extracharge . " extra";
						$price += $extracharge;
					}
					$name .= "-" . $option2name . ": " . $option2 . $chargedisplay . "-";
				}
				if ($option3 != "") {
					//Get Option Extra Charges
					$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
					$r7 = mysql_fetch_array($result7);
					$extracharge = ($r7['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {
						$chargedisplay .= " - $" . $extracharge . " extra";
						$price += $extracharge;
					}
					$name .= "-" . $option3name . ": " . $option3 . $chargedisplay . "-";
				}
				if ($option4 != "") {
					//Get Option Extra Charges
					$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
					$r7 = mysql_fetch_array($result7);
					$extracharge = ($r7['price']);
					$chargedisplay = "";
					if (($extracharge != "") && ($extracharge != 0)) {
						$chargedisplay .= " - $" . $extracharge . " extra";
						$price += $extracharge;
					}
					$name .= "-" . $option4name . ": " . $option4 . $chargedisplay . "-";
				}
		
				
				$price = number_format($price, 2,'.','');
				$price2 = number_format($price2, 2,'.','');
				$total += $price2;
				$itemname = "item_name_" . $itemcount;
				$itemnumber = "item_number_" . $itemcount;
				$itemamount = "amount_" . $itemcount;
				$itemquantity = "quantity_" . $itemcount;
			?>
				<input type='hidden' name='<?php echo"$itemname"; ?>' value='<?php echo"$name"; ?>'>
				<input type='hidden' name='<?php echo"$itemnumber"; ?>' value='<?php echo"$itemcount"; ?>'>
			    <input type='hidden' name='<?php echo"$itemamount"; ?>' value='<?php echo"$price"; ?>'>
			    <input type='hidden' name='<?php echo"$itemquantity"; ?>' value='<?php echo"$quantity"; ?>'>
			<?php
			$itemcount += 1;
			}
			?>
			<input type='hidden' name='discount_rate_cart' value='<?php echo"$discount"; ?>'>
			<input type='hidden' name='tax_cart' value='<?php echo"$tax"; ?>'>
			<input type='hidden' name='shipping_1' value='<?php echo"$shippingprice"; ?>'>
			<input type='hidden' name='page_style' value='' />
			<input type='hidden' name='first_name' value='<?php echo"$first"; ?>' />
			<input type='hidden' name='last_name' value='<?php echo"$last"; ?>' />
			<input type='hidden' name='country' value='<?php echo"$country"; ?>' />
			<input type='hidden' name='address1' value='<?php echo"$address"; ?>' />
			<input type='hidden' name='address2' value='<?php echo"$address2"; ?>' />
			<input type='hidden' name='city' value='<?php echo"$city"; ?>' />
			<input type='hidden' name='state' value='<?php echo"$state"; ?>' />
			<input type='hidden' name='zip' value='<?php echo"$zip"; ?>' />
			<input type='hidden' name='buyer_credit_promo_code' value=''>
			<input type='hidden' name='buyer_credit_product_category' value=''>
			<input type='hidden' name='buyer_credit_shipping_method' value=''>
			<input type='hidden' name='buyer_credit_user_address_change' value=''>
			<input type='hidden' name='number' value='<?php echo"$ccnumber"; ?>' />
			<input type='hidden' name='type' value='<?php echo"$cctype"; ?>' />
			<input type='hidden' name='expmonth' value='<?php echo"$ccexpirationmonth"; ?>' />
			<input type='hidden' name='expyear' value='<?php echo"$ccexpirationyear"; ?>' />
			<input type='hidden' name='cvv' value='<?php echo"$cccvv"; ?>' />
			<input type='hidden' name='no_shipping' value='0'>
			<input type='hidden' name='return' value='<?php echo"$baseurl/storesalecompletereturn.php"; ?>'>
			<input type="hidden" name="cancel_return" value="<?php echo"$baseurl/storesalecompletecancel.php"; ?>">
			<input type="hidden" name="notify_url" value="<?php echo"$baseurl/storesalecompleteipn.php"; ?>">
			<input type='hidden' name='no_note' value='1'>
			<input type='hidden' name='currency_code' value='USD'>
			<input type='hidden' name='lc' value='US'>
			<input type='hidden' name='bn' value='PP-BuyNowBF'>
			<input type='image' src='images/purchase.png' border='0' name='submit' alt='Make payments with PayPal - its fast, free and secure!'>
			<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
			</form>
			
			<?php
			/*
			echo"
			<form method=\"post\" action=\"http://www.supercrystals.net/storesalecomplete.php\">
			<input type=\"hidden\" name=\"first\" value=\"$first\" />
			<input type=\"hidden\" name=\"last\" value=\"$last\" />
			<input type=\"hidden\" name=\"country\" value=\"$country\" />
			<input type=\"hidden\" name=\"address\" value=\"$address\" />
			<input type=\"hidden\" name=\"address2\" value=\"$address2\" />
			<input type=\"hidden\" name=\"city\" value=\"$city\" />
			<input type=\"hidden\" name=\"state\" value=\"$state\" />
			<input type=\"hidden\" name=\"zip\" value=\"$zip\" />
			<input type=\"hidden\" name=\"number\" value=\"$ccnumber\" />
			<input type=\"hidden\" name=\"type\" value=\"$cctype\" />
			<input type=\"hidden\" name=\"expmonth\" value=\"$ccexpirationmonth\" />
			<input type=\"hidden\" name=\"expyear\" value=\"$ccexpirationyear\" />
			<input type=\"hidden\" name=\"cvv\" value=\"$cccvv\" />
			<input type=\"hidden\" name=\"total\" value=\"$total\" />
			<button class=\"custombutton\" type=\"submit\"><img src=\"images/purchase.png\" alt=\"Make Payment\"  /></button>
			</form>";
			*/
			?>
			</div>
		</div>
		</td>
		</tr>
		
		<tr>
		<td colspan="3" align="center" valign="top" class="borders" style="color:#FF0000; padding:10px;">
		<?php
			$message = ($_GET['message']);
			if ($message == 1) {
				echo"We have a limited amount of this product. <br />Please let us know which items you want more of.";
			}
			?>
		</td>
		</tr>
		</table>
		
		<table align='left' cellpadding="0px" cellspacing="2px" border="0px" width="300px" class='cart'>
		<tr>
		<td align="left" valign="top" colspan='3' class='checkoutheader'>
		<strong>PROMO CODES</strong>
		
		</td>
		</tr>
			
		<tr>
		<td colspan="2" align="right" valign="top"><?php if (isset($_SESSION['promocode'])) { echo"DISCOUNT:"; } else { echo"PROMO CODE:"; } ?></td>
		<td align="right" valign="top" class="cartitem">
		<?php
		 if (isset($_SESSION['promocode'])) {
			echo"$$discountamount - <a href='storeclearpromo.php'>Reset</a>";
		} else {
			echo"<form action='storeenterpromo.php' method='post'>";
			echo"<input type='text' name='promo' size='15' />";
			echo"<input type='image' src='images/addcode.png' border='0' name='submitcode' alt='ADD CODE'>";
			echo"</form>";
		}	
		 ?>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
            
            <!-- END Template -->
        </div>
        <div class="cl">&nbsp;</div>
    </div>
</div>
<img src="images/bottom_bg.png" width="1211"> </div>
<div class="cl"></div>
</div>
<?php require('includes/footer.php'); ?>
</body>
</html>
<?php
ob_end_flush();
?>
