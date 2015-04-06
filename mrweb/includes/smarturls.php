<?php
//write smart URLs
$line = "RewriteEngine  on \n";
//$line .= "RewriteBase / \n";
$line .= "ErrorDocument 404 /index.php \n";

//MAIN PAGES
$result = mysql_query("SELECT * FROM `pages`");
while ($r = mysql_fetch_array($result)) {
        $pageid = ($r['id']);
        $keywords = ($r['keywords']);
        //$keywords = str_replace(' ', '', $keywords);
        
        if ($keywords == "") {
                $keywords = $pageid;
        }
        
        $keywords = preg_replace("([^a-zA-Z0-9-])","",$keywords);
       
        //Write product page URLs
        $filename = "Page" . $pageid . "-" . $keywords;
        $line .= "RewriteRule ^" . $filename . "$ index.php?id=" . $pageid . "\n";
}


// PRODUCT PAGES
$result = mysql_query("SELECT * FROM `products`");
while ($r = mysql_fetch_array($result)) {
        $pageid = ($r['id']);
        $keywords = ($r['metakeywords']);
        //$keywords = str_replace(' ', '', $keywords);
        
        if ($keywords == "") {
                $keywords = $pageid;
        }
        
        $keywords = preg_replace("([^a-zA-Z0-9-])","",$keywords);
        
        //Write product page URLs
        $filename = "Product" . $pageid . "-" . $keywords;
        $line .= "RewriteRule ^" . $filename . "$ storeproduct.php?productid=" . $pageid . "\n";
}



$file = $htaccess;
$fp = fopen($file, 'w');
fwrite($fp, "$line");
fclose($fp);
//Smart URL's Done
?>