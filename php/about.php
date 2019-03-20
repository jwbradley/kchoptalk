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

                <a id="LC-navbar-brand" class="navbar-brand" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <img src="./Pics/KCHopTalkLogo-172x172.jpg">    
                </a>
                <div class="navbar-name">KC Hop Talk</div>
                <div class="navbar-page">KC Beer Events</div>
                <!-- <div class="navbar-page-tag"></div> -->
                
            </div>

            <div id="LC-navbar-collapse" class="collapse navbar-collapse">
                <ul id="LC-navbar-links" class="nav navbar-nav navbar-right">
                    <li><a href="./index.php">News</a></li>
                    <li><a href="./kcbreweries.php">Breweries</a></li>
                    <li><a href="./calendar.php">Events</a></li> 
                    <li><a href="./php/about.php">About</a></li>
                    <!-- <li><a href="../contact/">Contact Us</a></li> -->
                </ul>
            </div>
        </div>
    </nav> <!-- End Fixed navbar -->

    <div class="container" id="main">
      <div class="row">

        <div class="col-xs-12 " >
            <div id="event1-id" align="center">
	            <h1>About KC Hop Talk</h1>
                <p>KC Hop Talk wants keep beer fans informed about all things related to craft beer in Kansas City. This is done through constant monitoring of various blogs, social media and news sites for articles on craft beer and how craft brewing relates to the Beer Enthusiasts in Kansas City Craft. Kansas City Hop Talk is dedicated to delivering the most up-to-date information about news and events relating to “Craft Beer” in the Kansas City Community. This is a daily process setup to gather stories and place the content on the internet in an easy to use format.</p>
    						
    		</div>
        </div><!-- /.blog-main -->

        
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
