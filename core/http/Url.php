<?php
/**
 * Source code of Url class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * Url class is a class to content and parse urls for puntoengine
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class Url extends Object {
	/**
	 * Url path
	 * @var string
	 */
	protected $url;



	/**
	 * Diferentes url parth separated in directories
	 * @var array
	 */
	protected $urlParts;



	/**
	 * Construct to specified the url to parse
	 * @param string $url Url to parse
	 * @since 0.4.0
	 */
	public function __construct($url) {
		$this->url = $url;

		$this->urlParts = explode('/', ((substr($url, 0, 1) == '/') ? substr($url, 1) : $url));

		unset($url);
	}//__construct



	/**
	 * Return the posibles controllers are content in the url
	 * @return array
	 * @since 0.4.0
	 */
	public function getControllers() {
		for( $i = 0; $i < count( $this->urlParts ); $i++ ) {
			$this->urlParts[ $i ] = preg_replace( '/\-([a-z]{1})/e', "strtoupper( '\\1' )", $this->urlParts[ $i ] );
		}

		if(count($this->urlParts) == 1 && $this->urlParts[0] == '') {
			return array('Home');
		}

		$controllers = array();

		for($i = count($this->urlParts) - 1; $i >= 0; $i--) {
			if($i == count($this->urlParts) - 1) {
				if(isset($this->urlParts[$i - 1]) && strpos($this->urlParts[$i], '.') === false && strpos($this->urlParts[$i - 1], '.') === false) {
					$controllers[] = $this->urlParts[$i - 1].'.'.$this->urlParts[$i];
				}
			} else if($i != count($this->urlParts) - 2) {
				if(isset($this->urlParts[$i + 1]) && strpos($this->urlParts[$i], '.') === false && strpos($this->urlParts[$i + 1], '.') === false) {
					$controllers[] = $this->urlParts[$i].'.'.$this->urlParts[$i + 1];
				}
			}

			$controllers[] = $this->urlParts[$i];
		}

		unset($i);

		return $controllers;
	}//getControllers
}//Url