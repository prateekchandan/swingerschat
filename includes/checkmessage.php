<?php

include 'msgfn.php';

if(isset($_POST['post_type'])){
		if($_POST['post_type']=="SEND_MESSAGE"){
			$message = $_POST['message'];
			$frndid = $_POST['userid'];
			$userid = $_SESSION['memberloggedin'];
			mysql_query("INSERT INTO `messages`
				(`memberid` , `friendid` , `comment` ,`timestamp` ,`new` ,`messageid`) values
				('$userid','$frndid' ,'$message',current_timestamp,1,'')");
			echo "success";
			exit();
		}
}

$messages = mysql_query("SELECT * FROM `messages` WHERE (`new` = '1' && `friendid` = $memberid) ||
		`memberid` = '$memberid' ");


$users = array();

while($row = mysql_fetch_assoc($messages)){
	if($row['friendid'] == $memberid)
		$mem = $row['memberid'];
	else
		$mem = $row['friendid'];

	$users[$mem] = GetAllMessages($mem);
}

mysql_query("UPDATE `messages` set `new` = '0' where `friendid` = $memberid ");


echo json_encode($users);