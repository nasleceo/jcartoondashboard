<?php 

$url="https://likessb.com/6zwudegx1sz4.html";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true); // true to include the header in the output.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true true to follow any "Location: " header that the server sends as part of the HTTP header.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

$a = curl_exec($ch); // $a will contain all headers

$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL

// Uncomment to see all headers
echo $finalUrl; // Voila

echo "<pre>";
print_r($a);
echo"<br>";
echo "</pre>";



?>