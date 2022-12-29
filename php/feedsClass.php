<?php

use myfeeds\articlesFilter as articlesFilter;
require './articlesfilter_class.php';
ini_set("error_log", "../logs/BeerErrors.log");
set_time_limit(0);

class beerFeedClass {
   
	/**
	 * Feedly's REST API's.
	 * 
	 * Connecting to the Developer site: https://developer.feedly.com
	 * Feedly website manual access key resests: https://feedly.com/v3/auth/dev
	 * 
	 */


	private $TokenStorage       = __dir__  . '/../../.kct';
	private $RefreshTokenStore  = __dir__  . '/../../.kcr';
	const   PostedArticles      = __dir__  . '/../json/rss.json';
	const   beerHowToTags       = __dir__  . '/../json/beerhowtos.json';
	const   beerCookTags        = __dir__  . '/../json/cookswithbeer.json';
	const   beerJobTags         = __dir__  . '/../json/beerjobs.json';
	const   beerRecipeTags      = __dir__  . '/../json/beerRecipes.json';
	const   beerTraders         = __dir__  . '/../json/beerTraderNewsArticles.json';
	const   beerReviews         = __dir__  . '/../json/beerReviewArticles.json';


	public function __construct($feeds, $debugFlag) {
		// $this->feeds    = (is_array($feeds) ? $feeds : );
		$this->feeds    = $feeds;
		$this->debugger = $debugFlag;
		$this->readToken();
	}

	public function jsonOutput ($outputFile, $outputData, $encode_json='Y')  {
		/* Send ARRAY Values to a .json file for quick access. */
		$outArray = ($encode_json=='Y' ? json_encode($outputData) : $outputData);
		$fp2 = fopen($outputFile, 'w');
		fwrite($fp2, $outArray);
		fclose($fp2);
		chmod($outputFile, 0760);	
	}
		
    public function theRefreshToken () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => refreshToken -->\n" : '');

