<?php
require ('includes/dbconnect.php');
$title = "Member Pages";
require ('includes/head.php');
?>


<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<div class='divmain'>
				<?php
				unset($_SESSION['memberloggedin']);
				?>
				<br />
				<br />
				<p class='centeredtext'>You have successfully logged out!</p>
				<br />
				<br />
				</div>
				<!--    END TEMPLATE   -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php require('includes/footer.php'); ?>
</body>
</html>


<?php
ob_end_flush();
?>
