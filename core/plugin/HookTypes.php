<?php
/**
 * Source code of puntoengine HookTypes
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 * @license: GPLv3 or above
 */



/**
 * HookTypes are a constants used same a enumerator
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 */
class HookTypes {
	/**
	 * Hook launched in the last process of exception (when draw the error page)
	 * @since 0.3.0
	 */
	const CALL_PROCESS_EXCEPTION = 'CALL_PROCESS_EXCEPTION';



	/**
	 * Hook launched when redirect
	 * @since 0.3.0
	 */
	const CALL_SEND_REDIRECT = 'CALL_SEND_REDIRECT';



	/**
	 * Hook launched when not implemented the GET request and his is called
	 * @since 0.3.0
	 */
	const CALL_DO_BASE_GET = 'CALL_DO_BASE_GET';



	/**
	 * Hook launched when not implemented the POST request and his is called
	 * @since 0.3.0
	 */
	const CALL_DO_BASE_POST = 'CALL_DO_BASE_POST';



	/**
	 * Hook launched when not implemented the SERVICE request and his is called
	 * @since 0.3.0
	 */
	const CALL_DO_BASE_SERVICE = 'CALL_DO_BASE_SERVICE';
}//HookTypes