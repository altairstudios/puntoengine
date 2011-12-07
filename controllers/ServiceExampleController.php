<?php
/**
 * Source code of ServiceExampleController class controller
 * @category puntoengine
 * @package controllers
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * ServiceExampleController is a controller class of the many examples
 * @category puntoengine
 * @package controllers
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class ServiceExampleController extends ServiceController {
	/**
	 * Other action method
	 * @return array Test array data
	 */
	public function otherAction() {
		//Process the action, connect to database, etc
		$ex = array( 'test', 'other' => 'value', 'list' => array('juas juas', 'other other') );

		return $ex;
	}//otherAction


	/**
	 * Other action method
	 * @param string $test Test parameter
	 * @return array Test array data
	 */
	public function paramAction($test) {
		//Process the action, connect to database, etc
		$ex = array( 'test', 'other' => 'value', 'list' => array('juas juas', 'other other'), $test );

		return $ex;
	}//otherAction
}//ServiceExampleController