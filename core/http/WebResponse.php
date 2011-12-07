<?php
/**
 * Source code of WebResponse class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 * @license: GPLv3 or above
 */



/**
 * WebResponse is a response for the WebController.
 * WebResponse can set the response html, cookies, sessions, and any header
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.5.0
 */
class WebResponse extends HttpResponse {
	/**
	 * Master page
	 * @var string
	 * @since 0.5.0
	 */
	protected $master;



	/**
	 * Get if the response has a view o has a controller or render engine content
	 * @var bool
	 * @since 0.5.0
	 */
	protected $processView = true;



	/**
	 * Content of the response
	 * @var string
	 * @since 0.5.0
	 */
	protected $content;



	/**
	 * Renderer class callback if has assigned
	 * @var array
	 * @since 0.5.0
	 */
	protected $renderer = null;



	/**
	 * Return if response need process view or uses a renderer engine
	 * @return bool Process view or not
	 * @since 0.5.0
	 */
	public function getProcessView() {
		return $this->processView;
	}//getProcessView



	/**
	 * Set if response need process view or uses a renderer engine
	 * @param bool $processView Process view or not
	 * @since 0.5.0
	 */
	public function setProcessView( $processView ) {
		$this->processView = $processView;
	}//setProcessView



	/**
	 * Set the own renderer view
	 * @param mixed $view Own renderer view object or name
	 * @param string $render Render method to call
	 * @since 0.5.0
	 */
	public function setRenderer( $view, $render ) {
		if( is_callable( array( $view, $render ) ) ) {
			$this->renderer = array( $view, $render );
		}
	}//setProcessView



	/**
	 * Return the master page
	 * @return string Master page
	 * @since 0.5.0
	 */
	public function getMasterPage() {
		return $this->master;
	}//getMasterPage



	/**
	 * Set the master page
	 * @param string $master Master page
	 * @since 0.5.0
	 */
	public function setMasterPage($masterpage) {
		$this->master = $masterpage;
	}//setMasterPage



	/**
	 * Process the response and draw or redirect, set the cookies, etc.
	 * @param HttpRequest $request Request page params
	 * @since 0.5.0
	 */
	public function process(HttpRequest $request) {
		$content = '';

		$content = $this->processView($request);

		if($this->master != null) {
			$master = $this->processMasterPage($request, $content);
			$content = $master;
		}

		$path = Kernel::get()->getVirtualPath();

		if($path == '/') {
			$path = '';
		}

		$content = str_replace('~/', $path.'/', $content);

		echo $content;
	}//process



	/**
	 * Process the masterpge and the content of the page loading the dinamic content
	 * @param HttpRequest $request Request page params
	 * @since 0.5.0
	 */
	protected function processMasterPage( HttpRequest $request, $content ) {
		$master = $this->addTemplate($this->master, $request);
		preg_match( '/<php:place\s*name="content"\s*\/>/', $master, $match );

		$master = str_replace($match[0], $content, $master);

		return $master;
	}//processMasterPage



	/**
	 * Process the view of the content of the page loading the dinamic content
	 * @param HttpRequest $request Request page params
	 * @since 0.5.0
	 */
	protected function processView( HttpRequest $request ) {
		$content = '';
		$viewName = '';
		$renderName = '';

		if( $this->renderer != null ) {
			$viewName = $this->renderer[ 0 ];
			$renderName = $this->renderer[ 1 ];
		} else {
			$viewName = $this->controller->getName() . 'View';
			$renderName = $this->action . 'Render';
		}

		if( class_exists( $viewName ) && is_subclass_of( $viewName, 'PitaView' ) && method_exists( $viewName, $renderName ) ) {
			$view = new $viewName();
			$view->setRequest( $request );
			$view->setController( $this->controller );
			$view->$renderName();
			$content = $view->render();
			$this->master = null;
		} else if( $this->processView === true ) {
			$content = $this->addTemplate( '/template/' . strtolower( $this->controller->getName() ) . '/' . $this->action . '.php', $request );
		}

		return $content;
	}//processView



	/**
	 * Add a new template, same a addDispatcher but without static access
	 * @param string $template Template path
	 * @param HttpRequest $request Page request
	 * @return string Template content
	 * @since 0.5.0
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
}//WebResponse
