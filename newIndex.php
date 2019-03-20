<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../php/excel_reader2.php';

$data = new Spreadsheet_Excel_Reader("./hopfest/2014BeersList.xls");
?> 


<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>2014 KC Hop Fest</title> 
	
	<meta name="description" content="Kansas City's Waldo Area Presents the 2014 Hop Fest.  Between The Well and Lew's Grill & Bar.">
	<meta name="author" content="james" >
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	
	<meta property="og:title" content="2014 Kansas City Hop Fest"/>
	<meta property="og:url" content="http://kchoptalk.com/" />
	<meta property="og:image" content="http://kchoptalk.com/docs/hopfest/HFLogo.png"/>
	<meta property="og:image:secure_url" content="http://kchoptalk.com/docs/hopfest/HFLogo.png" />
	<meta property="og:site_name" content="2014 Hop Fest by KC Hop Talk"/>
	<meta property="og:description" content="Kansas City's Waldo Area Presents the 2014 Hop Fest.  Between The Well and Lew's Grill & Bar."/>
	
	
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="./hopfest/HFLogo-118x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./hopfest/HFLogo-94x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./hopfest/HFLogo-59x72.png">
	<link rel="apple-touch-icon-precomposed" href="./hopfest/HFLogo-47x57.png">
	<link rel="shortcut icon" href="http://kchoptalk.com/docs/hopfest/HFLogo.png">
	<link rel="image_src" href="http://kchoptalk.com/docs/hopfest/HFLogo.png"/>
	
	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="./hopfest/HFLogo-118x144.png">
	<meta name="msapplication-TileColor" content="#222222">
		
	
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
	
	<style type="text/css">a {text-decoration: none;}</style>

	<script>
  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  		ga('create', 'UA-37565453-3', 'kchoptalk.com');
  		ga('send', 'pageview');
	</script>
	
	<style>
		table.excel {
			border-style:ridge;
			border-width:1;
			border-collapse:collapse;
			font-family:sans-serif;
			font-size:12px;
		}
		table.excel thead th, table.excel tbody th {
			background:#CCCCCC;
			border-style:ridge;
			border-width:1;
			text-align: center;
			vertical-align:bottom;
		}
		table.excel tbody th {
			text-align:center;
			width:20px;
		}
		table.excel tbody td {
			vertical-align:bottom;
		}
		table.excel tbody td {
			padding: 0 3px;
			border: 1px solid #EEEEEE;
		}
	</style>
	
	<script language="javascript">
		document.onmousedown=disableselect;
		status="Right Click Disabled";
		Function disableclick(event)
		{
		  if(event.button==2)
		   {
			 alert(status);
			 return false;    
		   }
		}
	</script>
	
</head> 

	
<body oncontextmenu="return false">

<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>KC Hop Fest</h1>
	</div><!-- /header -->

	<div data-role="content" >	
	<table margin="0" style="width:100%">
		<tr>
			<td width="50%" align="left"><a href="#two" data-role="button" data-transition="slide" data-inline="true">Beer List</a></td>
			<td width="50%" align="right"><a href="#three" data-role="button" data-transition="slide" data-inline="true" >Schedule / Map</a></td>
		</tr>
	</table>
		<img src="./hopfest/HopFestPoster2014s4.jpg" alt="HopFest" height="80%" width="100%">
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="d">
		<h4><a href="http://kchoptalk.com" data-ajax="false">KC Hop Talk</a></h4>
	</div><!-- /footer -->
</div><!-- /page one -->


<!-- Start of second page: #two -->
<div data-role="page" id="two" data-theme="a">

	<div data-role="header">
		<h1>2014 Beer List</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="a">	
		<a href="#one" data-direction="reverse" data-rel="back" data-role="button" data-inline="true" data-icon="back" data-transition="slide">Hop Fest Flyer</a>
		<a href="#popup" data-role="button" data-rel="dialog" data-transition="pop" data-inline="true" >Rare Beer List</a>
		<h2>Complete Beer List</h2>
		<p><?php echo $data->dump(true,true); ?></p>	
		<h2>Yellow highlights indicate limited quantity beers</h2>
		<p><a href="#one" data-rel="back" data-role="button" data-inline="true" data-icon="back">Hop Fest Flyer</a></p>	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><a href="http://kchoptalk.com" data-ajax="false">KC Hop Talk</a></h4>
	</div><!-- /footer -->
