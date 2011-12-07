<?php
/**
 * Source code of HttpServlet class
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */
Kernel::import('core.exceptions');



/**
 * HttpServlet is a class same a Java Servlet with a little modifications.
 * The Servlet who are the request controller, have a differents methods
 * to catch the differents types of request and others utilities methods
 * same throw error, load a template or redirect to other page.
 * @category puntoengine
 * @package core
 * @subpackage http
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 */
class HttpServlet {
	/**
	 * Page output
	 * @var string
	 * @since 0.3.0
	 */
	protected $out;



	/**
	 * Indicate if engine is in debug mode
	 * @var bool
	 * @since 0.3.0
	 */
	protected $debug = false;



	/**
	 * Url requested to load this servlet
	 * @var string
	 * @since 0.3.0
	 */
	protected $url;



	/**
	 * Indicate the master template to load the base content
	 * @var string
	 * @since 0.3.0
	 */
	protected $master;



	/**
	 * Sections of page to add the content dinamicly to this sections
	 * @var array
	 * @since 0.3.0
	 */
	protected $templateSections;



	/**
	 * Name of action to execute by the servlet
	 * @var string
	 * @since 0.3.0
	 */
	protected $action;



	/**
	 * Return the current page output
	 * @return string Page output
	 * @since 0.3.0
	 */
	public function getOut() {
		return $this->out;
	}//getOut



	/**
	 * Set the action to execute by the servlet
	 * @param string $action Action to execute
	 * @since 0.3.0
	 */
	public function setAction($action) {
		$this->action = $action;
	}//setAction



	/**
	 * Set if the engine is in debug mode
	 * @param bool $debug Engine are in debug mode
	 * @since 0.3.0
	 */
	public function setDebug($debug) {
		$this->debug = $debug;
	}//setDebug



	/**
	 * Set the request url
	 * @param string $url Request url
	 * @since 0.3.0
	 */
	public function setUrl($url) {
		$this->url = $url;
	}//setUrl



	/**
	 * Add a new section page content by the key
	 * @param string $key Key of the section page
	 * @param string $value Content of the section page
	 * @since 0.3.0
	 */
	public function addTemplateSection($key, $value) {
		$this->templateSections[$key] = $value;
	}//addTemplateSection



	/**
	 * Initialize the servlet with the request and the type to load the
	 * method controller in the child of servlet
	 * @param HttpRequest $request Page request
	 * @param string $type Method type
	 * @todo Implement the xml service controller
	 * @since 0.3.0
	 */
	public function init(HttpRequest $request, $type) {
		ob_start();

		if($this->action != null && method_exists($this, $this->action)) {
			call_user_func(array($this, $this->action), $request);
		} else {
			if($type == HttpMethods::GET) {
				$this->doGet($request);
			} elseif($type == HttpMethods::POST) {
				$this->doPost($request);
			} else {
				$this->processRequest($request);
			}
		}

		$this->processMasterPage($request);
		echo $this->processOutput($this->out);

		if(ob_get_length() != 0) {
			ob_end_flush();
		}
	}//init



	/**
	 * Base request controller when don't declare this method in the child
	 * @param HttpRequest $request Page request
	 * @since 0.3.0
	 */
	protected function processRequest(HttpRequest $request) {
		throw new NotImplementedException(__METHOD__);
	}//processRequest



	/**
	 * GET method controller
	 * @param HttpRequest $request Page request
	 * @todo Hook HookTypes::DO_BASE_GET
	 * @since 0.3.0
	 */
	protected function doGet(HttpRequest $request) {
		$this->processRequest($request);
	}//doGet



	/**
	 * POST method controller
	 * @param HttpRequest $request Page request
	 * @todo Hook HookTypes::DO_BASE_POST
	 * @since 0.3.0
	 */
	protected function doPost(HttpRequest $request) {
		$this->processRequest($request);
	}//doPost



	/**
	 * Service xml controller
	 * @todo Implement
	 * @todo Hook HookTypes::DO_BASE_SERVICE
	 * @since 0.3.0
	 */
	protected function doService() {
		throw new NotImplementedException(__METHOD__);
	}//doService



	/**
	 * Set the request dispatcher
	 * @param string $dispatcher File dispatcher of template
	 * @param HttpRequest $request Page request
	 * @since 0.3.0
	 */
	protected function setRequestDispatcher($dispatcher, HttpRequest $request) {
		HttpServlet::addDispatcher($dispatcher, $request);
	}//setRequestDispatcher



	/**
	 * Add a dispatcher template
	 * @param string $dispatcher File dispatcher of template
	 * @param HttpRequest $request
	 * @deprecated Deprecated since version 0.2
	 * @since 0.2.0
	 */
	public static function addDispatcher($dispatcher, HttpRequest $request) {
		if(file_exists($dispatcher)) {
			include(Kernel::get()->getPath().$dispatcher);
		} elseif(file_exists(Kernel::get()->getPath().$dispatcher)) {
			include(Kernel::get()->getPath().$dispatcher);
		} else {
			throw new IOException(ExceptionCodes::IO_NOTFOUND, $dispatcher);
		}
	}//addDispatcher



	/**
	 * Add a new template, same a addDispatcher but without static access
	 * @param string $template Template path
	 * @param HttpRequest $request Page request
	 * @return string Template content
	 * @since 0.3.0
	 */
	protected function addTemplate($template, HttpRequest $request) {
		if(file_exists($template)) {
			include(Kernel::get()->getPath().$template);
		} elseif(file_exists(Kernel::get()->getPath().$template)) {
			include(Kernel::get()->getPath().$template);
		} else {
			throw new IOException(ExceptionCodes::IO_NOTFOUND, $template);
		}

		$out = ob_get_contents();
		ob_clean();

		return $out;
	}//addTemplate



