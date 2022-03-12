<?php
    ini_set("error_log", "./logs/BeerErrors.log");
    include './php/HTFunctions.php';
    include('./php/class.bufferapp.php' );
    include('./php/header.php' );
    include('./php/kc_class.php');

    echo "\n</head>\n<body>\n";

    $cur_page = '.' . htmlspecialchars($_SERVER["PHP_SELF"]);
    $pageDetails = new kcbeerclass();
    $pageDetails->menu_bar("KC Beer Events", "", $cur_page);

?>
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

<?php

  $pageDetails->page_footer();

?>
