<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$same = ($_GET['same']);

if ($same == 1) {
        ?>
        <input type="radio" name="same" value="0" checked="checked" />No
        <input type="radio" name="same" value="1" onclick="ShowMe('studentfields','main'), changebutton('updatebutton','checkoutbuttontype'),changeshipping(), changesame('0')";/>Yes
        <?php
} else {
        ?>
        <input type="radio" name="same" value="0" onclick="ShowMe('studentfields','main'), changebutton('updatebutton','checkoutbuttontype'),changeshipping(), changesame('1')";/>No
        <input type="radio" name="same" value="1" checked="checked" />Yes
        <?php
}
?>