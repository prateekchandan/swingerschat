<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;">
    <tr>
    <td colspan="3" align="center" valign="top">
    <?php
	
	$date = date('m');
	$date .= "/";
	$date .= date('d');
	$date .= "/";
	$date .= date('Y');
	$date .= " ";
	$date .= date('g');
	$date .= ":";
	$date .= date('i');
	$date .= date('a');
			
	$message = ($_GET['message']);
	if ($message == 1) {
		echo"Successfully added a new category!";
	}
	if ($message == 2) {
		echo"Successfully added a new product!";
	}

	?>
    </td>
    </tr>

    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    <div style="overflow:hidden; background-color:#FFFFFF;">
    <?php
	$result = mysql_query("SELECT * FROM `store_categories` ORDER BY `pageorder` ASC");
    echo"<ul class=\"storenav\">";
    while ($r = mysql_fetch_array($result)) {
        $category = ($r['name']);
		$categoryid = ($r['id']);
		echo"<li>";
		echo"<a href=\"editproduct2.php?categoryid=$categoryid&category=$category\">$category</a>";
		echo"</li>";
    }
	echo"</ul>";
    ?>

    </div>
    </td>
    
    <td align="center" valign="top" colspan='2' style="background-color:#CCCCCC;">
    <div style="overflow:hidden; background-color:#FFFFFF;">
    <?php
		$category = ($_GET['category']);
		$categoryid = ($_GET['categoryid']);
		?>
    	<table cellpadding="2" cellspacing="2px" border="0" width="100%">
        <tr>
        <td colspan="4" align="left" style='border:1px solid #cccccc;' >
        Choose Product to Edit - <a href="editproduct.php">On Sale Items</a> - <?php echo"$category"; ?>
        </td>
        </tr>
        
        <tr>
	    <td colspan='4'>
		<?php
		$url = $_SERVER['PHP_SELF'];
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page'])){
			$pageNum = $_GET['page'];
		} else {
			$pageNum = 1;
		}
		$rowsPerPage = "4000";
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;


		$result = mysql_query("SELECT * FROM `products` WHERE `category`='$categoryid' ORDER BY `picorder` ASC LIMIT $offset, $rowsPerPage");
		$result2 = mysql_query("SELECT * FROM `products` WHERE `category`='$categoryid' ");
		$rows2 = mysql_num_rows($result2);
		$_SESSION['gallerytable'] = "products";
		$_SESSION['cellblock'] = "picorder";
		echo'<div id="sortlist" width="100%" style="border:0px;">';
		$count = 0;
		while ($r = mysql_fetch_array($result)) {
			$id = ($r['id']);
			$photoid2 = "pictureId_" . ($r['id']);
			$name = ($r['name']);
                        $picorder = ($r['picorder']);
                        $ghost = ($r['ghost']);
			echo"<div style='width:500px; text-align:left' class='sorting' id='$photoid2'>";
                        echo"<a href=\"removeproduct.php?id=$id&url=$url\" style='color:#FF0000;' onclick=\"return confirm('Are you sure you want to delete this product?');\">DELETE</a> &nbsp;";
                        if ($ghost == 0) {
                            echo"<a href=\"editproduct3.php?id=$id\">$name</a> &nbsp; ";
                        } else {
                            $result88 = mysql_query("SELECT * FROM `products` WHERE `id`='$ghost' ");
                            $r88 = mysql_fetch_array($result88);
                            $name = ($r88['name']);
                            echo"<a href=\"editproduct3.php?id=$ghost\">$name</a> &nbsp; ";
                        }
			
			echo"</div>";
		}
		echo"</div>";
		?>
	    </td>
        </tr>
        
        <tr>
        <td colspan="4" align="left" class="catalog">
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
				$nav .= " <a href=\"$self?page=$page&categoryid=$categoryid&category=$category\">$page</a> ";
			}
		}
	
	
		// creating previous and next link
		// plus the link to go straight to
		// the first and last page
	
		if ($pageNum > 1){
			$page  = $pageNum - 1;
			$prev  = " <a href=\"$self?page=$page&categoryid=$categoryid&category=$category\">[Prev]</a> ";
	
			$first = " <a href=\"$self?page=1&categoryid=$categoryid&category=$category\">[First Page]</a> ";
		} else {
			$prev  = "<span style=\"color:#cccccc;\">[Prev]</span>"; // we're on page one, don't print previous link
			$first = "<span style=\"color:#cccccc;\">[First Page]</span>"; // nor the first page link
		}
	
	
		if ($pageNum < $maxPage){
			$page = $pageNum + 1;
			$next = " <a href=\"$self?page=$page&categoryid=$categoryid&category=$category\">[Next]</a> ";
	
			$last = " <a href=\"$self?page=$maxPage&categoryid=$categoryid&category=$category\">[Last Page]</a> ";
		} else {
			$next = "<span style=\"color:#cccccc;\">[Next]</span>"; // we're on the last page, don't print next link
			$last = "<span style=\"color:#cccccc;\">[Last Page]</span>"; // nor the last page link
		}
	
		// print the navigation link
		echo"
		<tr>
        <td colspan='4' align='center' style='border:1px solid #cccccc; color:#cccccc;'>
        $first . $prev . $nav . $next . $last
        </td>
        </tr>";
	
		echo "</div>";
		
		?>
        </td>
        </tr>
        </table>
    </div>
    </td>
	</tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




