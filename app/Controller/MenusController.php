<?php
// app/Controller/MenusController.php
class MenusController extends AppController {

	public function index() {

		$menu = $this->Menu->find('all', array(
			'conditions' => array(
				'Menu.id' => $this->Session->read('module_id')
				)
			)
		);

		//debug($menu);
		$this->set('menu',$menu);

		//s'il s'agit de l'appel pour l'élément
		if(isset($this->params['requested'])) { 
		$this->loadModel('MenuR');
		$this->MenuR->contain('Menu');
		$menu = $this->Menu->MenuR->find('all', array(
			'conditions' => array(
				'Menu.module_id' => $this->Session->read('module_id'),
				'Menu.active' => 1,
				'MenuR.profil_id' => $this->Session->read('profil_id')
				
				),'order' => 'Menu.order ASC'
			)
		);

		return $menu;
		}

	}

	// LISTE DES MENUS
	public function listing() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate('Menu'));
		$this->set('nbMenu', $this -> Menu -> find('count'));
		$this->set('nbRow', $this -> Menu -> find('count'));
	}

	// FICHE MENU
	public function view($id = null) {
		
		$this->Menu->contain('Profil');
		$profils = $this->Menu->Profil->find('list', array('conditions' => array('Profil.active' => 1)));
		$this->set(compact('profils'));

		if ( $this->request->is( 'ajax' ) ) {
			$this->Menu->contain('Profil');
			$id = $this->request->query[ 'id' ];
		    $menu = $this->Menu->findById($id);
		    $this->set(compact('menu'));
		}

		   

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Menu->id = $id;

	        if ($this->Menu->save($this->request->data)) {

	        	$this->Menu->updateAll(array('order' => 'Menu.order+1'), array('Menu.order >' => $this->request->data('Menu.order')));
	            $this->Session->setFlash('Le menu a été modifié avec succès', 'msg_enreg_ok');
	            return $this->redirect(array('controller' => 'modules', 'action' => 'view',$this->request->data('Menu.module_id')));
	        }
	        $this->Session->setFlash(__('Le menu n\'a pas été modifié'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $menu;
	        $this->set(compact('menu'));
	    }

	    $this->set(compact('menu'));
		

	  


		
	}

	// AJOUTER UN MENU
	public function add($id = null) {


		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash('Le menu a été ajouté avec succès !', 'msg_add');
				$this->redirect(array('controller' => 'modules', 'action' => 'view', $this->request->data['Menu']['module_id']));
			} else {
				$this->Session->setFlash(__('Le menu n\'a pas pu être ajouté.', 'msg_false'));
				$this->redirect(array('controller' => 'modules', 'action' => 'view', $this->request->data['Menu']['module_id']));
			}
		}
	}

	// SUPPRIMER UN MENU
	public function delete($id = null, $module_id) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Menu->delete()) {
			$this->Session->setFlash('Le menu a bien été supprimé !', 'msg_delete');
			$this->redirect(array('controller' => 'modules', 'action' => 'view', $module_id));
		}
		$this->Session->setFlash('Le menu na pas été supprimé !', 'msg_false');
		$this->redirect(array('controller' => 'modules', 'action' => 'view', $module_id));
	}	

	// AJAX - DRAG and DROP
	public function ajax_sortable_menus() {
		$model = 'Menu';
		if ( $this->request->is( 'post' ) ) {
			$this->loadModel($model);

			foreach( $_POST['SORTABLE_MENU'] as $order => $id ){
				
				$this->$model->id = $id;
				$this->$model->saveField('order',$order);
			}	
		}
		
	}
}
?>