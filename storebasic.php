<?php
require ('includes/dbconnect.php');

if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$pagetype = ($r['type']);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}


require ('includes/head2.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='text1'>
	<div class='div1'>
		
	<table align="center" cellpadding="0px" cellspacing="0px" width='100%'>
        <tr>
	<?php
		
		
        $url = $_SERVER['PHP_SELF'];
        // if $_GET['page'] defined, use it as page number
        if(isset($_GET['page'])){
            $pageNum = $_GET['page'];
        } else {
            $pageNum = 1;
        }
        $rowsPerPage = "9";
        // counting the offset
        $offset = ($pageNum - 1) * $rowsPerPage;
        

        $result = mysql_query("SELECT * FROM `products` WHERE `quantity` > '0' ORDER BY id ASC ");
        $result2 = mysql_query("SELECT * FROM `products` WHERE `quantity` > '0'");
        $rows2 = mysql_num_rows($result2);

        
        $count = 0;
	$count2 = 0;
        while ($r = mysql_fetch_array($result)) {
            $productid = ($r['id']);
            $name = ($r['name']);
            $pic1 = ($r['pic1']);
            $price = ($r['price']);
	    $description = ($r['description']);
	
             echo"<td align=\"center\" valign=\"top\" width=\"200px\" height=\"125px\" class=\"catalog\">";
				
		if ($pic1 != "noimage.jpg") {
			//echo"<a href=\"storeproduct.php?productid=$productid&category=$category&categoryid=$categoryid&subid=$productsubid\">";
			echo"<img src=\"productpics/$pic1\" width=\"90px\" style='margin-top:3px;'/><br />";
			//echo"</a><br />";
		} else {
			//echo"<a href=\"storeproduct.php?productid=$productid&category=$category&categoryid=$categoryid&subid=$productsubid\">";
			echo"<img src=\"productpics/noimage.jpg\" width=\"90px\" style='margin-top:3px;'/><br />";
			//echo"</a><br />";
		}

		
		echo"<span style='color:#000000;'>$name</span><br />";
		echo"<span style='color:#000000;'>$description</span><br />";
		echo"<span style='color:#48d612;'>$$price</span><br />";
		?>
		<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
		<input type='hidden' name='cmd' value='_xclick'>
		<input type='hidden' name='business' value='info@connect2artproject.org'>
		<input type='hidden' name='item_name' value='<?php echo"$name"; ?>'>
		<input type='hidden' name='item_number' value='1'>
		<input type='hidden' name='amount' value='<?php echo"$price"; ?>'>
		<input type='hidden' name='page_style' value='' />
		<input type='hidden' name='buyer_credit_promo_code' value=''>
		<input type='hidden' name='buyer_credit_product_category' value=''>
		<input type='hidden' name='buyer_credit_shipping_method' value=''>
		<input type='hidden' name='buyer_credit_user_address_change' value=''>
		<input type='hidden' name='no_shipping' value='0'>
		<input type='hidden' name='return' value='http://www.connect2artprogram.org/success.php'>
		<input type='hidden' name='cancel' value='http://www.connect2artprogram.org/cancel.php'>
		<input type='hidden' name='no_note' value='1'>
		<input type='hidden' name='currency_code' value='USD'>
		<input type='hidden' name='lc' value='US'>
		<input type='hidden' name='bn' value='PP-BuyNowBF'>
		<input type='submit' value='Buy Now' class='formfields'>
		</form>
		<?php
            echo"</td>";
            
            $count += 1;
            if ($count > 3) { 
                $count = 0; 
                echo"</tr><tr>";
            };
        }
        if ($count != 0) {
            while ($count < 4) {
                echo"<td width=\"200px\" class=\"catalog\"></td>";
                $count += 1;
            }
        }
        ?>
        </tr>
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
</table>
</body>
</html>

<?php
ob_end_flush();
?>
