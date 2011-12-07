<?php
/**
 * Source code of Object class
 * @category puntoengine
 * @package core
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * Object is a base class of all class of engine and
 * @category puntoengine
 * @package core
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class Object {
	/**
	 * This method is called when unset the object
	 * @since 0.4.0
	 * @todo Implements
	 */
	public function __destruct() {
	}//__destruct



	/**
	 * Default method call
	 * @since 0.4.0
	 * @todo Implements
	 */
	public function __invoke() {
	}//__invoke



	/**
	 * Call when serialize a object to string
	 * @since 0.4.0
	 * @todo Implements
	 */
	public function __sleep() {
	}//__sleep



	/**
	 * Call when unserialize a object from string
	 * @since 0.4.0
	 * @todo Implements
	 */
	public function __wakeup() {
	}//__wakeup



	/**
	 * Clone this class
	 * @return __CLASS__
	 * @since 0.4.0
	 */
	public function __clone() {
		return clone( $this );
	}//__clone



	/**
	 * Override undefined call to a method
	 * @param string $name Name of undefined method
	 * @param array $arguments Params of the method
	 * @since 0.4.0
	 */
	public function __call( $name, $arguments ) {
	}//__call



	/**
	 * Override undefined set property
	 * @param string $name Property name
	 * @param mixed $value Value to set
	 * @since 0.4.0
	 */
	public function __set( $name, $value ) {
	}//__set



	/**
	 * Override the get property
	 * @param string $name Property name
	 * @return null
	 * @since 0.4.0
	 */
	public function __get( $name ) {
		return null;
	}//__get



	/**
	 * Override the isset function are called againt property of the class
	 * @param string $name Property name
	 * @return bool
	 * @since 0.4.0
	 */
	public function __isset( $name ) {
		return false;
	}//__isset



	/**
	 * Override the unset function are called againt property of the class
	 * @param string $name Property name
	 * @since 0.4.0
	 * @todo Implement this method
	 */
	public function __unset( $name ) {
	}//__unset



	/**
	 * Render the class to a json encoding
	 * @return string
	 * @since 0.4.0
	 */
	public function toJson() {
		return json_encode( $this );
	}//toJson



	/**
	 * Render the class to a string encoding
	 * @return string
	 * @since 0.4.0
	 */
	public function toString() {
		return $this->__toString();
	}//toString



	/**
	 * Render the class to a string encoding
	 * @return string
	 * @since 0.4.0
	 */
	public function __toString() {
		return serialize( $this );
	}//__toString



	/**
	 * Render the class to a xml encoding
	 * @throws NotImplementedException
	 * @since 0.4.0
	 * @todo Implement this method
	 */
	public function toXml() {
		return XmlSerialize::serialize( $this );
	}//toXml
}//Object