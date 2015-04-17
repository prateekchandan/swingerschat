<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if($title != ""){
	echo"<title>$title</title>";
} else {
	echo"<title></title>";
}
?>

<META name='description' content="<?php echo"$description"; ?>">
<META name='keywords' content="<?php echo"$keywords"; ?>">

<link href="highslide/highslide.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">
function refreshState(catid) {
        new Ajax.Updater("state", "refreshstate.php?catid=" + catid,{onComplete:function(){
        	document.getElementById('state').innerHTML = "<option value=''>Select State</option>"+ document.getElementById('state').innerHTML;
        	document.getElementById('city').innerHTML = "<option value=''>Select City</option>";
        }});
}
function refreshCity(catid) {
        new Ajax.Updater("city", "refreshcity.php?catid=" + catid,{onComplete:function(){
        	if(catid!="")
        		document.getElementById('city').innerHTML = "<option value=''>Select City</option>" + document.getElementById('city').innerHTML;
        	else
        	document.getElementById('city').innerHTML = "<option value=''>Select City</option>";
        }});
}
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.1.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<script src="javascripts/prototype.js" type="text/javascript" language="javascript"></script>

<!-- Bootstrap -->
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->   

<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>


<SCRIPT type="text/javascript">
function ShowMe(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   tar.className = "show";
  } else {
   tar.className = "hide";
  }
 }
}

function ShowMe2(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   for (var i=0; i<con.length; i++){
    con[i].className = "hide";
   }
   tar.className = "show";
  } else {
	tar.className = "hide";
  }
 }
}

function changebutton(DIV, container){
 if(document.getElementById){
 var tar = document.getElementById(DIV);
 var con = document.getElementById(container).getElementsByTagName("DIV");
  if(tar.className == "hide"){
   for (var i=0; i<con.length; i++){
    con[i].className = "hide";
   }
   tar.className = "show";
  }
 }
}


function gotourl(url){  
window.location= url;  
}  


function changeshipping(zipcode, ounces) {
      new Ajax.Updater ("shippingdiv","changeshipping.php?zipcode=" + zipcode + "&ounces=" + ounces);
}
function changesame(same) {
      new Ajax.Updater ("samediv","changesame.php?same=" + same);
}
function changemainpic(pid, ovalue){
	new Ajax.Updater ("mainproductimage","changemainproductimage.php?productid=" + pid + "&optionvalue=" + ovalue);
}
</script>



<style>
.hide{display:none;}
.show{}
</style>



</head>


        
<!--navigation-->
<nav class="navbar navbar-default" role="navigation">
  
    <div class="row" style="background-color:#fff;">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#">Navigation</a>
	</div>
	<div class="container">
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse topbar" id="bs-example-navbar-collapse-1">
	<?php require('includes/login.php'); ?>
	</div>
	</div>
    </div>
  
</nav>
<!--navigation-->

<!--Header-->
<div class="main-content clearfix">
		<div class="container clearfix">
			<div class="row">
		<div class="col-md-12">
				<div class="col-md-3 logo">
	    <a href='index.php'><img src="images/logo.png" width="160"/></a>
	    </div>
	    <div class="col-md-3">&nbsp;</div>
	    <div class="col-md-6 headertxt">
	    <img src="images/theme.png">
	    </div>
	    </div>
			</div>
    </div>
</div>
     
	<!--Header-->