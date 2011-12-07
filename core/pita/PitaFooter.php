<?php
/**
 * Source code of PitaFooter class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaFooter is the footer of page
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaFooter extends PitaObject {
	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 * @todo add support for first title
	 * @todo add support for second title
	 */
	public function render( $level = 1 ) {
		$html = '';

		$html .= $this->tabs( $level ) . '<footer>' . "\n";
		$html .= $this->tabs( $level + 1 ) . 'text' . "\n";
		$html .= $this->tabs( $level ) . '</footer>' . "\n";

		return $html;
	}//render
}//PitaFooter