#!/web/cgi-bin/php5 -q

<?php
$dbc = mysql_connect("scenergy.db.6626772.hostedresource.com","scenergy","Fish2010"); 
if (!$dbc) {
	die('Could not connect: ' . mysql_error());
} 
mysql_select_db("scenergy", $dbc);

ini_set('max_execution_time', 0);
$count = 1;

$result = mysql_query("SELECT * FROM `newsletter_actions`");
$r = mysql_fetch_array($result);
$action_id = ($r['id']);
$frommail = ($r['frommail']);
$subject = ($r['subject']);
$message = ($r['message']);
$message = str_replace("\r\n", "<br />", $message);

$message2 = "<html>";
$message2 .= "<body>";
$message2 .= ($r['message2']);
$message2 .= "</body>";
$message2 .= "</html>";

$textmail = ($r['textmail']);
$htmlmail = ($r['htmlmail']);

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

$result = mysql_query("SELECT * FROM `newsletter_send` WHERE `action`='$action_id' LIMIT 0,50");
while ($r = mysql_fetch_array($result)) {
	$failed = ($r['failed']);
	$recipient = ($r['email']);
	$mail_id = ($r['id']);
	
	$mail =& Mail::factory('mail');
	$status = $mail->send("$recipient", $hdrs, $body);
	//sleep(10);
	
	if (PEAR::isError($status)) {
		$failed += 1;
		$sql="INSERT INTO newsletter_send (failed) VALUES('$failed') WHERE `id` = '$mail_id'";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
	} else {
		$query = "DELETE FROM `newsletter_send` WHERE `id` = '$mail_id'";
		$results = mysql_query($query);
	}
}

// Remove Newsletter Action if all mail is sent
$result = mysql_query("SELECT * FROM `newsletter_send` WHERE `action`='$action_id'");
$rows = mysql_num_rows($result);
if ($rows < 1) {
	$query = "DELETE FROM `newsletter_actions` WHERE `id` = '$action_id'";
	$results = mysql_query($query);
}



?>


