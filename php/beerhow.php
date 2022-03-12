<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  '/home/jambra49/kchoptalk.com/json/beerhowtos.json';
$feedTag     =  '/tag/ab6e7b8f-4ec9-49b4-9775-233c17e1e74e'; 
$feedCount   =  200;
$feedDays    =  60;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$mycoder     =  json_decode(curl_exec($curl), true);

$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder));

curl_close($curl);

?>