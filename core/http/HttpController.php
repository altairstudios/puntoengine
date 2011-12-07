<?php
/**
 * Source code of HttpController class
 * @category puntoengine
 * @package core
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * HttpController is a base controller class.
 * The controller who are the request, have a differents methods
 * to catch the differents types of request and others utilities methods
 * same throw error, load a template or redirect to other page.
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class HttpController extends Object {
	/**
	 * Response for the web request
	 * @var HttpResponse
	 * @since 0.4.0
	 */
	protected $response;



	/**
	 * Request called
	 * @var HttpRequest
	 * @since 0.5.0
	 */
	protected $request;



	/**
	 * Return the request response
	 * @return HttpResponse Request response
	 * @since 0.4.0
	 */
	public function getName() {
		return substr( get_class( $this ), 0, -10 );
	}//getResponse



	/**
	 * Return the request response
	 * @return HttpResponse Request response
	 * @since 0.4.0
	 */
	public function getResponse() {
		if($this->response === null) {
			$this->response = new HttpResponse();
		}
		return $this->response;
	}//getResponse



	/**
	 * Set the response
	 * @param HttpResponse $response Request response
	 * @since 0.4.0
	 */
	public function setResponse($response) {
		$this->response = $response;
	}//setResponse



	/**
	 * Set the request
	 * @param HttpRequest $request Request
	 * @since 0.4.0
	 */
	public function setRequest($request) {
		$this->request = $request;
	}//setRequest



	/**
	 * Return the request
	 * @return HttpRequest Request
	 * @since 0.4.0
	 */
	public function getRequest() {
		if($this->request === null) {
			$this->request = new HttpRequest();
		}
		return $this->request;
	}//getRequest



	/**
	 * Get the action in the controller
	 * @return array
	 * @since 0.5.0
	 */
	public function getActions() {
		$reflex = new ReflectionObject($this);

		$methods = $reflex->getMethods();

		$methodsCount = count($methods);
		$services = array();

		for($i = 0; $i < $methodsCount; $i++) {
			$method = $methods[$i];
			$name = $method->getName();
			if(substr($name, -6, 6) == 'Action') {
				$services[] = $name;
			}
		}

		return $services;
	}//getActions
}//HttpController