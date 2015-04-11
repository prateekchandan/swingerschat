<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
<tr>
<td class='sidetop2'>
</td>
</tr>

<tr>
<td class='sidemiddle1'>
<?php
$result = mysql_query("SELECT * FROM `members` WHERE `admin` = '1'");
$r = mysql_fetch_array($result);
$ads= stripslashes($r['shippingzip']);
echo"$ads";

?>
</td>
</tr>

<tr>
<td class='sidebottom1'>
</td>
</tr>
</table>

