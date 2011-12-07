<?php
/**
 * Source code of puntoengine Kernel
 * @category puntoengine
 * @package core
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */
Kernel::import( 'core' );
Kernel::import( 'core.admin' );
Kernel::import( 'core.exceptions' );
Kernel::import( 'core.http' );
Kernel::import( 'core.xml' );
Kernel::import( 'core.pita' );
Kernel::import( 'core.plugin' );
Kernel::import( 'controllers' );
Kernel::import( 'views' );
Kernel::import( 'servlets' );
Kernel::import( 'servlets.pepadmin' );



/**
 * This function is a handler to load the class and function autmaticly.
 * Call a kernel function to load it.
 * @param string $functionName Name of the function of class to load
 * @since 0.1.1
 */
function __autoload( $functionName ) {
	Kernel::get()->autoload( $functionName );
}//__autoload



/**
 * Kernel of the puntoengine application
 * @category puntoengine
 * @package core
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class Kernel {
	/**
	 * Physical path of the application
	 * @var string
	 * @since 0.3
	 */
	private $path;



	/**
	 * Virtual path of the project, accesible via browser
	 * @var string
	 * @since 0.3.0
	 */
	private $virtualPath;



	/**
	 * Virtual namespace to load the functions and classes
	 * @var array
	 * @since 0.3.0
	 */
	private $namespaces;



	/**
	 * Instance of Kernel
	 * @var Kernel
	 * @since 0.5.0
	 */
	private static $instance;



	/**
	 * Version of the puntoengine kernel. Indicate the version of puntoengine
	 * @since 0.3.0
	 */
	const VERSION = '0.5.0';



	/**
	 * Default constructor of kernel.
	 * A private constructor for the singleton pattern
	 * @return Kernel
	 * @since 0.5.0
	 */
	private function __construct() {
		return;
	}//__construct



	/**
	 * Return the active instance of kernel
	 * @return Kernel
	 * @since 0.5.0
	 */
	public static function instance() {
		return Kernel::get();
	}//instance



	/**
	 * Return the active instance of kernel.
	 * Alias of instance
	 * @return Kernel
	 * @since 0.5.0
	 */
	public static function get() {
		if( Kernel::$instance == null ) {
			Kernel::$instance = new Kernel();
		}
		return Kernel::$instance;
	}//get



	/**
	 * Return the real physical path of the puntoengine application
	 * @return string Path of the application
	 * @since 0.3.0
	 */
	public function getPath() {
		return $this->path;
	}//getPath



	/**
	 * Return the virtual path of the puntoengine application to access via browser
	 * @return string Virtual path of the application
	 * @since 0.3.0
	 */
	public function getVirtualPath() {
		return $this->virtualPath;
	}//getVirtualPath



	/**
	 * Initialize the kernel application
	 * @param array $get GET params array
	 * @param array $post POST params array
	 * @param array $server SERVER params array
	 * @param array $cookies COOKIE params array
	 * @param array $files FILES param array
	 * @todo check if the request has double bars // and redirect with one bar /
	 * @since 0.3.0
	 */
	public function process( $get, $post, $server, $cookies, $files ) {
		$this->garbageCollector();
		$this->configure();

		if( dirname( $server['SCRIPT_NAME'] ) != '/' ) {
			$servletName = str_replace( dirname( $server['SCRIPT_NAME'] ), '', $server['REQUEST_URI'] );
		} else {
			$servletName = $server['REQUEST_URI'];
		}

		$servletNameTemp = explode( '?', $servletName );
		$servletName = $servletNameTemp[0];

		if( is_file( $this->getPath().$servletName ) && ( substr( $servletName, 1, 6 ) == 'design' || substr( $servletName, 1, 6 ) == 'images' || substr( $servletName, 1, 2 ) == 'js' || substr( $servletName, 1, 3 ) == 'xml' || substr( $servletName, 1, 14 ) == 'core/resources' ) ) {
			$extension = pathinfo( $this->getPath() . $servletName, PATHINFO_EXTENSION );

			$document = new XmlDocument();
			$document->loadXmlFile( '/config/mimes.xml' );

			$contentType = $document->selectSingleNode( '/Mimes/Mime[Extensions/Extension/@ext = "'.$extension.'"]/@type' );

			header( 'Content-Type: ' . $contentType );

			echo file_get_contents( $this->getPath().$servletName );
			return;
		}

		$url = new Url( $servletName );

		$requestArray = array();
		$requestArray = array_merge( $get, $post );

		$request = new HttpRequest();
		$request->setParams( $requestArray );
		$request->setSession( $_SESSION );

		$controller = $this->getController( $url, $request );

		$response = $controller->getResponse();

		ob_start();
		ob_clean();

		$response->process( $request );

		if( ob_get_length() != 0 ) {
			ob_end_flush();
		}
	}//process



	/**
	 * Return the mime type of file based in extension of the file
	 * @param string $extension Extension of file to obtain the mime type
	 * @return string Mime type
	 * @since 0.4.0
	 */
	public function getMime( $extension ) {
		switch( $extension ) {
			case 'css': $mime = 'text/css'; break;
			case '.js': $mime = 'text/javascript'; break;
			default: $mime = 'text/plain';
		}

		return $mime;
	}//getMime



	/**
	 * Clear the garbage of the diferents automatic variables of PHP
	 * @todo Reimplement
	 * @since 0.3.0
	 */
	private function garbageCollector() {
		/*unset($_GET);
		unset($_POST);
		unset($_SERVER);
		unset($_ENV);
		unset($HTTP_ENV_VARS);
		unset($HTTP_POST_VARS);
		unset($HTTP_GET_VARS);
		unset($HTTP_SERVER_VARS);
		unset($_REQUEST);
		//unset($GLOBALS);
		//unset($_COOKIE);
		unset($_FILES);*/
	}//garbageCollector



	/**
	 * Configure the kernel of the puntoengine
	 * @since 0.3.0
	 */
	private function configure() {
		set_error_handler( array( $this, 'errorHandler' ) );
		set_exception_handler( array( $this, 'exceptionHandler' ) );

		date_default_timezone_set( 'Europe/Madrid' );

		$path = dirname( __FILE__ );
		$path = str_replace( '\\', '/', $path );
		$path = str_replace( '/core','', $path );

		$this->path = $path;
		$this->virtualPath = dirname( $_SERVER['PHP_SELF'] );
		session_start();

		$this->loadPlugins();
	}//configure



	/**
	 * Load all active plugins
	 * @since 0.3.0
	 * @todo implement with php_check_syntax to check include files are correct
	 */
	private function loadPlugins() {
		return;
	}



	/**
	 * Load automaticly the class and the function search this in the import
	 * list with the virtual paths
	 * @param string $functionName Name of the class or function to load
	 * @since 0.3.0
	 */
	public function autoload( $functionName ) {
		for( $i = 0; $i < count( $this->namespaces ); $i++ ) {
			$dir = $this->getPath() . '/' . str_replace( '.', '/', $this->namespaces[$i] );
			$file = $dir . '/' . $functionName . '.php' ;

			if( is_file( $file ) ) {
				include_once( $file );
			}
		}
	}//autoload



	/**
	 * Add a import virtual path namespace to load the classes
	 * @param string $import Virtual namespace path to load
	 * @since 0.3.0
	 */
	public static function import( $import ) {
		Kernel::get()->addNamespace( $import );
	}//import



	/**
	 * Add a import virtual path namespace to load the classes
	 * @param string $namespace Virtual namespace path to load
	 * @since 0.5.0
	 */
	public function addNamespace( $namespace ) {
		$this->namespaces[] = $namespace;
	}//addNamespace



	/**
	 * Load a Controller by the name in the request. Search in controller class
	 * and load the matched controller or throw a exception when don't found a
	 * matched controller
	 * @param Url $url Url of request
	 * @param HttpRequest $request Request
	 * @return HttpController Controller who matched with the request
	 * @since 0.4.0
	 */
	private function getController( Url $url, HttpRequest $request ) {
		$controllerName = null;
		$methodName = null;

		$controllers = $url->getControllers();
		$controllerCount = count( $controllers );

		for( $i = 0; $i < $controllerCount; $i++ ) {
			$tempController = array();
			if( strpos( $controllers[$i], '.' ) ) {
				$tempController = explode( '.', $controllers[$i] );
				$tempController[0] = ucfirst( $tempController[0] );

				if( class_exists( $tempController[0] . 'Controller', true) && is_subclass_of( $tempController[0] . 'Controller', 'HttpController' ) ) {
					if( method_exists( $tempController[0] . 'Controller', $tempController[1].'Action' ) ) {
						$controllerName = $tempController[0];
						$methodName = $tempController[1];
					}
				}
			} else {
				$tempController[0] = ucfirst( $controllers[$i] );

				if( class_exists( $tempController[0] . 'Controller', true ) && is_subclass_of( $tempController[0] . 'Controller', 'HttpController' ) ) {
					$controllerName = $tempController[0];
					$methodName = 'default';
				}
			}

			if( $controllerName !== null && $methodName !== null ) {
				$i = count( $controllers );
			}
		}


		if( $controllerName === null && $methodName === null ) {
			//TODO: catch error
		} else {
			$controllerClass = $controllerName.'Controller';
			$methodAction = $methodName.'Action';

			$controller = new $controllerClass();
			$controller->setRequest( $request );
			$response = $controller->getResponse();
			$response->setController( $controller );
			$response->setAction( $methodName );

			$controller->setResponse( $response );
			$controller->getResponse()->setResponse( $controller->$methodAction() );
		}

		return $controller;
	}//getController



	/**
	 * Catch a error and manage it with a internal exception manager
	 * @param int $code Error code
	 * @param string $message Descriptive error message
	 * @param string $file File where throw the error
	 * @param int $line Line where throw the error
	 * @param array $context Variables context when the error throwed
	 * @since 0.3.0
	 */
	public function errorHandler( $code, $message, $file, $line, $context ) {
		$exception = new CoreException( ExceptionCodes::CORE_EXCEPTION, $message );

		$this->exceptionHandler( $exception );
	}//errorHandler



	/**
	 * Catch a exception and manage it with a internal process
	 * @param Exception $exception Catched exception
	 * @since 0.3.0
	 */
	public function exceptionHandler( Exception $exception ) {
		$debug = false;

		try {
			$document = new XmlDocument();
			$document->loadXmlFile( '/config/web.xml' );
			$debug = $document->selectSingleNode( '/Web/Config/Debug/@activate' );

			if( $debug == 'true' ) {
				$debug = true;
			} else {
				$debug = false;
			}
		} catch( Exception $ex ) {
			$debug = false;
		}

		$servlet = new HttpServlet();
		$servlet->setDebug( $debug );
		$servlet->processException( $exception );

		echo $servlet->getOut();
		die;
	}//exceptionHandler
}//Kernel