<?php
/**
 * Source code of ExampleController class controller
 * @category puntoengine
 * @package controllers
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * ExampleController is a controller class of the many examples
 * @category puntoengine
 * @package controllers
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class ExampleController extends WebController {
	/**
	 * Master page
	 * @var string
	 */
	protected $master = 'example/master.php';



	/**
	 * Default action method
	 */
	public function defaultAction() {
		//Process the action, connect to database, etc
	}//defaultAction



	/**
	 * Other action method
	 */
	public function otherAction() {
		//Process the action, connect to database, etc
	}//otherAction



	/**
	 * Pita action method
	 */
	public function pitaAction() {
		//Process the action, connect to database, etc
	}//otherAction
}//ExampleController