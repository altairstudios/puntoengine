<?php
/**
 * Source code of XmlSerialize class
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * XmlSerialize is a serializer class for objects
 * @category puntoengine
 * @package core
 * @subpackage xml
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class XmlSerialize extends Object {
	/**
	 * Serialize a mixed value
	 * @param mixed $mixed Mixed value to serialize
	 * @return string Object serialized
	 * @since 0.5.0
	 */
	public static function serialize( $mixed ) {
		$tag = 'Node';

		if( gettype( $mixed ) == 'array') {
			$tag = 'Array';
		}

		return self::process( $mixed, $tag );
	}//serialize



	/**
	 * Serialize a mixed value
	 * @param mixed $mixed Mixed value to serialize
	 * @param string $tag Tag to use
	 * @return string Object serialized
	 * @throw NotImplementedException
	 * @since 0.5.0
	 */
	protected static function process( $mixed, $tag = 'Node' ) {
		$xml = null;
		$tag = ucfirst( $tag );

		switch( gettype( $mixed ) ) {
			case 'array':
				$xml = self::serializeArray( $mixed, $tag );
			break;
			case 'string':
				$xml = self::serializeString( $mixed, $tag );
			case 'object':
			break;
			default:
				echo gettype( $mixed ); die;
				throw new NotImplementedException( __METHOD__ );
		}

		return $xml;
	}//process



	/**
	 * Serialize a string to xml
	 * @param string $string String to serialize
	 * @param string $tag Tag to use
	 * @return string String serialized
	 * @since 0.5.0
	 */
	protected static function serializeString( $string, $tag = 'String' ) {
		$xml = '<' . $tag . '>';
		$xml .= $string;
		$xml .= '</' . $tag . '>';

		return $xml;
	}//serializeString



	/**
	 * Serialize a array to xml
	 * @param array $array Array to serialize
	 * @param string $tag Tag to use
	 * @return string Array serialized
	 * @since 0.5.0
	 */
	protected static function serializeArray( array $array, $tag = 'Array' ) {
		ksort( $array, SORT_STRING );

		$xml = '<' . $tag . '>';

		foreach( $array as $key => $value ) {
			if( is_numeric( $key ) ) {
				$key = 'Item';
			}

			$xml .= self::process( $value, $key );
		}

		$xml .= '</' . $tag . '>';

		return $xml;
	}//serializeArray
}//XmlSerialize