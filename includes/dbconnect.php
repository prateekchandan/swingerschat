<?php 
session_start();
ob_start();

$dbhost = "localhost";
$dbuser = "root";
$dbname = "swingerschat";
$dbpass = "9431221178";

$dbc = mysql_connect("$dbhost","$dbuser","$dbpass"); 
if (!$dbc) { 
	die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db("$dbname", $dbc);

$result = mysql_query('SELECT * FROM members WHERE admin = 1');
$r = mysql_fetch_array($result);
$adminemail = ($r['email']);
putenv("TZ=America/Chicago");

$baseurl = "http://www.mrwebpage.net/CUSTOM/ChadA/";
$htaccess = $_SERVER['DOCUMENT_ROOT'] .'/CUSTOM/ChadA/.htaccess';

$sitename = "Swingers Chat";

$slidewidth = 624;
$slideheight = 456;

ini_set('memory_limit', '128M');


//Functions

//Random String - Use this to get string - $my_string = rand_string( 5 );
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


// This work is licensed under a Creative Commons Attribution-NonCommercial 3.0 Unported License

function Email($remail, $rname, $semail, $sname, $cc, $bcc, $subject, $message, $attachments, $priority, $type)  {

// Checks if carbon copy & blind carbon copy exist
if($cc != null){$cc="CC: ".$cc."\r\n";}else{$cc="";}
if($bcc != null){$bcc="BCC: ".$bcc."\r\n";}else{$bcc="";}

// Checks the importance of the email
if($priority == "high"){$priority = "X-Priority: 1\r\nX-MSMail-Priority: High\r\nImportance: High\r\n";}
elseif($priority == "low"){$priority = "X-Priority: 3\r\nX-MSMail-Priority: Low\r\nImportance: Low\r\n";}
else{$priority = "";}

// Checks if it is plain text or HTML
if($type == "plain"){$type="text/plain";}else{$type="text/html";}

// The boundary is set up to separate the segments of the MIME email
$boundary = md5(@date("Y-m-d-g:ia"));

// The header includes most of the message details, such as from, cc, bcc, priority etc. 
$header = "From: ".$sname." <".$semail.">\r\nMIME-Version: 1.0\r\nX-Mailer: PHP\r\nReply-To: ".$sname." <".$semail.">\r\nReturn-Path: ".$sname." <".$semail.">\r\n".$cc.$bcc.$priority."Content-Type: multipart/mixed; boundary = ".$boundary."\r\n\r\n";    
  
// The full message takes the message and turns it into base 64, this basically makes it readable at the recipients end
$fullmessage .= "--".$boundary."\r\nContent-Type: ".$type."; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n".chunk_split(base64_encode($message));

// A loop is set up for the attachments to be included.
if($attachments != null) {
  foreach ($attachments as $attachment)  {
    $attachment = explode(":", $attachment);
    $fullmessage .= "--".$boundary."\r\nContent-Type: ".$attachment[1]."; name=\"".$attachment[2]."\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment\r\n\r\n".chunk_split(base64_encode(file_get_contents($attachment[0])));
  }
}

// And finally the end boundary to set the end of the message
$fullmessage .= "--".$boundary."--";

return mail($rname."<".$remail.">", $subject, $fullmessage, $header);
}



//Square Crop Function

 
function square_crop($src_image, $dest_image, $thumb_size = 64, $jpg_quality = 90) {
 
    // Get dimensions of existing image
    $image = getimagesize($src_image);
 
    // Check for valid dimensions
    if( $image[0] <= 0 || $image[1] <= 0 ) return false;
 
    // Determine format from MIME-Type
    $image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));
 
    // Import image
    switch( $image['format'] ) {
        case 'jpg':
        case 'jpeg':
            $image_data = imagecreatefromjpeg($src_image);
        break;
        case 'png':
            $image_data = imagecreatefrompng($src_image);
        break;
        case 'gif':
            $image_data = imagecreatefromgif($src_image);
        break;
        default:
            // Unsupported format
            return false;
        break;
    }
 
    // Verify import
    if( $image_data == false ) return false;
 
    // Calculate measurements
    if( $image[0] > $image[1] ) {
        // For landscape images
        $x_offset = ($image[0] - $image[1]) / 2;
        $y_offset = 0;
        $square_size = $image[0] - ($x_offset * 2);
    } else {
        // For portrait and square images
        $x_offset = 0;
        $y_offset = ($image[1] - $image[0]) / 2;
        $square_size = $image[1] - ($y_offset * 2);
    }
 
    // Resize and crop
    $canvas = imagecreatetruecolor($thumb_size, $thumb_size);
    if( imagecopyresampled(
        $canvas,
        $image_data,
        0,
        0,
        $x_offset,
        $y_offset,
        $thumb_size,
        $thumb_size,
        $square_size,
        $square_size
    )) {
 
        // Create thumbnail
        switch( strtolower(preg_replace('/^.*\./', '', $dest_image)) ) {
            case 'jpg':
            case 'jpeg':
                return imagejpeg($canvas, $dest_image, $jpg_quality);
            break;
            case 'png':
                return imagepng($canvas, $dest_image);
            break;
            case 'gif':
                return imagegif($canvas, $dest_image);
            break;
            default:
                // Unsupported format
                return false;
            break;
        }
 
    } else {
        return false;
    }
 
}


