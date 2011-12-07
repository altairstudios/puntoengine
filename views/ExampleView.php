<?php
/**
 * Source code of ExampleView class
 * @category puntoengine
 * @package views
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * ExampleView is a view class of the ExampleController
 * @category puntoengine
 * @package views
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class ExampleView extends PitaView {
	/**
	 * Pita render method
	 */
	public function pitaRender() {
		$this->add( new PitaHeader() );
		$this->add( new PitaNavigation() );
		$this->add( new PitaFooter() );
	}//pitaRender
}//ExampleView