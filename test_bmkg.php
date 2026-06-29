<?php
$url = 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.xml';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$xmlStr = curl_exec($ch);
curl_close($ch);

if ($xmlStr) {
    echo "SUCCESS\n";
    $xml = simplexml_load_string($xmlStr);
    echo json_encode($xml, JSON_PRETTY_PRINT);
} else {
    echo "FAILED";
}
