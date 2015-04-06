<?php
require ('../includes/dbconnect.php');
require ('includes/header2.php');
?>

<!--Body -->
<tr>
<td class="bodytable">

<br />
<br />
	<table align="center" cellpadding="5px" cellspacing="5px" border="0px" width="95%" style="border:1px solid #cccccc;" >
    <tr>
    <td colspan="3" align="center" valign="top">
    <?php
	$memberssection = 0;
	$blogsection = 0;
	
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
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="70%">

        <div style="overflow-x:hidden; overflow-y:hidden; background-color:#FFFFFF;">
        <table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#ffffff;" colspan='5'>
        <strong>NEW LEADS</strong>
        </td>
        </tr>
        
        <?php
		$error = ($_GET['error']);
		if ($error == 1) {
			echo"<tr>";
			echo"<td align='center' valign='middle' style='border-bottom:5px solid #FFFFFF; background-color:#FF0000;' colspan='5'>";
			echo"There is already an account in the mailing list with this e-mail address. <br /> Please edit the address with the edit icon.";
			echo"</td>";
			echo"</tr>";
		}
        $result = mysql_query("SELECT * FROM `newsletter` WHERE `status`='0' ORDER BY `id` DESC");
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			while ($r = mysql_fetch_array($result)) {	
				$emailid = ($r['id']);
				$first = ($r['first']);
				$last = ($r['last']);
				$email = ($r['email']);
				$message = ($r['message']);
				$message = str_replace("\r\n", "<br />", $message);

				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$first $last";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$email";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newsletterapprovemember.php?emailid=$emailid&email=$email\" onclick=\"return confirm('This will approve this lead and add them to your mailing list. Do you want to continue?');\"><img src=\"images/check.jpg\" /></a>";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newslettereditmember.php?emailid=$emailid\" ><img src=\"images/edit.jpg\" /></a>";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newsletterdeletemember.php?emailid=$emailid&email=$email\" onclick=\"return confirm('Are you sure you want to remove this lead?');\"><img src=\"images/trashcan.jpg\" /></a>";
				echo"</td>";
				echo"</tr>";
				
				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:5px solid #FFFFFF;' colspan='5'>";
				echo"$message";
				echo"</td>";
				echo"</tr>";
			}
		} else {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='5'>";
			echo"There are no new leads.";
			echo"</td>";
			echo"</tr>";
		}
        ?>
        </table>
        </div>
        
        
        <div style="overflow-x:hidden; overflow-y:hidden; background-color:#FFFFFF;">
        <table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#ffffff;" colspan='4'>
        <strong>CURRENT MEMBERS</strong>
        </td>
        </tr>
        <?php
        $result = mysql_query("SELECT * FROM `newsletter` WHERE `status`='1' ORDER BY `id` DESC");
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			while ($r = mysql_fetch_array($result)) {	
				$emailid = ($r['id']);
				$first = ($r['first']);
				$last = ($r['last']);
				$email = ($r['email']);
				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$first $last";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$email";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newslettereditmember.php?emailid=$emailid\" ><img src=\"images/edit.jpg\" /></a>";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newsletterdeletemember.php?emailid=$emailid&email=$email\" onclick=\"return confirm('Are you sure you want to delete this member?');\"><img src=\"images/trashcan.jpg\" /></a>";
				echo"</td>";
				echo"</tr>";
			}
		} else {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='4'>";
			echo"There are no current members.";
			echo"</td>";
			echo"</tr>";
		}
        ?>
        </table>
        </div>
        
        <div style="overflow-x:hidden; overflow-y:hidden; background-color:#FFFFFF;">
        <table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#ffffff;" colspan='54'>
        <strong>UNSUBSCRIBERS</strong>
        </td>
        </tr>
        
        <?php
        $result = mysql_query("SELECT * FROM `newsletter` WHERE `status`='3' ORDER BY `id` DESC");
		$rows = mysql_num_rows($result);
		if ($rows > 0) {
			while ($r = mysql_fetch_array($result)) {	
				$emailid = ($r['id']);
				$first = ($r['first']);
				$last = ($r['last']);
				$email = ($r['email']);
				$message = ($r['message']);
				$message = str_replace("\r\n", "<br />", $message);

				echo"<tr>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$first $last";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;'>";
				echo"$email";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newsletterapprovemember.php?emailid=$emailid&email=$email\" onclick=\"return confirm('This will add this member back to your mailing list. Do you want to continue?');\"><img src=\"images/check.jpg\" /></a>";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newslettereditmember.php?emailid=$emailid\" ><img src=\"images/edit.jpg\" /></a>";
				echo"</td>";
				echo"<td align='left' valign='middle' style='border:2px solid #F7F7F7; background-color:#FFFFFF;'>";
				echo"<a href=\"newsletterdeletemember.php?emailid=$emailid&email=$email\" onclick=\"return confirm('Are you sure you want to remove this lead?');\"><img src=\"images/trashcan.jpg\" /></a>";
				echo"</td>";
				echo"</tr>";
			}
		} else {
			echo"<tr>";
			echo"<td align='left' valign='middle' style='border-bottom:1px solid #F7F7F7;' colspan='5'>";
			echo"There are no unsubscribers.";
			echo"</td>";
			echo"</tr>";
		}
        ?>
        </table>
        </div>
        
        
        
    </td>
    
    <td align="center" valign="top" style="background-color:#CCCCCC;" width="30%">
	
    <div style="overflow-x:hidden; overflow-y:hidden; background-color:#FFFFFF;">

		<table align="center" cellpadding="0px" cellspacing="5px" border="0px" style="background-color:#FFFFFF;" width="100%">
        <tr>
        <td align="center">
        <br />
        	
            <?php
		// Get Active Mailing List for stats	 
		$result = mysql_query("SELECT * FROM `newsletter_lists` WHERE `active` = '1'");
		$r = mysql_fetch_array($result);
		$list_id = ($r['id']);
		$list_name = ($r['name']);
		$tablename = "newsletter_list_" . $list_id;
		if ($list_id == 2) {
			$result = mysql_query("SELECT * FROM `newsletter` WHERE `status` = '1'");
		} else {
			$result = mysql_query("SELECT * FROM `$tablename`");
		}
		$rows = mysql_num_rows($result);
		
		// Get Active Template List for stats
		$result = mysql_query("SELECT * FROM `newsletter_templates` WHERE `active` = '1'");
		$r = mysql_fetch_array($result);
		$template_name = ($r['name']);
		?>
		<a href="newslettersend.php" onclick="return confirm('<?php echo"You are about to send this newsletter to everyone in your $list_name mailing list using the $template_name template. Do you want to continue?"; ?>');"><img src='images/newsletter-1.jpg' /></a><br />
        <a href="newslettertest.php" onclick="return confirm('<?php echo"You are about to send 1 e-mail to $adminemail using the $template_name template. Do you want to continue?"; ?>');"><img src='images/newsletter-3.jpg' /></a>
        
        <br /><br />

        <?php
		// Get Active Mailing List		
		$result = mysql_query("SELECT * FROM `newsletter_actions`");
		while ($r = mysql_fetch_array($result)) {
			$messages = ($r['messages']);
			$action_id = ($r['id']);
			$list = ($r['list']);
			$template = ($r['template']);
		?>
        	<table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
            <tr>
            <td align="center" style="background-color:#333333; color:#ffffff;" colspan='2'>
            <strong>NEWSLETTER BEING SENT...</strong>
            </td>
            </tr>
            <tr>
            <td align="left" valign='top'>
            Total:
            </td>
            <td align="left" valign='top'>
            <?php echo"$messages e-mails"; ?>
            </td>
            </tr>
            
            <tr>
            <td align="left" valign='top'>
            Left:
            </td>
            <td align="left" valign='top'>
            <?php 
			$result2 = mysql_query("SELECT * FROM `newsletter_send` WHERE `action`='$action_id'");
		    $rows2 = mysql_num_rows($result2);
			echo"$rows2 e-mails"; ?>
            </td>
            </tr>
            
            <tr>
            <td align="left" valign='top'>
            List:
            </td>
            <td align="left" valign='top'>
            <?php echo"$list"; ?>
            </td>
            </tr>
            
            <tr>
            <td align="left" valign='top'>
            Template:
            </td>
            <td align="left" valign='top'>
            <?php echo"$template"; ?>
            </td>
            </tr>
            
            <tr>
            <td align="center" valign='top' colspan='2' style='background-color:#ffffff;'>
            <?php echo"<a href=\"newsletterstop.php?action_id=$action_id\" onclick=\"return confirm('By stopping the newsletter, you will stop all remaining e-mails from being sent. Do you want to continue?');\"><img src='images/newsletter-6.jpg' /></a>"; ?>
            </td>
            </tr>
            </table>
        <?php
		}
		?>
        
        

        </td>
        </tr>
        </table>
        
        <!-- Templates -->
		<table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#FFFFFF;" colspan='4'>
        <strong>NEWSLETTER TEMPLATES</strong>
        </td>
        </tr>
        

        <?php
		$message = ($_GET['message']);
		if ($message == 1) {
			echo"Subject successfully changed! <br /><br />";
		}
		
		$result = mysql_query("SELECT * FROM `newsletter_templates` ORDER BY `id` ASC");
        while ($r = mysql_fetch_array($result)) {
			$template_name = stripslashes($r['name']);
			$template_id = ($r['id']);
			$template_active = ($r['active']);
			echo"<tr>";
			if ($template_active == 1) {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<img src=\"images/active_mail.jpg\" width='20px'/>";
				echo"</td>";
			} else {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<a href=\"newslettermakeactive.php?id=$template_id\" ><img src=\"images/active_mail2.jpg\" width='20px'/></a>";
				echo"</td>";
			}
			echo"<td align='center' style='border-bottom:1px solid #FFFFFF;'>";
			echo"$template_name";
			echo"</td>";
			echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
			echo"<a href=\"newsletteredittemplate.php?id=$template_id\" ><img src=\"images/edit.jpg\" width='20px'/></a>";
			echo"</td>";
			echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
			echo"<a href=\"newsletterdeletetemplate.php?id=$template_id\" onclick=\"return confirm('Are you sure you want to delete this template?');\"><img src=\"images/trashcan.jpg\" width='20px'/></a>";
			echo"</td>";
			echo"</tr>";
		}
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#CCCCCC;' colspan='4'>";
		echo"</td></tr>";
		
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF;' colspan='4'>";
		echo"<a href='newsletteraddtemplate.php' ><img src='images/newsletter-4.jpg' /></a>";
		echo"</td></tr>";
		
		
		
		?>
        </table>
        
        
        <!-- Lists -->
        <table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#FFFFFF;" colspan='5'>
        <strong>NEWSLETTER LISTS</strong>
        </td>
        </tr>
        

        <?php
		$message = ($_GET['message']);
		if ($message == 1) {
			echo"Subject successfully changed! <br /><br />";
		}
		
		
		$result = mysql_query("SELECT * FROM `newsletter_lists` ORDER BY `id` ASC");
        while ($r = mysql_fetch_array($result)) {
			$list_name = stripslashes($r['name']);
			$list_id = ($r['id']);
			$list_active = ($r['active']);
			$list_deleteable = ($r['deleteable']);
			
			echo"<tr>";
			if ($list_active == 1) {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<img src=\"images/active_mail.jpg\" width='20px'/>";
				echo"</td>";
			} else {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<a href=\"newslettermakelistactive.php?id=$list_id\" ><img src=\"images/active_mail2.jpg\" width='20px'/></a>";
				echo"</td>";
			}
			
			if ($list_id == 2) {
				$tablename = "newsletter";
				$result2 = mysql_query("SELECT * FROM `$tablename` WHERE `status` != '0'");
				$rows2 = mysql_num_rows($result2);
			} else {
				$tablename = "newsletter_list_" . $list_id;
				$result2 = mysql_query("SELECT * FROM `$tablename`");
				$rows2 = mysql_num_rows($result2);
			}
			
			echo"<td align='center' style='background-color:#c7cbcc; border-bottom:1px solid #FFFFFF;'>";
			echo"$rows2";
			echo"</td>";
			
			echo"<td align='center' style='border-bottom:1px solid #FFFFFF;'>";
			echo"$list_name";
			echo"</td>";
			if ($list_deleteable == 1) {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<img src=\"images/edit2.jpg\" width='20px'/>";
				echo"</td>";
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<img src=\"images/trashcan2.jpg\" width='20px'/>";
			} else {
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<a href=\"newslettereditlist.php?id=$list_id\" ><img src=\"images/edit.jpg\" width='20px'/></a>";
				echo"</td>";
				echo"<td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF; border:1px solid #EFEFEF;'>";
				echo"<a href=\"newsletterdeletelist.php?id=$list_id\" onclick=\"return confirm('This will delete this entire list. Are you sure you want to continue?');\"><img src=\"images/trashcan.jpg\" width='20px'/></a>";
			}
				echo"</td>";
			echo"</tr>";
		}
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#CCCCCC;' colspan='5'>";
		echo"</td></tr>";
		
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF;' colspan='5'>";
		echo"<a href='newsletteraddlist.php' ><img src='images/newsletter-5.jpg' /></a>";
		echo"</td></tr>";
		
		
		
		?>
        </table>
        
        
        <!-- Members -->
		<table align="center" cellpadding="5px" cellspacing="0" border="0px" style="background-color:#EFEFEF; margin-bottom:50px;" width="100%">
        <tr>
        <td align="center" style="background-color:#333333; color:#FFFFFF;" colspan='4'>
        <strong>Members Panel</strong>
        </td>
        </tr>
        
        <?php
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#CCCCCC;' colspan='4'>";
		echo"</td></tr>";
		
		echo"<tr><td align='center' style='border-bottom:1px solid #FFFFFF; background-color:#FFFFFF;' colspan='4'>";
		echo"<a href='newsletteraddmember.php' ><img src='images/newsletter-7.jpg' /></a>";
		echo"</td></tr>";
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




