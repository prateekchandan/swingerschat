<?php
require ('../includes/dbconnect2.php');
$dbc = mysql_connect("$dbhost","$dbuser","$dbpass"); 
if (!$dbc) { 

	die('Could not connect: ' . mysql_error()); 

} 
mysql_select_db("$dbname", $dbc);

$file= fopen("../images.xml", "w");

$xml_output .= "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\" ?>\n";
$xml_output .= "<images>\n";

$count = 0;
$result = mysql_query("SELECT * FROM `ads` ORDER BY `id` ASC");
$rows = mysql_num_rows($result);
while ($r = mysql_fetch_array($result)) {	
	$photo = ($r['photo']);
	$domain = ($r['domain']);
	if ($domain != "No Link") {
		$xml_output .= "<image src=\"ADS/$photo\" caption=\"\" href=\"$domain\" target=\"_self\" transition=\"1\" />\n";
	} else {
		$xml_output .= "<image src=\"ADS/$photo\" caption=\"\" href=\"\" target=\"_self\" transition=\"1\" />\n";
	}

}


$xml_output .= "</images>\n";
$xml_output .= "<settings>\n";
$xml_output .= "<slideShow width = \"593\" height = \"189\"  />\n";
$xml_output .= "<autoPlay playOption = \"0\" delay = \"4\" />\n";
$xml_output .= "<caption capOption = \"1\" />\n";
$xml_output .= "<buttons styleOption = \"1\" />\n";
$xml_output .= "</settings>";

fwrite($file, $xml_output);

fclose($file);

?>
