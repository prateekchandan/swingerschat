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
    EDIT CATEGORIES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
		<td align='left' valign='top' colspan='4'><a href='addstorecategory.php'>Add New Category --></a></td>
		</tr>
        <?php
        $result = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$categoryid = ($r['id']);
			$pageorder = ($r['pageorder']);
			$name = ($r['name']);
			echo"
			<tr>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			<a href=\"removestorecategory.php?id=$categoryid\" onclick=\"return confirm('Are you sure you want to delete this category?');\"><img src='images/trashcan.jpg'></a>
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			<a href=\"editstorecategory.php?id=$categoryid\"><img src='images/edit.jpg'></a>
			</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
				echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
				echo"<a href=\"storecategoryorderup.php?order=$pageorder&id=$categoryid\"><img src=\"images/arrowup.jpg\" /></a>";
				echo"</td></tr><tr><td>";
				echo"<a href=\"storecategoryorderdown.php?order=$pageorder&id=$categoryid\"><img src=\"images/arrowdown.jpg\" /></a>";
				echo"</td></tr></table>";
			echo"</td>";
			
			echo"
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
			$name
			</td>
			</tr>";
        }
        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	EDIT PRODUCTS
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
		<td align='left' valign='top' colspan='3'>
        <a href='addstoreproduct.php'>Add New Product --></a>
        <br /><br />
        <a href='editproduct.php'>Edit Existing Products --></a>
        <br /><br />
        <a href='editproducthidden.php'>View Hidden Products --></a>
        </td>
		</tr>
        </table>
        </div>
    	
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	NEW ORDERS
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
        <td align="left" valign="middle" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>USERNAME</td>
		<td align="left" valign="middle" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>TRANSACTION ID</td>
        </tr>
        
        <?php
        $result = mysql_query("SELECT * FROM `orders` WHERE `shipped` = '0' and `paid` = '1'");
        while ($r = mysql_fetch_array($result)) {	
			$memberid = ($r['memberid']);
			$date = ($r['date']);
			$orderid = ($r['id']);
			$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
			$r2 = mysql_fetch_array($result2);
			$username = ($r2['username']);
			$first = ($r2['first']);
			$last = ($r2['last']);
			echo"
			<tr>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			$first $last
			</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
			echo"<a href=\"neworders.php?orderid=$orderid\">$orderid</a>";
			echo"</td>";
        }
        ?>
        
        <tr>
        <td align="center" valign="middle" colspan='2' style='border-top:1px solid #F7F7F7;'><br />
