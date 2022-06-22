<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  beerFeedClass::beerTraders;
$feedTag     =  '/tag/Beer Traders'; 
$feedCount   =  125;
$feedDays    =  15;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$mycoder     =  json_decode(curl_exec($curl), true);
// $response = curl_exec($curl);
// $mycoder     =  json_decode($response, true);

$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder), 'Y');

curl_close($curl);

?>