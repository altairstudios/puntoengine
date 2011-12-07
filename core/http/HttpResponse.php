<?php
/**
 * Source code of HttpResponse class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 * @license: GPLv3 or above
 */



/**
 * HttpResponse is a response for the Controller.
 * HttpResponse can set the response html, cookies, sessions, and any header
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.4.0
 */
class HttpResponse extends Object {
	/**
	 * Controller name
	 * @var string
	 * @since 0.4.0
	 */
	protected $controller;



	/**
	 * Action name
	 * @var string
	 * @since 0.4.0
	 */
	protected $action;



	/**
	 * Controler execution response
	 * @var mixed
	 * @since 0.5.0
	 */
	protected $response;



	/**
	 * Type of content same as xml, jpeg, png, html, etc
	 * @var string
	 * @since 0.5.0
	 */
	protected $type = 'html';



	/**
	 * Default constructor
	 * @since 0.4.0
	 */
	public function __construct() {
	}//__construct



	/**
	 * Return the type of content
	 * @return string Type of content
	 * @since 0.5.0
	 */
	public function getType() {
		return $this->type;
	}//getResponse



	/**
	 * Return the response of controller action
	 * @return string Response of controller action
	 * @since 0.5.0
	 */
	public function getResponse() {
		return $this->response;
	}//getResponse



	/**
	 * Set the response of controller action
	 * @param string $controller Controller name
	 * @since 0.5.0
	 */
	public function setResponse($response) {
		$this->response = $response;
	}//setResponse



	/**
	 * Return the controller name
	 * @return string Controller name
	 * @since 0.4.0
	 */
	public function getController() {
		return $this->controller;
	}//getController



	/**
	 * Set the controller name
	 * @param HttpController $controller Controller
	 * @since 0.4.0
	 */
	public function setController(HttpController $controller) {
		$this->controller = $controller;
	}//setController



	/**
	 * Return the action name
	 * @return string Action name
	 * @since 0.4.0
	 */
	public function getAction() {
		return $this->action;
	}//getAction



	/**
	 * Set the action name
	 * @param string $action Action name
	 * @since 0.4.0
	 */
	public function setAction($action) {
		$this->action = strtolower($action);
	}//setAction



	/**
	 * Return the master page
	 * @return string Master page
	 * @since 0.4.0
	 */
	public function getMasterPage() {
		return $this->master;
	}//getMasterPage



	/**
	 * Set the master page
	 * @param string Master page
	 * @since 0.4.0
	 */
	public function setMasterPage($masterpage) {
		$this->master = $masterpage;
	}//setMasterPage



	/**
	 * Process the response and draw or redirect, set the cookies, etc.
	 * @param HttpRequest $request Request page params
	 * @since 0.4.0
	 */
	public function process(HttpRequest $request) {
		ob_start();
		ob_clean();

		$content = $this->processView($request);

		if($this->master != null) {
			$master = $this->processMasterPage($request, $content);
			$content = $master;
		}

		echo $content;

		if(ob_get_length() != 0) {
			ob_end_flush();
		}
	}//process



	/**
	 * Process the masterpge and the content of the page loading the dinamic content
	 * @param HttpRequest $request Request page params
	 * @since 0.4.0
	 */
	protected function processMasterPage(HttpRequest $request, $content) {
		$master = $this->addTemplate($this->master, $request);
		preg_match('/<php:place\s*name="content"\s*\/>/', $master, $match);

		$master = str_replace($match[0], $content, $master);

		return $master;
	}//processMasterPage



	/**
	 * Process the view of the content of the page loading the dinamic content
	 * @param HttpRequest $request Request page params
	 * @since 0.4.0
	 */
	protected function processView(HttpRequest $request) {
		$content = $this->addTemplate('/template/'.$this->controller.'/'.$this->action.'.php', $request);

		return $content;
	}//processView



	/**
	 * Add a new template, same a addDispatcher but without static access
	 * @param string $template Template path
	 * @param HttpRequest $request Page request
	 * @return string Template content
	 * @since 0.4.0
	 */
	protected function addTemplate($template, HttpRequest $request) {
		if(file_exists(Kernel::get()->getPath().'/template/'.$template)) {
			include(Kernel::get()->getPath().'/template/'.$template);
		} elseif(file_exists(Kernel::get()->getPath().$template)) {
			include(Kernel::get()->getPath().$template);
		} else {
			throw new IOException(ExceptionCodes::IO_NOTFOUND, $template);
		}

		$out = ob_get_contents();
		ob_clean();

		return $out;
	}//addTemplate
}//HttpResponse