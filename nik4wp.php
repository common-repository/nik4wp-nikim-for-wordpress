<?php
/*
Plugin Name: nik4wp :: a nik.im plugin
Plugin URI: http://nik.im/nik4wp
Description: All comments posted on your blog posts are automatically transformed into nik.im shortened URLs, helping to save your SEO.
Version: 0.1
Author: Strike Internet
Author URI: http://www.strikeinternet.com
License: All Rights Reserved.
*/
/*  Copyright 2010 Strike Internet (info@strikeinternet.com)

    This program is free software, distributed by Strike Internet, the parent
	company of nik.im. This code may not be modified or redistributed under
	and condition. Redistribution or resale of this code is not permitted, and
	doing so may result in legal action on behalf of Strike Internet

	
	Limitation of Liability: 
	This program is provided WITHOUT ANY WARRANTY, implication of warranty,
	or fitness for a particular purpose. Strike Internet is NOT RESPONSIBLE 
	for damages resulting from the installation of this product or damages 
	resulting from using this product. Strike Internet is under no obligation 
	to provide any support for this product.	
*/

function nikim_urls($content) {
// The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

// Check if there is a url in the text
if(preg_match($reg_exUrl, $content, $url)) {

	   $nikim_url = $url[0];
       // make the urls hyper links
	   $url = "http://nik.im/api_create.php?url=$nikim_url&api_key=c0c7c76d30bd3dcaefc96f40275bdc0a";

	   $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
	curl_close($ch);   
       return preg_replace($reg_exUrl, $output, $content);

} else {
       // if no urls in the text just return the text
       return $content;

}
}

add_filter('comment_text','nikim_urls');
?>
