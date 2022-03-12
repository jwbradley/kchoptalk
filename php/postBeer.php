<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start        =  new beerFeedClass($debugger);

$feedTag      =  'Beer Traders'; 
$beerFeeds    =  array(
                       'http://news.google.com/news?hl=en&gl=us&q=craft%20beer&um=1&ie=UTF-8&output=rss',
                       'http://www.bevindustry.com/rss/topic/2244-beer',
                       'https://mashing-in.com/feed/',
                       'https://news.google.com/news/rss/search/section/q/%22craft%20beer%22/%22craft%20beer%22?hl=en&gl=US&ned=us', 
                       'https://news.google.com/news/rss/search/section/q/AB%20Inbev%20Acquires/AB%20Inbev%20Acquires?hl=en&gl=US&ned=us', 
                       'https://news.google.com/news/rss/search/section/q/Beer%20Collaborations/Beer%20Collaborations?hl=en&gl=US&ned=us', 
                       'https://news.google.com/news/rss/search/section/q/Beer%20Companies%20Unite/Beer%20Companies%20Unite?hl=en&gl=US&ned=us', 
                       'https://news.google.com/news/rss/search/section/q/Beer%20Merger/Beer%20Merger?hl=en&gl=US&ned=us', 
                       'https://news.google.com/news/rss/search/section/q/Beer/Beer?hl=en&gl=US&ned=us',
                       'https://news.google.com/news/rss/search/section/q/KC%20%22Craft%20Beer%22/KC%20%22Craft%20Beer%22?hl=en&gl=US&ned=us',
                       'https://www.google.com/alerts/feeds/04852459464937538736/1277946705449884927'
                      );

$findString1 =  array('kansas city');
$findString2 =  array('beer');
$feedDays     =  30;

$start->createPosts($beerFeeds, $findString1, $findString2, $feedDays);

?>
