<?php
require ('includes/dbconnect.php');


if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$result = mysql_query("SELECT * FROM pages ORDER BY pageorder ASC");
	$r = mysql_fetch_array($result);
	$id = ($r['id']);
}

$result = mysql_query("SELECT * FROM pages WHERE id = $id");
$r = mysql_fetch_array($result);
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);

require ('includes/hitcounter.php');

require ('includes/head.php');
?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='text1'>
    <div class='div1'>
    <?php echo"$text1"; ?>
    </div>
    </td>
    </tr>
    
    <tr>
    <td class='text2'>
    <div class='div1'>
    <?php 
            $tablename = "Gallery_" . $pageid;
            
            echo"<table width=\"100%\" align=\"left\" cellpadding=\"0px\" cellspacing=\"0px\"><tr>";
            $count = 0;
            $result = mysql_query("SELECT * FROM `$tablename` ORDER BY `picorder` ASC");
            while ($r = mysql_fetch_array($result)) {
                $photoid = ($r['id']);
                $filename = ($r['filename']);
                $caption = ($r['caption']);
            
                echo "<td class='gallerycell'><a href=\"$tablename/$filename\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"$tablename/thumbs/$filename\" class='galleryimage'/></a><div class=\"highslide-caption\" style='color:#000000;'>$caption</div></td>";
                
                $count += 1;
                if ($count > 5) {
                    echo"</tr><tr>";
                    $count = 0;
                }
            }
            while ($count < 6) {
                echo"<td class='gallerycell' align=\"center\" width=\"50px\"></td>";
                $count += 1;
            }
            echo"</tr>";
            echo"</table>";
            
            ?>
    </div>
    </td>
    </tr>
    
    <tr>
	<td class='text3'>
    <div class='div3'>
    <?php echo"$text2"; ?>
    </div>
    </td>
    </tr>
	</table>
</td>

<td class="bodytable2">
<div class='div4'>
<?php require ('includes/search.php'); ?>
</div>
</td>
</tr>
</table>

<?php
require ('includes/footer.php');
?>



</body>
</html>

<?php
ob_end_flush();
?>
