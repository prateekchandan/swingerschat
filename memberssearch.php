<?php
require ('includes/dbconnect.php');
$title = "Search Members";
require ('includes/head.php');
?>


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
				if(isset($_POST['max_age']) && intval($_POST['max_age']) > 0){
					$max_age = intval($_POST['max_age']);
					$searchstring .= "AND `age` < '$max_age' ";
				}
				?>
				<div class='row'>
					<div class='col-md-12' style='padding:10px'>
						<div class='searchfilters'>
							<form action='memberssearch.php' method='post'>
								<p>Sex: <br>
									<select name='filtersex' style='max-width:80px;'>
									<option value="">None</option>
									<option value='Male'  <?php if ($filtersex == "Male") { echo "selected"; } ?>>Male</option>
									<option value='Female' <?php if ($filtersex == "Female") { echo "selected"; } ?>>Female</option>
									</select>
								</p>
								
								<p>Min Age: <br>
									<input type="number" name="min_age" value="<?php echo $_POST['min_age'];?>" style="width:60px">
								</p>
								<p>Max Age: <br>
									<input type="number" name="max_age" value="<?php echo $_POST['max_age'];?>" style="width:60px">
								</p>
								<p></p>
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
								<p><br>
									<input type='submit' class="btn btn-success" name='submit' value='Search' />
									<button class="btn btn-warning" type="reset">Reset</button>
								</p>
							</form>
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
