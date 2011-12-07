<?php
/**
 * Source code of ExceptionCodes class
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * ExceptionCodes is a class who have the constant codes of all exceptions
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class ExceptionCodes {
	/**
	 * General core exception. Throws if don't have a exception code for
	 * your exception or when throw a undetected error
	 * @since 0.1.1
	 */
	const CORE_EXCEPTION = 1001;



	/**
	 * Not implemented exception. Throws when declare a method, function,
	 * or functionality but it's not implemented yet.
	 * @since 0.1.1
	 */
	const CORE_NOTIMPLEMENTED = 1002;



	/**
	 * Dynamic exception that throws when class not found, for example when
	 * call a servlet and don't exist
	 * @since 0.1.1
	 */
	const CORE_CLASSNOTFOUND = 1003;



	/**
	 * File not found exception. Throws when load a file and it don't exists
	 * @since 0.1.1
	 */
	const IO_NOTFOUND = 1101;



	/**
	 * Xml exception, when load a node that don't exists
	 * @since 0.1.1
	 */
	const XML_NODENOTFOUND = 1201;
}//ExceptionCodes