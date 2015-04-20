<?php
require ('includes/dbconnect.php');
$title = "My Gallery";
require ('includes/head.php');

//MEMBERS ONLY CHECK
if (!isset($_SESSION['memberloggedin'])) {
    header('Location: login.php');
    exit();
}

$memberid = ($_SESSION['memberloggedin']);

$home_dir = "./images/users/".$memberid."/";

if(isset($_POST['post_type'])){
	if($_POST['post_type']=='DELETE_PIC'){
		unlink($_POST['picname']);
	}
	if($_POST['post_type']=='UPLOAD_PIC'){
		$files = glob($home_dir.'*.*');
		$name = md5(sizeof($files)+1).'.'.pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["img"]["tmp_name"]);
		if($check !== false){
			move_uploaded_file($_FILES["img"]["tmp_name"], $home_dir.$name);
		}
	}
	header("Location:./mygallery.php");
}
?>

<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<div class='row'>
					<div class='col-md-12' style='padding:10px'>
						<div class='Searchfilters'>
							<h2 style="font-size:2em;"><u>My Gallery</u></h2>
						</div>
					</div>
				</div>
				<div class='cl'></div>
				<?php
				echo"<div class='searchfilters'>";
				?>
				<div class='memberpicbox'>
					<div class="text-center">
					<br>
					<form method="POST" action="./mygallery.php" style="float:none;" enctype="multipart/form-data">
						<label style="color:#666">Chose a file to upload to Gallery</label>
						<input type="file" class="form-control" name="img" id="uploadimg" accept="image/*" required>
						<input type="hidden" name="post_type" value="UPLOAD_PIC" required>
						<br>
						<button class="btn btn-success btn-xs"  style="color:#fff">
						<span class="glyphicon glyphicon-plus" ></span>
							Add
						</button>
					</form>
					<br>
					</div>
				</div>
				<?
				if (!file_exists($home_dir)) {
				    mkdir($home_dir, 0777);
				}
				foreach(glob($home_dir.'*.*') as $file) {
					echo "<div class='memberpicbox'>";
					echo"<img src='$file' />";
					?>
					<div class="text-center">
					<form method="POST" action="./mygallery.php" style="float:none;">
						<input type="hidden" name="picname" value="<?php echo $file;?>">
						<input type="hidden" name="post_type" value="DELETE_PIC">
						<button class="btn btn-danger btn-xs"  style="color:#fff">
						<span class="glyphicon glyphicon-minus" ></span>
							Delete
						</button>
					</form>
					</div>
					<?php
					echo "</div>";
				}
				
				echo"</div>";
				?>
				<br>
				<div class='cl'></div>
				<!--    END TEMPLATE   -->
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
