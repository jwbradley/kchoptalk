<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedTag      =  'f02777b6-1cd8-4176-928e-e513fc36dca7'; 
$findReviews  =  array('cooking with beer', 'cooked in beer'); 
$feedDays     =  30;
$start        =  new beerFeedClass('', $debugger);

$start->bulkTagFeedArticles($findReviews, $feedTag);

?>
