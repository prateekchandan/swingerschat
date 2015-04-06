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
		echo"Successfully edited the category name!";
	}

	?>
    </td>
    </tr>
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    EDIT CATEGORIES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
		<td align='left' valign='top' colspan='3'><a href='addforumcategory.php'>Add New Category --></a></td>
		</tr>
        <?php
        $result = mysql_query("SELECT * FROM `F_Categories` ORDER BY `name` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$categoryid = ($r['id']);
			$name = ($r['name']);
			echo"
			<tr>
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7; border-right:1px solid #F7F7F7;'>
			<a href=\"removeforumcategory.php?id=$categoryid\" onclick=\"return confirm('Are you sure you want to delete this category?');\"><img src='images/trashcan.jpg'></a>
			</td>";
			
			echo"
			<td align=\"left\" valign=\"middle\" style='border-bottom:1px solid #F7F7F7;'>
			<a href=\"editforumcategory.php?id=$categoryid\">$name</a>
			</td>
			</tr>";
        }
        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	
    </td>
    </tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




