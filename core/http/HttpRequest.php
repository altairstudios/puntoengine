<?php
/**
 * Source code of HttpRequest class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * HttpRequest is a request class of the connection process. When a user
 * connect to a page, all request GET, POST, XML and SESSION parameters is
 * envolved in this class to access more simply.
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class HttpRequest extends Object {
	/**
	 * Request parameters
	 * @var array
	 * @since 0.3.0
	 */
	private $params;



	/**
	 * Session parameters
	 * @var array
	 * @since 0.3.0
	 */
	private $session;



	/**
	 * Returns a param value by the key
	 * @param string $name Key of the param
	 * @return mixed Value of the param
	 * @since 0.3.0
	 */
	public function getParam($name) {
		if(isset($this->params[$name])) {
			return $this->params[$name];
		} else {
			return null;
		}
	}//getParam



	/**
	 * Set the param array
	 * @param array $params Array of params to stablish in the request
	 * @since 0.3.0
	 */
	public function setParams($params) {
	$this->params = $params;
	}//setParams



	/**
	 * Returns a session param by the key
	 * @param string $name Key of the session param
	 * @return string Value of the session param
	 * @since 0.3.0
	 */
	public function getSession($name) {
		if(isset($this->session[$name])) {
			return $this->session[$name];
		} else {
			return null;
		}
	}//getSession



	/**
	 * Set the session param array
	 * @param array $session Array of session params to stablish in the request
	 * @since 0.3.0
	 */
	public function setSession($session) {
		$this->session = $session;
	}//setSession



	/**
	 * Add a new session param
	 * @param string $key Key of the session param
	 * @param string $value Value of the session param
	 * @since 0.3.0
	 */
	public function addSession($key, $value) {
		$this->session[$key] = $value;
		$_SESSION[$key] = $value;
	}



	/**
	 * Remove a session param
	 * @param string $key Key of the session param to remove it
	 * @since 0.3.0
	 */
	public function removeSession($key) {
		if(isset($this->session[$key])) {
			unset($this->session[$key]);
		}
		if(isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}



	/**
	 * Add new param
	 * @param string $key Key of the param
	 * @param mixed $value Value of the param
	 * @since 0.3.0
	 */
	public function addParam($key, $value) {
		$this->params[$key] = $value;
	}
}//HttpRequest