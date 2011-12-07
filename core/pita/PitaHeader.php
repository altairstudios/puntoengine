<?php
/**
 * Source code of PitaHeader class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaHeader is the header of page with the title
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaHeader extends PitaObject {
	/**
	 * Title of header
	 * @var string
	 * @since 0.5.0
	 */
	protected $title = null;



	/**
	 * Subtitle of header
	 * @var string
	 * @since 0.5.0
	 */
	protected $subtitle = null;



	/**
	 * Set the title
	 * @param string $title Header title
	 * @since 0.5.0
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}//setTitle



	/**
	 * Set the subtitle
	 * @param string $subtitle Header subtitle
	 * @since 0.5.0
	 */
	public function setSubtitle( $subtitle ) {
		$this->subtitle = $subtitle;
	}//setSubtitle



	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 * @todo add support for first title
	 * @todo add support for second title
	 */
	public function render( $level = 1 ) {
		$html = '';

		$html .= $this->tabs( $level ) . '<header>' . "\n";
		$html .= $this->tabs( $level + 1 ) . '<hgroup>' . "\n";

		if( $this->title != null ) {
			$html .= $this->tabs( $level + 2 ) . '<h1>' . $this->title . '</h1>' . "\n";
		}

		if( $this->subtitle != null ) {
			$html .= $this->tabs( $level + 2 ) . '<h2>' . $this->subtitle . '</h2>' . "\n";
		}

		$html .= $this->tabs( $level + 1 ) . '</hgroup>' . "\n";
		$html .= $this->tabs( $level ) . '</header>' . "\n";

		return $html;
	}//render
}//PitaDocument