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
	$memberssection = 0;
	$blogsection = 0;
	$memberslogo = 0;
	
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
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
    CURRENT EVENTS
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		echo"<tr>";
		echo"<td colspan='2' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<a href=\"addevent.php\">Add New Event ---></a>";
		echo"</td>";
		echo"</tr>";
        $result = mysql_query("SELECT * FROM `events` ORDER BY `time` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$eventid = ($r['id']);
			$name = ($r['name']);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"editevent.php?id=$eventid\">$name</a>";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"deleteevent.php?id=$eventid\" onclick=\"return confirm('Are you sure you want to delete this event?');\"><img src=\"images/trashcan.jpg\" /></a>";
			echo"</td>";
			echo"</tr>";
        }
        ?>
        </table>
        </div>
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="33%">
	EVENT PLACES
        <div style="height:300px; overflow-x:hidden; overflow-y:scroll; background-color:#FFFFFF;">
        <table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <?php
		echo"<tr>";
		echo"<td colspan='2' align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
		echo"<a href=\"addeventplace.php\">Add New Place ---></a>";
		echo"</td>";
		echo"</tr>";
		
        $result = mysql_query("SELECT * FROM `events_places` ORDER BY `name` ASC");
        while ($r = mysql_fetch_array($result)) {	
			$placeid = ($r['id']);
			$name = ($r['name']);
			$photo = ($r['photo']);
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"editeventplace.php?id=$placeid\">$name</a>";
			echo"</td>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
			echo"<a href=\"deleteeventplace.php?id=$placeid&photo=$photo\" onclick=\"return confirm('Are you sure you want to delete this place?');\"><img src=\"images/trashcan.jpg\" /></a>";
			echo"</td>";
			echo"</tr>";
        }
        ?>
        </table>
        </div>
    	
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




