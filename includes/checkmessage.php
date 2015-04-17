<?php

include 'msgfn.php';

$messages = mysql_query("SELECT * FROM `messages` WHERE `new` = '1' &&
		(`memberid` = '$memberid' || `friendid` = $memberid )");

//mysql_query("UPDATE `messages` set `new` = '0' where `friendid` = $memberid ");

$users = array();

while($row = mysql_fetch_assoc($messages)){
	if($row['friendid'] == $memberid)
		$mem = $row['memberid'];
	else
		$mem = $row['friendid'];

	$users[$mem] = GetAllMessages($mem);
}

echo json_encode($users);