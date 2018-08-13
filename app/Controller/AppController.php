<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	

	public $helpers = array(
		'Js' => array('Jquery'),
		'Session',
		'Flash',
		'GoogleMap',
		'Formatage',
		'Listes',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
		'Cache',
		'Image',
		'JqueryValidation',
		'Media.Media',
		'PhpExcel'
	);

	
	public $components = array(
			//'Security',
			'Fonctions',
			'DebugKit.Toolbar',
			'Session',
			'Flash',
			'Cookie',
			'Auth' => array(
				
					'Authenticate' => array(
						'form' => array(
							
							'scope' => array('User.active' => 1),
							'passwordHasher' => array(
			                    'className' => 'Simple',
			                    'hashType' => 'sha256'
			                )
						)
					),
					'loginRedirect' => array('controller' => 'accueils', 'action' => 'index', 1),
					'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 1),
					'flash' => array(
						'element' => 'alert',
						'key' => 'auth',
						'params' => array(
							'plugin' => 'BoostCake',
							'class' => 'alert-error'
						)
					)
			),
			'RequestHandler',
			'Paginator',
			'Password',
			'Formatage',
			'Sql',
			'Check',
			'Listes',
			'Filter',
			'Verif'
	);
	public function canUploadMedias($model, $id){
		return true;
	}

	public function changeCore($core,$controller,$action){

		if($this->Session->read('user_id') == 23){
			$this->loadModel('Module');
			$this->Module->updateAll(array('core' => $core));
			define('CORECAKE',$core);


			$this->redirect(array('controller' => $controller, 'action' => $action));

		}
	}

	



	

	
	public function beforeFilter() {

		
				
		//$this->Security->validatePost = false;
		//$this->Security->csrfCheck = false ;
		

		//Security::setHash('md5');
		$this->Auth->allow('login');

	
	
		
		$this->Auth->allow('remind');
		$this->Auth->allow('reset');
		$this->Auth->allow('add2');

		$this->Auth->allow('presence');
		$this->Auth->allow('addPresence');
		$this->Auth->allow('addPublic');

		$this->Auth->allow('viewSpecial');






		/*$this->Auth->allow('ressources2');
		$this->Auth->allow('results2');
		$this->Auth->allow('resultsMulti');
		$this->Auth->allow('viewDocument');*/
		
		$this->Auth->allow('addUserGI');
		$this->Auth->allow('addUserStagiaire');

		$this->Auth->allow('addStagiairesProjet');
		$this->Auth->allow('activeUser');
		$this->Auth->allow('activeUserGI');
		$this->Auth->allow('activeUserStagiaire');
		$this->Auth->allow('calendar');
		$this->Auth->allow('calendarByRegion');
		$this->Auth->allow('calendarByDepartement');
		$this->Auth->allow('calendarBySport');
		$this->Auth->allow('calendar2');

		$this->Auth->allow('ajax_get_type_event_list3');
		
		$this->Auth->allow('searchEventCal');
		$this->Auth->allow('searchCommune');
		$this->Auth->allow('viewEventCalendar');
		$this->Auth->allow('viewEventCalendar2');
		$this->Auth->allow('viewSearchCalendar');
		$this->Auth->allow('viewMonthCalendar');

		$this->Auth->allow('editionConvocation');
		$this->Auth->allow('editionContratFormation');

		$this->Auth->allow('searchChild');

		


		// Codes to add https to website
        /*$this->Security->validatePost=false;
        $this->Security->csrfCheck=false;
        $this->Security->csrfUseOnce=false;
        $remove_ssl_from_url  = array();
        $this->Security->blackHoleCallback = 'addSSL';
        if(!in_array($this->params['action'],$remove_ssl_from_url)){
            $this->Security->requireSecure('*');
        }*/


		
		if($this->RequestHandler->isAjax()){
			$this->layout=null;
		}

		// liste déroulante - Type de dahlir
        /*$this->loadModel('Sport');
        $sports_list = $this->Sport->find('list',array(
                'fields' => array('DisciplineCode', 'DisciplineLibelle'),
                'order' => 'DisciplineLibelle ASC'));
        $this->set(compact('sports_list'));*/


	}

	



	
	


	
	public function logout() {


		$this->User->Connection-> create();
	    $this->User->Connection-> save(array(
	        'user_id' => $this->Auth->User('id'),
	        'profil_id' => $this->Session->read('profilR_id'),
	        'module_id' => $this->Session->read('module_id'),
	        'controller' => $this->request->controller,
	        'action' => $this->request->action
	    ));
		

		if($this->Session->read('connectByFormation') == 1){
			$this->Session->destroy();
			$this->redirect('/Users/loginFormation');
		} else {
			$this->Session->destroy();
			$this->Auth->logout();
			//$this->redirect('https://extranet.handisport.org/users/login');
			$this->redirect(array('controller' => 'users', 'action' => 'login', 1));

		}
	}
}

?>
