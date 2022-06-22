<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  beerFeedClass::beerCookTags;
$feedTag     =  '/tag/f02777b6-1cd8-4176-928e-e513fc36dca7'; 
$feedCount   =  200;
$feedDays    =  60;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$mycoder     =  json_decode(curl_exec($curl), true);

$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder));

curl_close($curl);

?>