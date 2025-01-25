<?php

/**
 * kcbeerclass v2.1
 * The Feedly API
 * The purpose of the Feedly API is to empower individuals and businesses to streamline their 
 * research and curation workflows as well as empower third-party developers to create 
 * different/innovative reading experiences.
 *
 * @package	    kcbeerclass
 * @author		James Bradley (kchoptalk.com)
 * @copyright   If you find any of this useful. You are more than welcome to use it for your project.
 * @link		https://kchoptalk.com
 * @since		Version 0.1 back in 2012
 * @filesource  
 */

class kcbeerclass { 

	const   email         =  'contentmanager@kchoptalk.com';
	const   socialAccount = "KCHopTalk";

	function __construct($bugs='') {
		$this->debug = $bugs;
		$this->twitterLink();
		$this->facebookLink();
		$this->instagramLink();
		$this->pinterestLink();
		$this->untappdLink();
		$this->ratebeerLink();
		$this->redditLink();
		$this->emailReachOut();
		
	}

	function menu_bar($page_title, $page_slogan, $selfpage) {
		echo "\n\t<!-- Start Fixed navbar -->\n";
		echo "\t<nav id=\"KC-navbar\" class=\"navbar navbar-default navbar-fixed-top\">\n";
		echo "\t\t<div class=\"container-fluid\">\n";
		echo "\t\t\t<div id=\"KC-navbar-header\" class=\"navbar-header\">\n";
		echo "\t\t\t\t<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#KC-navbar-collapse\">\n";
		echo "\t\t\t\t\t<span class=\"sr-only\"></span>\n";
		echo "\t\t\t\t\t<span class=\"icon-bar\"></span>\n";
		echo "\t\t\t\t\t<span class=\"icon-bar\"></span>\n";
		echo "\t\t\t\t\t<span class=\"icon-bar\"></span>\n";
		echo "\t\t\t\t</button>\n";
		echo "\t\t\t\t<a id=\"KC-navbar-brand\" class=\"navbar-brand\" href=\"".$selfpage."\">\n";
		echo "\t\t\t\t\t<img style=\"background-color:#ffffff;\" src=\"./Pics/KCHopTalkLogo-172x172.png\" alt=\"KC Hop Talk Beer News\">    \n";
		echo "\t\t\t\t\t<!-- <img src=\"./Pics/KCHopTalkLogo-172x172.jpg\">     -->\n";
		echo "\t\t\t\t</a>\n";
		echo "\t\t\t\t<div class=\"navbar-name\"><h1 style=\"display: none;\">KC Hop Talk</h1></div>\n";
		echo "\t\t\t\t<div class=\"navbar-name\"><h1 style=\"display: none;\">KC Beer News</h1></div>\n";
		echo "\t\t\t\t<div class=\"navbar-name\"><h1 style=\"display: none;\">Kansas City Beer News</h1></div>\n";
		echo "\t\t\t\t<div class=\"navbar-name\"><h1 style=\"display: none;\">Beer News</h1></div>\n";
		
		echo "\t\t\t\t<div class=\"navbar-page\">".$page_title."</div>\n";
		echo "\t\t\t\t<div class=\"navbar-page-tag\">".$page_slogan."</div>\n";
		echo "\t\t\t</div>\n";
		echo "\t\t\t<div id=\"KC-navbar-collapse\" class=\"collapse navbar-collapse\">\n";
		echo "\t\t\t\t<ul id=\"KC-navbar-links\" class=\"nav navbar-nav navbar-right\">\n";
		echo "\t\t\t\t\t<li><a href=\"./\">Beer<br />News</a></li>\n";
		// // echo "\t\t\t\t\t<li><a href=\"./calendar\">KC<br />Events</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./releases\">New<br />Releases</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./reviews\">Beer<br />Reviews</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./jobs\">Beer<br />Jobs</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./cooking\">Cook<br/>with<br/>Beer</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./recipes\">Beer<br/>Recipes</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./howto\">How<br />To</a></li>\n";
		echo "\t\t\t\t\t<li><a href=\"./about\">About</a></li> \n";      
		
		// echo "\t\t\t\t\t<li><a href=\"./kcbreweries\">Breweries</a></li>\n";
		// echo "\t\t\t\t\t<li><a href=\"./blog\">Blog</a></li>\n";
		// echo "\t\t\t\t\t<li><a href=\"./contact\">Contact Us</a></li>\n";
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</div>\n";
		echo "\t\t</div>\n";
		echo "\t</nav>\n\t<!-- End Fixed navbar -->\n";
	}


