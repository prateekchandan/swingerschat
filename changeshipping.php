<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$shippingzip = ($_GET['zipcode']);
$ounces = ($_GET['ounces']);

?>

<table align="center" cellspacing="0px" cellpadding="0px" class='checkout' width="280px">
<tr>
<td align='left' colspan='2' valign='top' class='checkoutheader'>
<strong>Shipping Information:</strong> 
</td>
</tr>




<tr>
<td align="left" colspan='2' valign="top" class='checkoutcellleft'>
Your shipping address has changed. Please press the update order button in the right colum to get new shipping prices.
</td>
</tr>
</table>
 