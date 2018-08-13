<?php
class TabsController extends AppController {

	public function afterFilter() {
		if(!is_null(AuthComponent::user('id'))){
			$this->Tab->User->Connection-> create();
		    $this->Tab->User->Connection-> save(array(
		        'user_id' => $this->Auth->User('id'),
		        'profil_id' => $this->Session->read('profilR_id'),
		        'module_id' => $this->Session->read('module_id'),
		        'controller' => $this->request->controller,
		        'action' => $this->request->action
		    ));
		}	
	}

	// LISTE DES NEWS DU MODULE
	public function index($tabActive = null) {
		// FILTRE CONTROLLER
		if(!empty($this->data['Tab']['controller'])){ 
			$filterController = array('TabR.controller' => $this->request->data['Tab']['controller']); 
			$this->set('filter_controller', $this->request->data['Tab']['controller']);
		} else { 
			$filterController = array();
			$this->set('filter_controller', 'vide');
		}

		// FILTRE ACTION
		if(!empty($this->data['Tab']['action'])){ 
			$filterAction = array('TabR.action' => $this->request->data['Tab']['action']); 
			$this->set('filter_action', $this->request->data['Tab']['action']);
		} else { 
			$filterAction = array();
			$this->set('filter_action', 'vide');
		}

		// FILTRE EVENT
		if(!empty($this->data['Tab']['event_id'])){ 
			$filterEvent = array('TabR.event_id' => $this->request->data['Tab']['event_id']); 
			$this->set('filter_event', $this->request->data['Tab']['event_id']);
		} else { 
			$filterEvent = array();
			$this->set('filter_event', 'vide');
		}

		// FILTRE TAB
		if(!empty($this->data['Tab']['tab'])){ 
			$filterTab = array('TabR.tab_id' => $this->request->data['Tab']['tab']); 
			$this->set('filter_tab', $this->request->data['Tab']['tab']);
		} else { 
			$filterTab = array();
			$this->set('filter_tab', 'vide');
		}

			$filter = array_merge($filterController,$filterAction,$filterEvent,$filterTab);

			$conditions = array(
				'TabR.id !=' => 0,
				$filter
			);

		// LISTE FILTRE PAR SPORT
		$this->loadModel('TabR');
		$events = $this->TabR->find('list', array(
			'fields' => array('TabR.event_id', 'Event.name'),
			'group' => 'TabR.event_id',
			'order' => 'Event.name',
			'contain' => array('Event')
			)
		);
		$this->set(compact('events'));


		$controllers = $this->TabR->find('list', array(
			'fields' => array('TabR.controller', 'TabR.controller'),
			'group' => 'TabR.controller',
			'order' => 'TabR.controller'
			)
		);
		$this->set(compact('controllers'));

		$actions = $this->TabR->find('list', array(
			'fields' => array('TabR.action', 'TabR.action'),
			'group' => 'TabR.action',
			'order' => 'TabR.action'
			)
		);
		$this->set(compact('actions'));

		$this->Paginator->settings = array('contain' => 'User.Personne', 'limit' => 500);
		$this->set('tabs', $this->paginate('Tab'));

		$this->loadModel('TabR');
		$this->Paginator->settings = array('contain' => array('User.Personne', 'Tab','Event'), 'order' => array('TabR.id' =>  'desc', 'TabR.order' =>  'asc'), 'limit' => 500);
		$this->set('tabsR', $this->paginate('TabR',$conditions));

		$this->set(compact('tabActive'));
	}


	// VOIR / MODIFIER UNE NEWS
	public function viewTabR($id = null) {
		$this->loadModel('TabR');
		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ];
		    
