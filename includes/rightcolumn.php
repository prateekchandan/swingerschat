<?php
if (isset($_SESSION['form1'])) {
	$form1 = ($_SESSION['form1']);
} else {
	$form1 = "Name";
}
if (isset($_SESSION['form2'])) {
	$form2 = ($_SESSION['form2']);
} else {
	$form2 = "Email";
}
if (isset($_SESSION['form3'])) {
	$form3 = ($_SESSION['form3']);
} else {
	$form3 = "Phone";
}
if (isset($_SESSION['form4'])) {
	$form4 = ($_SESSION['form4']);
} else {
	$form4 = "Date to meet ?";
}
if (isset($_SESSION['form5'])) {
	$form5 = ($_SESSION['form5']);
} else {
	$form5 = "Time to meet ?";
}
if (isset($_SESSION['form6'])) {
	$form6 = ($_SESSION['form6']);
} else {
	$form6 = "Comment";
}
if (isset($_SESSION['form7'])) {
	$form7 = ($_SESSION['form7']);
} else {
	$form7 = "Address";
}
?>
<div class="heading">Free Consulation</div>
<div class="inner-wrap">
	<form action='homeform.php' method='post' />
	<input type="text" name="name" placeholder="<?php echo"$form1"; ?>"  <?php if (isset($_SESSION['form1'])) { echo"value='$form1'"; } ?> />
	<input type="text" name="email" placeholder="<?php echo"$form2"; ?>" <?php if (isset($_SESSION['form2'])) { echo"value='$form2'"; } ?> />
	<input type="text" name="phone" placeholder="<?php echo"$form3"; ?>" <?php if (isset($_SESSION['form3'])) { echo"value='$form3'"; } ?> />
	<input type="text" name="address" placeholder="<?php echo"$form7"; ?>" <?php if (isset($_SESSION['form7'])) { echo"value='$form7'"; } ?> />
	<input type="text" name="date" placeholder="<?php echo"$form4"; ?>" <?php if (isset($_SESSION['form4'])) { echo"value='$form4'"; } ?> />
	<input type="text" name="time" placeholder="<?php echo"$form5"; ?>" <?php if (isset($_SESSION['form5'])) { echo"value='$form5'"; } ?> />
	<textarea cols=5 rows=7 name="comments" placeholder="<?php echo"$form6"; ?>"><?php if (isset($_SESSION['form6'])) { echo"$form6"; } ?></textarea>
	<h2 class="dark-orange">SECURITY QUESTION</h2>
	<input type="text" name="code" placeholder="What is 2 + 2 ?" />
	<input class="orange-btn" type="submit" name="submit" value="Submit" style="margin:15px 0;" />
	</form>
</div>