<?php 
session_start();
ob_start();

if (!isset($_SESSION['admin'])) {
	header ("Location: index.php");
	exit();
}

putenv("TZ=America/Chicago");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Admin Section</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<link href="highslide/highslide.css" rel="stylesheet" type="text/css" />

<!--Gallery Script -->
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/javascript" src="javascripts/hidediv.js"></script>

<script src="javascripts/prototype.js" type="text/javascript"></script>
<script src="javascripts/scriptaculous.js" type="text/javascript"></script>

<script type="text/javascript">
//<![CDATA[
	document.observe('dom:loaded', function() {
		var changeEffect;
		Sortable.create('sortlist', { tag: 'div', overlap:'horizontal',constraint:false, 
			onChange: function(item) {
				var list = Sortable.options(item).element;
				$('changeNotification').update(Sortable.serialize(list).escapeHTML());
				if(changeEffect) changeEffect.cancel();
				changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
			},
				
			onUpdate: function() {
				new Ajax.Request("saveImageOrder.php", {
					method: "post",
					onLoading: function(){$('activityIndicator').show()},
					onLoaded: function(){$('activityIndicator').hide()},
					parameters: { data: Sortable.serialize("sortlist") }
				});
			}				
		});
	});
// ]]>
</script>	


<style>
.hide{display:none;}
.show{}
</style>
</head>

<body style="margin:40px 0px 0px 0px;">

<table align="center" cellpadding="0" cellspacing="0" width="993px">
<tr>
<td class="headertable">
ADMINISTRATION AREA
</td>
</tr>

<tr>
<td align="center">
<a href="adminhome.php">HOME</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$result = mysql_query("SELECT * FROM `pages` WHERE `type` = 'Store'");
$rows = mysql_num_rows($result);
if ($rows > 0) {
	echo'<a href="store.php">EDIT STORE</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo'<a href="productreviews.php">PRODUCT REVIEWS</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
}

$result = mysql_query("SELECT * FROM `pages` WHERE `type` = 'Reviews'");
$rows = mysql_num_rows($result);
if ($rows > 0) {
	echo'<a href="reviews.php">REVIEWS</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
}
?>
<a href="files.php">FILE UPLOADER</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="editadmin.php">EDIT ADMIN</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="db_backup.php">BACKUP DATABASE</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="help.php">HELP</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="logout.php">LOGOUT</a>
</td>
</tr>

