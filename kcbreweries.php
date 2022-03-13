<?php
    ini_set("error_log", "./logs/BeerErrors.log");
	
	include('./php/header.php' );
    include('./php/kc_class.php');
?>

	<meta http-equiv="refresh" content="0; URL='./index.php'" />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
	<link href='https://fonts.googleapis.com/css?family=Sigmar+One|Raleway|Comfortaa' rel='stylesheet' type='text/css'>

	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>

    <style>
      #brewery { font-family: 'Comfortaa', cursive; font-weight: normal; }
      .mapper { font-family: 'Sigmar One', cursive; font-weight: 400; color:red; }
      #sep { font-family: 'Raleway', cursive; font-weight: normal; color:blue; }
      .small { line-height: 90%; }
	  #yr { display: none; }

    </style>
</head>  
<body>
<?php
    
    $cur_page = '.' . htmlspecialchars($_SERVER["PHP_SELF"]);
    $pageDetails = new kcbeerclass();
    $pageDetails->menu_bar("Kansas City Breweries", "", $cur_page);

?>


    <div class="container" >
    	<div class="row">
	        <div id="map-id" class="col-sm-3 col-md-3 col-lg-3" >
				<div data-role="content" data-theme="d">	

					<p class="small"><span id="yr">1989</span><span class="mapper">A</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Boulevard Brewing Company</span></p>
					<p class="small"><span id="yr">1989</span><span class="mapper">B</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Free State Brewery</span></p>
					<p class="small"><span id="yr">1989</span><span class="mapper">C</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">23<sup>rd</sup> Street Brewery</span></p>
			   <!-- <p class="small"><span id="yr">1993</span><span class="mapper">D</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">75<SUP>th</SUP> Street Brewing</span></p> -->
					<p class="small"><span id="yr">1995</span><span class="mapper">E</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Blind Tiger Brewery &#38; Restaurant</span></p>
					<p class="small"><span id="yr">1995</span><span class="mapper">F</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Little Apple Brewing Company</span></p>
					<p class="small"><span id="yr">1995</span><span class="mapper">G</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Barley's Brewhaus</span></p>
					<p class="small"><span id="yr">1997</span><span class="mapper">H</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">McCoy's Public House</span></p>
					<p class="small"><span id="yr">1999</span><span class="mapper">I</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Gordon Biersch</span></p>
					<p class="small"><span id="yr">1999</span><span class="mapper">J</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Granite City</span></p>
					<p class="small"><span id="yr">2001</span><span class="mapper">K</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Amerisports Bar &#38; Grill</span></p>
					<p class="small"><span id="yr">2005</span><span class="mapper">L</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Weston Brewing Company</span></p>
					<p class="small"><span id="yr">2006</span><span class="mapper">M</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Tallgrass Brewing Company</span></p>
					<p class="small"><span id="yr">2011</span><span class="mapper">N</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Martin City Brewing Company</span></p>
					<p class="small"><span id="yr">2012</span><span class="mapper">O</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">The Big Rip Brewery</span></p>
					<p class="small"><span id="yr">2012</span><span class="mapper">P</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Green Room Burgers &#38; Beer</span></p>
					<p class="small"><span id="yr">2013</span><span class="mapper">Q</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Cinder Block Brewery</span></p>
					<p class="small"><span id="yr">2013</span><span class="mapper">R</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Kansas City Bier Company</span></p>
					<p class="small"><span id="yr">2014</span><span class="mapper">S</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Rock &#38; Run Brewery</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">T</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Border Brewing Company</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">U</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Torn Label Brewing Co.</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">V</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Double Shift Brewing Company</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">W</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Red Crow Brewing Company</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">X</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Grinders High Noon</span></p>
					<p class="small"><span id="yr">2015</span><span class="mapper">Y</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Ninja Moose Brewery</span></p>
					<p class="small"><span id="yr">2016</span><span class="mapper">Z</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Crane Brewing</span></p>
					<p class="small"><span id="yr">2016</span><span class="mapper">1</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Stockyards Brewing Company</span></p>
					<p class="small"><span id="yr">2016</span><span class="mapper">2</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Miami Creek Brewing Company</span></p>
					<p class="small"><span id="yr">2016</span><span class="mapper">3</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery">Calibration Brewery</span></p>
			<!-- 	 		
					<p class="small"><span id="yr"></span><span class="mapper">4</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">5</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">6</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">7</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">8</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">9</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p>
					<p class="small"><span id="yr"></span><span class="mapper">0</span><span id="sep">&nbsp;&#8226;&nbsp;</span><span id="brewery"></span></p> -->

					<!-- <p><a href="#one" data-rel="back" data-role="button" data-inline="true" data-icon="back">Back to Beer List</a></p>	 -->
				</div><!-- /content -->
			</div>
			<div class="col-xs-12 col-md-9 col-lg-9">
				<div align="center">
					
					<!-- <div id="map" style="width: 100%; height: 800px"> -->
					<div id="map">
						<iframe width='100%' height='600px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/kchoptalk.e98e7fb8/attribution,zoompan,zoomwheel,geocoder.html?access_token=pk.eyJ1Ijoia2Nob3B0YWxrIiwiYSI6ImJjMGJjYzQ0MDdmYjUyOGIzY2U0MWIyOTZmMDdkYWM3In0.t8GUsJIaDlgN5DcXg4EnBA'></iframe>
					</div>
				</div>
		 	</div>
	 	</div> <!-- /.row -->
	</div>

<?php
  
  $pageDetails->page_footer();

?>