</div><!-- /page two -->


<!-- Start of second page: #three -->
<div data-role="page" id="three" data-theme="a">

	<div data-role="header">
		<h1>Event Program</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="a">	
		<a href="#one" data-direction="reverse"  data-role="button" data-inline="true" data-icon="back" data-transition="slide">Hop Fest Flyer</a>
		<a href="#four" data-role="button" data-inline="true" data-transition="flip" data-inline="true" >Map</a>
		<img src="./hopfest/HopFestProgramFront2014.jpg" alt="Schedule" height="80%" width="100%">
		<p><a href="#one" data-direction="reverse"  data-role="button" data-inline="true" data-icon="back" data-transition="slide">Hop Fest Flyer</a></p>	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><a href="http://kchoptalk.com" data-ajax="false">KC Hop Talk</a></h4>
	</div><!-- /footer -->
</div><!-- /page three -->


<!-- Start of second page: #four -->
<div data-role="page" id="four" data-theme="a">

	<div data-role="header">
		<h1>Event Map</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="a">	
		<a href="#three" data-role="button" data-rel="dialog" data-transition="flip" data-direction="reverse" data-inline="true" data-icon="back">Schedule</a>
		<img src="./hopfest/HopFestProgramBack2014.jpg" alt="Schedule" height="80%" width="100%">
		<p><a href="#one" data-direction="reverse"  data-role="button" data-inline="true" data-transition="slide">Hop Fest Flyer</a></p>	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><a href="http://kchoptalk.com" data-ajax="false">KC Hop Talk</a></h4>
	</div><!-- /footer -->
</div><!-- /page four -->


<!-- Start of third page: #popup -->
<div data-role="page" id="popup">

	<div data-role="header" data-theme="e">
		<h1>2014 Limited Beers</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="d">	
		<h2>List of the rarest beers for Hopfest 2014</h2>
		<h3>Some of these have a very limited quantities, and if you are looking forward to sampling them you may want to pay the extra $15 for the VIP Ticket.</h3>
		
		<p>Ommegang Fire and Blood- Red Ale</p>
		<p>Stone Charred-Strong Ale aged in Bourbon Barrels</p>
		<p>Firestone Walker Sucaba-Barleywine</p>
		<p>Firestone Walker Parabola-Russian Imperial Stout</p>
		<p>Mothers Chong-West Coast IPA</p>
		<p>Mothers Chocolate Thunder-Chocolate Porter</p>
		<p>Boulevard Lemon Ginger Radler</p>
		<p>Big Sky Ivan the Terrible 2012 and 2013 Vintage-Bourbon Barrel Aged Imperial Stout</p>
		<p>Sante Fe Los Innavadores-Bourbon Barrel aged Sour</p>
		<p>Sante Fe Bourbon Barrel Aged Java Imperial Stout</p>
		<p>Lagunitas Waldo Special-Double Imperial IPA</p>
		<p>Founders KBS-Bourbon Barrel Aged Imperial Stout</p>
		<p>Goose Island Bourbon County Stout</p>
		<p>Deschutes Class of ’88-Barleywine collaboration with Goose Island</p>
		<p>New Belgium La Folie-Sour Brown Ale</p>
		<p>Bell’s Hopslam-Double Imperial IPA</p>
		<p>Avery Rumpkin</p>

		<h4>These are all beers that either have limited and super allocated releases in the Kansas City Market or are available only at festivals. &nbsp;The two beers from Mothers are only available in their tasting room at the brewery. &nbsp;Obviously the Game of Thrones beer is a hot commodity.    </h4>	

		<p><a href="#one" data-rel="back" data-role="button" data-inline="true" data-icon="back">Back to Beer List</a></p>	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4><a href="http://kchoptalk.com" data-ajax="false">KC Hop Talk</a></h4>
	</div><!-- /footer -->
</div><!-- /page popup -->

</body>
</html>
