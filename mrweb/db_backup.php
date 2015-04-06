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

ini_set('max_execution_time', 0);

$date = date('m');
$date .= "-";
$date .= date('d');
$date .= "-";
$date .= date('Y');
$date .= "-";
$date .= date('g');
$date .= "-";
$date .= date('i');
$date .= date('a');

backup_tables("$dbhost","$dbuser","$dbpass","$dbname");


/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen("ddd/db-backup-" . date('m') . date('d') . date('Y') . '-' . time() .".sql",'w+');
	fwrite($handle,$return);
	fclose($handle);
}

echo"<br /><br />Your site DB has been successfully backed up!.";
 ?>
 	</td>
    </tr>
    </table>


</td>
</tr>


<?php
require ('includes/footer.php');
?>




