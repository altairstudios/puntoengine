<?php
/**
 * Source code of PitaView class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaView is a base view of pita engine
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaView extends Object {
	/**
	 * PitaDocument to add the elements
	 * @var PitaDocument
	 * @since 0.5.0
	 */
	protected $document;



	/**
	 * Generic request
	 * @var HttpRequest
	 * @since 0.5.0
	 */
	protected $request;



	/**
	 * Generic controller
	 * @var HttpController
	 * @since 0.5.0
	 */
	protected $controller;



	/**
	 * Default constructor
	 * @since 0.5.0
	 */
	public function __construct() {
		$this->document = new PitaDocument();
	}//__construct



	/**
	 * Set the generic request
	 * @param HttpRequest $request Generic request
	 * @since 0.5.0
	 */
	public function setRequest( HttpRequest $request ) {
		$this->request = $request;
	}//setRequest



	/**
	 * Set the generic controller
	 * @param HttpController $controller Generic controller
	 * @since 0.5.0
	 */
	public function setController( HttpController $controller ) {
		$this->controller = $controller;
	}//setRequest



	/**
	 * Add elements to document
	 * @param PitaObject $object Element to add
	 * @since 0.5.0
	 */
	protected function add( PitaObject $object ) {
		$this->document->add( $object );
	}//add



	/**
	 * Render the view
	 * @return string Html of the view
	 * @since 0.5.0
	 */
	public function render() {
		return $this->document->render();
	}//render
}//PitaView