	function twitterLink() {
		$this->socialLinks['twitter']['url'] = "https://twitter.com/".self::socialAccount;
		$this->socialLinks['twitter']['acc'] = self::socialAccount;
		$this->socialLinks['twitter']['ico'] = "./Pics/twitter_32.png";
	}

	function facebookLink() {
		$this->socialLinks['facebook']['url'] = "https://www.facebook.com/".self::socialAccount;
		$this->socialLinks['facebook']['acc'] = self::socialAccount;
		$this->socialLinks['facebook']['ico'] = "./Pics/f_logo.png";
	}

	function instagramLink() {
		$this->socialLinks['instagram']['url'] = "https://instagram.com/".self::socialAccount."?ref=badge";
		$this->socialLinks['instagram']['acc'] = self::socialAccount; 
		$this->socialLinks['instagram']['ico'] = "./Pics/ig-badge-48.png";
	}

	function pinterestLink() {
		$this->socialLinks['pinterest']['url'] = "https://www.pinterest.com/".self::socialAccount;
		$this->socialLinks['pinterest']['acc'] = self::socialAccount;
		$this->socialLinks['pinterest']['ico'] = "./Pics/pinterest.png";
	}

	function untappdLink() {
		$this->socialLinks['untappd']['url'] = "https://untappd.com/user/".self::socialAccount;
		$this->socialLinks['untappd']['acc'] = self::socialAccount;
		$this->socialLinks['untappd']['ico'] = "./Pics/untappd.jpeg";
	}

	function ratebeerLink() {
		$this->socialLinks['ratebeer']['url'] = "https://www.ratebeer.com/user/276207/";
		$this->socialLinks['ratebeer']['acc'] = self::socialAccount;
		$this->socialLinks['ratebeer']['ico'] = "./Pics/rate+beer.png";
	}

	function redditLink() {
		$this->socialLinks['reddit']['url'] = "https://www.reddit.com/r/".self::socialAccount;
		$this->socialLinks['reddit']['acc'] = self::socialAccount;
		$this->socialLinks['reddit']['ico'] = "./Pics/reddit.png";
	}

	function emailReachOut() {
		$this->socialLinks['email']['url'] = htmlentities("mailto:".self::email, ENT_HTML5);
		$this->socialLinks['email']['acc'] = htmlentities(self::email, ENT_HTML5);
		$this->socialLinks['email']['ico'] = "./Pics/email.png";
	}

	function page_footer() {
		echo "\n\t<br />\n<br />\n<br />\n\t<br />\n\t\t<br />\n";
		echo "\t<!-- kchoptalk footer -->\n\n";
		echo "\t<footer class=\"footer text-center text-white\" style=\"background-color: #202020; color: #FCFCFC;\">\n";
		echo "\t\t<!-- Grid container -->\n";
		echo "\t\t<div class=\"container p-4 pb-0\">\n";
		echo "\t\t\t<!-- Section: Social media -->\n";
		echo "\t\t\t<section class=\"mb-4\">\n\n";
		foreach ($this->socialLinks as $key => $social) {
			echo "\t\t\t<!-- ".$key." -->\n";
			echo "\t\t\t<a class=\"btn btn-floating m-1\" href=\"".$social['url']."\" role=\"button\"><img alt=\"".$key."\" width=\"25\" height=\"25\"  src=\"".$social['ico']."\" /></i></a>\n\n";
		}
		echo "\t\t\t</section>\n";
		echo "\t\t\t<!-- Section: Social media -->\n";
		echo "\t\t</div>\n";
		echo "\t\t<!-- Grid container -->\n";
		echo "\n";
		echo "\t\t<!-- Copyright -->\n";
		echo "\t\t<div class=\"text-white text-center p-3\" style=\"font-size: 16px;\">\n";
		echo "\t\t\t&copy 2012-".date("Y")." Copyright:\n";
		echo "\t\t\t<a style=\"color:white;\"href=\"https://kchoptalk.com/\">kchoptalk.com</a>\n";
		echo "\t\t</div>\n";
		echo "\t\t<!-- Copyright -->\n";
		echo "\t</footer>\n";
		echo "\t<!-- ============================================================================== -->\n";
		echo "\t<!-- Bootstrap core JavaScript                                                      -->\n";
		echo "\t<!-- ============================================================================== -->\n";
		echo "\t<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>\n";
		echo "\t<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\"></script>\n";
		echo "\t<!-- ============================================================================== -->\n";
		echo "\t</body>\n";
		echo "</html>\n";
	}

