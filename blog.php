<?php
    ini_set("error_log", "./logs/BeerErrors.log");
    include './php/HTFunctions.php';
    include('./php/class.bufferapp.php' );
    include('./php/header.php' );
    include('./php/kc_class.php');

    echo "\n</head>\n<body>\n";

    $cur_page = '.' . htmlspecialchars($_SERVER["PHP_SELF"]);
    $pageDetails = new kcbeerclass();
    $pageDetails->menu_bar("Hop Talk Beer Blog", "Just a few beer stories we wanted to write about", $cur_page);

?>

    <div class="container" id="main">
      <div class="row">
        <div class="col-sm-8 col-md-8 blog-main" >
  
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2018/01/start-year-with-selection-of-99-beers_12.html" target="_blank"><strong>Start the Year with a Selection of 99 Beers</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2017/11/review-of-hopcat-wood-wild-ales-event.html" target="_blank"><strong>Review of the HopCat Wood &#38; Wild Ales Event</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2017/10/growler-filling-stations-have-arrived.html" target="_blank"><strong>Growler Filling Stations Have Arrived in the Northland!</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2017/09/houlihans-lunch-bar.html" target="_blank"><strong>Houlihan's Lunch Bar</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2017/07/hip-hops-hooray-beer-fest.html" target="_blank"><strong>Hip Hops Hooray Beer Fest</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2016/10/kansas-citys-oktoberfest-live-presented.html" target="_blank"><strong>Kansas City's Oktoberfest Live! presented by Leinenkugel's KC</strong></a></div>
          <div class="blog-post"><a href="http://beernews.kchoptalk.com/2016/08/barley-hops-craft-candles.html" target="_blank"><strong>Barley &#38; Hops Craft Candles</strong></a></div>
          <div class="blog-post"><a href="http://thewanderinggourmand.com/vanilla-ice-cream-pairing/" target="_blank"><strong>Beer vs Wine – What's Your Perfect Vanilla Ice Cream Pairing?</strong></a></div>
  
        </div><!-- /.blog-main -->
        <div class="col-sm-4 col-md-4 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset"  style="background-color:#ffffff;">
            <div id="calendar-id" class="sidebar-module" style="background-color:#E9E9E9;">
            <h3 id="calHeader">What's on Tap</h3>
                <iframe src="./HTML/Cal2.html" style=" border-width:0 " width=100% height="300" frameborder="0" scrolling="no"></iframe>  
            </div>          
        </div><!-- /.sidebar-module sidebar-module-inset -->
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div>


<?php

  $pageDetails->page_footer();

?>