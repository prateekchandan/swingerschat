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
		echo"Successfully edited page!";
	}
	if ($message == 2) {
		echo"Successfully added new page!";
	}
	if ($message == 3) {
		echo"Your changes have been discarded!";
	}
	if ($message == 4) {
		echo"Successfully posted new blog entry!";
	}
	if ($message == 5) {
		echo"Successfully edited blog entry!";
	}
	if ($message == 6) {
		echo"That page cannot be deleted!";
	}
	if ($message == 7) {
		echo"Successfully updated your admin account!";
	}
	if ($message == 8) {
		echo"Successfully deleted member!";
	}
	?>
    </td>
    </tr>
    
    <tr>
    <td align="center" valign="top" style="background-color:#CCCCCC;" colspan="3">
    VIEW FILES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF; text-align:left;">
        <a href="fileuploader.php">Upload New File --></a><br />
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
        $result = mysql_query('SELECT * FROM `files`');
        while ($r = mysql_fetch_array($result)) {	
			$fileid = ($r['id']);
			$name = ($r['name']);
			$url = $baseurl . "files/" . $name;
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$name";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"$url";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"deletefile.php?fileid=$fileid&filename=$name\" onclick=\"return confirm('Are you sure you want to delete this file?');\"><img src=\"images/trashcan.jpg\" /></a>";
			echo"</td>";
			echo"</tr>";
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




