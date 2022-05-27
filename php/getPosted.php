<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$beerFeeds    =  'http://kchoptalk.com/index-rss.php';
$feedDays     =  31;
$readOnly     =  'false';
$counter      =  1000;
$start        =  new beerFeedClass('', $debugger);

var_dump($start->feedlyGetSearch($beerFeeds, $feedDays, $readOnly, $counter));
var_dump(json_decode(curl_exec($start->getFeedly($start->feedlyGetSearch($beerFeeds, $feedDays, $readOnly, $counter)))));




?>
