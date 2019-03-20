<?php
			include './php/HTFunctions.php';
			include('./php/class.bufferapp.php' );
			

			
// echo '<META HTTP-EQUIV="refresh" CONTENT="1800">';

echo "<?xml version=\"1.0\"?>\n";
echo "<rss version=\"2.0\"  xmlns:atom=\"http://www.w3.org/2005/Atom\" >\n";
echo "<channel>\n\t<atom:link href=\"http://kchoptalk.com/index-rss.php\" rel=\"self\" type=\"application/rss+xml\" />\n";

echo "\t<title>KC Hop Talk</title>\n";
echo "\t<description>KC Hop Talk is Beer News for Beer Nerds. Current Craft Beer News for Kansas City Hop Heads seeking information pertaining to Beer.</description>\n";
echo "\t<link>http://kchoptalk.com</link>\n";

			
$buffer = new BufferPHP('1/e14fca3551b6db62983a5863a493294e');

$data = array('profile_ids' => array());

$ret = $buffer->get('/profiles/526d4a13e350edfd4e0001c9/updates/sent', $data);

$cur_day = '';

$postCounter = 0;


if (is_array($ret) || is_object($ret))
{
	foreach($ret as $key=>$row) 
	{
		if (is_array($row) || is_object($row))
		{
			foreach($row as $key2=>$column)
			{
				foreach($column as $key3=>$value)
				{
					if ($key3 == "text")
					{
						if(strrpos($value, 'https://') >0 ) {
							$link      =  htmlspecialchars( substr($value, strrpos($value, 'https://'), strlen($value)-strrpos($value, 'https://') ) ) ;
							$PageTitle =  trim(htmlspecialchars( substr($value, 0, strrpos($value, 'https://') ) ) ) ;
						} elseif (strrpos($value, 'http://') >0 ) {
							$link      =  htmlspecialchars( substr($value, strrpos($value, 'http://'), strlen($value)-strrpos($value, 'http://') ) ) ;
							$PageTitle =  trim(htmlspecialchars( substr($value, 0, strrpos($value, 'http://' ) ) ) ) ;
						} else {
							$link      = '';
							$PageTitle = '';
						}

						if( ($link) && (!linkfilter($link) ) ) {
                    	// if($link)  {
							echo "\t<item>\n";
							echo "\t\t<title>".$PageTitle."</title>\n";
							echo "\t\t<description>".$PageTitle."</description>\n";
							echo "\t\t<link>".trim($link). "</link>\n";
							echo "\t</item>\n";
						}									
					}
				}
			}
		}
	}
}

echo "\n</channel>\n";
echo "</rss>\n";



?>


