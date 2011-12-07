<?php
/**
 * Source code of WebController class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * WebController is a base web controller class.
 * The web controller who are the web request, have a differents methods
 * to catch the differents types of request and others utilities methods
 * same throw error, load a template or redirect to other page.
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class WebController extends HttpController {
	/**
	 * Masterpage for the request
	 * @var string
	 * @since 0.5.0
	 */
	protected $master;



	/**
	 * Return the master page
	 * @return string Master page
	 * @since 0.5.0
	 */
	public function getMasterPage() {
		return $this->master;
	}//getMasterPage



	/**
	 * Set the master page
	 * @param string Master page
	 * @since 0.5.0
	 */
	public function setMasterPage($masterpage) {
		$this->master = $masterpage;
	}//setMasterPage



	/**
	 * Set the response
	 * @param HttpResponse $response Request response
	 * @since 0.5.0
	 */
	public function setResponse($response) {
		$response->setMasterPage($this->master);
		parent::setResponse($response);
	}//setResponse



	/**
	 * Return the request response
	 * @return WebResponse Request response
	 * @since 0.5.0
	 */
	public function getResponse() {
		if($this->response === null) {
			$this->response = new WebResponse();
		}
		return $this->response;
	}//getResponse
}//HttpController