		    $this->TabR->contain('Tab','Event');
		    $tabR = $this->TabR->findById($id);
		    $this->set(compact('tabR'));
		}

	    if ($this->request->is(array('post', 'put'))) {	  

	        $this->TabR->id = $id;

	        $this->TabR->updateAll(
					array('order' => 'TabR.order+1'), 
					array(
						'TabR.order >=' => $this->request->data['TabR']['order'],
						'TabR.controller' => $this->request->data['TabR']['controller'],
						'TabR.action' => $this->request->data['TabR']['action'],
						'TabR.event_id' => $this->request->data('TabR.event_id')
			));

	        if ($this->TabR->save($this->request->data)) {
	        	

	            $this->Session->setFlash('La tabR a été modifiée avec succès', 'msg_enreg_ok');   
	        } else {
	        	$this->Session->setFlash(__('La tabR n\'a pas été modifiée'));
	        }
 			return $this->redirect(array('action' => 'index',0));

	    }

	    if (!$this->request->data) {
	        $this->request->data = $tabR;
	        $this->set(compact('tabR'));
	    }
	    
	    $this->set(compact('tabR'));
	}

	// SUPPRIMER UNE NEWS
	public function delete($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		$tabs = $this->Tab->find('first', array(
		    	'conditions' => array(
		    		'Tab.user_id' => $this->Auth->User('id'),
		    		'Tab.id' => $id)
		    	)
		    );

	    if(empty($tabs)){
	    	$this->Session->setFlash('Vous ne pouvez pas supprimer cette tab', 'msg_false');
	    	return $this->redirect(array('action' => 'index'));	  
	    }

		if ($this->Tab->delete($tabs['Tab']['id'])) {
			$this->Session->setFlash('La tab a bien été supprimée !', 'msg_delete');
			$this->redirect(array('action' => 'index'));
		}		
	}

	// SUPPRIMER UNE TABR
	public function deleteTabR($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}
		$this->loadModel('TabR');
		$tabs = $this->TabR->find('first', array(
		    	'conditions' => array(
		    		'TabR.user_create_id' => $this->Auth->User('id'),
		    		'TabR.id' => $id)
		    	)
		    );

	    if(empty($tabs)){
	    	$this->Session->setFlash('Vous ne pouvez pas supprimer cette tabR', 'msg_false');
	    	return $this->redirect(array('action' => 'index'));	  
	    }

		if ($this->TabR->delete($tabs['TabR']['id'])) {

			$this->TabR->updateAll(
					array('order' => 'TabR.order-1'), 
					array(
						'TabR.order >' => $tabs['TabR']['order'],
						'TabR.controller' => $tabs['TabR']['controller'],
						'TabR.action' => $tabs['TabR']['action']
			));


			$this->Session->setFlash('La tabR a bien été supprimée !', 'msg_delete');
			$this->redirect(array('action' => 'index',0));
		}		
	}

	// AJOUTER UNE TAB
	public function add() {
		if ($this->request->is('post')) {
			$this->Tab->create();
			if ($this->Tab->save($this->request->data)) {
				$this->Session->setFlash('La tab a été ajoutée avec succès !', 'msg_add');					
			} else {
				$this->Session->setFlash('La tab n\a pas été ajoutée !', 'msg_false');
			}
			$this->redirect(array('action' => 'index',0));
		}
	}

	// AJOUTER UNE TABR
	public function addTabR() {
		if ($this->request->is('post')) {

			//debug($this->request->data); die;
			$this->loadModel('TabR');

			$this->TabR->updateAll(
					array('order' => 'TabR.order+1'), 
					array(
						'TabR.order >=' => $this->request->data('TabR.order'),
						'TabR.controller' => $this->request->data('TabR.controller'),
						'TabR.action' => $this->request->data('TabR.action'),
						'TabR.event_id' => $this->request->data('TabR.event_id')
			));


			$this->TabR->create();
			if ($this->TabR->save($this->request->data)) {

				
				$this->Session->setFlash('La tabR a été ajoutée avec succès !', 'msg_add');					
			} else {
				$this->Session->setFlash('La tabR n\a pas été ajoutée !', 'msg_false');
			}


			if(isset($this->request->data['Tab']['by_view'])){
				if($this->request->data['Tab']['by_view'] == 'event'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['TabR']['event_id']));
				} else if($this->request->data['Tab']['by_view'] == 'delegation'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['delegation_id']));
				} else if($this->request->data['Tab']['by_view'] == 'participant'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['participant_id']));
				} else if($this->request->data['Tab']['by_view'] == 'stagiaire'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['stagiaire_id']));
				} else if($this->request->data['Tab']['by_view'] == 'Fsession'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['fsession_id']));
				} else if($this->request->data['Tab']['by_view'] == 'Formation'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['formation_id']));
				} else if($this->request->data['Tab']['by_view'] == 'Annuaire'){
					$this->redirect(array('controller' => $this->request->data['TabR']['controller'], 'action' => $this->request->data['TabR']['action'],$this->request->data['Tab']['annuaire_id']));
				} else {
					$this->redirect(array('action' => 'index',0));
				}
			} else {
				$this->redirect(array('action' => 'index',0));
			}
		}
	}

	// AJAX - DRAG and DROP
	public function ajax_sortable_tabs() {
		$model = 'TabR';
		if ( $this->request->is( 'post' ) ) {
			$this->loadModel($model);

			foreach( $_POST['SORTABLE'] as $order => $id ){
				
				$this->$model->id = $id;
				$this->$model->saveField('order',$order);
			}	
		}
		
	}


	
}
?>