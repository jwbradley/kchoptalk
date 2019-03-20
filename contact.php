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
                <div class="navbar-page">Contact Us</div>
                <!-- <div class="navbar-page-tag"></div> -->
                
            </div>

            <div id="LC-navbar-collapse" class="collapse navbar-collapse">
                <ul id="LC-navbar-links" class="nav navbar-nav navbar-right">
                    <li><a href="./index.php">News</a></li>
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
            <div id="event1-id" align="left">
                <form class="form-horizontal">

                <fieldset>

                 

                <!-- Form Name -->

                <legend>Contact KC Hop Talk</legend>

                 

                <!-- Text input-->

                <div class="form-group">

                  <label class="col-md-4 control-label" for="textinput">Your Name</label> 

                  <div class="col-md-4">

                  <input id="textinput" name="textinput" type="text" placeholder="John Doe" class="form-control input-md" required="">

                   

                  </div>

                </div>

                 

                <!-- Text input-->

                <div class="form-group">

                  <label class="col-md-4 control-label" for="textinput">Email Address</label> 

                  <div class="col-md-4">

                  <input id="textinput" name="textinput" type="text" placeholder="you@yourdomain.com" class="form-control input-md" required="">

                  <span class="help-block">Enter your email address</span> 

                  </div>

                </div>

                 

                <!-- Textarea -->

                <div class="form-group">

                  <label class="col-md-4 control-label" for="textarea">Your Message</label>

                  <div class="col-md-4">                    

                    <textarea class="form-control" id="textarea" name="textarea">Message Text Here.</textarea>

                  </div>

                </div>

                 

                <!-- Button -->

                <div class="form-group">

                  <label class="col-md-4 control-label" for="singlebutton"></label>

                  <div class="col-md-4">

                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Send</button>

                  </div>

                </div>

                 

                </fieldset>

                </form>
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
