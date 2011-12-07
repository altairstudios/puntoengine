<?php
/**
 * Source code of PitaObject class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaObject is the base object of pita engine
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
abstract class PitaObject extends Object {
	/**
	 * Child elements attached to this element
	 * @var array
	 * @since 0.5.0
	 */
	protected $childs = array();



	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 */
	public abstract function render();



	/**
	 * Add elements to document
	 * @param PitaObject $object Element to add
	 * @since 0.5.0
	 */
	public function add( PitaObject $object ) {
		$this->childs[] = $object;
	}//add



	/**
	 * Render tab level
	 * @param int $level Tab level
	 * @return string Concat tabs
	 * @since 0.5.0
	 */
	protected function tabs( $level ) {
		$tabs = '';
		$tab = "\t";

		for( $i = 1; $i < $level; $i++ ) {
			$tabs .= $tab;
		}

		return $tabs;
	}//tabs
}//PitaObject