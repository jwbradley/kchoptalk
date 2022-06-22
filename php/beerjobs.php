<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  beerFeedClass::beerJobTags;
$feedTag     =  '/tag/a005d466-a174-46a1-8322-59167c04b8d0'; 
$feedCount   =  200;
$feedDays    =  60;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$mycoder     =  json_decode(curl_exec($curl), true);

$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder));

curl_close($curl);

?>
