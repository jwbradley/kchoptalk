<?php
			include './php/HTFunctions.php';
			include('./php/header.php' );
?>
</head>  
<body>
<?php
			include('./php/menu.php' );
			
?>




<table width="100%"> 
<tr valign=top  > 

<td width="2%"><br /><br />
	
<td align="left" width="75%">

<div class="text_Box">
<li class="indent1">  
<?php

$url  = "http://news.google.com/news?hl=en&gl=us&q=%22Kansas+City%22+Beer&um=1&ie=UTF-8&output=rss";
$rss = simplexml_load_file($url);

if($rss)
{
	echo '<h1 align="center">Kansas City Beer News</h1>';
	echo '<h3>KC Hop Talk is constantly looking out for news and information related to craft beers and craft brewing that directly impacts the Kansas City Craft Beer Consumers.</h3>';
	echo $rss->channel->pubDate."<br />\n";

	$beerNews = $rss->channel->item;
	foreach($beerNews as $article)
	{
		$title = $article->title;
		$link = $article->link;
		$published_on = $article->pubDate;
		$description = $article->description;
		// echo '<h3><a href="'.$link.'">'.$title."</a></h3><br />\n";
		// echo '<span>('.$published_on.")</span><br />\n";
		echo '<p>'.$description."</p>\n";
	}
}

?>
</li>
</div>


</td>

</td>
<td width="23%" valign=top>
	<a class="twitter-timeline" href="https://twitter.com/KCHopTalk" data-widget-id="330758631001825282">Tweets by @KCHopTalk</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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