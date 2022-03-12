<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'ab6e7b8f-4ec9-49b4-9775-233c17e1e74e'; 
$findReviews  =  array('video tip:', 'how to brew', 'tips for brew', 'tips & tricks', 'tips and tricks', 'homebrewing tip', 'how to make', 'how to get', 'grow your own'); 
$feedDays     =  30;
$start        =  new beerFeedClass('', $debugger);

$start->bulkTagFeedArticles($findReviews, $feedTag);

?>
