<?php
/**
 * Source code of HttpWebConnection class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * HttpRequest is a class to connect same a robot o crawler to other page
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class HttpWebConnection {
	/**
	 * Url to connect it
	 * @var string
	 * @since 0.3
	 */
	private $url;



	/**
	 * Useragent to identify the crawler
	 * @since 0.3
	 */
	private $userAgent = 'puntoengine (crawler)';



	/**
	 * Default constructor
	 * @since 0.3
	 */
	public function __construct() {
	}//__construct



	/**
	 * Set the url to connect it
	 * @param string $url Url to connect the crawler
	 * @since 0.3.0
	 */
	public function setUrl($url) {
		$this->url = $url;
	}//setUrl



	/**
	 * Connect to the url with the data previusly indicated and return the
	 * content of the page connection same a browser
	 * @return string Page result of the connection
	 * @since 0.3.0
	 */
	public function connect() {
		$curlResource = curl_init();

		curl_setopt($curlResource, CURLOPT_URL, $this->url);
		curl_setopt($curlResource, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlResource, CURLOPT_USERAGENT, $this->userAgent);

		$response = curl_exec($curlResource);

		curl_close($curlResource);

		return $response;
	}//connect
}//HttpWebConnection