<?php
/**
 * Source code of PitaDocument class
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * PitaDocument is the base document of pita where add all controls
 * @category puntoengine
 * @package core
 * @subpackage pita
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class PitaDocument extends PitaObject {
	/**
	 * Render the element
	 * @return string Html of the element
	 * @since 0.5.0
	 * @todo implement html language
	 * @todo implement html manifest
	 * @todo implement title
	 * @todo implement scripts
	 * @todo implement css
	 */
	public function render() {
		$html = '';
		$countChilds = count( $this->childs );

		$html .= $this->tabs( 1 ) . '<!DOCTYPE html>' . "\n";
		$html .= $this->tabs( 1 ) . '<html lang="es">' . "\n";
		$html .= $this->tabs( 2 ) . '<head>' . "\n";
		$html .= $this->tabs( 3 ) . '<meta charset="utf-8" />' . "\n";
		$html .= $this->tabs( 3 ) . '<title>PITA render page of PuntoEngine</title>' . "\n";
		$html .= $this->tabs( 3 ) . '<link href="~/core/resources/pita/css/pita.css" rel="stylesheet" type="text/css" media="all" />' . "\n";
		$html .= $this->tabs( 2 ) . '</head>' . "\n";
		$html .= $this->tabs( 2 ) . '<body>' . "\n";
		$html .= $this->tabs( 3 ) . '<div id="wrapper">' . "\n";

		for( $i = 0; $i < $countChilds; $i++ ) {
			$html .= $this->childs[ $i ]->render( 4 );
		}

		$html .= $this->tabs( 3 ) . '</div>' . "\n";
		$html .= $this->tabs( 2 ) . '</body>' . "\n";
		$html .= $this->tabs( 1 ) . '</html>' . "\n";

		return $html;
	}//render
}//PitaDocument