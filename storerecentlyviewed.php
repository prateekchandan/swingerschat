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
<td class="bodytable">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
    <tr>
	<td class='text5'>
    <div class='div4'>
	 <br />
    	<table align="center" cellpadding="0px" cellspacing="0px" >
        <tr>
		<td colspan="4" align="left" class="storebreadcrumbs">
		<?php 
			echo"Recently Viewed Items"; 

		?>
		</td>
		</tr>
        
        <tr>
	<?php
		$time = time();
		$time -= 172800;
		$result = mysql_query("SELECT * FROM `recent` WHERE `timestamp` < '$time'");
		while ($r = mysql_fetch_array($result)) {
			$recentid = ($r['id']);
			$query = "DELETE FROM recent WHERE id = $recentid";
			$results = mysql_query($query);
		}
			
       	$ip=getenv("REMOTE_ADDR");
        $url = $_SERVER['PHP_SELF'];
        // if $_GET['page'] defined, use it as page number
        if(isset($_GET['page'])){
            $pageNum = $_GET['page'];
        } else {
            $pageNum = 1;
        }
        $rowsPerPage = "9";
        // counting the offset
        $offset = ($pageNum - 1) * $rowsPerPage;

		$result = mysql_query("SELECT * FROM `recent` WHERE `ip`='$ip' ORDER BY `timestamp` DESC LIMIT $offset, $rowsPerPage");
		$result2 = mysql_query("SELECT * FROM `recent` WHERE `ip`='$ip'");
		$rows2 = mysql_num_rows($result2);

        $count = 0;
        while ($r = mysql_fetch_array($result)) {
            $productid = ($r['productid']);
            $categoryid = ($r['category']);
			$result3 = mysql_query("SELECT * FROM `store_categories` WHERE `id` = '$categoryid'");
			$r3 = mysql_fetch_array($result3);
			$category = ($r3['name']);
			$result4 = mysql_query("SELECT * FROM `products` WHERE `id` = '$productid' LIMIT 0,1");
			$r4 = mysql_fetch_array($result4);
            $name = ($r4['name']);
            $pic1 = ($r4['pic1']);
            $price = ($r4['price']);
			$featured = ($r['featured']);
             echo"<td align=\"center\" valign=\"top\" width=\"200px\" height=\"125px\" class=\"catalog\">";

				
				if ($pic1 != "noimage.jpg") {
					echo"<a href=\"storeproduct.php?productid=$productid&category=$category&categoryid=$categoryid\"><img src=\"productpics/thumbs/$pic1\" width=\"90px\" style='margin-top:3px;'/></a><br />";
				} else {
					echo"<a href=\"storeproduct.php?productid=$productid&category=$category&categoryid=$categoryid\"><img src=\"productpics/noimage.jpg\" width=\"90px\" style='margin-top:3px;'/></a><br />";
				}

				
				echo"<span style='color:#000000;'>$name</span><br />";
				echo"<span style='color:#48d612;'>$$price</span><br />";
				if ($featured = 1) {
					echo"<span style='color:#0dde12;'>ON SALE!</span><br />";
				}


			
            echo"</td>";
            
            $count += 1;
            if ($count > 3) { 
                $count = 0; 
                echo"</tr><tr>";
            };
        }
        if ($count != 0) {
            while ($count < 4) {
                echo"<td width=\"125px\" class=\"catalog\"></td>";
                $count += 1;
            }
        }
        ?>
        </tr>
        
        <tr>
        <td colspan="4" align="left" >
        <?php
        // how many pages we have when using paging?
        $maxPage = ceil($rows2/$rowsPerPage);
        $maxPage1 = ($maxPage + 1);
        print"<div class=\"catalogfooternav\">";
        
        // print the link to access each page
        $self = $_SERVER['PHP_SELF'];
        $nav  = '';
        
        for($page = 1; $page < $maxPage1; $page++){
            if ($page == $pageNum){
                $nav .= "$page"; // no need to create a link to current page
            } else {
                $nav .= " <a href=\"$self?page=$page&category=$category&categoryid=$categoryid&keyword=$keyword\">$page</a> ";
            }
        }
        
        
        // creating previous and next link
        // plus the link to go straight to
        // the first and last page
        
        if ($pageNum > 1){
            $page  = $pageNum - 1;
            $prev  = " <a href=\"$self?page=$page&category=$category&categoryid=$categoryid&keyword=$keyword\"><img src=\"images/prev.jpg\" /></a> ";
        
            //$first = " <a href=\"$self?page=1&category=$category&categoryid=$categoryid\">[First Page]</a> ";
        } else {
            $prev  = "<span><img src=\"images/prev2.jpg\" /></span>"; // we're on page one, don't print previous link
            //$first = "<span>[First Page]</span>"; // nor the first page link
        }
        
        
        if ($pageNum < $maxPage){
            $page = $pageNum + 1;
            $next = " <a href=\"$self?page=$page&category=$category&categoryid=$categoryid&keyword=$keyword\"><img src=\"images/next.jpg\" /></a> ";
        
            //$last = " <a href=\"$self?page=$maxPage&category=$category&categoryid=$categoryid\"><img src'images/next2.jpg' /></a> ";
        } else {
            $next = "<span><img src=\"images/next2.jpg\"/></span>"; // we're on the last page, don't print next link
           //$last = "<span>[Last Page]</span>"; // nor the last page link
        }
        
        // print the navigation link

        echo"
        <tr>
        <td colspan='4' align='center' class='storebottomlinks' style='text-align:center; vertical-align:top; height:29px;'>
        	<table align='center'>
			<tr>
			<td align='center' valign='top'>$prev</td> 
			<td align='center' valign='top'>$nav</td>
			<td align='center' valign='top'>$next</td>
			</tr>
			</table>
        </td>
        </tr>";

        
        echo "</div>";
        echo"</table>";
        ?>
	<br />
    </div>
    </td>
    </tr>
	</table>
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
