<?php
/**
 * Source code of ServiceController class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * ServiceController is a webservice base controller class.
 * The controller who are the xml request, have a differents methods
 * to catch the differents types of request and others utilities methods
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class ServiceController extends HttpController {
	/**
	 * Return the request response
	 * @return ServiceResponse Request response
	 * @since 0.5.0
	 */
	public function getResponse() {
		if($this->response === null) {
			$this->response = new ServiceResponse();
		}
		return $this->response;
	}//getResponse



	/**
	 * Default action in service is a index of service methods for user view
	 * @since 0.5.0
	 */
	public function defaultAction() {
		$services = $this->getActions();
		$this->request->addParam( 'services', $services );

		$this->response = new WebResponse();
		$this->response->setProcessView(false);
		$this->response->setController( $this );
		$this->response->setRenderer( 'ServiceRenderView', 'homeRender' );
	}//defaultAction
}//ServiceController