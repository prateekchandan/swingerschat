<div style=" background-color:#000000; height:45px; width:100%; position:fixed; top:0px;z-index:200; text-align:center; padding-top:0px; color:#ffffff; font-size:12px;">
	<?php
    $result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
    $r = mysql_fetch_array($result);
    $phone = ($r['shippingcountry']);
	?>
	<table align='center' cellpadding='0' cellspacing='0' border='0'>
    <tr>
    <td align='left' valign='middle'>
	<?php
    $memberid = ($_SESSION['memberloggedin']);
    if (isset($_SESSION['memberloggedin'])) {
        echo"<a href='logout.php'>Safely logout here.</a>";
    } else {
        echo"Welcome Guest, Click here to <a href='login.php'>login</a> or <a href='signup.php'>register</a>";
    }	
    ?>
	</td>
    
    <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <?php echo"$phone"; ?>
    </td>
    
    <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <?php
    $memberid = ($_SESSION['memberloggedin']);
    if (isset($_SESSION['memberloggedin'])) {
        echo"<a href='members.php'>My Account</a>";
    } else {
        echo"<a href='login.php'>My Account</a>";
    }	
    ?>
    
    </td>
    
    <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <a href='http://www.supercrystals.net/contact.php?id=41'>Contact Us</a>
    </td>
    
    <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <a href='storerecentlyviewed.php'>Recently Viewed</a>
    </td>
    
    <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <a href='storeviewcart.php'><img src='images/viewcart.png'/></a>
    </td>
    
     <td align='left' valign='middle'>
    <img src='images/divider.png' style='margin:0px 10px 0px 10px;'/>
    </td>
    
    <td align='left' valign='middle'>
    <?php
	$subtotal = 0.00;
	$items = 0;
	if (isset($_SESSION['memberloggedin'])) {
		$membertable = "member_" . $memberid;
		$result = mysql_query("SELECT * FROM `$membertable`");
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$result2 = mysql_query("SELECT price FROM `products` WHERE `id`='$productid'");
			$r2 = mysql_fetch_array($result2);
			$price = ($r2['price']);
			$price = ($price * $quantity);
			$items += $quantity;
			$subtotal += $price;
		}
	} else {
		$ip=getenv("REMOTE_ADDR");
		$result = mysql_query("SELECT * FROM `guests` WHERE `ip`='$ip'");
		while ($r = mysql_fetch_array($result)) {
			$productid = ($r['productid']);
			$quantity = ($r['quantity']);
			$result2 = mysql_query("SELECT price FROM `products` WHERE `id`='$productid'");
			$r2 = mysql_fetch_array($result2);
			$price = ($r2['price']);
			$price = ($price * $quantity);
			$items += $quantity;
			$subtotal += $price;
		}
	}
	$subtotal = number_format($subtotal, 2);
	echo"Items: $items <br />";
	echo"Subtotal: $$subtotal";
	?>
    </td>
    
    </tr>
    </table>

</div>