<?php
			
			include('./php/class.bufferapp.php' );
			

// header('Content-Type: text/xml');

// echo '<META HTTP-EQUIV="refresh" CONTENT="1800">';

/* echo "<?xml version=\"1.0\"?>\n";  */
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<rss version=\"2.0\">\n";
// <feed xmlns=\"http://www.w3.org/2005/Atom\">\n";
// echo "<channel>\n\t<atom:link href=\"http://kchoptalk.com/index-rss.php\" rel=\"self\" type=\"application/atom+xml\" />\n";
echo "<channel>\n";
echo "\t<title>KC Hop Talk</title>\n";
echo "\t<link>http://kchoptalk.com</link>\n";
echo "\t<description>KC Hop Talk is Beer News for Beer Nerds. Current Craft Beer News for Kansas City Hop Heads seeking information pertaining to Beer.</description>\n";
// echo "\n\t<link rel=\"self\" href=\"http://kchoptalk.com/index-rss.php\" />\n";

// echo "\t<subtitle>KC Hop Talk is Beer News for Beer Nerds. Current Craft Beer News for Kansas City Hop Heads seeking information pertaining to Beer.</subtitle>\n";
// echo "\t<link href=\"http://kchoptalk.com\"/>\n";
// echo "\t<author>\n\t\t<name>KC Hop Talk</name>\n\t</author>\n";
// echo "\t<id>http://kchoptalk.com/</id>\n";
// echo "\t<updated>".date("Y-m-d\Th:i:sP")."</updated>\n";

$debugger     =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

$buffer       =  new BufferPHP('2/ebcb260331971a34d60620edfa2d59ebaa1a82fc58b76b7c0b53ac678c288706cc41fc341f9047408f147d98d2d4c708247f9a4e824492eccc76896d72cb8e77');
$data         =  array('profile_ids' => array());
$ret          =  $buffer->get('/profiles/556f027e4fac11e854f04916/updates/sent', $data);
$cur_day      =  '';
$postCounter  =  0;
$prevlink      =  '';

if (is_array($ret) || is_object($ret))
{
	foreach($ret as $key2=>$allLinkData)
	{
		if (is_array($allLinkData))
		{
			$rssOutputText = "";
			foreach($allLinkData as $key3=>$value)
			{
				// echo "\n<!-- this \$key3 is $key3 with \$value -- ";
				// var_dump($value);
				// echo "  -->\n";
				// if(strrpos($value, 'https://') >0 ) {
				// 	echo "\n<!-- if loop nest 1 -->\n ";
				// 	$link      =  htmlspecialchars( substr($value['text'], strrpos($value['text'], 'https://'), strlen($value['text'])-strrpos($value['text'], 'https://') ) ) ;
				// 	$PageTitle =  substr($value['text'], 0, strrpos($value['text'], 'https://') );                  
				// } elseif (strrpos($value, 'http://') >0 ) {
				// 	echo "\n<!-- if loop nest 2 -->\n ";
				// 	$link    = htmlspecialchars( substr($value['text'], strrpos($value['text'], 'http://'),  strlen($value['text'])-strrpos($value['text'], 'http://' ) ) ) ;
    //                 $PageTitle    = substr($value['text'], 0, strrpos($value['text'], 'http://' ) );
          
				
				if ((strrpos($value['text'], 'https://') != 0 ) || (strrpos($value['text'], 'http://') != 0 ) ) { 
					  // echo "\n<!-- if loop nest 2 -->\n ";
	                  $link    = htmlspecialchars( $value['media']["link"] ) ;
	                  $PageTitle   = $value['media']['title'];
	                  $hrefDesc    = $value['media']['description'];
	                  $hrefThumb   = $value['media']['thumbnail'];
                } else if ((strrpos($value['text'], 'https://') == 0 ) && (strrpos($value['text'], 'http://') == 0 ) ) { 
					  // echo "\n<!-- if loop nest 3 -->\n ";
	                  $link    = htmlspecialchars( $value['media']["link"] ) ;
	                  $PageTitle   = $value['text'];
	                  $hrefTitle   = ($value['media']['title'] == '404' ? '' : $value['media']['title']);
	                  $hrefDesc    = ($value['media']['title'] == '404' ? '' : $value['media']['description']);
	                  $hrefThumb   = $value['media']['thumbnail'];
                } 
				// if ( ($link) && ($link !== $prevlink) ) {
				// if ( ($link) && ($link !== $prevlink) && (!array_search($link, array_column($people, 'fav_color')) ) ) {
				if ( ($link) && ($PageTitle) && ($hrefDesc) && ($PageTitle != 'null') && ($hrefDesc != 'null') && ($link !== $prevlink) && (!strpos($rssOutputText, $link) ) ) {
					$rssOutputText .= "\t<item>\n";
					$rssOutputText .= "\t\t<title>".trim(htmlspecialchars($PageTitle))."</title>\n";
					$rssOutputText .= "\t\t<description>".htmlspecialchars(trim($hrefDesc))."</description>\n";
					$rssOutputText .= "\t\t<link>".trim(htmlspecialchars($link)). "</link>\n";
					$rssOutputText .= "\t</item>\n";
					// echo "\t<item>\n";
					// echo "\t\t<title>".trim(htmlspecialchars($PageTitle))."</title>\n";
					// echo "\t\t<description>".htmlspecialchars(trim($hrefDesc))."</description>\n";
					// echo "\t\t<link>".trim(htmlspecialchars($link)). "</link>\n";
					// echo "\t</item>\n";
					$prevlink = $link;
				}									
			}
			echo $rssOutputText;
		}
	}
}

echo "\n</channel>\n";
echo "</rss>\n";



// if($debugger) {
// 	echo "\n<!-- this is the return from buffer -- ";
// 	var_dump($ret);
// 	echo "  -->\n";
// }

?>