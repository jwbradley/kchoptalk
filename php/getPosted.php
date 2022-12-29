<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$jsonOut      =  beerFeedClass::PostedArticles;
$beerFeeds    =  'http://kchoptalk.com/index-rss.php';
$feedDays     =  31;
$readOnly     =  'false';
$counter      =  250;
$start        =  new beerFeedClass('', $debugger);

$start->jsonOutput($jsonOut, curl_exec($start->getFeedly($start->feedlyGetSearch($beerFeeds, $feedDays, $readOnly, $counter))), 'N');

?>