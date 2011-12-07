<?php
/**
 * Source code of XmlException class
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * XmlException class is the exception base xml manipulations errors
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class XmlException extends CoreException {
	/**
	 * XmlException construct
	 * @param int $code Exception code
	 * @param string $message Exception base message
	 * @since 0.1.1
	 */
	public function __construct($code, $message) {
		if($code == ExceptionCodes::XML_NODENOTFOUND) {
			$message = 'Node not found: '.$message;
		}

		parent::__construct($code, $message);
	}//__construct
}//XmlException