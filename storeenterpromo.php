<?php
require ('includes/dbconnect.php');

$pagetype = "Logout";

require ('includes/head.php');

?>

<div id="page_content">
    <div id="sidebar">
        <?php require('includes/leftcolumn.php'); ?>
    </div>
    <div id="content">
        
        <?php
		$promo = ($_POST['promo']);
		$result = mysql_query("SELECT * FROM `promocodes` WHERE `code`='$promo'");
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			$r = mysql_fetch_array($result);
			$discount = ($r['discount']);
			$promoid = ($r['id']);
			$_SESSION['promocode'] = $discount;
			$_SESSION['promocode2'] = $promo;
			$_SESSION['promocode3'] = $promoid;
			header("Location: storecheckout.php");
			exit;
		} else {
			echo"<br /><br />Sorry, that is an invalid promo code. <br /><br /><a href='storecheckout.php'>Go Back.</a>";
		}
		
		
		?>

    </div>
    <?php require('includes/footer.php'); ?>
</div>
</div>
</body>
</html>

<?php
ob_end_flush();
?>
