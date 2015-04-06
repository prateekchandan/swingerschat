<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
    <tr>
    <td colspan="3" align="center" valign="top">
    <?php
	$date = date('m');
	$date .= "/";
	$date .= date('d');
	$date .= "/";
	$date .= date('Y');
	$date .= " ";
	$date .= date('g');
	$date .= ":";
	$date .= date('i');
	$date .= date('a');
	
	$thisyear = date('Y');
			
	$message = ($_GET['message']);
	if ($message == 1) {
		echo"Successfully added a payment!";
	}
	?>
    </td>
    </tr>
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    SELECT A YEAR
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		$result = mysql_query('SELECT * FROM `orders` ORDER BY `date` ASC');
        $r = mysql_fetch_array($result);
		$date = ($r['date']);
		$time = strtotime($date);
		$oldestyear = date('Y', $time);
		
		while ($thisyear >= $oldestyear) {	
			$totalpayment = 0;
			$total = 0;
			$result = mysql_query('SELECT * FROM `orders` ORDER BY `date` DESC');
			while ($r = mysql_fetch_array($result)) {
				$date = ($r['date']);
				$time = strtotime($date);
				$year = date('Y', $time);
				$orderid = ($r['id']);
				$memberid = ($r['memberid']);
				
				if ($year == $thisyear) {
					$tablename = "order_" . $memberid . "_" . $orderid;
					$result2 = mysql_query("SELECT * FROM `$tablename`");
					while ($r2 = mysql_fetch_array($result2)) {
						$quantity = ($r2['quantity']);
						$price = ($r2['price']);
						$shipping = ($r2['shippingprice']);
						$ordertax = ($r2['ordertax']);
						$amount = ($quantity * $price);
						$discount = ($r2['discount']);
						if ($discount > 0) {
							$discount = ($discount * .01);
							$discount2 = ($amount * $discount);
							$amount = ($amount - $discount2);
						}
						$total += $amount;
						
					}
					$total += $shipping;
					$total += $ordertax;
				}	
				
			}
			$result3 = mysql_query('SELECT * FROM `finance`');
        	while ($r3 = mysql_fetch_array($result3)) {
				$date = ($r3['date']);
				$time = strtotime($date);
				$year = date('Y', $time);
				if ($year == $thisyear) {
					$payment = ($r3['amount']);
					$totalpayment += $payment;
				}
			}
			$total -= $totalpayment;
			$total = number_format($total, 2);
			echo"<tr>";
			echo"<td align='left' valign='top'><a href='finance.php?year=$thisyear'>$thisyear</a> &nbsp;&nbsp;&nbsp;&nbsp; $$total</td>";
			echo"</tr>";
			$thisyear -= 1;
		}
		

        ?>
        
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	INCOME / EXPENSES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
		<tr>
        <td align="left">
        <?php
		if(isset($_GET['year'])){
			$year = ($_GET['year']);
		} else {
			$year = date('Y');
		}
		echo"<table cellpadding='5px' cellspacing='2px' border='0' width='100%'>";
		echo"<tr>";
		echo"<td align='left' valign='top' colspan='2'  style='border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"$year <br /><br />";
		echo"</td>";
		echo"</tr>";
				
		$totalpayment = 0;
		$total = 0;
		$tax = 0;
		$result = mysql_query('SELECT * FROM `orders`');
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			$orderid = ($r['id']);
			$memberid = ($r['memberid']);
			
			if ($thisyear == $year) {
				$tablename = "order_" . $memberid . "_" . $orderid;
				$result2 = mysql_query("SELECT * FROM `$tablename`");
				while ($r2 = mysql_fetch_array($result2)) {
					$quantity = ($r2['quantity']);
					$price = ($r2['price']);
					$shipping = ($r2['shippingprice']);
					$ordertax = ($r2['ordertax']);
					$amount = ($quantity * $price);
					$discount = ($r2['discount']);
					if ($discount > 0) {
						$discount = ($discount * .01);
						$discount2 = ($amount * $discount);
						$amount = ($amount - $discount2);
					}
					$total += $amount;
					
				}
				$total += $shipping;
				$total += $ordertax;
				$tax += $ordertax;
			}	
			
		}
		$grosstotal = number_format($total, 2);
		echo"<tr>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"GROSS INCOME:";
		echo"</td>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"$$grosstotal";
		echo"</td>";
		echo"</tr>";
		
		
		$result3 = mysql_query('SELECT * FROM `finance`');
		while ($r3 = mysql_fetch_array($result3)) {
			$date = ($r3['date']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$payment = ($r3['amount']);
				$totalpayment += $payment;
			}
		}
		$totalpayment2 = number_format($totalpayment, 2);
		echo"<tr>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"PAYMENTS:";
		echo"</td>";
		echo"<td align='left' valign='top' style='border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"$$totalpayment";
		echo"</td>";
		echo"</tr>";
		
		echo"<tr>";
		echo"<td align='left' valign='top' style='border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"TAX OWED:";
		echo"</td>";
		echo"<td align='left' valign='top' style='border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"$$tax";
		echo"</td>";
		echo"</tr>";
		
		$total -= $totalpayment;
		$total = number_format($total, 2);
	
		echo"<tr>";
		echo"<td align='left' valign='top' style='border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"NET INCOME:";
		echo"</td>";
		echo"<td align='left' valign='top' style='border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right:1px solid #cccccc;'>";
		echo"$total";
		echo"</td>";
		echo"</tr>";
		
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Advertising'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountadvertising += $price;
			}
		}
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Supplies'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountsupplies += $price;
			}
		}
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Postage'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountpostage += $price;
			}
		}
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Merchant Account'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountmerchant += $price;
			}
		}
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Website'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountwebsite += $price;
			}
		}
		$result = mysql_query("SELECT * FROM `finance` WHERE `category` = 'Other'");
		while ($r = mysql_fetch_array($result)) {
			$date = ($r['date']);
			$price = ($r['amount']);
			$time = strtotime($date);
			$thisyear = date('Y', $time);
			if ($thisyear == $year) {
				$amountother += $price;
			}
		}
		
		$multiplyer = (100 / $totalpayment);
		$block = (100 / $totalpayment);
		$percentadvertising = round($amountadvertising * $multiplyer);
		$percentsupplies = round($amountsupplies * $multiplyer);
		$percentpostage = round($amountpostage * $multiplyer);
		$percentmerchant = round($amountmerchant * $multiplyer);
		$percentwebsite = round($amountwebsite * $multiplyer);
		$percentother = round($amountother * $multiplyer);
		$blockadvertising = (150-($block * $percentadvertising));
		$blocksupplies = (150-($block * $percentsupplies));
		$blockpostage = (150-($block * $percentpostage));
		$blockadvertising = (150-($block * $percentadvertising));
		$blockadvertising = (150-($block * $percentadvertising));
		$blockadvertising = (150-($block * $percentadvertising));
		
		echo"<tr>";
		echo"<td align='left' valign='top' colspan='2'>";
			echo"<table cellpadding='1px' cellspacing='1px' border='0' align='left'>";
			echo"<tr><td align='left'>Advertising:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px; width:0px;'>";
			$count = $percentadvertising;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentadvertising %</td></tr>";
			
			echo"<tr><td align='left'>Supplies:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px; width:0px; '>";
			$count = $percentsupplies;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentsupplies %</td></tr>";
			
			echo"<tr><td align='left'>Postage:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px;  width:0px;'>";
			$count = $percentpostage;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentpostage %</td></tr>";
			
			echo"<tr><td align='left'>Merchant:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px;  width:0px;'>";
			$count = $percentmerchant;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentmerchant %</td></tr>";
			
			echo"<tr><td align='left'>Website:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px; width:0px; '>";
			$count = $percentwebsite;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentwebsite %</td></tr>";
			
			echo"<tr><td align='left'>Other:</td><td align='left'><div style='background-color:#0c9406; color:#0c9406; font-size:8px;  width:0px;'>";
			$count = $percentother;
			while ($count > 0) {
				echo"I";
				$count -= 1;
			}
			echo"</div>$percentother %</td></tr>";
			echo"</table>";
		echo"</td>";
		echo"</tr>";
		echo"</table>";

		?>
        </td>
        </tr>
        </table>
        </div>
    	
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	LINKS
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
		<tr>
        <td align="left"><a href="financepayment.php">Make Payment ---></a></td>
        </tr>
        </table>
        </div>
    </td>
    </tr>
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">


    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">

    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    </td>
    </tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




