<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$beerFeeds    =  array(
                       'http://www.americancraftbeer.com/feed/',
                       'http://feeds.feedburner.com/AmericanHomebrewersAssociation'
                      );

$findString   =  array('ALL');
$feedDays     =  30;
$start        =  new beerFeedClass($beerFeeds, $debugger);

$start->createPosts($findString, $feedDays);

?>
