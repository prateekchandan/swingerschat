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
    <td align="left" valign="top" style="background-color:#CCCCCC;" width="100%">
    ORDER HISTORY
	<div style="background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
        <td align="left" valign="middle" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>USERNAME</td>
		<td align="left" valign="middle" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>TRANSACTION ID</td>
        <td align="left" valign="middle" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>DATE</td>
        </tr>
        
        <?php
		$url = $_SERVER['PHP_SELF'];
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page'])){
			$pageNum = $_GET['page'];
		} else {
			$pageNum = 1;
		}
		$rowsPerPage = "40";
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;

		$result = mysql_query("SELECT * FROM `orders` WHERE `paid` = '1' ORDER BY `date` DESC LIMIT $offset, $rowsPerPage");
		$result2 = mysql_query("SELECT * FROM `orders` WHERE `paid` = '1' ORDER BY `date` DESC");
		$rows2 = mysql_num_rows($result2);
		
		while ($r = mysql_fetch_array($result)) {	
				$memberid = ($r['memberid']);
				$date = ($r['date']);
				$orderid = ($r['id']);
				$result2 = mysql_query("SELECT * FROM `members` WHERE `id` = '$memberid'");
				$r2 = mysql_fetch_array($result2);
				$username = ($r2['username']);
				$first = ($r2['first']);
				$last = ($r2['last']);
				echo"
				<tr>
				<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
				<a href=\"members.php?memberid=$memberid\">$first $last</a>
				</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
				echo"<a href=\"neworders.php?orderid=$orderid\">$orderid</a>";
				echo"</td>";
				
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>";
				echo"$date";
				echo"</td>";
		}
        	
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
				$nav .= " <a href=\"$self?page=$page&category=$category\">$page</a> ";
			}
		}
	
	
		// creating previous and next link
		// plus the link to go straight to
		// the first and last page
	
		if ($pageNum > 1){
			$page  = $pageNum - 1;
			$prev  = " <a href=\"$self?page=$page&category=$category\">[Prev]</a> ";
	
			$first = " <a href=\"$self?page=1&category=$category\">[First Page]</a> ";
		} else {
			$prev  = "<span style=\"color:#cccccc;\">[Prev]</span>"; // we're on page one, don't print previous link
			$first = "<span style=\"color:#cccccc;\">[First Page]</span>"; // nor the first page link
		}
	
	
		if ($pageNum < $maxPage){
			$page = $pageNum + 1;
			$next = " <a href=\"$self?page=$page&category=$category\">[Next]</a> ";
	
			$last = " <a href=\"$self?page=$maxPage&category=$category\">[Last Page]</a> ";
		} else {
			$next = "<span style=\"color:#cccccc;\">[Next]</span>"; // we're on the last page, don't print next link
			$last = "<span style=\"color:#cccccc;\">[Last Page]</span>"; // nor the last page link
		}
	
		// print the navigation link
		echo"
		<tr>
		<td colspan='3' align='center' style='border:1px solid #cccccc; color:#cccccc;'>
		$first $prev $nav $next $last
		</td>
		</tr>";
	
		echo "</div>";
		
		?>
        
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




