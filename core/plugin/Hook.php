<?php
/**
 * Source code of puntoengine Hook
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 * @license: GPLv3 or above
 */



/**
 * Hook are a model class for the hooks
 * @category puntoengine
 * @package core
 * @subpackage plugin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3.0
 */
class Hook {
	/**
	 * Internal name of the hook (for logs)
	 * @var string
	 * @since 0.3.0
	 */
	private $name;



	/**
	 * Name of plugin who call this hook
	 * @var string
	 * @since 0.3.0
	 */
	private $plugin;



	/**
	 * Creation time of hook object
	 * @var int
	 * @since 0.3.0
	 */
	private $creationTime;



	/**
	 * Execution time of hook process
	 * @var int
	 * @since 0.3.0
	 */
	private $executionTime;



	/**
	 * Callback function who invoke when hook is called
	 * @var mixed
	 * @since 0.3.0
	 */
	private $callback;



	/**
	 * Type of hook
	 * @var string
	 * @see HookTypes
	 * @since 0.3.0
	 */
	private $hookType;



	/**
	 * Return the internal name of hook
	 * @return string Internal name of hook
	 * @since 0.3.0
	 */
	public function getName() {
		return $this->name;
	}//getName



	/**
	 * Set the internal name of hook
	 * @param string $name Internal name of hook
	 * @since 0.3.0
	 */
	public function setName($name) {
		$this->name = $name;
	}//setName



	/**
	 * Return the name of plugin that create this hook
	 * @return string Name of plugin
	 * @since 0.3.0
	 */
	public function getPlugin() {
		return $this->plugin;
	}//getPlugin



	/**
	 * Set the name of plugin that create this hook
	 * @param string $plugin Name of plugin
	 * @since 0.3.0
	 */
	public function setPlugin($plugin) {
		$this->plugin = $plugin;
	}//setPlugin



	/**
	 * Return the creation time of hook
	 * @return int Creation time of hook
	 * @since 0.3.0
	 */
	public function getCreationTime() {
		return $this->creationTime;
	}//getCreationTime



	/**
	 * Set the creation time of hook
	 * @param int $creationTime Creation time of hook
	 * @since 0.3.0
	 */
	public function setCreationTime($creationTime) {
		$this->creationTime = $creationTime;
	}//setCreationTime



	/**
	 * Return the execution time of hook
	 * @return int Execution time of hook
	 * @since 0.3.0
	 */
	public function getExecutionTime() {
		return $this->executionTime;
	}//getExecutionTime



	/**
	 * Set the execution time of hook
	 * @param int $executionTime Execution time of hook
	 * @since 0.3.0
	 */
	public function setExecutionTime($executionTime) {
		$this->executionTime = $executionTime;
	}//setExecutionTime



	/**
	 * Return the callback object
	 * @return mixed Callback object
	 * @since 0.3.0
	 */
	public function getCallback() {
		return $this->callback;
	}//getCallback



	/**
	 * Set the callback object
	 * @param mixed $callback Callback object
	 * @since 0.3.0
	 */
	public function setCallback($callback) {
		$this->callback = $callback;
	}//setCallback



	/**
	 * Return the type of this hook
	 * @return string Type of hook
	 * @see HookTypes
	 * @since 0.3.0
	 */
	public function getHookType() {
		return $this->hookType;
	}//getHookType



	/**
	 * Set the type of hook
	 * @param string $hookType
	 * @see HookTypes
	 * @since 0.3.0
	 */
	public function setHookType($hookType) {
		$this->hookType = $hookType;
	}//setHookType
}//Hook