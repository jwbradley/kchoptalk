<?php

ini_set("error_log", "../logs/BeerErrors.log");

require './feedsClass.php';

$debugger    =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));
$start       =  new beerFeedClass("", $debugger);

$response    =  $start->refreshFeedlyToken();

if($response) {
	echo "<h1>Token Refreshed</h1>\n";
} else {
	echo "<h1>Issues With Token Refresh</h1>\n";
}

?>