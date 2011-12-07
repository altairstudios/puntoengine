<?php
/**
 * Source code of HttpMethods class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * HttpMethods is a enumeration class with the types of the diferent connection
 * method at the server via http protocol
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class HttpMethods {
	/**
	 * GET method is a convencional connection method
	 * @since 0.3.0
	 */
	const GET = 'GET';



	/**
	 * POST method is a form submition connection
	 * @since 0.3.0
	 */
	const POST = 'POST';



	/**
	 * SERVICE method is a xml webservice connection
	 * @since 0.3.0
	 */
	const SERVICE = 'SERVICE';
}//HttpMethods