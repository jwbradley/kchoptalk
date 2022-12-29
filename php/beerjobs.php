<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass('', $debugger);

$jsonOut     =  beerFeedClass::beerJobTags;
$feedTag     =  '/tag/a005d466-a174-46a1-8322-59167c04b8d0'; 
$feedCount   =  250;
$feedDays    =  0;

$curl        =  $start->getFeedly($start->feedlyStreamURL($feedTag, $feedCount, $feedDays));
$curl_feed   =  curl_exec($curl);
$mycoder     =  json_decode($curl_feed, true);

// // echo "\n<!-- We're dumping ===  \$curl_feed\n";
// // var_dump($curl_feed);
// // echo "\nEND dumping ===  \$curl_feed -->\n";

echo "\n<!-- We're dumping ===  \$mycoder[\"continuation\"]\n";
var_dump($mycoder["continuation"]);
echo "\nEND dumping ===  \$mycoder[\"continuation\"] -->\n";

echo "\n<!-- We're dumping ===  \$mycoder\n";
var_dump($mycoder);
echo "\nEND dumping ===  \$mycoder -->\n";


$start->jsonOutput($jsonOut, $start->arrayBuilder($mycoder));

curl_close($curl);

?>