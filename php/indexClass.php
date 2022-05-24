<?php


class beerIndexClass {
   
	/**
     * beerIndexClass v2.0
	 * Buffer API's.
	 * The Buffer API provides access to user's pending and sent updates, social media profiles, 
	 * scheduled times and more.
	 * 
	 * As of October 14th, 2019, Buffer no longer supports the registration of new developer 
	 * applications. Applications created prior to this date will retain access to the Buffer Publish API. 
	 * 
	 * @package	    beerIndexClass
	 * @author		James Bradley (kchoptalk.com)
	 * @copyright   If you find any of this useful. You are more than welcome to use it for your project.
	 * @link		https://kchoptalk.com
	 * @since		Version 0.1 back in 2012
	 * @filesource  
	 */

	private $buffrTokenStore = __dir__  . '/../../.kcb';

	public function __construct($debugFlag='N') {
		$this->debugger = $debugFlag;
		$this->loadTokens();
	}

    public function loadTokens () {
		echo ($this->debugger ? "\n<!-- [EXECUTE] => loadTokens -->\n" : '');

    	$tokenData = json_decode(file_get_contents($this->buffrTokenStore), true);

		$this->buffer_id     =  $tokenData["buff_id"];
		$this->buffer_twitt  =  $tokenData["buff_twitt"];
		$this->buffer_linkd  =  $tokenData["buff_linkd"];
		$this->buffer_insta  =  $tokenData["buff_insta"];
    }

}	

?>