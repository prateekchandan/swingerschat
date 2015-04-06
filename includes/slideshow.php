<?php 
echo"
<tr>
<td class='text1' colspan='3'>";
//Below this is script for the slideshow
   $count = 0;
    $result = mysql_query("SELECT * FROM `ads` ORDER BY `id` ASC");
    while ($r = mysql_fetch_array($result)) {	
	    $adid = ($r['id']);
	    $addomain = ($r['domain']);
	    $photo = ($r['photo']);
	    if ($count == 1) {
		    $firstimage = $photo;
	    }
	    $displaynumber = ($count + 1);
	    $pageanation .= "<a style='background-color:#ffffff; padding:4px; margin-right:3px;' href='javascript:translideshow1.navigate($count)'>$displaynumber</a>";
	    $count += 1;
	    $simages .= "[\"ADS/$photo\"";
	    if ($addomain != "No Link") {
		$simages .= ",\"$addomain\",\"_self\"],";
	    } else {
		$simages .= "],";
	    } 
    }
    $simages = substr($simages, 0, -1);
    //http://www.dynamicdrive.com/dynamicindex14/translucentslide.htm
?>
<div style='position:relative;'>
<div id="myslideshow"></div>
<div style='position:absolute; bottom:20px; left:20px; z-index:5000;'>
<?php //echo"$pageanation"; ?>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="javascripts/translucentslideshow.js" type="text/javascript"></script>
<script type="text/javascript">
var translideshow1=new translideshow({
	wrapperid: "myslideshow", //ID of blank DIV on page to house Slideshow
	dimensions: [<?php echo"$slidewidth, $slideheight"; ?>], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		/*
		["http://i26.tinypic.com/11l7ls0.jpg"], //["image_path", "optional_link", "optional_target"]
		["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "_new"],
		["http://i30.tinypic.com/531q3n.jpg"],
		["http://i31.tinypic.com/119w28m.jpg"] //<--no trailing comma after very last image element!
		*/
		<?php echo"$simages"; ?>
	],
	displaymode: {type:'auto', pause:2000, cycles:2, pauseonmouseover:true},
	orientation: "h", //Valid values: "h" or "v"
	persist: true, //remember last viewed slide and recall within same session?
	slideduration: 400 //transition duration (milliseconds)
})

</script>