<?php
/**
 * Source code of ServiceResponse class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * ServiceResponse is a response for the Controller.
 * ServiceResponse can set the response xml
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class ServiceResponse extends HttpResponse {
	/**
	 * Type of xml content
	 * @var string
	 * @since 0.5.0
	 */
	protected $type = 'xml';



	/**
	 * Process the response and generate the service response
	 * @param HttpRequest $request Request page params
	 * @since 0.5.0
	 * @todo change the header to kernel
	 */
	public function process(HttpRequest $request) {
		header('content-type: text/xml');

		$tag = ucfirst($this->action);

		$xml = '<' . $tag . '>';
		$xml .= XmlSerialize::serialize($this->response);
		$xml .= '</' . $tag . '>';

		echo $xml;
	}//process
}//ServiceResponse