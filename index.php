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

        <?php
        echo "\n";
        $buffer = new BufferPHP('1/e14fca3551b6db62983a5863a493294e');

        $data = array('profile_ids' => array());

        $ret = $buffer->get('/profiles/526d4a13e350edfd4e0001c9/updates/sent', $data);

        $cur_day = '';
        $prv     = '';

        $postCounter = 0;
        $linkIgnore = array(); // Need to add logic to read in listing from json file. Maybe add a function call here.

        if (is_array($ret) || is_object($ret))
        {
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
                  if ($key3 == "text")
                  {
                    $valu2 = str_replace('.@', '', $value);

                    if (strrpos($value, 'https://') > 0 ) {
                      $hrefLink    = htmlspecialchars( substr($value, strrpos($value, 'https://'), strlen($value)-strrpos($value, 'https://') ) ) ;
                      $headline    = substr($value, 0, strrpos($value, 'https://') );
                      // $outputKey[$postCounter]['link'] = "<a href=\"".$hrefLink. "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'https://') )."</strong></a>";
                    }
                    else if (strrpos($value, 'http://') > 0 ) {
                      $hrefLink    = htmlspecialchars( substr($value, strrpos($value, 'http://'),  strlen($value)-strrpos($value, 'http://' ) ) ) ;
                      $headline    = substr($value, 0, strrpos($value, 'http://' ) );
                      // $outputKey[$postCounter]['link'] = "<a href=\"".$hrefLink. "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'http://') )."</strong></a>";
                    }

                    if (!linkfilter($hrefLink)) {
                      // $outputKey[$postCounter]['link'] = "<a href=\"".$hrefLink. "\"  target=\"_blank\"><strong>".$headline."</strong></a>";

                      // $linkcoded = base64_encode(urlencode($hrefLink));
                      // $TitleCoded = base64_encode(urlencode($headline));
                      $linkcoded  = urlencode($hrefLink);
                      $TitleCoded = urlencode($headline);
                      
                      $outputKey[$postCounter]['link'] = "<a href=\"./post.php?l=".$linkcoded."&t=".htmlspecialchars($TitleCoded)."\" target=\"_blank\"><strong>".$headline."</strong></a>";

                    }

                    // if (strrpos($value, 'https://') > 0 ) {
                    //   $outputKey[$postCounter]['link'] = "<a href=\"".substr($value, strrpos($value, 'https://'), strlen($value)-strrpos($value, 'https://') ). "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'https://') )."</strong></a>";
                    // }
                    // else {
                    //   $outputKey[$postCounter]['link'] = "<a href=\"".substr($value, strrpos($value, 'http://'), strlen($value)-strrpos($value, 'http://') ). "\"  target=\"_blank\"><strong>".substr($value, 0, strrpos($value, 'http://') )."</strong></a>";
                    // }

                  }
                  // $outKey = array_unique($outputKey);

                  if (($postCounter <= 30) && ($key3 == "text_formatted") && ($prv != $outputKey[$postCounter]['link']))
                  // if ( ($postCounter < 30) && (!linkfilter($hrefLink)) )
                  {
                    echo "\t<div class=\"blog-post\">";
                      echo $outputKey[$postCounter]['link'];
                    echo "</div>\n";
                    $prv = $outputKey[$postCounter]['link'];
                    ++$postCounter;
                  }
                }
                // ++$postCounter;
              }
            }
          }
        }
        ?>
        </div><!-- /.blog-main -->

<!--         <div id="advert-id" class="sidebar-module">
            <a href="./fest/springfling.html"  id="fb"><img src="./fest/springfling/springfling-logo.jpg" alt="Spring Fling Beer Festival" align="left" style="padding-right:10px;" height="250" width="250" ></a>
        </div>   -->
        <div class="col-sm-4 col-md-4 blog-sidebar">

          <div class="sidebar-module sidebar-module-inset"  style="background-color:#ffffff;">

            <div id="calendar-id" class="sidebar-module" style="background-color:#E9E9E9;">
            <h3 id="calHeader">What's on Tap</h3>
                <iframe src="./HTML/Cal2.html" style=" border-width:0 " width=100% height="300" frameborder="0" scrolling="no"></iframe>  
            </div>          
            
            <div class="sidebar-module" style="background-color:#F5F6CE;">
              <h3 id="popPost">Popular Posts</h3>
              <ol class="list-unstyled">
                <?php
                    if (is_array($outputKey)) { rsort($outputKey); }
                    for($x=0;$x<10;$x++)
                    {
                      echo "\t<div class=\"blog-post\">";
                        echo $outputKey[$x]['link'];
                      echo "</div>\n";
                    }
                ?> 
              </ol>
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
