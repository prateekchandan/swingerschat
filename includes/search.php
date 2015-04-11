<table align="left" cellpadding="0" cellspacing="0px" width="100%" style='margin:0px 0px 0px 0px;'>
<tr>
<td align='left' valign="top" width='196px'>


    <?php
    $result = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
    echo"<ul class=\"storenav\">";

    while ($r = mysql_fetch_array($result)) {
        $category = ($r['name']);
		$name2 = ($r['name2']);
        $categoryid = ($r['id']);
		
		$result2 = mysql_query("SELECT * FROM `products` WHERE `category` = '$categoryid' AND `quantity` > '0'");
		$rows2 = mysql_num_rows($result2);
		if ($rows2 > 0) {
			echo"<li>";
			echo"<a href=\"store.php?category=$category&categoryid=$categoryid\">$category</a>";
			$result3 = mysql_query("SELECT * FROM `store_subcategories` ORDER BY `pageorder`");
			echo"<ul>";
        	while ($r3 = mysql_fetch_array($result3)) {
				$subid = ($r3['id']);
				$subname = ($r3['name']);
				$result4 = mysql_query("SELECT * FROM `products` WHERE `category` = '$categoryid' AND `subcategory` = '$subid' AND `quantity` > '0'");
				$rows4 = mysql_num_rows($result4);
				if ($rows4 > 0) {
					echo"<li>";
					echo"<a href=\"store.php?category=$category&categoryid=$categoryid&subid=$subid\">$subname</a>";
					echo"</li>";
				}
			
			}
			echo"</ul>";
			echo"</li>";
		}
    }
    echo"</ul>";
    ?>
<!--    
<div style='color:#FFFFFF; text-align:left; margin:10px 0px 0px 10px;'>PRODUCT SEARCH<br />  </div>
<div class='keywordsearch'>
<form enctype='multipart/form-data' action="store.php" method='post'>
<table cellpadding='0' cellspacing='0' border='0'>
<tr>
<td>
<input type='text' size='20' name='keyword' value='Type Here...' style='width:165px; height:21px; border:1px solid #20211d; background-color:#151414; color:#393838;' onFocus="javascript:this.value=''" autocomplete="off"/>
</td>
</tr>
<tr>
<td>
<input type='image' src='images/search.png' border='0' name='submit' alt='Search!'>
</td>
</tr>
</table>
</form>
</div>
-->
</td>
</tr>
</table>

