<?php

namespace myfeeds;

ini_set("error_log", "../logs/BeerErrors.log");

class articlesFilter {
    private $servers      =  array();
    private $filter_keys  =  null;
    const   replaceChars  =  array('-', '|', ':', ';', '‘', '’', "'", '—', '…', '...', ' ', '/', 'brewbound', '.com', '&', '\u2013');

    function __construct($filter_keys) {
    	echo "\n<!-- [INSTANCIATE] => articlesFilter Class -->\n";
        $this->filter_keys  =  (is_array($filter_keys) ? $filter_keys : array($filter_keys) );
    }

    public static function replacables()
    {
        return self::replaceChars;
    }

    function bulkTagArticles($i) {
        /**
         * This class method is looking for the articles we want to tag in Feedly. Making it easy to find for other uses.
         * True -- Means we will be tagging this article and marking it as read.
         * False -- Means we are going to skip this article for our tagging function. 
         *    
         */
		$noKeeper = false;
        // echo "<!-- Searching Article:  ".$i['title']." -->\n"; 
        foreach ($this->filter_keys as $key => $value) {
        	if(stripos($i['title'], $value) !== false) { 
                // echo "<!-- Found Job Search Term = ".$value." -->\n"; 
        		$noKeeper = true;
        	}
        }
		return $noKeeper;
    }

    function bulkFilterArticles($i) {
        /**
         * This class method looks unwanted articles, by sending a boolean value to the callback function of the array_filter function. 
         * True -- Means keep the article in the array, so it can be marked as READ in the feedly feeds.
         * False -- Removes it from the results, thus not getting marked as READ in the feedly feeds. 
         */
        $noKeeper = true;
		// echo "<!-- Searching Article:  ".$i['title']." -->\n"; 
        foreach ($this->filter_keys as $key => $value) {
			if(stripos($i['title'], $value) !== false) {
				// echo "<!-- Found Beer Term = ".$value." -->\n"; 
				$noKeeper = false;
        	}
        }
        return $noKeeper;
    }

    function findAllDupeArticles($i) {
        /**
         * Looking through the entire listing of category articles for this is runduplicates.
         * The idea here is to have this class method is looking for the articles we don't want, 
         * by sending a boolean value back to the callback function from the array_filter function. 
         * True  -- Means this article IS A duplicate. This process will keep the article in the array, so it can marked READ.
         * False -- Means it is NOT a dupe. It'll be filtered out of the result set, and it will NOT be marked as READ. 
         */
		$isDupe = false;
		
        foreach ($this->filter_keys as $key => $value) {
			if ($i['id'] !=  $value['id']) {
                $sim_check = similar_text($i['title'], $value['title'], $similar_percentage);

                if  (str_replace(self::replaceChars, '', strtolower($i['title'])) === str_replace(self::replaceChars, '', strtolower($value['title']))) { 
		    		$isDupe = true;
					echo "<!--                     Is Dupe: ".$value['title']." -->\n"; 
					echo "<!--          Setting \$isDupe as: "; var_export($isDupe); echo " -->\n"; 

                } elseif ( $similar_percentage >= 80 ) {
                    /* Some of the feedly duped articles have very similar text, and I want to exclude these articles, too. */
                        $isDupe = true;
                        echo "<!--  \$value is ".round($similar_percentage)."% Similar Text: ".$value['title']." -->\n"; 
                        echo "<!--          Setting \$isDupe as: "; var_export($isDupe); echo " -->\n"; 

	        	}  elseif (stripos($i['title'], ' - ') == true) {
                    /* Some of the feedly duped articles only have different text after the dash separator, and I want to exclude these articles, too. */
                    if ( substr($i['title'], 0, stripos($i['title'], ' - ')) == substr($value['title'], 0, stripos($i['title'], ' - ')) ) {
                        $isDupe = true;
                        echo "<!--       \$value is a DASH Dupe: ".$value['title']." -->\n"; 
                        echo "<!--          Setting \$isDupe as: "; var_export($isDupe); echo " -->\n"; 
                    } 

                } elseif (stripos($i['title'], ' | ')  == true) {
                    /* Some of the feedly duped articles only have different text after the vertical bar separator, and I want to exclude these articles, too. */
                    if ( substr($i['title'], 0, stripos($i['title'], ' | ')) == substr($value['title'], 0, stripos($i['title'], ' | ')) ) {
                        $isDupe = true;
                        echo "<!-- \$value is vertical bar Dupe: ".$value['title']." -->\n"; 
                        echo "<!--          Setting \$isDupe as: "; var_export($isDupe); echo " -->\n"; 
                    }
                }
	        }
        }
		return $isDupe;
    }
}

?>