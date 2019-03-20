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
                    <img style="background-color:#ffffff;" src="./Pics/KCHopTalkLogo-172x172.png">    
                    <!-- <img src="./Pics/KCHopTalkLogo-172x172.jpg">     --> 
                </a>
                <div class="navbar-name">KC Hop Talk</div>
                <div class="navbar-page">KC Beer Events</div>
                <!-- <div class="navbar-page-tag"></div> -->
                
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

        <div class="col-xs-12 " >
            <div id="event2-id" align="center">
                <iframe src="./HTML/Cal2.html" style="border-width:0" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
            </div>    
            <div id="event1-id" align="center">
	            <iframe src="./HTML/Cal1.html" style=" border-width:0 " width="992" height="650" frameborder="0" scrolling="no"></iframe>
                <br/>
                <b style="font-size:22px;">Don't see your event? <br>Send an email with details on your beer event to: 
                <a style="text-decoration:none" href=" <?php emailAddressEncode('calendar@kchoptalk.com'); ?> ?subject=Kansas City Hop Talk Calendar Listing">&#99;&#97;&#108;&#101;&#110;&#100;&#97;&#114;&#64;&#107;&#99;&#104;&#111;&#112;&#116;&#97;&#108;&#107;&#46;&#99;&#111;&#109;</a>
                </b>
    						
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
