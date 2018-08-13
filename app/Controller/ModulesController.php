<?php
// app/Controller/MenusController.php
class ModulesController extends AppController {

	// LISTE DES MODULES DE L'EXTRANET
	public function index($id = null) {

		$module = $this->Module->find('all');
		$this->set('modules', $module);
		$this->set('nbModules', $this -> Module -> find('count'));



		if(isset($this->params['requested'])) { 

			$this->loadModel('ProfilR');
			$this -> ProfilR -> contain('Module');
			$module1 = $this->ProfilR->find('all', array(
				'conditions' => array(
					'ProfilR.user_id' => $this->Auth->user('id'),
					'ProfilR.active' => 1,
					'Module.active' => 1,
					'Module.type_module' => 'module'
					),
				'group' => 'ProfilR.module_id',
				'order' => 'Module.order ASC'
				)
			);

			
			
			return $module1;
		}
	}

	public function index2($id = null) {
		
		if(isset($this->params['requested'])) { 
			
			$module_active = $this->Module->find('all', array(
				'fields' => array('id','name'),
				'conditions' => array(
					'Module.id' => $this->Session->read('module_id')
					)
				)
			);
			return $module_active;
		}
	}

	public function index3($id = null) {
		$module = $this->Module->find('all');
		
		if(isset($this->params['requested'])) { 
			$this->loadModel('ProfilR');
			$this->ProfilR->contain('Module');
			$module2 = $this->Module->ProfilR->find('all', array(
				'conditions' => array(
					'ProfilR.user_id' => $this->Auth->user('id'),
					'Module.active' => 1,
					'Module.type_module' => 'extranet'
					),
				'group' => 'ProfilR.module_id',
				'order' => 'Module.order ASC'
				)
			);
			//debug($module2); die;
			return $module2;
		}
	}


	// Voir/modifier UN MODULE
	public function view($id = null) {
		if (!$id) {
	        throw new NotFoundException(__('Module invalide'));
	    }
	    $this->Module->contain('Menu','Menu.Profil');
	    $profils = $this->Module->Menu->Profil->find('list', array('conditions' => array('Profil.active' => 1)));
		$this->set(compact('profils'));

	    $module = $this->Module->findById($id);

	    $menus = $this->Module->Menu->find('all', array(
	    	'conditions' => array(
	    		'Menu.module_id' => $id
	    	)
	    ));
	    $this->set(compact('menus'));

	   	$this->set(compact('module'));

	    if (!$module) {
        throw new NotFoundException(__('Module invalide'));
	    }

		
	        
	    if ($this->request->is('post')) {
	        $this->Module->id = $id;

	        if ($this->Module->save($this->request->data)) {       

 				$this->Session->setFlash('Le module a été modifiée', 'success');
	            return $this->redirect(array('action' => 'view', $id));
	        }        
	        $this->Session->setFlash('Le module n\'a pas été modifié', 'failure');
	    }

	} 

	// SUPPRIMER UN MODULE
	public function delete($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		

		if ($this->Module->delete($id)) {
			$this->Session->setFlash('Le module a bien été supprimé !', 'msg_delete');
			$this->redirect(array('action' => 'index'));
		}
		
	}   

	// VOIR / MODIFIER EXTRANET POWER
	public function viewExtranetPower($id = null) {		
		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ]; 
		    $extraPOW = $this->Module->findById($id);
		    $this->set(compact('extraPOW'));
		   
		}
	    if ($this->request->is(array('post', 'put'))) {
	    	$this->Module->id = $this->request->data('Module.id');    	
	        if ($this->Module->save($this->request->data)) {

	        	$this->Session->write('extranet_off',$this->request->data('Module.extranet_off') );
	        	      	
            	$this->Session->setFlash('L\'extranet a été modifié avec succès !', 'msg_enreg_ok');
            } else {
            	 $this->Session->setFlash('L\'extranet n\'a pas été modifiée !', 'msg_false');
            }
            return $this->redirect(array('controller' => 'accueils','action' => 'params', 6));


        }	    

	    if (!$this->request->data) {
	        $this->request->data = $extraPOW;
	        $this->set(compact('extraPOW'));
	    }
	    $this->set(compact('extraPOW'));
	}


}
?>