<?php
/**
 * Source code of Database class
 * @category puntoengine
 * @package core
 * @subpackage database
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */



/**
 * Database class are the database connections core class and is the parent
 * class of all datas class
 * @category puntoengine
 * @package core
 * @subpackage database
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @todo Checks posible errors
 */
class Database {
	/**
	 * PHP database connection resource
	 * @var resource
	 * @since 0.1.1
	 */
	private static $connection;



	/**
	 * PHP results of query database resource
	 * @var resource
	 * @since 0.1.1
	 */
	private $results;



	/**
	 * Default constructor, that load the configuration of the database
	 * connection
	 * @since 0.1.1
	 * @final
	 */
	public function __construct() {
	if(Database::$connection == null) {
		$document = new XmlDocument();
		$document->loadXmlFile('/config/database.xml');
		$baseXpath = '/Database/Connection/';

		$server = $document->selectSingleNode($baseXpath.'Server');
		$user = $document->selectSingleNode($baseXpath.'User');
		$pass = $document->selectSingleNode($baseXpath.'Password');
		$database = $document->selectSingleNode($baseXpath.'DB');

		$this->connection = mysql_connect($server, $user, $pass);
		mysql_select_db($database, $this->connection);
	}
	}//__construct



	/**
	 * Execute a query againts database
	 * @param string $query Query to execute in database
	 * @since 0.1.1
	 */
	protected function query($query) {
	$this->results = mysql_query($query, $this->connection);
	}//query



	/**
	 * Execute a fetch to results of the query
	 * @return array Array with the results of the query
	 * @since 0.1.1
	 */
	protected function fetch() {
	return mysql_fetch_assoc($this->results);
	}//fetch
}//Database