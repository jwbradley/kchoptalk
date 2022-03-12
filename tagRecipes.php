<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'Beer Recipes'; 
$beerFeeds    =  array('http://feeds.feedburner.com/CraftBeerAndBrewingMagazine');
$findReviews  =  array('beer recipe', 'recipe:'); 
$feedDays     =  30;
$start        =  new beerFeedClass($beerFeeds, $debugger);
 
$start->tagFeedArticles($findReviews, $feedTag, $feedDays);

?>
