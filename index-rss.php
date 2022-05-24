<?php
			
include('./php/class.bufferapp.php' );
include('./php/indexClass.php');

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<rss version=\"2.0\">\n";

echo "<channel>\n";
echo "\t<title>KC Hop Talk</title>\n";
echo "\t<link>http://kchoptalk.com</link>\n";
echo "\t<description>KC Hop Talk is Beer News for Beer Nerds. Current Craft Beer News for Kansas City Hop Heads seeking information pertaining to Beer.</description>\n";

$debugger     =  ((!isset($_GET['debug']))  ? '' : htmlspecialchars($_GET['debug']));

$index        =  new beerIndexClass($debugger);

$buffer       =  new BufferPHP($index->buffer_id);
$data         =  array('profile_ids' => array());
$ret          =  $buffer->get('/profiles/'. $index->buffer_linkd .'/updates/sent', $data);  
$cur_day      =  '';
$postCounter  =  0;
$prevlink     =  '';

if (is_array($ret) || is_object($ret)) {
	foreach($ret as $key2=>$allLinkData) {
		if (is_array($allLinkData)) {
			$rssOutputText = "";
			foreach($allLinkData as $key3=>$value) {
						
				if ((strrpos($value['text'], 'https://') != 0 ) || (strrpos($value['text'], 'http://') != 0 ) ) { 
					$link    = htmlspecialchars( $value['media']["link"] ) ;
	                $PageTitle   = $value['media']['title'];
	                $hrefDesc    = $value['media']['description'];
	                $hrefThumb   = $value['media']['thumbnail'];
                } else if ((strrpos($value['text'], 'https://') == 0 ) && (strrpos($value['text'], 'http://') == 0 ) ) { 
					$link    = htmlspecialchars( $value['media']["link"] ) ;
	                $PageTitle   = $value['text'];
	                $hrefTitle   = ($value['media']['title'] == '404' ? '' : $value['media']['title']);
	                $hrefDesc    = ($value['media']['title'] == '404' ? '' : $value['media']['description']);
	                $hrefThumb   = $value['media']['thumbnail'];
                } 
				
				if ( ($link) && ($PageTitle) && ($hrefDesc) && ($PageTitle != 'null') && ($hrefDesc != 'null') && ($link !== $prevlink) && (!strpos($rssOutputText, $link) ) ) {
					$rssOutputText .= "\t<item>\n";
					$rssOutputText .= "\t\t<title>".trim(htmlspecialchars($PageTitle))."</title>\n";
					$rssOutputText .= "\t\t<description>".htmlspecialchars(trim($hrefDesc))."</description>\n";
					$rssOutputText .= "\t\t<link>".trim(htmlspecialchars($link)). "</link>\n";
					$rssOutputText .= "\t</item>\n";
				    $prevlink = $link;
				}									
			}
			echo $rssOutputText;
		}
	}
}

echo "\n</channel>\n";
echo "</rss>\n";

?>