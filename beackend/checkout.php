
<?php

$rsrsPath = $_GET['resourcePath'];
$urlPath = "https://test.oppwa.com".$rsrsPath;
//var_dump($urlPath) ;
function request($url){
      $url .= '?entityId=8ac7a4c871bf63f00171c2f2e77c0d14';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        return curl_error($ch);
    }

    curl_close($ch);
    return $response;
}

echo request($urlPath);