    	$refreshTokenData     = json_decode(file_get_contents($this->RefreshTokenStore), true);
		$this->refreshToken   = $refreshTokenData["refresh_token"];
    }

    public function readToken () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => readToken -->\n" : '');

    	$tokenData = json_decode(file_get_contents($this->TokenStorage), true);

		$this->feedlyPlan       =  $tokenData["plan"];
		$this->feedlyProvider   =  $tokenData["provider"];
		$this->theFeedlyID      =  $tokenData["id"];
		$this->feedlyScope      =  $tokenData["scope"];
		$this->feedlyType       =  $tokenData["token_type"];
		$this->theAccessToken   =  $tokenData["access_token"];
		$this->theFeedlyExpDate =  $tokenData["expires_in"];
    }
	
    public function getApiBaseUrl() {
    	echo ($this->debugger ? "\n<!-- [EXECUTE] => getApiBaseUrl -->\n" : '');
        return "https://cloud.feedly.com";
    }

	function feedlyGetSearch ($searchStream, $feedDays=31, $readonly='true', $counter=250) {  /* This seems like redundant code.  Maybe collapse to feedlyStreamURL(). */
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyGetSearch -->" : '');
		// return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("feed/".$searchStream)."&unreadOnly=".$readonly."&count=".$counter."&newerThan=".(time() - ($feedDays*24*60*60).'.0000');	
		// return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("feed/".$searchStream)."&unreadOnly=".$readonly."&count=".$counter."&newerThan=".(floor(microtime(true) * 1000) - ($feedDays*24*60*60));
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("feed/".$searchStream)."&unreadOnly=".$readonly."&count=".$counter;
	}
	
	function feedlyGetStreamContentsURL () { 
		/**
		 *  This method creates the URL used to get a list of Unread articles in the Beer Category. 
		 **/
		$continuing = (isset($this->categoryArticles["continuation"]) ?  ($this->categoryArticles["continuation"] != '' ? "&continuation=".$this->categoryArticles["continuation"] : '') : '');
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyGetStreamContents -->" : '');
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=user/".$this->theFeedlyID."/category/Beer&count=250&unreadOnly=true".$continuing;	
	}
	
	function feedlyTagId ($feedTag, $theID) { 
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyTagId -->" : '');
		echo ($this->debugger ? "\n<!-- \$this->theFeedlyID   = \"{$this->theFeedlyID}\"; \$feedTag=\"{$feedTag}\"; \$theID=\"{$theID}\"  -->\n" : '');
		return $this->getApiBaseUrl() . "/v3/tags/".urlencode("user/".$this->theFeedlyID).urlencode($feedTag)."/".$theID;
	}	
	
	function feedlyMarkRead () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyMarkRead -->" : '');
		return $this->getApiBaseUrl() . "/v3/markers";
	}	

	function feedlyStreamURL ($feedTag='/tag/Beer Traders', $feedCount=100, $feedDays=31, $unreadonly='true') {
		/**
		 *  This method creates the URL used to get a list of $feedTag items, that will be saved into our .json file
		 **/
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyStreamURL -->" : '');
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("user/".$this->theFeedlyID).urlencode($feedTag).($feedCount > 0 ? "&count=".$feedCount : '').(isset($unreadonly) ? "&unreadonly=".$unreadonly : '').($feedDays==0 ? '' :"&newerThan=".(time() - ($feedDays*24*60*60)));
	}

	function refreshFeedlyToken () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => refreshFeedlyToken -->\n" : '');

		$this->theRefreshToken();
		$curl         =  curl_init();
		$refreshURL   =  $this->getApiBaseUrl() . "/v3/auth/token";		
		$postValues   =  "";
		$postValues  .=  "refresh_token=".$this->refreshToken;
		$postValues  .=  "&client_id=feedlydev";
		$postValues  .=  "&client_secret=feedlydev";
		$postValues  .=  "&grant_type=refresh_token";

		curl_setopt_array($curl, array(
		    CURLOPT_URL => $refreshURL,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postValues,
			CURLOPT_HTTPHEADER => array(
			  "cache-control: no-cache",
			  "content-type: application/x-www-form-urlencoded"
			)
		)); 

		$this->jsonOutput ($this->TokenStorage, curl_exec($curl), 'N');

		curl_close($curl);

		if (curl_error($curl)) {
			echo ( ($this->debugger) ? "<!-- We've received a cURL Error #:" . $err. " -->\n" : '');
			return false;
		} else {
			return true;
		}		
	}

	function getFeedly ($feedlyLink, $action="GET") {

		/* Working to phase out this part of the code */
		echo ($this->debugger ? "\n<!-- [EXECUTE] => getFeedly -->\n" : '');

		$curl = curl_init();

		$AccessToken = "authorization: ".$this->theAccessToken;

		echo ($this->debugger ? "\n<!-- \$feedlyLink         = {$feedlyLink}   -->\n" : '');
		
		curl_setopt_array($curl, array(
		    CURLOPT_URL => $feedlyLink,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST => $action,
		    CURLOPT_HTTPHEADER => array($AccessToken)
		)); 
		
		return $curl;
	}

	function postFeedly ($feedlyLink, $action="POST", $postValues='') {

		echo ($this->debugger ? "\n<!-- [EXECUTE] => postFeedly -->\n" : '');
		$curl = curl_init();
		$postToken = array("authorization: ".$this->theAccessToken, "cache-control: no-cache", "content-type: application/json");

		echo ($this->debugger ? "\n<!-- \$feedlyLink         = {$feedlyLink}   -->\n<!-- \$postValues  = '{$postValues}'   -->\n" : '');
			
		curl_setopt_array($curl, array(
		    CURLOPT_URL => $feedlyLink,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST => $action,
		    CURLOPT_POSTFIELDS => $postValues,
		    CURLOPT_HTTPHEADER => $postToken
		)); 
	
		return $curl;
	}

	function getCategoriesArticles() {
		/**
		 *  Get all of the articles from a feedly category.
		 */
	    echo ($this->debugger ? "<!-- [EXECUTE] => getCategoriesArticles -->\n" : '');
		$this->cat_url           =  $this->getFeedly($this->feedlyGetStreamContentsURL());
		$this->categoryArticles  =  json_decode(curl_exec($this->cat_url), true);
		curl_close($this->cat_url);	
	}

	function getPostedArticlesList() {
		/**
		 *  Get all of the articles from a feedly category.
		 */
	    echo ($this->debugger ? "<!-- [EXECUTE] => getPostedArticlesList -->\n" : '');
		$fileDate     =  date ("Y-m-d", filemtime($jsonoutDay));
		$fDteTme      =  date ("F d, Y, H:i:s", filemtime($jsonoutDay));
		$str          =  file_get_contents(self::PostedArticles);
		$this->Posted =  json_decode($str, true);      // decode the .json into an associative array
	}

	function feedTagger($tag, $tagThem='Y') {
	    /**
	     * Makes calls to the feedly API's to Mark feedly articles as READ and set tags in feedly.
	     */	
	    echo ($this->debugger ? "<!-- [EXECUTE] => feedTagger -->\n" : '');
    	    if ($this->debugger != '')  { echo "\n\n\n\n\n<!-- \$taggingThese\n"; var_export($this->tagList); echo " -->\n"; echo "<!-- \$readThese\n"; var_export($this->markReadList); echo " -->\n"; }
	    if (strlen($this->markReadList) >0) {
    		$postIt   =  "{\"action\": \"markAsRead\",\"type\": \"entries\",\"entryIds\": [".$this->markReadList."]}";
    		$setRead  =  curl_exec($this->postFeedly($this->feedlyMarkRead(), "POST", $postIt));
    		$tagTheID =  ($tagThem == 'Y' ? curl_exec($this->getFeedly($this->feedlyTagId('/tag/'.$tag, $this->tagList), "PUT")) : '' );
	   	}
	}

	function filterDupes($filteringArray) {
		/**
		 *  Looks for duplicate articles
		 */
	    echo ($this->debugger ? "<!-- [EXECUTE] => Filter Duplicate Articles -->\n" : '');

		$scrub['title'] = '';
		$allDUPES       = array_filter($filteringArray, array(new articlesFilter($filteringArray), 'findAllDupeArticles'));
	    $replaceChars   = articlesFilter::replacables();
		if(is_array($allDUPES) && (count($allDUPES)>0)) {
	    	echo ($this->debugger ? "<!-- [EXECUTE] => Dupes Scrubbing -->\n" : '');
		    array_multisort( array_column($allDUPES, "title"), SORT_ASC, SORT_STRING|SORT_FLAG_CASE, $allDUPES );
	    	
			foreach ($allDUPES as $key => $value) {
				// The following logic will keep the first article in the dupes list and set the rest to be marked as read.
	    		$similarChecker = similar_text($scrub['title'], $value['title'], $similar_percentage);
	    		if  (( str_replace($replaceChars, '', strtolower($value['title'])) != str_replace($replaceChars, '', strtolower($scrub['title'])) ) && ($similar_percentage <80)) { 
		       		$scrub['title'] = $value['title'];
		       		echo "<!-- keeping 1st DUPE: ".$value['title']."; \$similar_percentage = ".round($similar_percentage)."% -->\n";
	       	   		unset($allDUPES[$key]);
		       	}
			}	
	    	echo ($this->debugger ? "<!-- [CALL] => Load Duplicate ID's into global variable (\$this->markReadList) that will get marked as read. -->\n" : '');
			$this->getArticleIDs($allDUPES);
	    } 
	}

	function checkPosted($inBoundArray) {
		/**
		 *  Looks for dupes in the articles already posted to the website. 
		 *  I feel like this could use code already built. Eitherway, we're starting here.
		 * 
		 * 	We're going to get a array from external and then use it against the Filter to find all of the articles that have been posted.
		 * 
		 *  Still trying to work out the logic on this idea.
		 * 
		 */
	    // echo ($this->debugger ? "<!-- [EXECUTE] => Filter Out Already Posted Articles -->\n" : '');
	    // $this->getCategoriesArticles();
		// $scrub['title'] = '';
	    // echo ($this->debugger ? "<!-- [EXECUTE] => Start Array Filter -->\n" : '');
		// $allDUPES       = array_filter($inBoundArray['items'], array(new articlesFilter($this->categoryArticles['items']), 'findAllDupeArticles'));
	    // $replaceChars   = articlesFilter::replacables();


	    // echo ($this->debugger ? "\n<!-- [DUMP] => Array \$allDUPES -->\n" : '');
	    // var_dump($allDUPES);

	    // echo ($this->debugger ? "<!-- [EXECUTE] => Loop The Array of DUPES -->\n" : '');
		// if(is_array($allDUPES) && (count($allDUPES)>0)) {
	    // 	echo ($this->debugger ? "<!-- [EXECUTE] => Dupes Scrubbing -->\n" : '');
		//     array_multisort( array_column($allDUPES, "title"), SORT_ASC, $allDUPES );
	    	
		// 	foreach ($allDUPES as $key => $value) {
		// 		// The following logic will keep the first article in the dupes list and set the rest to be marked as read.
	    // 		if  (str_replace($replaceChars, '', strtolower($value['title'])) === str_replace($replaceChars, '', strtolower($scrub['title']))) { 
	    //    	   		unset($allDUPES[$key]);
		//        		$scrub['title'] = $value['title'];
		//        	} 
		// 	}	
	    // } 
		// return $this->getArticleIDs($allDUPES);
	}

	function getArticlesListing () {
		$ContinueFlag = true;
		do {
			    echo ($this->debugger ? "\n<!-- [EXECUTE] => Articles Reader -->\n" : '');
				$this->getCategoriesArticles();
				$feedArticles[] =  $this->categoryArticles;
				$ContinueFlag   =  ($this->categoryArticles["continuation"] != '' ? true : false);
		} while ($ContinueFlag  == true);
		
		foreach ($feedArticles as $key => $nextLevel) {
			foreach ($nextLevel as $key => $thirdLevel) {
				if(is_array($thirdLevel)) {
					foreach ($thirdLevel as $key => $continuationSection) {
					    $this->ArticlesArray[] = $continuationSection;
					}
				}
			}
		}
		
	}

	function filterFeedArticles($keepThese) {
		/**
		 *  Looks for articles that do not have any of the passed in key words
		 */

	    echo ($this->debugger ? "\n<!-- [EXECUTE] => filterFeedArticles -->\n" : '');
	    $this->getArticlesListing();

		echo ($this->debugger ? "\n<!-- [CALL] => Filter Out Dupes. -->\n" : '');	
		$this->filterDupes($this->ArticlesArray);

		echo ($this->debugger ? "\n<!-- [CALL] => Load Non-Beer Articles to be marked as read. -->\n" : '');	
		$this->getArticleIDs(array_filter($this->ArticlesArray, array(new articlesFilter($keepThese), 'bulkFilterArticles')));
		
		echo ($this->debugger ? "\n<!-- [CALL] => feedTagger() Method to mark articles as read. -->\n" : '');	
		$this->feedTagger('', 'N'); 
	}

	function bulkTagFeedArticles($tagThese, $tag) {
		/**
		 *  Gets a list of all the articles in a feedly category.
		 */

	    echo ($this->debugger ? "<!-- [EXECUTE] => bulkTagFeedArticles -->\n" : '');
	    $this->getArticlesListing();

		$this->getArticleIDs(array_filter($this->ArticlesArray, array(new articlesFilter($tagThese), 'bulkTagArticles')));
		echo ($this->debugger ? "\n<!-- [CALL] => feedTagger() Method to Tag and Mark articles as read. -->\n" : '');	
		$this->feedTagger($tag, 'Y');

	}

	function getFeedsArticles($days=31) {
	    /**
	     * This method gets all of the atricles from multiple feedly subscriptions. 
	     */			
		foreach($this->feeds as $key => $searchFeed)  { 
			echo ($this->debugger !=  '' ? "\n\n\n<!-- Article Ingested: \"{$streamdata['title']}\" -->\n"         : '');
			$artfeeds_curl  =  $this->getFeedly($this->feedlyGetSearch($searchFeed, $days));
			$quickResults = json_decode(curl_exec($artfeeds_curl), true);
			$this->theArticles[$key]  =  $quickResults['items'];
			curl_close($artfeeds_curl);		
		}
		return $this->theArticles;
	}

	function getArticleIDs($articlesList) {
	    /**
	     * This method gets all of the article ID's for the feedly POST output. 
	     */	
	    echo ($this->debugger ? "\n<!-- [EXECUTE] => getArticleIDs -->\n" : '');
	    // var_dump($articlesList);
		if(is_array($articlesList)) {
			foreach($articlesList as $feed => $streamdata)  {
				
				echo ($this->debugger !=  '' ? "\n<!-- Article Title: \"{$streamdata['title']}\" -->\n"         : '');
				echo ($this->debugger !=  '' ? "<!-- Article ID:    \"{$streamdata['id']}\" -->\n"         : '');
				// echo ($this->debugger !=  '' ? "<!-- Article ID:    \"".(!$streamdata['canonicalUrl'] ? $streamdata['alternate'] : $streamdata['canonicalUrl'])"\" -->\n"         : '');
				$this->markReadList   .=  (strlen($this->markReadList   )>0  ? ",".'"'.$streamdata['id'].'"'    : '"'.$streamdata['id'].'"'    ) ;
				$this->tagList        .=  (strlen($this->tagList)>0  ? ','.urlencode($streamdata['id']) : urlencode($streamdata['id']) ) ;
				
			}
		}
	}

	function tagFeedArticles($searches, $tag, $days=31, $justFilter='N') {
		
		$this->getFeedsArticles($days);
		foreach($this->theArticles as $key => $searchFeed)  { 
			if(is_array($searchFeed)) {
				$this->getArticleIDs(array_filter($searchFeed, array(new articlesFilter($searches), 'bulkTagArticles')));
			}
		}
		$this->feedTagger($tag);
	}

	public function arrayBuilder($inputData) {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => arrayBuilder -->\n" : '');
		if(is_array($inputData)) {
			foreach($inputData as $feed=>$items)  {
				if(is_array($items)) {
					foreach($items as $item_no => $streamdata)  {  
						$outputData[$item_no]["fingerprint"] = $streamdata["fingerprint"];
						$outputData[$item_no]["title"] = $streamdata["title"];
						if (strpos($streamdata["originId"] , 'http') !== false) {
							$outputData[$item_no]["link"]  = $streamdata["originId"];
						} else {
							$outputData[$item_no]["link"]  = $streamdata["alternate"][0]["href"];
						}
						$outputData[$item_no]["crawled"]   = $streamdata["crawled"];
						$outputData[$item_no]["published"] = $streamdata["published"];
						$outputData[$item_no]["actionTimestamp"] = $streamdata["actionTimestamp"];
					}  
				}
			}
		}
		if($this->debugger) {
		  echo "<!-- This is the results from feedly ...  ";
		  var_dump($outputData);
		  echo " -->";
		}
		return $outputData;
	}

}	

?>