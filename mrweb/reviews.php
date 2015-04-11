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
    <td align="left" valign="top" style="background-color:#CCCCCC;">
	New Reviews
        <div style="background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
	<?php
        $result = mysql_query("SELECT * FROM `reviews` WHERE `approved` = '0' ORDER BY `date` DESC");
        while ($r = mysql_fetch_array($result)) {
	    $rid = ($r['id']);
	    $review = stripslashes($r['review']);
	    $review = str_replace("\n", "<br />", $review);
	    $name = stripslashes($r['name']);
	    echo"
	    <tr>
	    <td align=\"left\" valign=\"middle\" width='30px' style='border-bottom:3px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
	    <a href=\"removereview.php?rid=$rid\" onclick=\"return confirm('Are you sure you want to delete this review?');\"><img src='images/trashcan.jpg'></a>
	    </td>
	    <td align=\"left\" valign=\"middle\" width='30px' style='border-bottom:3px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
	    <a href=\"approvereview.php?rid=$rid\"><img src='images/check.jpg'></a>
	    </td>
	    <td align=\"left\" valign=\"middle\" style='border-bottom:3px solid #F7F7F7;'>
	    $review
	    </td>
	    <td align=\"left\" valign=\"middle\" style='border-bottom:3px solid #F7F7F7;'>
	    $name
	    </td>
	    </tr>";
        }
        ?>
        </table>
        </div>
        
    </td>
    </tr>
    
    <tr>
    <td align="left" valign="top" style="background-color:#CCCCCC;">
	Approved Reviews
        <div style="background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
	<?php
        $result = mysql_query("SELECT * FROM `reviews` WHERE `approved` = '1' ORDER BY `date` DESC");
        while ($r = mysql_fetch_array($result)) {
	    $rid = ($r['id']);
	    $review = stripslashes($r['review']);
	    $review = str_replace("\n", "<br />", $review);
	    $name = stripslashes($r['name']);
	    echo"
	    <tr>
	    <td align=\"left\" valign=\"middle\" width='30px' style='border-bottom:3px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
	    <a href=\"removereview.php?rid=$rid\" onclick=\"return confirm('Are you sure you want to delete this review?');\"><img src='images/trashcan.jpg'></a>
	    </td>
	    <td align=\"left\" valign=\"middle\" style='border-bottom:3px solid #F7F7F7;'>
	    $review
	    </td>
	    <td align=\"left\" valign=\"middle\" style='border-bottom:3px solid #F7F7F7;'>
	    $name
	    </td>
	    </tr>";
        }
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




