<?php
			include './php/HTFunctions.php';
			include('./php/class.bufferapp.php' );
			include('./php/header.php' );
			
?>
<META HTTP-EQUIV="refresh" CONTENT="1800">
<style type="text/css">
#footer_container 
{
	background:#eee; 
	border:3px solid #665; 
	bottom:0;
	height:45px; 
	left:0; 
	position: fixed;
	width: 100%;
}
</style>
<link href='http://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet' type='text/css'>
</head>  
<body>
<?php
			include('./php/menu.php' );
			
?>


<table width="100%"> 
<tr valign=top  > 

<td width="15%"><br /><br />
	
<td align="left" width="70%">

<div class="text_Box">
<li class="indent1">  
<?php
$buffer = new BufferPHP('1/e14fca3551b6db62983a5863a493294e');

$data = array('profile_ids' => array());

$ret = $buffer->get('/profiles/526d4a13e350edfd4e0001c9/updates/sent', $data);

$cur_day = '';
echo '<h1 align="center">Beer News for Beer Nerds</h1>';
echo '<h3 align="center">Kansas City Beer News for Hop Heads seeking information pertaining to Craft Beer.</h3>';
$postCounter = 0;

foreach($ret as $key=>$row) 
{
	foreach($row as $key2=>$column)
	{
		foreach($column as $key3=>$value)
		{
			if ($key3 == "statistics")
			{
				$outputKey[$postCounter]['rank'] =  ($value['retweets']*5) + ($value['reach']) + ($value['clicks']*10) + ($value['favorites']*3) + ($value['mentions']*2) ;
				// $outputKey[$postCounter] =  ($value['retweets']*5) + ($value['reach']) + ($value['clicks']*10) + ($value['favorites']*3) + ($value['mentions']*2) ;
				// $outputKey[][$key3] =  $postCounter;
			}
			if ($key3 == "text_formatted")
			{
				// if ($cur_day != $column['day'])
				// {
				// 	if ($column['day'] != 'Today') { echo "<br>"; }
				// 	echo "<h2><u>".$column['day']."</u></h2>\n";
					
				// 	$cur_day = $column['day'];
				// }
				$valu2 = str_replace('.@', '', $value);
				// $valu3 = str_replace('<a class=', '</strong><br><font size="2" color="grey"><a class=', $valu2);
				$valu3 = str_replace('<a class=', '</strong><br><a class=', $valu2);
				// echo  "<p id=\"{$key3}\"><strong>" . $valu3 .' - '.$column['due_time']."</font></p>";
				$outputKey[$postCounter]['link'] = "<p id=\"{$key3}\"><strong>" . $valu3 ."</p>\n";
			}
			if (($postCounter < 30) && ($key3 == "text_formatted"))
			{
				echo $outputKey[$postCounter]['link'];
			}
		}
		++$postCounter;
		echo "\n";
	}
}





// $url  = "http://news.google.com/news?hl=en&gl=us&q=%22Kansas+City%22+Beer&um=1&ie=UTF-8&output=rss";
// $rss = simplexml_load_file($url);


// if($rss)
// {
// 	echo $rss->channel->pubDate."<br />\n";

// 	$beerNews = $rss->channel->item;
// 	foreach($beerNews as $article)
// 	{
// 		$title = $article->title;
// 		$link = $article->link;
// 		$published_on = $article->pubDate;
// 		$description = $article->description;
// 		// echo '<h3><a href="'.$link.'">'.$title."</a></h3><br />\n";
// 		// echo '<span>('.$published_on.")</span><br />\n";
// 		echo '<p>'.$description."</p>\n";
// 	}
// }

?>
</li>
<br>
</div>

<br><br><br>
</td>

</td>
<td width="15%" valign=top>
	<div class="text_Box">
	<h1 align=center>Popular Posts</h1>
	<li class="indent4">  
		<?php
		     	rsort($outputKey);
				for($x=0;$x<10;$x++)
				{
					echo $outputKey[$x]['link'];
				}
		?> 
		<br>
	</li>
	</div>
     <!-- <a class="twitter-timeline" href="https://twitter.com/KCHopTalk" data-widget-id="330758631001825282">Tweets by @KCHopTalk</a>
	 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> -->
 </td>



</tr>
</table>

   <div id="footer_container">
   	<table class="footer">	
			<tbody>
				<tr>
					<td></td>
				   <td><?php CRDate2(); ?></td>
				   <td></td>
				</tr>
			</tbody>
		</table>
	</div>

</body>
</html>