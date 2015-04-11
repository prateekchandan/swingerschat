<?php
require ('includes/dbconnect.php');
require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
<?php

$email = trim($_POST['email']);
$email = stripslashes($_POST['email']);
$name = stripslashes($_POST['name']);
$phone = stripslashes($_POST['phone']);
$code = mysql_real_escape_string($_POST['code']);
$date = stripslashes($_POST['date']);
$time = stripslashes($_POST['time']);
$comments = stripslashes($_POST['comments']);
$address = stripslashes($_POST['address']);

if ($name != "") {$_SESSION['form1'] = $name;} else {unset ($_SESSION['form1']);}
if ($email != "") {$_SESSION['form2'] = $email;} else {unset ($_SESSION['form2']);}
if ($phone != "") {$_SESSION['form3'] = $phone;} else {unset ($_SESSION['form3']);}
if ($address != "") {$_SESSION['form7'] = $address;} else {unset ($_SESSION['form7']);}
if ($date != "") {$_SESSION['form4'] = $date;} else {unset ($_SESSION['form4']);}
if ($time != "") {$_SESSION['form5'] = $time;} else {unset ($_SESSION['form5']);}
if ($comments != "") {$_SESSION['form6'] = $comments;} else {unset ($_SESSION['form6']);}

$message = "NAME: $name \nE-MAIL: $email \nPHONE: $phone \nADDRESS: $address \nDATE TO MEET: $date \nTIME TO MEET: $time \nCOMMENTS: $comments";

if (($code == 4) || ($code == four) || ($code == Four)) {
    mail( "$adminemail", "$sitename - Contact Form", "$message", "From: $adminemail" ) ;
    
    unset ($_SESSION['form1']);
    unset ($_SESSION['form2']);
    unset ($_SESSION['form3']);
    unset ($_SESSION['form4']);
    unset ($_SESSION['form5']);
    unset ($_SESSION['form6']);
    unset ($_SESSION['form7']);

    header('Location: index.php?id=77');
    exit();
} else {
    header('Location: index.php?id=78');
    exit();
}


?>
</td>
</tr>
<?php
require ('includes/footer.php');
?>
</table>
</body>
</html>

<?php
ob_end_flush();
?>
