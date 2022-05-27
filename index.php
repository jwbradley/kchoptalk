<?php

    ini_set("error_log", "./logs/BeerErrors.log");

    include('./php/class.bufferapp.php' );
    include('./php/header.php' );
    include('./php/kc_class.php');
    include('./php/indexClass.php');

    echo "\n</head>\n<body>\n";

    $debugger  =  ((!isset($_GET['debug'])) ? '' : (htmlspecialchars($_GET['debug']) == 'Y' ? 'Y' : 'N'));
    $cur_page  =  '.' . str_replace('.php', '', strtolower(htmlspecialchars($_SERVER["PHP_SELF"])));
    $beerNews  =  new kcbeerclass();
    $index     =  new beerIndexClass($debugger);
    
    $beerNews->menu_bar("KC's Beer News Site", "Where Hop Heads Get Craft Beer News", $cur_page);

?>

    <div class="container" id="main">

      <div class="row">

        <div class="col-sm-8 col-md-8 blog-main" >

        <?php
        echo "\n";

        $buffer = new BufferPHP($index->buffer_id);

        $data = array('profile_ids' => array());

        $returnData = $buffer->get('/profiles/'. $index->buffer_linkd .'/updates/sent', $data);  // LinkedIn account
        // $returnData = $buffer->get('/profiles/'. $index->buffer_twitt .'/updates/sent', $data);  // Twitter account
        // $returnData = $buffer->get('/profiles/'. $index->buffer_insta .'/updates/sent', $data);  // Instagram account
                                              
        $cur_day = '';
        $prv     = '';

        $postCounter = 0;
        $linkIgnore = array(); // Need to add logic to read in listing from json file. Maybe add a function call here.

        if (is_array($returnData) || is_object($returnData)) {
          foreach($returnData as $key=>$allLinkData) {
            if (is_array($allLinkData)) {
              foreach($allLinkData as $key2=>$theLink) {

                $descript = '';
                $hrefLink = '';
                $headline = '';
                $hrefTitle = '';
                $hrefDesc = '';
                $outputKey[$postCounter]['rank'] =  ($theLink['statistics']['reshares']*20) + ($theLink['statistics']['clicks']*15) + ($theLink['statistics']['likes']*10) + ($theLink['statistics']['comments']*5);
                if ((strrpos($theLink['text'], 'https://') > 0 ) ||  (strrpos($theLink['text'], 'http://') > 0 )) {
                  $hrefLink    = htmlspecialchars( substr($theLink['text'], strrpos($theLink['text'], 'http'), strlen($theLink['text'])-strrpos($theLink['text'], 'http') ) ) ;
                  $headline    = substr($theLink['text'], 0, strrpos($theLink['text'], 'http') );                  
                  $hrefDesc    =  ($theLink['media']['title'] == '404' ? '' : $theLink['media']['description']);

                  /* blacklisted site */
                  $hrefLink    =  (stripos($theLink['media']['title'], 'mybeerbuzz') === false ? (stripos($theLink['media']['expanded_link'], 'mybeerbuzz') === false ? $hrefLink : '') : '');
                  
                } else if ((strrpos($theLink['text'], 'https://') == 0 ) && (strrpos($theLink['text'], 'http://') == 0 ) ) { 
                    $hrefLink    =  htmlspecialchars( $theLink['media']["link"] ) ;
                    $headline    =  $theLink['text'];
                    $hrefTitle   =  $theLink['media']['title'];
                    $hrefDesc    =  ($theLink['media']['title'] == '404' ? '' : $theLink['media']['description']);;
                    $hrefThumb   =  $theLink['media']['thumbnail'];
                }

                if (($beerNews->linkfilters($hrefLink) === false) && isset($hrefLink) && ($hrefLink != '') ) {
                  /* URL Encoded -- easier to read on the page.*/
                  $linkcoded  = trim($hrefLink);
                  $TitleCoded = urlencode($headline);
                  
                  $descript   = ( $hrefDesc == '' || strtolower($hrefDesc) == 'null' ? '' : "<br /><div style=\"font-size: small; padding-left: 10pt; \">".$hrefDesc."</div>" );
                  $outputKey[$postCounter]['link'] = "<a href=\"./post.php?l=".$linkcoded."&t=".htmlspecialchars($TitleCoded)."\" target=\"_blank\"><strong>".$headline."</strong></a>";

                }
                
                if (($postCounter <= 35)  && ($prv != $outputKey[$postCounter]['link']) && (isset($outputKey[$postCounter]['link'])) )  {
                  echo "\n\t\t\t<div class=\"blog-post\">\n\t\t\t\t";
                    echo $outputKey[$postCounter]['link'].$descript;
                  echo "\n\t\t\t</div>";
                  $prv    = $outputKey[$postCounter]['link'];
                  $prvdsc = $descript;
                  $prvTtl = $TitleCoded;
                  ++$postCounter;
                }
              }
            }
          }
        }
        ?>
        </div><!-- /.blog-main -->
        <div id="advert-id" class="sidebar-module">
            <!-- <a href="./fest/springfling.html"  id="fb"><img src="./fest/springfling/springfling-logo.jpg" alt="Spring Fling Beer Festival" align="left" style="padding-right:10px;" height="250" width="250" ></a> -->
            <!-- <a href="./fest/folt.php"  id="fb"><img src="./fest/folt/folt-logo.jpg" alt="Festival of the Lost Township" align="left" style="padding-right:10px;" height="250" width="250" ></a> -->

        </div>  
        <div class="col-sm-4 col-md-4 blog-sidebar">

          <div class="sidebar-module sidebar-module-inset"  style="background-color:#ffffff;">

            <!-- <div id="calendar-id" class="sidebar-module" style="background-color:#E9E9E9;">
            <h3 id="calHeader">What's on Tap</h3>
                <iframe src="./HTML/Cal2.html" style=" border-width:0 " width=100% height="300" frameborder="0" scrolling="no"></iframe>  
            </div>           -->
            
            <div class="sidebar-module" style="background-color:#F5F6CE;">
              <h3 id="popPost">Popular Posts</h3>
              <ol class="list-unstyled">
                <?php
                    if (is_array($outputKey)) { rsort($outputKey); }
                    for($x=0;$x<10;$x++)
                    {
                      echo "\n\t\t\t\t<div class=\"blog-post\">\n\t\t\t\t\t";
                        echo $outputKey[$x]['link'];
                      echo "\n\t\t\t\t</div>";
                    }
                ?> 
              </ol>
            </div>

        </div><!-- /.sidebar-module sidebar-module-inset -->
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div>


<?php
  
  $beerNews->page_footer();

?>
