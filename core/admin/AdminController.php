<?php
/**
 * Source code of AdminController class controller
 * @category puntoengine
 * @package core
 * @subpackage admin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3
 */


/**
 * AdminController is a controller class of the default admin
 * @category puntoengine
 * @package core
 * @subpackage admin
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.3
 */
class AdminController extends HttpServlet {
    protected $master = '/core/admin/template/master.php';
    

    /**
     * Implement the GET method connection and load the login form
     * @param HttpRequest $request Page request
     */
    protected function processRequest(HttpRequest $request) {
		if($request->getSession('admin') == 'true') {
			$this->sendRedirect('~/admin/home');
		} else {
			$this->sendRedirect('~/admin/login');
		}
    }//doGet
	
	
	protected function login(HttpRequest $request) {
		$this->addTemplateSection('content', $this->addTemplate('/core/admin/template/login.php', $request));
	}
	
	
	protected function signup(HttpRequest $request) {
		$document = new XmlDocument();
		$document->loadXmlFile('/config/admin.xml');

		try {
			$admin = $document->selectSingleNode('/Admin/Users/User[Credentials/@user="'.$request->getParam('user').'" and Credentials/@pass="'.$request->getParam('pass').'"]');

			if($admin != '') {
				$request->addSession('admin', 'true');
			}
		} catch(Exception $ex) {
		}

		$this->sendRedirect('~/admin');
	}
	
	
	protected function home(HttpRequest $request) {
		$this->addTemplateSection('content', $this->addTemplate('/core/admin/template/home.php', $request));
	}
}//AdminController
?>