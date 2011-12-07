<?php
/**
 * Source code of IOExcpetion class
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * IOException class is the exception base from input/ouput error same
 * load a file that not exist, write a file without permissons, etc.
 * @category puntoengine
 * @package core
 * @subpackage exceptions
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class IOException extends CoreException {
	/**
	 * IOException construct
	 * @param int $code Exception code
	 * @param string $file File that have a exception (the file load, write, etc).
	 * @since 0.1.1
	 */
	public function __construct($code, $file) {
		$message = '';

		if($code == ExceptionCodes::IO_NOTFOUND) {
			$message = 'File not found: '.$file;
		}

		parent::__construct($code, $message);
	}//CoreException
}//IOException