	function linkfilters($inLink){

		$ignoreFile     = file_get_contents("./docs/ignoreListing.json");
		$ignoreLinkList = json_decode($ignoreFile, true); 

		foreach($ignoreLinkList as $key => $row ) {
			if($inLink == $row["link"]){
				return true;
			}
		}
		return false;
	}

	function pagesOutput($jsonFile, $maxOut=75, $maxAge=60) {

        $fileDate       =  date ("Y-m-d", filemtime($jsonFile));
        $str            =  file_get_contents($jsonFile);
        $tNews          =  json_decode($str, true); // decode the JSON into an associative array
        $postCounter    =  0;
        $prvLink        =  '';
        $htmlLink       =  '';
        $prvTitle       =  '';
        $prvFingerPrint =  '';
          
        echo (($this->debug == 'Y') ? "\n<!-- Processing .json file created on: {$fileDate} -->\n" : '');
        if(($this->debug == 'Y')) {
        	echo "<!-- We're dumping \$tNews:\n";
        	var_dump($tNews);
        	echo "End dump of \$tNews -->\n";
        }

        foreach($tNews as $key2=>$articles) {
            $fingrprint =  $articles["fingerprint"];
            $headline   =  $articles["title"];
            $linkcoded  =  urlencode($articles["link"]);
            $pubDate    =  $articles["published"];
            $linkAge    =  floor((time()-($pubDate/1000))/60/60/24); // Days Old
            $justLink   =  (strstr($articles["link"], '&') ? stristr(preg_replace('#^https?://#', '', $articles["link"]), '&', true) : $articles["link"]);
            $TitleCoded =  urlencode($articles["title"]);
            $outputKey[$postCounter]['link'] = "<a href=\"./post.php?beerlink=".$linkcoded."&title=".htmlspecialchars($TitleCoded)."\" target=\"_blank\"><strong>".$headline."</strong></a>\n\t\t<p style=\"font-size: 55%;\">Posted: " .date('l, F j, Y', strtotime(date('Y-m-d') . ' -'.$linkAge.' day')). "</p>";

            echo (($this->debug == 'Y') ? "\n<!--         \$headline: {$headline} -->" : '');
            echo (($this->debug == 'Y') ? "\n<!-- \$articles[\"link\"]: {$articles["link"]} -->" : '');
            echo (($this->debug == 'Y') && ($justLink != $articles["link"]) ? "\n<!--         \$justLink: {$justLink } -->" : '');
            echo (($this->debug == 'Y') ? "\n<!--          \$pubDate: {$pubDate } or ".$linkAge." days ago. -->" : '');   
            echo (($this->debug == 'Y') ? "\n<!--          \$maxDays: ".$maxAge."   -->" : '');  

            if (($postCounter <= $maxOut) && ($prvFingerPrint != $fingrprint) && ($linkcoded != $prvLink) && ($prvTitle != $headline) && ($maxAge >= $linkAge)) { 
                echo "\t<div class=\"beer-post\">\n\t\t";
                echo $outputKey[$postCounter]['link'];
                echo "\n\t</div>\n";
                $prvFingerPrint  = $fingrprint;
                $prvLink         = $linkcoded;
                $htmlLink        = $outputKey[$postCounter]['link'];
                $prvTitle        = $headline;
                ++$postCounter;
            }
        }
	}
}


?>