	/**
	 * Process the masterpge and the content of the page loading the dinamic content
	 * @param HttpRequest $request Request page params
	 * @since 0.3.0
	 */
	protected function processMasterPage(HttpRequest $request) {
		if($this->master != null) {
			$this->out = $this->addTemplate($this->master, $request);
		}

		preg_match_all('/\<pep:place(.*)\/\>/Usi', $this->out, $pepPlaces);

		for($i = 0; $i < count($pepPlaces[1]); $i++) {
			preg_match_all('/([a-z]*)="(.*)"/Usi', $pepPlaces[1][$i], $pepPlace);

			for($j = 0; $j < count($pepPlace[1]); $j++) {
				if($pepPlace[1][$j] == 'name') {
					if(isset($this->templateSections[$pepPlace[2][$j]])) {
						$this->out = str_replace($pepPlaces[0][$i], $this->templateSections[$pepPlace[2][$j]], $this->out);
						break;
					}
				} else if($pepPlace[1][$j] == 'include') {
					$tempOut = $this->addTemplate($pepPlace[2][$j], $request);
					$this->out = str_replace($pepPlaces[0][$i], $tempOut, $this->out);
					break;
				}
			}
		}
	}//processMasterPage



	/**
	 * Post process output to change for example the path in links ~/ for the project path
	 * @param string $output Page output
	 * @return string Post formated output
	 * @since 0.3.0
	 */
	protected function processOutput($output) {
		$path = Kernel::get()->getVirtualPath();

		if($path == '/') {
			$path = '';
		}

		$output = str_replace('~/', $path.'/', $output);

		return $output;
	}//processOutput



	/**
	 * Redirect the request to other url
	 * @param string $url Url to redirect the page
	 * @todo Implement the 301 redirect
	 * @todo Hook HookTypes::SEND_REDIRECT
	 * @since 0.3.0
	 */
	protected function sendRedirect($url) {
		if(substr($url, 0, 2) == '~/') {
			$url = str_replace('~/', Kernel::get()->getVirtualPath().'/', $url);
		}

		header('Location: '.$url);
	}//sendRedirect



	/**
	 * Proccess a exception in the servlet to load a default exception page
	 * @param CoreException $exception Exception to draw a error page
	 * @todo Hook HookTypes::CALL_PROCESS_EXCEPTION
	 * @since 0.3.0
	 */
	public function processException(CoreException $exception) {
		PluginManager::instance()->executeHook(HookTypes::CALL_PROCESS_EXCEPTION, array('exception' => $exception));

		$exceptionType = 'Exception';

		switch($exception->getCode()) {
			case ExceptionCodes::CORE_EXCEPTION:
				$exceptionType = 'core.exception.CoreException';
			break;
			case ExceptionCodes::CORE_NOTIMPLEMENTED:
				$exceptionType = 'core.exception.NotImplementedException';
			break;
			case ExceptionCodes::CORE_NOTIMPLEMENTED:
				$exceptionType = 'core.exception.ClassNotFound';
			break;
			case ExceptionCodes::IO_NOTFOUND:
				$exceptionType = 'core.exception.IOException';
			break;
			case ExceptionCodes::XML_NODENOTFOUND:
				$exceptionType = 'core.exception.XmlException';
			break;
			default:
				$exceptionType = 'php.Exception';
			break;
		}

		$trace = $exception->getTrace();

		$body = '<h1 class="title">Core error - status 500</h1>'."\n";
		$body .= '<hr/>'."\n";
		$body .= '<p><span class="title">type</span> Exception report</p>'."\n";
		$body .= '<p><span class="title">message</span> '.$exception->getMessage().'</p>'."\n";
		$body .= '<p><span class="title">exception</span> '.$exceptionType.'</p>'."\n";
		$body .= '<p><span class="title">cause</span><br/>'."\n";

		for($i = 0; $i < count($trace); $i++) {
			$line = '';

			if(isset($trace[$i - 1]['line'])) {
				$line = '('.$trace[$i - 1]['line'].')';
			}

			$body .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$trace[$i]['class'].$trace[$i]['type'].$trace[$i]['function'].$line.'<br/>'."\n";
		}

		if($this->debug == true) {
			$body .= '<p><span class="title">trace</span>'."\n";
			$body .= '<pre>'.$exception->getTraceAsString().'</pre>';
			$body .= '</p>'."\n";
		}

		$body .= '</p>'."\n";
		$body .= '<p><span class="title">note</span> The full stack trace of the cause is available in the PuntoEngine Server/'.Kernel::VERSION.' logs</p>'."\n";
		$body .= '<hr/>'."\n";
		$body .= '<h2 class="title">Punto Engine Server/'.Kernel::VERSION.'</h2>'."\n";

		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">'."\n";
		$html .= '<head profile="http://gmpg.org/xfn/11">'."\n";
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
		$html .= '<title>Core exception</title>'."\n";
		$html .= '<link href="'.Kernel::get()->getVirtualPath().'/core/resources/css/exception.css" class="theme" rel="stylesheet" media="all" />'."\n";
		$html .= '</style>'."\n";
		$html .= '</head>'."\n";
		$html .= '<body>'."\n";
		$html .= $body."\n";
		$html .= '</body>'."\n";
		$html .= '</html>'."\n";

		$this->out = $html;
	}//processException
}//HttpServlet