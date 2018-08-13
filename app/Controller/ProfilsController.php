<?php
// app/Controller/ProfilsController.php
class ProfilsController extends AppController {

	public function index() {

		$profils = $this->Profil->find('all');
		$this->set('profils',$profils);
		$this->set('nbProfils', $this -> Profil -> find('count'));

		//s'il s'agit de l'appel pour l'élément
		if(isset($this->params['requested'])) { 
			$this->loadModel('ProfilR');
			
			$profil = $this->Profil->ProfilR->find('first', array(
				'contain' => array(
					'Profil',
					'Structure',
					'User' => array(
			            'Personne' => array(
			                'fields' => array('civilite','photo_thumb')
			            )			        
					)
				),
				'conditions' => array(
					'ProfilR.module_id' => 1,
					'ProfilR.user_id' => $this->Session->read('user_id'),
					'ProfilR.selected' => 1
				))
			);

			$this->loadModel('Module');
			$extranet_off = $this->Module->find('first', array(
				'conditions' => array(
					'id' => 1
				),
				'fields' => array('extranet_off')
			));
					
			$this->Session->write('profil_structure_id',$profil['ProfilR']['structure_id']);
			$this->Session->write('profil_structure_name',$profil['Structure']['name']);
			$this->Session->write('profil_libelle',$profil['Profil']['name']);
			$this->Session->write('profil_user_id',$profil['ProfilR']['profil_id']);
			$this->Session->write('profil_id',$profil['ProfilR']['profil_id']);
			$this->Session->write('profilR_id', $profil['ProfilR']['id']);
			$this->Session->write('profil_code',$profil['Profil']['code']);
			$this->Session->write('extranet_off',$extranet_off['Module']['extranet_off']);

			return $profil;
		}

	}

	public function index4() {

		//s'il s'agit de l'appel pour l'élément
		if(isset($this->params['requested'])) { 

		$nbProfil = $this->Profil->ProfilR->find('count', array(
			'conditions' => array(
				'ProfilR.module_id' => $this->Session->read('module_id'),
				'ProfilR.user_id' => $this->Session->read('user_id')
			))
		);
		
		return $nbProfil;
		}

	}

	public function index5() {

		//s'il s'agit de l'appel pour l'élément
		if(isset($this->params['requested'])) { 
		$this->loadModel('ProfilR');
		$this->ProfilR->contain('Structure','Profil');
		$profils_list = $this->Profil->ProfilR->find('all', array(
			'conditions' => array(
				'ProfilR.module_id' => $this->Session->read('module_id'),
				'ProfilR.user_id' => $this->Session->read('user_id')
			),
			'fields' => array('ProfilR.id', 'Profil.name', 'Structure.name')
			)
		);
		//debug($profils_list); die();
		return $profils_list;
		}

	}



	// AJOUTER UN PROFIL
	public function add($id = null) {

		if ($this->request->is('post')) {
			$this->Profil->create();
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash('Le profil a été ajouté avec succès !', 'msg_add');
			} else {
				$this->Session->setFlash(__('Le menu n\'a pas pu être ajouté.', 'msg_false'));			
			}
			$this->redirect(array('action' => 'index'));
		}
	}


	// Voir/modifier UN PROFIL-UTILISATEUR
	public function view($id = null) {
		if (!$id) {
	        throw new NotFoundException(__('Profil invalide'));
	    }

	    $profil = $this->Profil->findById($id);


	    if (!$profil) {
        throw new NotFoundException(__('Profil invalide'));
	    }

		
	        
	    if ($this->request->is('post')) {
	        $this->Profil->id = $id;

	        if ($this->Profil->save($this->request->data)) {       

 				$this->Session->setFlash('Le profil-utilisateur a été modifiée', 'msg_enreg_ok');
	            return $this->redirect(array('action' => 'view', $id));
	        }        
	        $this->Session->setFlash('Le profil-utilisateur n\'a pas été modifié', 'msg_false');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $profil;
	        $this->set(compact('profil'));

	    }

	}    

	// SUPPRIMER LE PROFIL
	public function delete($id = null) {

		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Profil->id = $id;
		if (!$this->Profil->exists()) {
			throw new NotFoundException(__('Menu Invalide'));
		}
		if ($this->Profil->delete()) {
			$this->Session->setFlash('Le profil a bien été supprimé !', 'msg_delete');
		} else {
		$this->Session->setFlash('Le profil n\'a pas été supprimé !', 'msg_false');
		}
		$this->redirect(array('action' => 'index'));
	}	
}

	
?>