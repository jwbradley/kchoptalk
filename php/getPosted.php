<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$jsonOut      =  '/home/jambra49/kchoptalk.com/json/rss.json';
$beerFeeds    =  'http://kchoptalk.com/index-rss.php';
$feedDays     =  31;
$readOnly     =  'false';
$counter      =  1000;
$start        =  new beerFeedClass('', $debugger);

$start->jsonOutput($jsonOut, curl_exec($start->getFeedly($start->feedlyGetSearch($beerFeeds, $feedDays, $readOnly, $counter))), 'N');

?>