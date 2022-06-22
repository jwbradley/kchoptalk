<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'a005d466-a174-46a1-8322-59167c04b8d0'; 
$findReviews  =  array('beer job listing'); 
$feedDays     =  14;
$start        =  new beerFeedClass('', $debugger);

$start->bulkTagFeedArticles($findReviews, $feedTag);

?>
