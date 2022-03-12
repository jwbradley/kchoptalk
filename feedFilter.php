<?php

ini_set("error_log", "../logs/BeerErrors.log");
require './feedsClass.php';

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$feedDays     =  30;
$key_words    =  array(
                       ' ale ', 
                       ' ales ', 
                       ' gins ', 
                       ' gin ', 
                       ' rum ', 
                       ' rums ', 
                       ' tap', 
                       '6 pack', 
                       '6-pack', 
                       'bar', 
                       'barley', 
                       'barrel', 
                       'beer', 
                       'booze', 
                       'bottle',
                       'bourbon', 
                       'brew', 
                       'bud', 
                       'cask', 
                       'cellar', 
                       'cider', 
                       'distill', 
                       'hop', 
                       'ipa', 
                       'keg', 
                       'lager', 
                       'malt', 
                       'market', 
                       'mead', 
                       'Octoberfest', 
                       'Oktoberfest', 
                       'pilsner', 
                       'pub', 
                       'seltzer', 
                       'spirits', 
                       'stout', 
                       'whiskey', 
                       'wine', 
                       'wort', 
                       'yeast'
                       );
$start        =  new beerFeedClass("", $debugger);

$start->filterFeedArticles($key_words); 

?>
