<?php


class beerIndexClass {
   
	/**
	 * Buffer REST API's.
	 * 
	 * 
	 */


	private $buffrTokenStore = __dir__  . '/../../.kcb';

	public function __construct($debugFlag) {
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