//USPS Shipping Prices
function USPSParcelRate($service, $ounces, $shippingzip, $postagetype) {  

 
// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.    

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========  

$userName = '235SUPER6761'; // Your USPS Username  
$orig_zip = '78124'; // Zipcode you are shipping FROM  
 
// =============== DON'T CHANGE BELOW THIS LINE ===============  
 
$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";  
$ch = curl_init();  
 
// set the target url  
curl_setopt($ch, CURLOPT_URL,$url);  
curl_setopt($ch, CURLOPT_HEADER, 1);  
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
 
// parameters to post  
curl_setopt($ch, CURLOPT_POST, 1);

//GET SHIP DATE
$date = time();
$month = date('M',"$date");
$day = date('j',"$date");
$year = date('Y',"$date");
$hour = date('g',"$date");
$minute = date('i',"$date");
$meridiem = date('a',"$date");
$shipdate = $day . "-" . $month . "-" . $year;





if ($shippingcountry != "United States") {
	//$postagetype = "2";
	$shippingarea = "INTLRATERESPONSE";
	$rate = "POSTAGE";
	$data = "API=IntlRate&XML=<IntlRateRequest USERID=\"$userName\"><Package ID=\"1ST\"><Pounds>0</Pounds><Ounces>$ounces</Ounces><Machinable>False</Machinable><MailType>Package</MailType><Country>$shippingcountry</Country></Package></IntlRateRequest>";  
} else {
	
$shippingarea = "RATEV4RESPONSE";
$rate = "RATE";
$data = "API=RateV4&XML=<RateV4Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>$service</Service><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$shippingzip</ZipDestination><Pounds>0</Pounds><Ounces>$ounces</Ounces><Container>Variable</Container><Size>REGULAR</Size><Width></Width><Length></Length><Height></Height><Girth></Girth><Machinable>False</Machinable><ReturnLocations>FALSE</ReturnLocations><ShipDate Option=\"HFP\">$shipdate</ShipDate></Package></RateV4Request>";  



}
 
// send the POST values to USPS  
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  
 
$result=curl_exec ($ch);  
$data = strstr($result, '<?');  
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments  
$xml_parser = xml_parser_create();  
xml_parse_into_struct($xml_parser, $data, $vals, $index);  
xml_parser_free($xml_parser);  
$params = array();  
$level = array();  
foreach ($vals as $xml_elem) {  
    if ($xml_elem['type'] == 'open') {  
        if (array_key_exists('attributes',$xml_elem)) {  
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);  
        } else {  
        $level[$xml_elem['level']] = $xml_elem['tag'];  
        }  
    }  
    if ($xml_elem['type'] == 'complete') {  
    $start_level = 1;  
    $php_stmt = '$params';  
    while($start_level < $xml_elem['level']) {  
        $php_stmt .= '[$level['.$start_level.']]';  
        $start_level++;  
    }  
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';  
    eval($php_stmt);  
    }  
}  
curl_close($ch);  
//echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags  
return $params["$shippingarea"]['1ST']["$postagetype"]["$rate"];  
}  
//End USPS SHIPPING

?>
