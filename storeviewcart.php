<?php
require ('includes/dbconnect.php');

$pagetype = "Store Page";

require ('includes/head.php');
?>

	<div class="main-content">
		<div class="product-wrap">
			<div class='divmain'>
			<!-- START TEMPLATE -->
			
			
		<?php
		//Get Option Titles
		$result = mysql_query("SELECT * FROM `product_option1`");
		$r = mysql_fetch_array($result);
		$option1name = strtoupper($r['name']);
		$result = mysql_query("SELECT * FROM `product_option2`");
		$r = mysql_fetch_array($result);
		$option2name = strtoupper($r['name']);
		$result = mysql_query("SELECT * FROM `product_option3`");
		$r = mysql_fetch_array($result);
		$option3name = strtoupper($r['name']);
		$result = mysql_query("SELECT * FROM `product_option4`");
		$r = mysql_fetch_array($result);
		$option4name = strtoupper($r['name']);
	
		?>
	    <table align='center' cellpadding="0px" cellspacing="2px" border="0px" width="600px" class='cart' style='margin:30px auto;'>
            <tr>
            <td colspan="6" class='storebreadcrumbs' align="left">
            Your Shopping Cart - <a href='store.php'>Continue Shopping?</a>
            </td>
            </tr>
            
            <tr>
            <td align="left" valign="top" width="5%" class='cartheaders'>
            </td>
            <td align="left" valign="top" width="55%" class='cartheaders'>
            ITEM
            </td>
            <td align="right" valign="top" class='cartheaders'>
            </td>
            <td align="right" valign="top" class='cartheaders'>
            QTY
            </td>
            <td align="right" valign="top" width="15%" class='cartheaders'>
            PRICE
            </td>
            <td align="right" valign="top" width="15%" class='cartheaders'>
            SUB
            </td>
            </tr>
            
            <?php
	    $sarray = array();
            $url = $_SERVER['PHP_SELF'];
            
            if (isset($_SESSION['memberloggedin'])) {
                $memberid = ($_SESSION['memberloggedin']);
                $result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
                while ($r = mysql_fetch_array($result)) {
                    $cartid = ($r['id']);
                    $productid = ($r['productid']);
                    $quantity = ($r['quantity']);
					$option1 = ($r['option1']);
					$option2 = ($r['option2']);
					$option3 = ($r['option3']);
					$option4 = ($r['option4']);
                    
                    $result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
                    $r2 = mysql_fetch_array($result2);
                    $category = ($r2['category']);
                    $name = ($r2['name']);
                    $price = ($r2['price']);
                    $price2 = ($price * $quantity);
		    
		     //Do related items
		    $suggested1 = ($r2['suggested1']);
		    $suggested2 = ($r2['suggested2']);
		    $suggested3 = ($r2['suggested3']);
		    $suggested4 = ($r2['suggested4']);
		    
		    if (!in_array("$suggested1", $sarray)) {
			array_push($sarray, "$suggested1");
		    }
		    if (!in_array("$suggested2", $sarray)) {
			array_push($sarray, "$suggested2");
		    }
		    if (!in_array("$suggested3", $sarray)) {
			array_push($sarray, "$suggested3");
		    }
		    if (!in_array("$suggested4", $sarray)) {
			array_push($sarray, "$suggested4");
		    }
                    ?>
                    <tr>
                    <td align="center" valign="top" class="cartitem"><?php echo"<a href=\"storeremovefromcart.php?id=$cartid&url=$url\"><img src=\"mrweb/images/trashcan.jpg\" /></a>"; ?></td>
                    <td align="left" valign="middle" class="cartitem">
					<?php 
					echo"$name"; 
					if (($option1 != "")) {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option1name: $option1 $chargedisplay</div>";
					}
					if ($option2 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option2name: $option2 $chargedisplay</div>";
					}
					if ($option3 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option3name: $option3 $chargedisplay</div>";
					}
					if ($option4 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option4name: $option4 $chargedisplay</div>";
					}
			
					?>
                    </td>
                    <td align="left" valign="top" class="cartitem">
                        <table align="right"  cellpadding="0" cellspacing="0" border="0">
                        <tr>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storeupquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/plus.jpg" /></a></td>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storedownquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/minus.jpg" /></a></td>
                        </tr>
                        </table>
                    </td>
		    <?php
		    $price = number_format($price, 2,'.','');
		    $price2 = number_format($price2, 2,'.','');
                    $total += $price2;
		    ?>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$quantity"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price2"; ?></td>
                    </tr>
                    <?php

                }
            } else if (isset($_SESSION['guestloggedin'])) {
                $memberid = ($_SESSION['guestloggedin']);
                $result = mysql_query("SELECT * FROM `cart` WHERE `memberid` = '$memberid'");
                while ($r = mysql_fetch_array($result)) {
                    $cartid = ($r['id']);
                    $productid = ($r['productid']);
                    $quantity = ($r['quantity']);
					$option1 = ($r['option1']);
					$option2 = ($r['option2']);
					$option3 = ($r['option3']);
					$option4 = ($r['option4']);
                    
                    $result2 = mysql_query('SELECT * FROM products WHERE id = "'.$productid.'"');
                    $r2 = mysql_fetch_array($result2);
                    $category = ($r2['category']);
                    $name = ($r2['name']);
                    $price = ($r2['price']);
                    $price2 = ($price * $quantity);
		    
		    //Do related items
		    $suggested1 = ($r2['suggested1']);
		    $suggested2 = ($r2['suggested2']);
		    $suggested3 = ($r2['suggested3']);
		    $suggested4 = ($r2['suggested4']);
		    
		    if (!in_array("$suggested1", $sarray)) {
			array_push($sarray, "$suggested1");
		    }
		    if (!in_array("$suggested2", $sarray)) {
			array_push($sarray, "$suggested2");
		    }
		    if (!in_array("$suggested3", $sarray)) {
			array_push($sarray, "$suggested3");
		    }
		    if (!in_array("$suggested4", $sarray)) {
			array_push($sarray, "$suggested4");
		    }
                    ?>
                    <tr>
                    <td align="center" valign="top" class="cartitem"><?php echo"<a href=\"storeremovefromcart.php?id=$cartid&url=$url\"><img src=\"mrweb/images/trashcan.jpg\" /></a>"; ?></td>
                    <td align="left" valign="middle" class="cartitem">
					<?php 
					echo"$name"; 
					if (($option1 != "")) {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option1name: $option1 $chargedisplay</div>";
					}
					if ($option2 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option2name: $option2 $chargedisplay</div>";
					}
					if ($option3 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option3name: $option3 $chargedisplay</div>";
					}
					if ($option4 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option4name: $option4 $chargedisplay</div>";
					}
			
					?>
                    </td>
                    <td align="left" valign="top" class="cartitem">
                        <table align="right"  cellpadding="0" cellspacing="0" border="0">
                        <tr>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storeupquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/plus.jpg" /></a></td>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storedownquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/minus.jpg" /></a></td>
                        </tr>
                        </table>
                    </td>
		    <?php
		    $price = number_format($price, 2,'.','');
		    $price2 = number_format($price2, 2,'.','');
                    $total += $price2;
		    ?>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$quantity"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price2"; ?></td>
                    </tr>
                    <?php

                }
            } else {
                $ip=getenv("REMOTE_ADDR");
                $result = mysql_query("SELECT * FROM `cart` WHERE `ip` = '$ip'");
                while ($r = mysql_fetch_array($result)) {
                    $cartid = ($r['id']);
                    $productid = ($r['productid']);
                    $quantity = ($r['quantity']);
			$option1 = ($r['option1']);
			$option2 = ($r['option2']);
			$option3 = ($r['option3']);
			$option4 = ($r['option4']);
                    
                    $result2 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
                    $r2 = mysql_fetch_array($result2);
                    $category = ($r2['category']);
                    $name = ($r2['name']);
                    $price = ($r2['price']);
                    $price2 = ($price * $quantity);
		    
		    //Do related items
		    $suggested1 = ($r2['suggested1']);
		    $suggested2 = ($r2['suggested2']);
		    $suggested3 = ($r2['suggested3']);
		    $suggested4 = ($r2['suggested4']);
		    
		    if (!in_array("$suggested1", $sarray)) {
			array_push($sarray, "$suggested1");
		    }
		    if (!in_array("$suggested2", $sarray)) {
			array_push($sarray, "$suggested2");
		    }
		    if (!in_array("$suggested3", $sarray)) {
			array_push($sarray, "$suggested3");
		    }
		    if (!in_array("$suggested4", $sarray)) {
			array_push($sarray, "$suggested4");
		    }
                    ?>
                    <tr>
                    <td align="center" valign="top" class="cartitem"><?php echo"<a href=\"storeremovefromcart.php?id=$cartid&url=$url\"><img src=\"mrweb/images/trashcan.jpg\" /></a>"; ?></td>
                    <td align="left" valign="middle" class="cartitem">
					<?php 
					echo"$name"; 
					if (($option1 != "")) {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option1_list` WHERE `name`='$option1'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option1name: $option1 $chargedisplay</div>";
					}
					if ($option2 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option2_list` WHERE `name`='$option2'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option2name: $option2 $chargedisplay</div>";
					}
					if ($option3 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option3_list` WHERE `name`='$option3'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option3name: $option3 $chargedisplay</div>";
					}
					if ($option4 != "") {
						//Get Option Extra Charges
						$result7 = mysql_query("SELECT * FROM `product_option4_list` WHERE `name`='$option4'");
						$r7 = mysql_fetch_array($result7);
						$extracharge = ($r7['price']);
						$chargedisplay = "";
						if (($extracharge != "") && ($extracharge != 0)) {
							$chargedisplay .= " - $" . $extracharge . " extra";
							$optionprice = ($extracharge * $quantity);
							$price2 += $optionprice;
						}
						echo"<br /><div class='viewcartoptions'>$option4name: $option4 $chargedisplay</div>";
					}
				
					?>
                    </td>
    
                    <td align="left" valign="top" class="cartitem">
                        <table align="right"  cellpadding="0" cellspacing="0" border="0">
                        <tr>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storeupquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/plus.jpg" /></a></td>
                        <td align="center" valign="middle" style="padding-top:2px;"><?php echo"<a href=\"storedownquantity.php?tablename=$tablename&cartid=$cartid&quantity=$quantity&url=$url&productid=$productid\">"; ?><img src="images/minus.jpg" /></a></td>
                        </tr>
                        </table>
                    </td>
		    <?php
		    $price = number_format($price, 2,'.','');
		    $price2 = number_format($price2, 2,'.','');
                    $total += $price2;
		    ?>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$quantity"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price"; ?></td>
                    <td align="right" valign="middle" class="cartitem"><?php echo"$$price2"; ?></td>
                    </tr>
                    <?php
                }
            }
            $total = number_format($total, 2);
            ?>
            
            <tr>
            <td colspan="6" align="right" valign="top" class="cartitem"><br /></td>
            </tr>
            <tr>
            <td colspan="4" align="right" valign="top"></td>
            <td align="right" valign="top">TOTAL:</td>
            <td align="right" valign="top" class="cartitem"><?php echo"$$total"; ?></td>
            </tr>
            <tr>
            <td colspan="6" align="right" valign="top"><br /></td>
            </tr>
            <tr>
            <td colspan="6" align="right" valign="top">
            <form method="get" action="storecheckout.php">
            <input type="submit" name="submit" value="Checkout" />
            </form>
            </td>
            </tr>
            
            <tr>
            <td colspan="6" align="center" valign="top" class="borders" style="color:#FF0000; padding:10px;">
            <?php
            $message = ($_GET['message']);
            if ($message == 1) {
                echo"We have a limited amount of this product. <br />Please let us know which items you want more of.";
            }
            ?>
            </td>
            </tr>
	    
	    <tr>
            <td colspan="6" align="center" valign="top">
		<strong>OTHER PRODUCTS YOU MIGHT ENJOY</strong><br /><br />
            </td>
            </tr>
	    
	    <tr>
            <td colspan="6" align="right" valign="top">
			<table align='center' cellpadding='0' cellspacing='0' border='0'>
			<tr>
			<?php
			$count = 0;
			for ($x = 0; $x < count($sarray); $x++) {
				$sid =  $sarray[$x];
				$count += 1;
				if (($sid != 0) && ($count < 4)) {
					$result5 = mysql_query("SELECT * FROM `products` WHERE `id` = '$sid'");
					$r5 = mysql_fetch_array($result5);
					$name = ($r5['name']);
					$pic1 = ($r5['pic1']);
					echo"<td align='center' valign='top' width='160px'>";
					echo"$name<br />";
					if ($pic1 != "noimage.jpg") {
						echo"<a href='storeproduct.php?productid=$sid'><img src='productpics/$pic1' width='120px'/></a>"; 
					} else {
						echo"<a href='storeproduct.php?productid=$sid'><img src='productpics/noimage.jpg' width='120px' height='150px'/></a>";
					}
					echo"</td>";
				}
			}
			while ($count < 4) {
				echo"<td width='160px'></td>";
				$count += 1;
			}
			?>
			<tr>
			</table>
            </td>
            </tr>
	    
	    <tr>
            <td colspan="6" align="center" valign="top">
		<br />
            </td>
            </tr>
            </table>	
				
			<!-- END TEMPLATE -->	
			</div>
		</div>
	</div>
	
	<?php require('includes/footer.php'); ?>
</div>
</body>
</html>

<?php
ob_end_flush();
?>
