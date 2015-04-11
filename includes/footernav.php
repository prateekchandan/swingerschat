<!-- START BOOKMARK LINK -->
<script language="javascript">
	<!--
	function bookmarksite(title, url) {
		if (document.all)
			window.external.AddFavorite(url, title);
		else if (window.sidebar)
			alert("Press Ctrl D keys to bookmark our site");
	}
	//-->
</script>


<?php
$result = mysql_query('SELECT * FROM pages WHERE nav3 = 1 ORDER BY pageorder ASC');
while ($r = mysql_fetch_array($result)) {
    $id = ($r['id']);
    $name = strtoupper($r['name']);
	$type = ($r['type']);
	$url = ($r['copyright']);
	$keywords = "Page" . $id . "-" . ($r['keywords']);
	$keywords = str_replace(' ', '', $keywords);
	$membersonly = ($r['membersonly']);
	if ($membersonly == 1) {
	    $good = 0;
	} else {
	    $good = 1;
	}
	if ($membersonly == 1) {
	    if ($_SESSION['membertype'] == 1) {
		$good = 1;
	    } else {
		$good = 0;
	    }
	}
	
	if ($good == 1) {
		echo"<li>";
			if (($type != "External Link") && ($type != "Dropdown Menu") && ($type != "Blog") && ($type != "Store")) { echo"<a href=\"$keywords\">$name</a>"; }
			if ($type == "Store") { echo"<a href=\"store.php\" >$name</a>"; }
			if ($type == "Blog") { echo"<a href=\"blog.php\" >$name</a>"; }
			if ($type == "External Link") { echo"<a href=\"$url\" target='_blank'>$name</a>"; }
		echo"</li>";
	} 
}
?>