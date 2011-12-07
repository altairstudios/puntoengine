<?php
/**
 * Source code of puntoengine PluginManager
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 * @license: GPLv3 or above
 */



/**
 * PluginManager are a class to manage the diferents hooks in the framework to
 * are catched by plugins loaded
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 */
class PluginManager {
	/**
	 * List of all loaded hooks
	 * @var array<Hook>
	 * @since 0.3.0
	 */
	private $hookList = array();



	/**
	 * Singleton instance of HookManager
	 * @var PluginManager
	 * @since 0.3.0
	 */
	private static $instance;



	/**
	 * Private contruct for singleton
	 * @since 0.3.0
	 */
	private function __construct() {
	}//__construct



	/**
	 * Return the unique (singleton) instance of class PluginManager
	 * @return PluginManager Instance of PluginManager
	 * @since 0.3.0
	 */
	public static function instance() {
		if(self::$instance == null) {
			self::$instance = new PluginManager();
		}

		return self::$instance;
	}//instance



	/**
	 * Add a new hook to PluginManager
	 * @param Hook $hook New hook
	 * @since 0.3.0
	 */
	public function addHook(Hook $hook) {
		$this->hookList[$hook->getHookType()][] = $hook;
	}//addHook



	/**
	 * Execute any hooks of this type
	 * @param string $hookType Type of hook
	 * @param array $data Parameters in a array
	 * @return mixed Modified result
	 * @see HookTypes
	 * @since 0.3.0
	 */
	public function executeHook($hookType, $parameters) {
		if(isset($this->hookList[$hookType])) {
			for($i = 0; $i < count($this->hookList[$hookType]); $i++) {
				$data['results'] = call_user_func_array($this->hookList[$hookType][$i]->getCallback(), $parameters);
			}
		}

		if(isset($data['results'])) {
			return $data['results'];
		} else {
			return null;
		}
	}//executeHook
}//HookManager