<a href='orderhistory.php'>View Order History</a></td>
        </tr>
        </table>
        </div>
    </td>
    </tr>
	<?php
	/*
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	EDIT SUB-CATEGORIES
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
		<td align='left' valign='top' colspan='4'><a href='addstoresubcategory.php'>Add New Sub-Category --></a></td>
		</tr>
        <?php
        $result = mysql_query("SELECT * FROM `store_subcategories` ORDER BY `pageorder` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$categoryid = ($r['id']);
			$pageorder = ($r['pageorder']);
			$name = ($r['name']);
			echo"
			<tr>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			<a href=\"removestoresubcategory.php?id=$categoryid\" onclick=\"return confirm('Are you sure you want to delete this sub-category?');\"><img src='images/trashcan.jpg'></a>
			</td>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			<a href=\"editstoresubcategory.php?id=$categoryid\"><img src='images/edit.jpg'></a>
			</td>";
			
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
				echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
				echo"<a href=\"storesubcategoryorderup.php?order=$pageorder&id=$categoryid\"><img src=\"images/arrowup.jpg\" /></a>";
				echo"</td></tr><tr><td>";
				echo"<a href=\"storesubcategoryorderdown.php?order=$pageorder&id=$categoryid\"><img src=\"images/arrowdown.jpg\" /></a>";
				echo"</td></tr></table>";
			echo"</td>";
			
			echo"
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
			$name
			</td>
			</tr>";
        }
        ?>
        </table>
        </div>
        
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	PROMO CODES
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		echo"<tr>";
		echo"<td colspan='3' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<a href='createpromocode.php'>Create New Promo Code --></a>";
		echo"</td>";
		echo"</tr>";
		
        $result = mysql_query("SELECT * FROM `promocodes` ORDER BY `id` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$id = ($r['id']);
			$code = ($r['code']);
			$name = ($r['name']);
			$discount = ($r['discount']);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$discount%";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$code";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; width:100px;'>";
			echo"$name";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
                        echo"<a href='deletepromocode.php?promoid=$id' style='color:#ff0000;' >DELETE</a>";
			echo"</td>";
			echo"</tr>";
        }

		
        ?>
        </table>
        </div>
        
    	
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	PROMO STATS
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">

        </table>
        </div>
    </td>
    </tr>
    
    <?php
	/*
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	PRODUCT OPTIONS
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		$result = mysql_query("SELECT * FROM `product_option1`");
        $r = mysql_fetch_array($result);
		$name = ($r['name']);
		$id = ($r['id']);
			
		echo"<tr>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"Option 1";
		echo"</td>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<form enctype='multipart/form-data' action=\"updateproductoption.php\" method='post'>";
		echo"<input type='text' name='name' value='$name' size='15'/>";
		echo"</td>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<input type='hidden' name='optiontable' value='product_option1' />";
		echo"<input type='hidden' name='id' value='$id' />";
		echo"<input type=\"submit\" name=\"submit\" value=\"SAVE\" />";
		echo"</form>";
		echo"</td>";
		echo"</tr>";
		
		$result = mysql_query("SELECT * FROM `product_option2`");
        $r = mysql_fetch_array($result);
		$name2 = ($r['name']);
		$id = ($r['id']);
			
		echo"<tr>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"Option 2";
		echo"</td>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<form enctype='multipart/form-data' action=\"updateproductoption.php\" method='post'>";
		echo"<input type='text' name='name' value='$name2' size='15'/>";
		echo"</td>";
		echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<input type='hidden' name='optiontable' value='product_option2' />";
		echo"<input type='hidden' name='id' value='$id' />";
		echo"<input type=\"submit\" name=\"submit\" value=\"SAVE\" />";
		echo"</form>";
		echo"</td>";
		echo"</tr>";

        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	<?php echo"PRODUCT OPTION $name"; ?>
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		$result = mysql_query("SELECT * FROM `product_option1_list` ORDER BY `id` ASC");
		$rows = mysql_num_rows($result);
		if ($rows < 10) {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
			echo"<a href='addproductoption.php?optiontable=product_option1_list'>Add New Option --></a>";
			echo"</td>";
			echo"</td>";
			echo"</tr>";
		}
		if ($rows > 0) {
			while ($r = mysql_fetch_array($result)) {
				$option = ($r['name']);
				$id = ($r['id']);
					
				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$option";
				echo"</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
					echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
					echo"<a href=\"productoptionorderup.php?optiontable=product_option1_list&id=$id\"><img src=\"images/arrowup.jpg\" /></a>";
					echo"</td></tr><tr><td>";
					echo"<a href=\"productoptionorderdown.php?optiontable=product_option1_list&id=$id\"><img src=\"images/arrowdown.jpg\" /></a>";
					echo"</td></tr></table>";
				echo"</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"<a href='deleteproductoption.php?optiontable=product_option1_list&id=$id' style='color:#FF0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Delete</a>";
				echo"</td>";
				echo"</tr>";
			}
		} else {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
			echo"<br /><br />There are no options...";
			echo"</form>";
			echo"</td>";
			echo"</tr>";
		}
		
        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	<?php echo"PRODUCT OPTION $name2"; ?>
        <div style="height:400px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		$result = mysql_query("SELECT * FROM `product_option2_list` ORDER BY `id` ASC");
		$rows = mysql_num_rows($result);
		if ($rows < 10) {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
			echo"<a href='addproductoption.php?optiontable=product_option1_list'>Add New Option --></a>";
			echo"</td>";
			echo"</td>";
			echo"</tr>";
		}
		if ($rows > 0) {
			while ($r = mysql_fetch_array($result)) {
				$option = ($r['name']);
				$id = ($r['id']);
					
				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$option";
				echo"</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
					echo"<table cellpadding='0px' cellspacing='0px' border='0px'><tr><td>";
					echo"<a href=\"productoptionorderup.php?optiontable=product_option2_list&id=$id\"><img src=\"images/arrowup.jpg\" /></a>";
					echo"</td></tr><tr><td>";
					echo"<a href=\"productoptionorderdown.php?optiontable=product_option2_list&id=$id\"><img src=\"images/arrowdown.jpg\" /></a>";
					echo"</td></tr></table>";
				echo"</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"<a href='deleteproductoption.php?optiontable=product_option2_list&id=$id' style='color:#FF0000;' onclick=\"return confirm('Are you sure you want to delete this option?');\">Delete</a>";
				echo"</td>";
				echo"</tr>";
			}
		} else {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='3'>";
			echo"<br /><br />There are no options...";
			echo"</form>";
			echo"</td>";
			echo"</tr>";
		}
		
        ?>
        </table>
        </div>
    </td>
    </tr>
	*/
	?>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




