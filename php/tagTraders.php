<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$feedTag      =  'Beer Traders'; 
$feedDays     =  30;
$beerFeeds    =  array('http://mybeerbuzz.blogspot.com/feeds/posts/default', 
                       'http://www.brewbound.com/feed/', 
                       'http://iabeerbaron.wordpress.com/feed/', 
                       'http://thebrewermagazine.com/?feed=rss2', 
                       'http://www.porchdrinking.com/feed/'
                       );
$findNewBeers =  array('releas', 'announc', 'introduc', 'adding', 'collaborate', 'collaboration', 'team up', 'returns', 'returning', 'brews coming', 'launches', 'brews up', 'debuts');
$start        =  new beerFeedClass($beerFeeds, $debugger);

$start->tagFeedArticles($findNewBeers, $feedTag, $feedDays);

?>
