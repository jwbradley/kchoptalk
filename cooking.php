<?php
    ini_set("error_log", "./logs/BeerErrors.log");
    
    include('./php/class.bufferapp.php' );
    include('./php/header.php' );
    include('./php/kc_class.php');

    echo "\n</head>\n<body>\n";

    $cur_page = '.' . htmlspecialchars($_SERVER["PHP_SELF"]);
    $pageDetails = new kcbeerclass();
    $pageDetails->menu_bar("Cooking With Beer", "Discover the world of cooking your favorite foods using beer as an ingredient.", $cur_page);

?>

    <div class="container" id="main">

      <div class="row">

        <div class="col-sm-8 col-md-8 blog-main" >

        <?php
        echo "\n";
        $debugger       =  ((!isset($_GET['debug']))  ? ''    : htmlspecialchars($_GET['debug']));

        $jsonOut        =  '/home/jambra49/kchoptalk.com/json/cookswithbeer.json';
        $pageDetails->pagesOutput($jsonOut);
        
        ?>
        </div><!-- /.blog-main -->

        <div class="col-sm-4 col-md-4 blog-sidebar">

          <div class="sidebar-module sidebar-module-inset"  style="background-color:#ffffff;">

          </div>
        </div><!-- /.sidebar-module sidebar-module-inset -->
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div>

<?php

  $pageDetails->page_footer();
?>
