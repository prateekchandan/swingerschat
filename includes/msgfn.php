<?php

include "dbconnect2.php";
session_start();
$_GET = array_merge($_GET , $_POST);
if (!isset($_SESSION['memberloggedin'])) {
    echo json_encode(array());
    exit();
}

$memberid = ($_SESSION['memberloggedin']);


function GetAllMessages($userid)
{
	global $memberid;
	$name = array($userid => "", $memberid=>"Me");
		
	$q = mysql_query("SELECT `username` FROM `members` WHERE `id` = '$userid'");

	if(mysql_num_rows($q) == 0){
		return array();
	}

	$name[$userid] = mysql_fetch_assoc($q)['username'];

	$messages = mysql_query("SELECT * FROM `messages` WHERE 
			(`memberid` = '$memberid' && `friendid` = '$userid') ||
			(`memberid` = '$userid' && `friendid` = '$memberid') 
			order by `timestamp` desc
			");

	$return = array();
	$check = "No Show";
	while($row = mysql_fetch_assoc($messages)){
		$t1 = strtotime($row['timestamp']);
		$t2 = time();

		$t2 = $t2 - $t1;
		$str = "";
		
		if($t2<60)
			$str = $t2." seconds ago";
		else{
			$t2 = intval($t2/60);
			if($t2<60)
				$str = $t2." minutes ago";
			else{
				$t2 = intval($t2/60);
				if($t2<60)
					$str = $t2." hours ago";
				else{
					$t2 = intval($t2/24);
					$str = $t2." days ago";
				}
			}
		}


		if($row['memberid'] == $memberid){
			$temp = array(1,$name[$memberid],$row['comment'],$str);
		}
		if($row['memberid'] == $userid){
			$temp = array(0,$name[$userid],$row['comment'],$str);
			$check = "Show";
		}
		array_push($return, $temp);
	}
	return array_merge(array($check,$name[$userid]),$return);
}