<?php
/**
 * Source code of XmlDocument class
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * XmlDocument is a class to manage the xml
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class XmlDocument {
	/**
	 * PHP DOMDocument
	 * @var DOMDocument
	 * @since 0.3.0
	 */
	private $dom;



	/**
	 * Create a new xml document
	 * Optionaly can send a xml param that this can be a file, string xml or
	 * DOMDocument.
	 * @param string|DOMDocument $xml Xml to process it
	 * @todo Implement the xml param process
	 * @since 0.3.0
	 */
	public function __construct($xml = null) {
		if($xml != null) {
			throw new NotImplementedException(__METHOD__);
		}
	}//__construct



	/**
	 * Load a xml from a file
	 * @param string $file Name of the xml file
	 * @since 0.3.0
	 */
	public function loadXmlFile($file) {
		$this->dom = new DOMDocument();

		if(is_file($file)) {
			$this->dom->load($file);
		} elseif(is_file(Kernel::get()->getPath().$file)) {
			$this->dom->load(Kernel::get()->getPath().$file);
		} else {
			throw new IOException(ExceptionCodes::IO_NOTFOUND, $file);
		}
	}//loadXmlFile



	/**
	 * Load a xml from a string
	 * @param string $xml XML to load
	 * @todo Implement it
	 * @since 0.3
	 */
	public function loadXml($xml) {
		throw new NotImplementedException(__METHOD__);
	}//loadXml



	/**
	 * Load a xml from a DOMDocument
	 * @param DOMDocument $domDocument DOM xml document to load it
	 * @since 0.3.0
	 */
	public function loadDomDocument(DOMDocument $domDocument) {
		throw new NotImplementedException(__METHOD__);
	}//loadDomDocument



	/**
	 * Select a node to return the value
	 * @param string $xpath XPath to load the node
	 * @return string The value of the node
	 * @todo Implement to return a XmlNode
	 * @since 0.3.0
	 */
	public function selectSingleNode($xpath) {
		$xpathDom = new DOMXPath($this->dom);

		$nodelist = $xpathDom->query($xpath);

		foreach($nodelist as $node) {
			$xmlNode = new XmlNode($node);
		}

		if(!isset($xmlNode) || $xmlNode == null) {
			throw new XmlException(ExceptionCodes::XML_NODENOTFOUND, $xpath);
		}

		return $xmlNode->getValue();
	}//selectSingleNode



	/**
	 * Select a nodes who match with the xpath
	 * @param string $xpath XPath of the nodes to load
	 * @return array Array of XmlNode with the nodes matches with the xpath
	 * @since 0.3.0
	 */
	public function selectNodes($xpath) {
		$xpathDom = new DOMXPath($this->dom);

		$nodelist = $xpathDom->query($xpath);

		foreach($nodelist as $node) {
			$nodes[] = new XmlNode($node);
		}

		if(!isset($nodes) || $nodes == null) {
			throw new XmlException(ExceptionCodes::XML_NODENOTFOUND, $xpath);
		}

		return $nodes;
	}//selectNodes
}//XmlDocument