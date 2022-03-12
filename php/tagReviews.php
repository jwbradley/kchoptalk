<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'dfe5658f-a44e-4ad8-8c25-eea30e3ba504'; 
$findReviews  =  array('beer review:', 'brew review:', 'reviewed:', 'best american craft beer', 'best beer', 'best american craft stout', 'best american craft ale', 'best sour beer', 'best american craft lager', 'best craft beer', 'best craft brewer'); 
$feedDays     =  30;
$start        =  new beerFeedClass('', $debugger);

$start->bulkTagFeedArticles($findReviews, $feedTag);

?>
