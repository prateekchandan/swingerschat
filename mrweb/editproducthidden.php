<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
    <tr>
    <td colspan="3" align="center" valign="top">
    <?php
	
	$date = date('m');
	$date .= "/";
	$date .= date('d');
	$date .= "/";
	$date .= date('Y');
	$date .= " ";
	$date .= date('g');
	$date .= ":";
	$date .= date('i');
	$date .= date('a');
			
	$message = ($_GET['message']);
	if ($message == 1) {
		echo"Successfully added a new category!";
	}
	if ($message == 2) {
		echo"Successfully added a new product!";
	}

	?>
    </td>
    </tr>

    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    <div style="overflow:hidden; background-color:#FFFFFF;">
    <?php
	$result = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
    echo"<ul class=\"storenav\">";
    while ($r = mysql_fetch_array($result)) {
        $category = ($r['name']);
		$categoryid = ($r['id']);
		echo"<li>";
		echo"<a href=\"editproduct2.php?categoryid=$categoryid&category=$category\">$category</a>";
		echo"</li>";
    }
	echo"</ul>";
    ?>

    </div>
    </td>
    
    <td align="center" valign="top" colspan='2' style="background-color:#CCCCCC;">
    <div style="overflow:hidden; background-color:#FFFFFF;">
    <?php
		$category = ($_GET['category']);
		$categoryid = ($_GET['categoryid']);
		?>
    	<table cellpadding="2" cellspacing="2px" border="0" width="100%">
        <tr>
        <td colspan="4" align="left" style='border:1px solid #cccccc;' >
        Choose Product to Edit - <a href="editproduct.php">Featured Items</a> - Hidden Items
        </td>
        </tr>
        
		<?php



		$result = mysql_query("SELECT * FROM `products`");
		$count = 0;
		while ($r = mysql_fetch_array($result)) {
			$categoryid = ($r['category']);
			$result2 = mysql_query("SELECT * FROM `store_categories` WHERE `id`='$categoryid'");
			$rows2 = mysql_num_rows($result2);
			if ($rows2 < 1 ) {
				$id = ($r['id']);
				$name = ($r['name']);
				$pic1 = ($r['pic1']);
				$price = ($r['price']);
				$part = ($r['partnumber']);
				echo"<tr>";
				echo"<td align=\"left\" valign=\"top\" width=\"50px\" class=\"catalog\">";
					echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
					echo"<a href=\"storeproductorderup.php?productid=$id&categoryid=$categoryid&category=$category\"><img src=\"images/arrowup.jpg\" /></a>";
					echo"</td></tr><tr><td>";
					echo"<a href=\"storeproductorderdown.php?productid=$id&categoryid=$categoryid&category=$category\"><img src=\"images/arrowdown.jpg\" /></a>";
					echo"</td></tr></table>";
				echo"</td>";
				echo"<td align=\"left\" valign=\"top\" width=\"50px\" class=\"catalog\">";
				echo"$part";
				echo"</td>";
				echo"<td align=\"left\" valign=\"top\" width=\"200px\" class=\"catalog\">";
				echo"<a href=\"editproduct3.php?id=$id\">$name</a>";
				echo"</td>";
				echo"<td align=\"left\" valign=\"top\" width=\"25px\" class=\"catalog\">";
				echo"<a href=\"removeproduct.php?id=$id&url=$url\" style='color:#FF0000;' onclick=\"return confirm('Are you sure you want to delete this product?');\">DELETE</a>";
				echo"</td>";
				echo"</tr>";
			}
		}

		?>
        </table>
    </div>
    </td>
	</tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




