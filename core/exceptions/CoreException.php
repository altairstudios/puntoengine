<?php
/**
 * Source code of CoreException class
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * CoreException as the base exception of puntoengine
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class CoreException extends Exception {
	/**
	 * Default constructor. Inidates all params to trace the error.
	 * @param int $code Exception code
	 * @param string $message Exception message
	 * @param string $file File who throws the exception
	 * @param int $line Line where generate the error
	 * @param array $context Variables context when the exception was throw
	 * @since 0.1.1
	 */
	public function __construct($code, $message, $file = null, $line = null, $context = null) {
		parent::__construct($message, $code);
	}//__construct
}//CoreException