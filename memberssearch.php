<?php
require ('includes/dbconnect.php');
$title = "Search Members";
require ('includes/head.php');
?>
<style type="text/css">
	#filter1 { width : 12%;}
	#filter2 { width : 12%;}
	#filter3 { width : 13%;}
	#filter4 { width : 19%;}
	#filter5 { width : 18%;}
	#filter6 { width : 18%;}
	#filter7 { width : 8%;}
	@media(max-width: 768px){
		#filter1 { width : 20%;}
		#filter2 { width : 20%;}
		#filter3 { width : 20%;}
		#filter4 { width : 40%;}
		#filter5 { width : 40%;}
		#filter6 { width : 40%;}
		#filter7 { width : 20%;}
		#filter1,#filter2,#filter3,#filter4,#filter5,#filter6,#filter7
		{
			display: block;
			float: left;
			height: 70px;
		}
	}
	@media (min-width: 768px){
		.container {
		  width: 1000px;
	}
</style>

<div class="main-content clearfix">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-12">
				<div class="members">
				<!--    START TEMPLATE    -->
				<?php
				$searchstring = "";
				if (isset($_SESSION['memberloggedin'])) {
					$memberid = ($_SESSION['memberloggedin']);
					$searchstring .= "AND `id` != '$memberid'";
				}
				if ($_POST['filtersex']) {
					$filtersex = ($_POST['filtersex']);
					if($filtersex!='')
					$searchstring .= "AND `sex` = '$filtersex' ";
				} 
				if(isset($_POST['billingcountry'])){
					$billingcountry= $_POST['billingcountry'];
					if($billingcountry!='')
					$searchstring .= "AND `country` = '$billingcountry' ";
				}
				else{
					$billingcountry = '';
				}
				if(isset($_POST['billingstate'])){
					$billingstate= $_POST['billingstate'];
					if($billingstate!='')
					$searchstring .= "AND `state` = '$billingstate' ";
				}
				else{
					$billingstate = '';
				}
				if(isset($_POST['billingcity'])){
					$billingcity= $_POST['billingcity'];
					if($billingcity!='')
					$searchstring .= "AND `city` = '$billingcity' ";
				}
				else{
					$billingcity = '';
				}
				if(isset($_POST['min_age']) && intval($_POST['min_age']) > 0){
					$min_age = intval($_POST['min_age']);
					$searchstring .= "AND `age` >= '$min_age' ";
				}
				else{
					$min_age = 18;
				}
				if(isset($_POST['max_age']) && intval($_POST['max_age']) > 0){
					$max_age = intval($_POST['max_age']);
					$searchstring .= "AND `age` <= '$max_age' ";
				}
				else{
					$max_age = 65;
				}

				?>
				<div class='row'>
					<div class='col-md-12' style='padding:4px'>
						<div class='searchfilters'>
							<div class="row">
							<form action='memberssearch.php' method='post' style="width:100%">
								<div class="col-sm-2" id="filter1">
									<p>Sex: <br>
									<select name='filtersex' style='max-width:80px;'>
									<option value="">None</option>
									<option value='Male'  <?php if ($filtersex == "Male") { echo "selected"; } ?>>Male</option>
									<option value='Female' <?php if ($filtersex == "Female") { echo "selected"; } ?>>Female</option>
									</select></p>
								</div>
								
								<div class="col-sm-2" id="filter2">
								<p>Min age:<br>
									<input type="number" name="min_age" value="<?php echo $min_age;?>" style="width:60px">
								</p>
								</div>
								<div class="col-sm-2" id="filter3">
								<p>Max Age:<br>
									<input type="number" name="max_age" value="<?php echo $max_age;?>" style="width:60px">
								</p>
								</div>
								<div class="col-sm-2" id="filter4" >
								<p>Country:<br>
									<select name='billingcountry' onchange='refreshState(this.value)' style='max-width:140px;' >
									<option value="">No Filter</option>
									<?php
									$resultCountry = mysql_query("SELECT * FROM `citydb` group by country order by country");
									while ($rCountry = mysql_fetch_array($resultCountry)) {
										$nameCountry = ($rCountry['country']);
										$CountryCode = ($rCountry['country_code']);
										echo"<option value='$nameCountry' "; 
										if ($billingcountry == $nameCountry) 
											{ echo"selected"; }
										echo">$nameCountry</option>";
									}
									?>
						
									</select>
								</p>
								</div>
								<div class="col-sm-2" id="filter5">
								<p>State<br>
									<select name='billingstate' id='state' onchange='refreshCity(this.value)' style='max-width:140px' >";
									<option value="">No Filter</option>
									<?php
									$resultState = mysql_query("SELECT * FROM `citydb` where country='$billingcountry' group by state order by state");
										while ($rState = mysql_fetch_array($resultState)) {
											$nameState = ($rState['state']);
											echo"<option value='$nameState' "; if ($billingstate == $nameState) { echo"selected"; } echo">$nameState</option>";
										} 
									?>
									</select>
								</p>
								</div>
								<div class="col-sm-2" id="filter6">
								<p>City <br>
									<select name='billingcity' id='city' style='max-width:140px'>";
									<option value="">No Filter</option>
									<?php
										$resultCity = mysql_query("SELECT * FROM `citydb` where state='$billingstate' group by city order by city");
										while ($rCity = mysql_fetch_array($resultCity) && $billingstate!='') {
											$nameCity = ($rCity['city']);
											echo"<option value='$nameCity' "; if ($billingcity == $nameCity) { echo"selected"; } echo">$nameCity</option>";
										}
									?>
									</select>
								</p>
								</div>
								<div class="col-sm-2" id="filter7">
								<p><br>
									<input type='submit' class="btn btn-success" name='submit' value='Search' />
								</p>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class='cl'></div>
				<?php
				echo"<div class='searchfilters'>";
				$result = mysql_query("SELECT * FROM `members` WHERE `setup`='1' AND `approved`='1' $searchstring");
				while ($r = mysql_fetch_array($result)) {
					$userid = ($r['id']);
					$first = ($r['first']);
					$last = ($r['last']);
					$username = ($r['username']);
					$email = ($r['email']);
					$phone = ($r['phone']);
					$password = ($r['password']);
					$billingcountry = ($r['country']);
					$billingaddress = ($r['address']);
					$billingaddress2 = ($r['address2']);
					$billingcity = ($r['city']);
					$billingstate = ($r['state']);
					$billingzip = ($r['zip']);
					$shippingcountry = ($r['shippingcountry']);
					$shippingaddress = ($r['shippingaddress']);
					$shippingaddress2 = ($r['shippingaddress2']);
					$shippingcity = ($r['shippingcity']);
					$shippingstate = ($r['shippingstate']);
					$shippingzip = ($r['shippingzip']);
					$type = ($r['type']);
					$age = ($r['age']);
					$photo = ($r['photo']);
					$age = ($r['age']);
					$sex = ($r['sex']);
					$bio = stripslashes($r['bio']);
					$bio = str_replace("\n", "<br />", $bio);
					echo"<div class='memberpicbox'>";
					echo"<a href='profile.php?userid=$userid'><img src='members/$photo' /></a>";
					echo"</div>";
				}
				echo"</div>";
				
				?>
				<div class='cl'></div>
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
