<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'Beer Traders'; 
$findNewBeers =  array('new release:', 'release new beer', 'beer release', 'brewing release', 'brewery releas', 'brewing company release', 'brews coming', 'brewing unleashes', 'Release Limited Edition Beer', 'release beer', 'release:', 'announces the release', 'distillers release');
$feedDays     =  30;
$start        =  new beerFeedClass('', $debugger);

$start->bulkTagFeedArticles($findNewBeers, $feedTag);

?>
