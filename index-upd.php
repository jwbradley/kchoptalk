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
	a:link {
	    text-decoration: none;
	    color:black;
	}

	a:visited {
	    text-decoration: none;
	    color:black;
	}

	a:hover {
	    text-decoration: underline;
	}

	a:active {
	    text-decoration: underline;
	}
	hr {
	    color: #000;
     	background: #000; 
	    width: 90%; 
	    height: 2px;
	}
</style>
<link href='http://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet' type='text/css'>
</head>  
<body>
<?php
			include('./php/menu.php' );
			
?>


<table width="100%" > 
<tr   > 

<td width="20%" valign="top">
	<iframe src="https://www.google.com/calendar/embed?title=KC%20Beer%20Events&amp;showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=300&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=kchoptalk%40gmail.com&amp;color=%232F6309&amp;ctz=America%2FChicago" style=" border-width:0 " width="275" height="300" frameborder="0" scrolling="no"></iframe>	
</td>
<td align="left" width="60%" valign="top">

<div class="text_Box">
<li class="indent1">  
<?php
$buffer = new BufferPHP('1/e14fca3551b6db62983a5863a493294e');

$data = array('profile_ids' => array());

$ret = $buffer->get('/profiles/526d4a13e350edfd4e0001c9/updates/sent', $data);

$cur_day = '';
echo '<h1 align="center">Beer News for Beer Nerds</h1>';
echo '<h3 align="center">Current Craft Beer News for Kansas City Hop Heads seeking information pertaining to Beer.</h3><hr>';
$postCounter = 0;

foreach($ret as $key=>$row) 
{
	// echo "\n<!-- this is the \$row details and the \$postCounter is {$postCounter} -- ";
	// var_dump($row);
	// echo "  -->\n";
	if (is_array($row))
	{
		foreach($row as $key2=>$column)
		{
			foreach($column as $key3=>$value)
			{
				if ($key3 == "statistics")
				{
					$outputKey[$postCounter]['rank'] =  ($value['retweets']*20) + ($value['reach']) + ($value['clicks']*15) + ($value['favorites']*10) + ($value['mentions']*5);
				}
				// if ($key3 == "text_formatted")
				if ($key3 == "text")
				{
					$valu2 = str_replace('.@', '', $value);
					// $valu3 = str_replace('<a class=', '</strong><br><a class=', $valu2);
					// $outputKey[$postCounter]['link'] = "<p id=\"{$key3}\"><strong>" . $valu3 ."</p>\n";

					// $outputKey[$postCounter]['link'] = "<p><a href=\"".substr($value, strrpos($value, 'http://l.kchoptalk.com/'), strlen($value)-strrpos($value, 'http://l.kchoptalk.com/') ). "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'http://l.kchoptalk.com/') )."</strong></a></p>";

					if (strrpos($value, 'https://') > 0 ) {
						$outputKey[$postCounter]['link'] = "<p><a href=\"".substr($value, strrpos($value, 'https://'), strlen($value)-strrpos($value, 'https://') ). "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'https://') )."</strong></a></p>";	
					}
					else {
						$outputKey[$postCounter]['link'] = "<p><a href=\"".substr($value, strrpos($value, 'http://'), strlen($value)-strrpos($value, 'http://') ). "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'http://') )."</strong></a></p>";
					}

				}
				if (($postCounter < 30) && ($key3 == "text_formatted"))
				{
					// if (substr($outputKey[$postCounter]['link'], 0, 41) != '<b>Warning</b>: Invalid argument supplied')
					// {
						// echo "\n<!-- ".substr($outputKey[$postCounter]['link'], 0, 41)." -->\n";
						echo $outputKey[$postCounter]['link'];
					// }
				}
			}
			++$postCounter;
			// echo "\n";
		}
	}
}



?>
</li>
<br>
</div>

<br><br><br>


</td>
<td width="20%" valign="top">

	<div class="text_Box" style="background-color:#F5F6CE;">

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