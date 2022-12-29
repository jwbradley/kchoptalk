<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  beerFeedClass::beerRecipeTags;
$feedTag     =  '/tag/Beer Recipes'; 
$feedCount   =  250;
$feedDays    =  0;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$mycoder     =  json_decode(curl_exec($curl), true);

$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder));

curl_close($curl);

?>