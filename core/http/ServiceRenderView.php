<?php
/**
 * Source code of ServiceRenderView class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * ServiceRenderView is a special view for webservice methods
 * ServiceResponse can set the response xml
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class ServiceRenderView extends PitaView {
	public function homeRender() {
		$header = new PitaHeader();
		$header->setTitle( $this->controller->getName() );
		$header->setSubtitle( 'Service index' );

		$navigation = new PitaNavigation();


		$this->add( $header );
		$this->add( new PitaNavigation() );
		$this->add( new PitaFooter() );
	}
}//ServiceRenderView