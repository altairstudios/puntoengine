<?php
/**
 * Source code of puntoengine Plugin Base class
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 * @license: GPLv3 or above
 */



/**
 * Plugin base of the puntoengine application who extends all plugins
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 */
abstract class Plugin {
	/**
	 * List of hooks
	 * @var array
	 * @since 0.3.0
	 */
	protected $hookList = array();



	/**
	 * Default constructor
	 * @since 0.3.0
	 */
	public function __construct() {
	}//__construct



	/**
	 * Return all declared hooks
	 * @return array All declared hooks
	 * @since 0.3.0
	 */
	public function getHookList() {
		return $this->hookList;
	}//getHookList



	/**
	 * Define in the childs all available hooks
	 * @since 0.3.0
	 */
	abstract public function declareHooks();
}//Plugin