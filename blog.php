<?php
      include './php/HTFunctions.php';
      include('./php/class.bufferapp.php' );
      include('./php/header.php' );
?>
	

  </head>



  <body>


    <!-- Start Fixed navbar -->
 <nav id="LC-navbar" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div id="LC-navbar-header" class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#LC-navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a id="LC-navbar-brand" class="navbar-brand" href="<?php echo '.'.htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <img style="background-color:#ffffff;" src="./Pics/KCHopTalkLogo-172x172.png" alt="KC Hop Talk Beer News">    
                    <!-- <img src="./Pics/KCHopTalkLogo-172x172.jpg">     -->
                </a>
                <div class="navbar-name">KC Hop Talk</div>
                <div class="navbar-page">Beer News for Beer Nerds</div>
                <div class="navbar-page-tag">Where KC Hop Heads Find Current Craft Beer Information</div>
                
            </div>

            <div id="LC-navbar-collapse" class="collapse navbar-collapse">
                <ul id="LC-navbar-links" class="nav navbar-nav navbar-right">
                    <li><a href="./index.php">News</a></li>
                    <li><a href="./blog.php">Blog</a></li>
                    <li><a href="./kcbreweries.php">Breweries</a></li>
                    <li><a href="./calendar.php">Events</a></li>
                    <li><a href="./about.php">About</a></li> 
                    <!-- <li><a href="./contact.php">Contact Us</a></li> -->
                </ul>
            </div>
        </div>
    </nav> <!-- End Fixed navbar -->

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


    <footer class="footer" style="background-color:#AAA09D; text-align:center;">
      <div class="container">
        <p><?php CRDate2(); ?> </p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
