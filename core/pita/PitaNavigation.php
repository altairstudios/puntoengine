<?php
/**
 * Source code of PitaNavigation class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaNavigation is the navigation panel menu
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaNavigation extends PitaObject {
	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 * @todo support for add link childs elements
	 */
	public function render( $level = 1 ) {
		$html = '';

		$html .= $this->tabs( $level ) . '<nav>' . "\n";
		$html .= $this->tabs( $level + 1 ) . '<ul>' . "\n";
		$html .= $this->tabs( $level + 2 ) . '<li>' . "\n";
		$html .= $this->tabs( $level + 3 ) . '<a href="~/">home</a>' . "\n";
		$html .= $this->tabs( $level + 2 ) . '</li>' . "\n";
		$html .= $this->tabs( $level + 1 ) . '</ul>' . "\n";
		$html .= $this->tabs( $level ) . '</nav>' . "\n";

		return $html;
	}//render
}//PitaNavigation