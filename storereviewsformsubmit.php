<?php
require ('includes/dbconnect.php');
$pagetype = "Members";
$productid = ($_GET['productid']);
$result = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid'");
$r = mysql_fetch_array($result);
$title = strip_tags($r['metatitle']);
$description = strip_tags($r['metadescription']);
$keywords = strip_tags($r['metakeywords']);
require ('includes/head.php');
?>
  <?php
  if ($pagetype == "Home Page") {
      ?>
      <div class="conatainer header_bottom">
            <div id="thought"></div>
            <?php require('includes/special.php'); ?>
  </div>
      <?php
  }
  ?>
  
        <div id="body1">
		<div class="conatainer">
		<!-- START TEMPLATE -->
	<?php
		$productid = ($_POST['productid']);
		$memberid = ($_SESSION['memberloggedin']);
		$review2 = ($_POST['review']);
		$review = mysql_real_escape_string($_POST['review']);
		$code = ($_POST['code']);
		$name = mysql_real_escape_string($_POST['name']);
		$stars = ($_POST['stars']);
		$result5 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
		$r5 = mysql_fetch_array($result5);
		$first = ($r5['first']);
		$last = ($r5['last']);
		$username = $first . " " . $last;
		$timestamp = time();
		
		$_SESSION['review'] = "$review2";
	
		$sql="INSERT INTO productreviews (name, review, date, stars, productid, approved) VALUES('$username','$review','$timestamp','$stars','$productid','1')";
		if (!mysql_query($sql,$dbc)) {
			die('Error: ' . mysql_error());
		}
			
		
		mail( "$adminemail", "New Review", "There is a new product review awaiting your approval.", "From: $adminemail" ) ;
		
		unset($_SESSION['review']);
		
		echo"<center><br /><br /><br />Thank you! <br /><br />Your review will be posted to the site.<br /><br /><a href='storeproduct.php?productid=$productid'>Back to Product Details.</a></center>";
		?>
		<!-- END TEMPLATE -->
		</div>
        </div>
       <?php require('includes/footer.php'); ?>

    </div>
    </body>
</html>
<?php
ob_end_flush();
?>
