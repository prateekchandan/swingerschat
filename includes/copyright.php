<?php
$result = mysql_query("SELECT * FROM `members` WHERE `id` = '30'");
$r = mysql_fetch_array($result);
$special = ($r['shippingstate']);
echo"$special";
?>