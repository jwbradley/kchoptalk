<?php

use myfeeds\articlesFilter as articlesFilter;
require './articlesfilter_class.php';
ini_set("error_log", "../logs/BeerErrors.log");

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

	public function __construct($feeds, $debugFlag) {
		// $this->feeds    = (is_array($feeds) ? $feeds : );
		$this->feeds    = $feeds;
		$this->debugger = $debugFlag;
		$this->readToken();
	}

	public function jsonOutput ($outputFile, $outputData, $json_type='Y')  {
		/* Send ARRAY Values to a .json file for quick access. */
		$outArray = ($json_type=='Y' ? json_encode($outputData) : $outputData);
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

	function feedlyGetSearch ($searchStream, $feedDays=31, $readonly='true', $counter=200) {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyGetSearch -->" : '');
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("feed/".$searchStream)."&unreadOnly=".$readonly."&count=".$counter."&newerThan=".(time() - ($feedDays*24*60*60).'.0000');	
	}
	
	function feedlyGetStreamContents () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyGetStreamContents -->" : '');
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=user/".$this->theFeedlyID."/category/Beer&count=1000&unreadOnly=true";	
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

	function feedlyStreamURL ($feedTag='/tag/Beer Traders', $feedCount=150, $feedDays=31) {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => feedlyStreamURL -->" : '');
		return $this->getApiBaseUrl() . "/v3/streams/contents?streamId=".urlencode("user/".$this->theFeedlyID).urlencode($feedTag).($feedCount > 0 ? "&count=".$feedCount : '')."&newerThan=".(time() - ($feedDays*24*60*60));
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
		$this->cat_url           =  $this->getFeedly($this->feedlyGetStreamContents());
		$this->categoryArticles  =  json_decode(curl_exec($this->cat_url), true);
		curl_close($this->cat_url);	
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

	function filterDupes() {
		/**
		 *  Looks for duplicate articles
		 */
	    echo ($this->debugger ? "<!-- [EXECUTE] => Filter Duplicate Articles -->\n" : '');

		$scrub['title'] = '';
		$allDUPES       = (array_filter($this->categoryArticles['items'], array(new articlesFilter($this->categoryArticles['items']), 'findAllDupeArticles')));
	    $replaceChars   = articlesFilter::replacables();
		if(is_array($allDUPES) && (count($allDUPES)>0)) {
	    	echo ($this->debugger ? "<!-- [EXECUTE] => Dupes Scrubbing -->\n" : '');
		    array_multisort( array_column($allDUPES, "title"), SORT_ASC, $allDUPES );
	    	
			foreach ($allDUPES as $key => $value) {
				// The following logic will keep the first article in the dupes list and set the rest to be marked as read.
	    		if  (str_replace($replaceChars, '', strtolower($value['title'])) === str_replace($replaceChars, '', strtolower($scrub['title']))) { 
	       	   		unset($allDUPES[$key]);
		       		$scrub['title'] = $value['title'];
		       	} 
			}	
			$this->getArticleIDs($allDUPES);
	    } 
	}

	function filterFeedArticles($keepThese) {
		/**
		 *  Looks for articles that do not have any of the passed in key words
		 */
		$this->getCategoriesArticles();
		$this->filterDupes();
	    echo ($this->debugger ? "\n<!-- [EXECUTE] => filterFeedArticles -->\n" : '');
		$this->getArticleIDs(array_filter($this->categoryArticles['items'], array(new articlesFilter($keepThese), 'bulkFilterArticles')));
		$this->feedTagger('', 'N'); 
	}

	function bulkTagFeedArticles($tagThese, $tag) {
		/**
		 *  Gets a list of all the articles in a feedly category.
		 */
	    echo ($this->debugger ? "<!-- [EXECUTE] => bulkTagFeedArticles -->\n" : '');
		$this->getCategoriesArticles();
		// var_dump(array_filter($this->categoryArticles['items'], array(new articlesFilter($tagThese), 'bulkTagArticles')));
		$this->getArticleIDs(array_filter($this->categoryArticles['items'], array(new articlesFilter($tagThese), 'bulkTagArticles')));
		$this->feedTagger($tag, 'Y');
	}

	function getFeedsArticles() {
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
			foreach($articlesList as $feed=>$streamdata)  {
				echo ($this->debugger !=  '' ? "\n<!-- Article Title: \"{$streamdata['title']}\" -->\n"         : '');
				echo ($this->debugger !=  '' ? "<!-- Article ID:    \"{$streamdata['id']}\" -->\n"         : '');
				// echo ($this->debugger !=  '' ? "<!-- Article ID:    \"".(!$streamdata['canonicalUrl'] ? $streamdata['alternate'] : $streamdata['canonicalUrl'])"\" -->\n"         : '');
				$this->markReadList   .=  (strlen($this->markReadList   )>0  ? ",".'"'.$streamdata['id'].'"'    : '"'.$streamdata['id'].'"'    ) ;
				$this->tagList        .=  (strlen($this->tagList)>0  ? ','.urlencode($streamdata['id']) : urlencode($streamdata['id']) ) ;
			}
		}
	}

	function tagFeedArticles($searches, $tag, $days=31, $justFilter='N') {
		
		$this->getFeedsArticles();
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
						$outputData[$item_no]["title"] = $streamdata["title"];
						if (strpos($streamdata["originId"] , 'http') !== false) {
							$outputData[$item_no]["link"] = $streamdata["originId"];
						} else {
							$outputData[$item_no]["link"] = $streamdata["alternate"][0]["href"];
						}
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