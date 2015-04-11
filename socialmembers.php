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
$pagetype = "Other";
$name = ($r['name']);
$title = ($r['title']);
$description = ($r['description']);
$keywords = ($r['keywords']);
$text1= stripslashes($r['text1']);
$text2= stripslashes($r['text2']);
$text3= stripslashes($r['text3']);
$text4= stripslashes($r['text4']);
$text5= stripslashes($r['text5']);
$copyright = stripslashes($r['copyright']);
$pageid = ($r['id']);
$contactemail = ($r['contactemail']);
$contactthankyou = ($r['contactthankyou']);
$membersonly = ($r['membersonly']);

//MEMBERS ONLY CHECK
if ($membersonly == 1) {
	if (!isset($_SESSION['memberloggedin'])) {
		header ('Location: login.php');
		exit();
	}
}

require ('includes/head.php');

// ADD ECOMMERCE SEARCH CODE
// require ('includes/search.php');

?>


<tr>
<td class="bodytable1">
	<table align="center" cellpadding="0px" cellspacing="0px" width="100%">
	<tr>
	<td class='leftcolumn'>
		<table align="center" cellpadding="0px" cellspacing="0px" style='margin:20px 0px 20px 0px;'>
		<tr>
		<td class='text1'>
		<div class='div1'>	
		<form enctype='multipart/form-data' action="socialmembers.php" method='post'>
		<table cellpadding='0' cellspacing='0' border='0' align='left'>
		<tr>
		<td align='left' valign='top' style='width:40px;'></td>
		<td style=''>
		<input type='text' size='20' name='keyword' autocomplete='off' onkeydown="if(this.value=='Enter Username or Real Name') this.value='';" 
		onblur="if(this.value=='') this.value='Enter Username or Real Name';" value='Enter Username or Real Name' style='background-color:#ffffff; border:1px solid #cccccc; width:200px; height:23px; ' />
		</td>
		
		<td>
		<input type='image' src='images/search.jpg' border='0' name='submit' alt='Search!'>
		</td>
		</tr>
		</table>
		</form>
		
	<table cellpadding="0" cellspacing="0" border="0" width="100%" ">
            <tr>
		<td colspan='3'><br /></td>
	    </tr>
	    <tr>
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
            
		if (isset($_POST['keyword'])) {
			$keyword = ($_POST['keyword']);
			$keyword2 = "%" . $keyword . "%";
			$result = mysql_query("SELECT * FROM `members` WHERE `admin`='0' AND (`username` LIKE '$keyword2' OR `first` LIKE '$keyword2' OR `last` LIKE '$keyword2') ORDER BY `username` ASC LIMIT $offset, $rowsPerPage");
			$result2 = mysql_query("SELECT * FROM `members` WHERE `admin`='0' AND (`username` LIKE '$keyword2')");
			
		} else {
			$result = mysql_query("SELECT * FROM `members` WHERE `admin`='0' ORDER BY `id` DESC LIMIT $offset, $rowsPerPage");
			$result2 = mysql_query("SELECT * FROM `members` WHERE `admin`='0'");
		}
         
            $rows2 = mysql_num_rows($result2);
            
            
            $count = 0;
            while ($r = mysql_fetch_array($result)) {
                $userid = ($r['id']);
                $username = ($r['username']);
				$first = ($r['first']);
				$city = ($r['city']);
				$state = ($r['state']);
				$gender = ($r['gender']);
				$age = ($r['age']);
				$photo = ($r['photo']);
				echo"<td align='center' valign='top'>";
				echo"$username<br /><a href='profile.php?userid=$userid'><img src='members/$photo' width='110px' height='130px'/></a>"; 	
				echo"</td>";
                
                $count += 1;
                if ($count > 2) { 
                    $count = 0; 
                    echo"</tr><tr>";
                };
            }
            if ($count != 0) {
                while ($count < 3) {
                    echo"<td width=\"175px\" class=\"catalog\"></td>";
                    $count += 1;
                }
            }
            ?>
            </tr>
            
            <tr>
            <td colspan="6" align="left" class="catalogfooternav">
            <?php
            // how many pages we have when using paging?
            $maxPage = ceil($rows2/$rowsPerPage);
            $maxPage1 = ($maxPage + 1);
            echo"<div class=\"catalogfooternav\">";
            
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
                $prev  = "<span>[Prev]</span>"; // we're on page one, don't print previous link
                $first = "<span>[First Page]</span>"; // nor the first page link
            }
            
            
            if ($pageNum < $maxPage){
                $page = $pageNum + 1;
                $next = " <a href=\"$self?page=$page&category=$category\">[Next]</a> ";
            
                $last = " <a href=\"$self?page=$maxPage&category=$category\">[Last Page]</a> ";
            } else {
                $next = "<span>[Next]</span>"; // we're on the last page, don't print next link
                $last = "<span>[Last Page]</span>"; // nor the last page link
            }
            
            // print the navigation link
            
            
            echo "</div>";
            echo"</td></tr></table>";
            ?>
			
		</div>
		</td>
		</tr>
		</table>
	</td>
	
	<td class='rightcolumn'>
	<div class="righttable"'>
	<?php require('includes/rightcolumn.php'); ?>
	</div>
	</td>
	</tr>
	</table>
</td>
</tr>

<?php
require ('includes/footer.php');
?>

</body>
</html>

<?php
ob_end_flush();
?>
