<?php
$id = htmlspecialchars(end(explode("/",$_SERVER['PHP_SELF'])),ENT_QUOTES);
header("Content-type:application/xml;");
function getrss($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
echo getrss("http://localhost:3000/api/".$id);