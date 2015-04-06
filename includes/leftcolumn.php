<p style='margin-left:48px;'>GET A FREE ESTIMATE<br /><span style='margin-left:25px; font-size:10px; font-style:italic;'>Fill out the form below</span></p>
<?php
if (isset($_SESSION['form1'])) {
	$form1 = ($_SESSION['form1']);
} else {
	$form1 = "NAME";
}
if (isset($_SESSION['form2'])) {
	$form2 = ($_SESSION['form2']);
} else {
	$form2 = "EMAIL";
}
if (isset($_SESSION['form3'])) {
	$form3 = ($_SESSION['form3']);
} else {
	$form3 = "PHONE";
}
if (isset($_SESSION['form4'])) {
	$form4 = ($_SESSION['form4']);
} else {
	$form4 = "COMMENTS";
}
?>
<form enctype='multipart/form-data' action="homeform.php" method='POST'>
<div style='margin:0px 0px 0px 0px;'>
<table cellpadding='2px' cellspacing='3px' border='0' style='margin:0px 0px 0px 25px;'>	
<tr>
<td align='left'>
<input type='text' size='20' autocomplete='off' name='name' onkeydown="if(this.value=='NAME') this.value='';" 
onblur="if(this.value=='') this.value='NAME';" value='<?php echo"$form1"; ?>' class='estimateform'/>
</td>
</tr>

<tr>
<td align='left'>
<input type='text' size='20' autocomplete='off' name='email' onkeydown="if(this.value=='EMAIL') this.value='';" 
onblur="if(this.value=='') this.value='EMAIL';" value='<?php echo"$form2"; ?>' class='estimateform' />
</td>
</tr>

<tr>
<td align='left'>
<input type='text' size='20' autocomplete='off' name='phone' onkeydown="if(this.value=='PHONE') this.value='';" 
onblur="if(this.value=='') this.value='PHONE';" value='<?php echo"$form3"; ?>' class='estimateform' />
</td>
</tr>

<tr>
<td align='left'>
<textarea name='comments' autocomplete='off' onkeydown="if(this.value=='COMMENTS') this.value='';" 
onblur="if(this.value=='') this.value='COMMENTS';" value='COMMENTS' class='estimateform' style='height:125px;'><?php echo"$form4"; ?></textarea>
</td>
</tr>

<tr>
<td align='left'>
SECURITY QUESTION
</td>
</tr>

<tr>
<td align='left'>
<input type='text' size='20' autocomplete='off' name='code' onkeydown="if(this.value=='What is 2 + 2?') this.value='';" 
onblur="if(this.value=='') this.value='What is 2 + 2?';" value='What is 2 + 2?' class='estimateform' />
</td>
</tr>


<tr>
<td align='center'>
<input type='hidden' name='formsent' value='sent' />
<br />
<button class='custombutton' type='submit'><img src='images/sendbutton.jpg' alt='Contact Us'  /></button>
</td>
</tr>
</table>
</div>
</form>

<br />