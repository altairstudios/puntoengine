<?php
/**
 * Source code of NotImplementedException class
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * NotImplementedException class is the exception base from not implemented
 * functionalities in the code
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class NotImplementedException extends CoreException {
	/**
	 * NotImplementedException construct
	 * @param string $method Method that not implemented yet.
	 * @since 0.1.1
	 */
	public function __construct($method) {
		$message = 'Method not implemented: '.$method;
		$code = ExceptionCodes::CORE_NOTIMPLEMENTED;

		parent::__construct($code, $message);
	}//__construct
}//NotImplementedException