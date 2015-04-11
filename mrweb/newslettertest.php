<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
<?php


$result = mysql_query('SELECT * FROM members WHERE admin = 1');
$r = mysql_fetch_array($result);
$adminemail = ($r['email']);

$result = mysql_query("SELECT * FROM `newsletter_templates` WHERE `active` = '1'");
$r = mysql_fetch_array($result);
$frommail = ($r['frommail']);
$subject = ($r['subject']);
$message = ($r['message']);
$message .= "\n\nTo Unsubscribe: http://www.scenergy-dating.com/newsletterunsubscribe.php";

$message2 = "<html>";
$message2 .= "<body>";
$message2 .= ($r['message2']);
$message2 .= "</body>";
$message2 .= "</html>";
$message2 .= "\n\n<a href='http://www.scenergy-dating.com/newsletterunsubscribe.php'>Unsubscribe from this mailing list.</a>";

$textmail = ($r['textmail']);
$htmlmail = ($r['htmlmail']);
$template_name = ($r['name']);


ini_set("include_path", '/home/content/72/6626772/html/go-pear/PEAR/' . ini_get("include_path") );

include_once('/home/content/72/6626772/html/go-pear/PEAR/Mail.php');
include_once('/home/content/72/6626772/html/go-pear/PEAR/Mail/mime.php');

$file = '/home/richard/example.php';
$crlf = "\n";

$hdrs = array(
              'From'    => "$frommail",
              'Subject' => "$subject"
              );

$mime = new Mail_mime($crlf);

if ($textmail == 1) {
	$mime->setTXTBody($message);  //send text email
}
if ($htmlmail == 1) {
	$mime->setHTMLBody($message2);   //send html email
}
// $mime->addAttachment($file, 'text/plain');   //send attachment

//do not ever try to call these lines in reverse order
$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$status = $mail->send("$adminemail", $hdrs, $body);
//sleep(10);


header("Location: newsletter.php");
exit;


?>




</td>
</tr>


<?php
require ('includes/footer.php');
?>




