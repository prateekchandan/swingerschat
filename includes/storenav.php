<?php
echo"<ul class='storenav'>";
$result = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
while ($r = mysql_fetch_array($result)) {
	$category = ($r['name']);
	$catid = ($r['id']);
	$result2 = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `quantity` > '0'");
	$rows2 = mysql_num_rows($result2);
	if ($rows2 > 0) {
		echo"<li>";
		echo"<a href=\"store.php?catid=$catid\">Buy $category</a>";
		$result3 = mysql_query("SELECT * FROM `store_subcategories` ORDER BY `pageorder`");
		$rows3 = mysql_num_rows($result3);
		if ($rows3 > 0) {
			echo"<ul>";
			while ($r3 = mysql_fetch_array($result3)) {
				$subid = ($r3['id']);
				$subname = ($r3['name']);
				$result4 = mysql_query("SELECT * FROM `products` WHERE `category` = '$catid' AND `subcategory` = '$subid' AND `quantity` > '0'");
				$rows4 = mysql_num_rows($result4);
				if ($rows4 > 0) {
					echo"<li>";
					echo"<a href=\"store.php?catid=$catid&subid=$subid\">$subname</a>";
					echo"</li>";
				}
			}
			echo"</ul>";
		}
		echo"</li>";
	}
}
echo"</ul>";
?>