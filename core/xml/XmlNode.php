<?php
/**
 * Source code of XmlNode class
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * XmlNode is a class to manage the xml nodes. Depends of the XmlDocument class
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class XmlNode {
	/**
	 * Xml DOM node
	 * @var DOMNode
	 * @since 0.3.0
	 */
	private $node;



	/**
	 * Default constructor to indicates the DOMNode
	 * @param DOMNode $node Nodo al que encapsular
	 * @since 0.3.0
	 */
	public function __construct(DOMNode $node) {
		$this->node = $node;
	}//__construct



	/**
	 * Return the node value
	 * @return string Node value
	 * @since 0.3.0
	 */
	public function getValue() {
		return $this->node->nodeValue;
	}//getValue
}//XmlNode