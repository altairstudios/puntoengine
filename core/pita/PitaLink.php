<?php
/**
 * Source code of PitaLink class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaLink is link anchor
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaLink extends PitaObject {
	/**
	 * Name of link
	 * @var string
	 * @since 0.5.0
	 */
	protected $name = null;



	/**
	 * Link of anchor
	 * @var string
	 * @since 0.5.0
	 */
	protected $link = null;



	/**
	 * Set the name
	 * @param string $name Name of link
	 * @since 0.5.0
	 */
	public function setName( $name ) {
		$this->name = $name;
	}//setName



	/**
	 * Set the link
	 * @param string $subtitle Header subtitle
	 * @since 0.5.0
	 */
	public function setLink( $link ) {
		$this->link = $link;
	}//setLink



	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 */
	public function render( $level = 1 ) {
		$html = '';
		$name = ( $this->name != null ) ? $this->name : '&nbsp;';
		$link = ( $this->link != null ) ? $this->link : '#';

		$html .= $this->tabs( $level ) . '<a href="' . $link . '">' . "\n";
		$html .= $this->tabs( $level + 1 ) . $name . "\n";
		$html .= $this->tabs( $level ) . '</a>' . "\n";

		return $html;
	}//render
}//PitaDocument