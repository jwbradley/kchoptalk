<?php
/**
 * BufferPHP v0.1
 *
 * See http://www.little-apps.org/blog/2012/09/automatically-post-updates-buffer-api-php/ for an example on how to use this class
 * Information on the Buffer API can be found at http://bufferapp.com/developers/api
 *
 * @package	BufferPHP
 * @author		Little Apps (http://www.little-apps.org)
 * @copyright   This is public domain so anyone can use it for any reason
 * @link		http://little-apps.org
 * @since		Version 0.1
 * @filesource
 */

if (!function_exists('curl_init')) {
  throw new Exception('BufferPHP needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('BufferPHP needs the JSON PHP extension.');
}

class BufferPHP {
	// You can change the options below if you wish
	private $config = array(
						'user_agent' => 'BufferPHP v0.1', // The user agent to send to the Buffer API
						'connect_timeout' => 30, // Maximum time to wait (in seconds) before connect fails
						'timeout' => 30, // Maximum time to wait (in seconds) before API doesnt respond
						'verify_ssl_cert' => false // This is false by default because some servers have trouble verifing SSL certificates through cURL
						);
						
	// You should only change the code below if you know what you're doing!
	
	/**
     * @var string Access token
     */
	private $access_token = '';
	
	/**
     * @var string Base URL for API 
     */
	private $base_url = 'https://api.bufferapp.com/1/';
	
	/**
     * @var array HTTP headers from last request
     */
	public $http_header = array();
	/**
     * @var array Info about last cURL request
     */
	public $http_info = array();
	/**
     * @var string The last URL used
     */
	public $last_url = '';

	/**
	 * Class constructor
	 * (Throws InvalidArgumentException if $token is not a string)
	 *
	 * @param string $token Access Token for app
	 */
	function __construct($token) {
		if (is_string($token)) {
			$this->access_token = $token;
		} else {
			throw new InvalidArgumentException('token must be a string');
		}
	}
	
	/**
	 * Sends GET request to Buffer API
	 *
	 * @access public
	 *
	 * @param string $uri Endpoint to send data to (usually something like 'updates/create')
	 * @param array $data Data to send to API. See API documentation for the parameters.
	 *
	 * @return class Returns a stdClass containing decode JSON data
	 */
	public function get($uri, $data = array()) {
		if (is_array($data) && count($data) > 0) {
			$query = http_build_query($data);
		}
	
		return $this->api('get', $this->base_url . $uri, $query);
	}
	
	/**
	 * Sends POST request to Buffer API
	 *
	 * @access public
	 *
	 * @param string $uri Endpoint to send data to (usually something like 'updates/create')
	 * @param array $data Data to send to API. See API documentation for the parameters.
	 *
	 * @return class Returns a stdClass containing decode JSON data
	 */
	public function post($uri, $data = array()) {
		if (is_array($data) && count($data) > 0) {
			$query = http_build_query($data);
		}
		
		return $this->api('post', $this->base_url . $uri, $query);
	}
	
	/**
	 * Sends HTTP request to Buffer API
	 *
	 * @access private
	 *
	 * @param string $method Method to use to send data (post or get)
	 * @param string $uri URL for where to send data
	 * @param string $query_string Query string to pass to server (default is empty)
	 *
	 * @return class Returns a stdClass containing decode JSON data
	 */
	private function api($method, $uri, $query_string = '') {
		if (preg_match('/\.json$/', $uri) == 0)
			$uri .= '.json';
			
		$this->http_info = array();
		
		// $query_string .= 'count=30';
		$query_string .= 'count=100';

		$ci = curl_init();
		/* Curl settings */
		curl_setopt($ci, CURLOPT_USERAGENT, $this->config['user_agent']);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->config['connect_timeout']);
		curl_setopt($ci, CURLOPT_TIMEOUT, $this->config['timeout']);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:', 'Authorization: Bearer ' . $this->access_token));
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->config['verify_ssl_cert']);
		curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
		curl_setopt($ci, CURLOPT_HEADER, 0);

		if ($method == 'post') {
			curl_setopt($ci, CURLOPT_POST, TRUE);
			if (!empty($query_string)) {
				curl_setopt($ci, CURLOPT_POSTFIELDS, $query_string);
			}
		} else if ($method == 'get' && !empty($query_string)) {
			$uri = $uri . '?' . $query_string;
		}

		curl_setopt($ci, CURLOPT_URL, $uri);
		$response = curl_exec($ci);

		$this->http_info = array_merge($this->http_info, curl_getinfo($ci));
		$this->last_url = $uri;
		
		curl_close ($ci);
		
		// echo "<!-- ";
		// var_dump($response);
		// echo "  -->";
		return json_decode($response, true);
		// return $response;
	}
	
	/**
	 * Used to save HTTP header of last request
	 *
	 * @access private
	 *
	 * @param resource $ch cURL handler
	 * @param string HTTP header
	 *
	 * @return int Returns length of header
	 */
	private function getHeader($ch, $header) {
		$i = strpos($header, ':');
		if (!empty($i)) {
			$key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
			$value = trim(substr($header, $i + 2));
			$this->http_header[$key] = $value;
		}
		return strlen($header);
	}
}

class CurlResponse
{
    var $headers = array();
    function parse_header ($handle, $header)
    {
        $details = split(':', $header, 2);
        if (count($details) == 2) {
            $key   = trim($details[0]);
            $value = trim($details[1]);

            $this->headers[$key] = $value;
        }
        return strlen($header);
    }
}

class ecsclass {
	function __construct($auth, $debug="N") {
		$this->debug  = $debug;
		$this->auth   = $auth;
	}

	function ecs_curl() {
		$this->read_cURL = curl_init();

		curl_setopt_array($this->read_cURL, array( CURLOPT_RETURNTRANSFER => true,
                                                   CURLOPT_URL            => $this->url,
                                                   CURLOPT_CONNECTTIMEOUT => $timeout,
                                                   CURLOPT_TIMEOUT        => $timeout,
                                                   CURLOPT_USERAGENT      => 'BPS Hosting wiki Server BPSClass.php AWDCLIENT class.'
                                                   ));
        $ret_cURL = curl_exec($this->read_cURL);

		return $ret_cURL;

	}

	function ecs_token($url) {
		$this->url = $url;
		$this->response  =  new  CurlResponse($this->url, $this->auth);

		$ch        =  curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->auth);
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, array(&$this->response, 'parse_header'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);

		$this->token_AUTH  = array('cache-control: no-cache', 'x-sds-auth-token: '.trim($this->response->headers["X-SDS-AUTH-TOKEN"]));
		$this->token_AUTH2 = array('cache-control: no-cache', 'x-sds-auth-token: '.trim($this->response->headers["X-SDS-AUTH-TOKEN"]), 'Content-Type: application/json');
		return $this->response;
	}

	function ecs_multi_curl($ecs_URL) {

		// initialize the multihandler
		$mh = curl_multi_init();

		$this->channels = array();
		foreach ($ecs_URL as $key => $url) {

		    // initiate individual channel
		    $this->channels[$key] = curl_init();
		    curl_setopt_array($this->channels[$key], array(
		        CURLOPT_URL => $url,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_SSL_VERIFYPEER => false,

		        CURLOPT_HTTPHEADER => $this->token_AUTH
		    ));

		    // add channel to multihandler
		    curl_multi_add_handle($mh, $this->channels[$key]);
		}

		// execute - if there is an active connection then keep looping
		$this->active = null;
		do {
		    curl_multi_exec($mh, $this->active);
		    curl_multi_select($mh);
		}
		while ($this->active > 0 );
	}

}

