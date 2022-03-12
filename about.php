<?php

    ini_set("error_log", "./logs/BeerErrors.log");
    include './php/HTFunctions.php';
    include('./php/class.bufferapp.php' );
    include('./php/header.php' );
    include('./php/kc_class.php');
    echo "\n</head>\n<body>\n";

    $cur_page    = '.' . htmlspecialchars($_SERVER["PHP_SELF"]);
    $pageDetails = new kcbeerclass();
    $pageDetails->menu_bar("About Page", "", $cur_page);
    $Originated  = new DateTime("2012-04-01");
    $CurrentDate = new DateTime(date("Y-m-d"));
    $SiteAge     = $Originated->diff($CurrentDate);
    $f           = new NumberFormatter("en", NumberFormatter::SPELLOUT);

?>

    <div class="container" id="main">
      <div class="row">
        <div class="col-xs-12 " >
            <div id="about-kcht" align="left">
	            <div hidden><h1>About KCHOPTALK</h1></div>
                <p style="font-size: 18px;">For the past <? echo trim($f->format($SiteAge->y)); ?> years Kansas City Hop Talk has been a popular content curation site intent on keeping local beer enthusiasts informed about craft beer. The information is gathered through the constant monitoring of blog sites, news media, social media and other beverage related sites for anything relevant to craft beer. KC Hop Talk is truly dedicated to craft beer fans of Kansas City, and is dedicated to deliver the most up-to-date information directly to the “Craft Beer” Community.</p>
    		</div>
        </div><!-- /.blog-main -->
       
      </div><!-- /.row -->
    </div>

<?php

  $pageDetails->page_footer();

?>