<ul>
<?php
$pageid = $id;
$result = mysql_query("SELECT * FROM `pages` WHERE `nav1` = '1' ORDER BY pageorder ASC");
$rows = mysql_num_rows($result);
$height = ($rows * 26) . "px";
$count == 0;
while ($r = mysql_fetch_array($result)) {
	$id = ($r['id']);
        $name = ($r['name']);
	$url = ($r['copyright']);
        $target = ($r['target']);
	$type = ($r['type']);
	$membersonly = ($r['membersonly']);
	$dropdown1 = ($r['dropdown1']);
	$keywords = "Page" . $id . "-" . ($r['keywords']);
	//$keywords = str_replace(' ', '', $keywords);
	$keywords = preg_replace("([^a-zA-Z0-9-])","",$keywords);
	
	$file = $_SERVER['PHP_SELF'];
	$file = explode('/', $file);
	$file = $file[count($file) - 1]; 
	$style = '';
	$style2 = '';
	if (($pageid == $id) && (($file == "index.php") || ($file == "index2.php") || ($file == "contact.php") || ($file == "gallery.php"))) {
		//$style='background-color:#1c5799;';
		//$style2='color:#000000;';
	}
	
	if ($membersonly == 1) {
	    $good = 0;
	} else {
	    $good = 1;
	}
	if ($membersonly == 1) {
	    if (isset($_SESSION['memberloggedin'])) {
		$good = 1;
	    } 
	}
	
	if ($good == 1) {
	    if (($type != "External Link") && ($type != "Dropdown Menu") && ($type != "Blog") && ($type != "Store")) { echo"<li style='$style'><a href=\"$keywords\" style='$style2'>$name</a>"; }
	    //if ($type == "Store") { echo"<li style='$style'><a href=\"store.php\" style='$style2'>$name</a>"; }
	  
	      if ($type == "Store") {
		echo"<li style='$style'><a href=\"store.php\" style='$style2'>$name</a>";
		$result3 = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
		echo"<ul>";
				
		while ($r3 = mysql_fetch_array($result3)) {
			$catid = ($r3['id']);
			$catname = ($r3['name']);
			$result4 = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid'");
			$rows4 = mysql_num_rows($result4);
			//if ($rows4 > 0) {
				echo"<li>";
				echo"<a href=\"store.php?catid=$catid\">$catname</a>";
				echo"</li>";
			//}
		}
		echo"<li>";
				echo"<a href=\"store.php\">All Items</a>";
				echo"</li>";
		echo"</ul>";
	    }
	    if ($type == "Blog") { echo"<li style='$style'><a href=\"blog.php\" style='$style2'>$name</a>"; }
	    if ($type == "External Link") { echo"<li style='$style'><a href=\"$url\" target='_blank' style='$style2'>$name</a>"; }
	    if ($type == "Dropdown Menu") { 
		$tablename = "Dropdown_" . $id;
		$result3 = mysql_query("SELECT * FROM `$tablename` WHERE `pageid` = '$pageid'");
		$rows3 = mysql_num_rows($result3);
		if ($rows3 > 0) {
			//$style2='color:#000000;';
		}
		//Get Page Link for main nav link
		$result2 = mysql_query("SELECT * FROM `$tablename` ORDER BY pageorder ASC");
		$rows2 = mysql_num_rows($result2);
		$r2 = mysql_fetch_array($result2);
		$mainid = ($r2['pageid']);
		$result5 = mysql_query("SELECT * FROM `pages` WHERE `id` = '$target'");
		$r5 = mysql_fetch_array($result5);
		$mainname = ($r5['name']);
		$mainkeywords = "Page" . $target . "-" . ($r5['keywords']);
		//$mainkeywords = str_replace(' ', '', $mainkeywords);
		$mainkeywords = preg_replace("([^a-zA-Z0-9-])","",$mainkeywords);
		if ($rows2 > 0) {
			echo"<li style='$style'><a href=\"$mainkeywords\" style='$style2'>$name</a>";
		} else {
			echo"<li style='$style'><a href=\"#\" style='$style2'>$name</a>";
		}
		if ($rows2 > 0) {
		    echo"<ul>";
		    $result2 = mysql_query("SELECT * FROM `$tablename` ORDER BY pageorder ASC");
		    while ($r2 = mysql_fetch_array($result2)) {
			$dropdownpageid = ($r2['pageid']);
			$dropdownpagetype = ($r2['type']);
			$result3 = mysql_query("SELECT * FROM `pages` WHERE `id` = '$dropdownpageid'");
			$r3 = mysql_fetch_array($result3);
			$dropdownpagename = ($r3['name']);
			$dropdownurl = ($r3['copyright']);
			$dropdownmembersonly = ($r3['membersonly']);
			$dropdownkeywords = "Page" . $dropdownpageid . "-" . ($r3['keywords']);
			//$dropdownkeywords = str_replace(' ', '', $dropdownkeywords);
			$dropdownkeywords = preg_replace("([^a-zA-Z0-9-])","",$dropdownkeywords);
	
			if ($membersonly == 1) {
			    $good = 0;
			} else {
			    $good = 1;
			}
			if ($dropdownmembersonly == 1) {
			    if ($_SESSION['membertype'] == 1) {
				$good = 1;
			    }
			}
			
			
			
			if ($good == 1) {
			    echo"<li>";
			    if (($dropdownpagetype != "External Link") && ($dropdownpagetype != "Dropdown Menu") && ($dropdownpagetype != "Blog") && ($dropdownpagetype != "Store")) { echo"<a href=\"$dropdownkeywords\">$dropdownpagename</a>"; }
			    if ($dropdownpagetype == "Store") { echo"<a href=\"store.php\" >$dropdownpagename</a>"; }
			    if ($dropdownpagetype == "Blog") { echo"<a href=\"blog.php\" >$dropdownpagename</a>"; }
			    if ($dropdownpagetype == "External Link") { echo"<a href=\"$url\" target='_blank' >$dropdownpagename</a>"; }
			    echo"</li>";
			}
		    }
		    echo"</ul>";
		}
	    }
	    echo"</li>";
	
	}
	/*
	$count += 1;
	if ($count < $rows) {
		echo"<li><img src='images/navline.jpg' /></li>";
	}
	*/

}
/*
$file = $_SERVER['PHP_SELF'];
$file = explode('/', $file);
$file = $file[count($file) - 1]; 

if ((isset($_SESSION['memberloggedin'])) && ($file != "logout.php")) {
	echo"<li><a href='members.php'>My Account</a></li>";
	echo"<li><a href='logout.php'>Logout</a></li>";
} else {
	echo"<li><a href='login.php'>Login</a></li>";
	echo"<li><a href='signup.php'>Sign Up</a></li>";
}

*/

?>
</ul>

