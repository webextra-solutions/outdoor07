<?php
// app/Controller/DemandesController.php
class ConnectionsController extends AppController {


	// Accueil - Liste des Connexions
	public function indexAccueil() {

		//s'il s'agit de l'appel pour l'élément
		if(isset($this->params['requested'])) { 
			$this->Connection->contain('User', 'User.Personne');

			$controller = "seances";
			

			$connections = $this->Connection->find('all', array(
			'conditions' => array(
				//'Connection.module_id' => $this->Session->read('module_id'),
				//'Connection.controller' => $controller,
				//'Connection.action' => 'accueil',				
				),
			'group' => 'Connection.user_id',
			'order' => 'Connection.created_last DESC',
			'limit' => 20
			
			)
		);
	    return $connections;
       }
    }

	
	// Accueil - Liste des Connexions
	public function index($controllerFilter = 'null', $userFilter = null) {	

		


		$controllers = $this->Connection->find('list', array(
			'fields' => array('controller','controller'),
			'group' => array('controller')
		));
		$this->set(compact('controllers'));

		$actions = $this->Connection->find('list', array(
			'fields' => array('action','action'),
			'group' => array('action')
		));
		$this->set(compact('actions'));

		
		// FILTRE CONTROLLER
		if(!empty($this->data['Connection']['controller'])){ 
			$filterController = array('Connection.controller' => $this->request->data('Connection.controller')); 
		} else { 
			$filterController = array();
		}
	
		// FILTRE ACTION
		if(!empty($this->data['Connection']['action'])){ 
			$filterAction = array('Connection.action' => $this->request->data('Connection.action')); 
		} else { 
			$filterAction = array();
		}

		$filter = array_merge($filterController,$filterAction);

	    	


	   

		

		$this->Paginator->settings = array(
	        'limit' => 100,
	        'contain' => array(
	        	'User' => array('Personne' => array(
	        		'fields' => array('PersonneNom', 'PersonnePrenom'))),
	        	'ProfilR' => array(
	        		'fields' => array('profil_id', 'structure_id'),
	        		'Profil' => array('fields' => array('name')),
	        		'Structure' => array('fields' => array('name'))
	        	)	        	
	        ),
	        'conditions' => $filter,
	        'group' => 'Connection.id',
			'order' => 'Connection.created DESC'	
	    	);
		$this->set('connections', $this->paginate('Connection'));

    }
	
	
		// Accueil - Liste des Connexions
	public function index2() {	


		

		$this->Paginator->settings = array(
	        'limit' => 100,
	        'contain' => array(
	        	'User' => array('Personne' => array(
	        		'fields' => array('PersonneNom', 'PersonnePrenom'))),
	        	'ProfilR' => array(
	        		'fields' => array('profil_id', 'structure_id'),
	        		'Profil' => array('fields' => array('name')),
	        		'Structure' => array('fields' => array('name'))
	        	)	        	
	        ),
	       
	        'group' => array('Connection.user_id HAVING MAX(Connection.created) < "2015-06-01"'),
			'order' => 'Connection.created_last DESC'	
	    	);
		$this->set('connections', $this->paginate('Connection'));

    }


   // AJOUTER UNE CONNEXION
	public function add() {
		
		
				
		if ($this->request->is('post')) {
			$this->request->data['Demande']['ddn'] = $this->Formatage->dateFRtoUS($this->request->data['Demande']['ddn']);
			$this->Demande->create();
			if ($this->Demande->save($this->request->data)) {

				// Liste des emails des administrateurs et gestionnaires DAHLIR
				$this->loadModel('ProfilR');
				$destinataires = $this->ProfilR->find('list', array(
					'recursive' => 1,
					'conditions' => array(
						'OR' => array(
							'ProfilR.profil_id' => 1,
							'AND' => array(
								'ProfilR.profil_id' => 2,
								'ProfilR.dahlir_id' => $this->request->data['Demande']['dahlir_id']
							)
						)
					),
					'fields' => array('User.email')
				));

				//debug($destinataires); die;

				// ALERT EMAIL -> AU GESTIONNAIRE DAHLIR
				$email = new CakeEmail('default');
				$email->from(array('extranet'.$this->request->data['Demande']['dahlir_id'].'@dahlir.fr' => 'Extranet Dahlir '.$this->request->data['Demande']['dahlir_id']));
				//$email->to($this->request->data['Demande']['email']);
				$email->to($destinataires);


				$email->viewVars(array(
						'Name' => $this->request->data('Demande.name'),
						'Firstname' => $this->request->data('Demande.first_name'),
						'Dahlir' => $this->request->data('Demande.dahlir_id')
				));
				$email->subject('Extranet DAHLIR '.$this->request->data['Demande']['dahlir_id'].' - Nouvelle demande');
				$email->template('new_demande','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}

				$this->Session->setFlash('La demande a été transmise à notre équipe. Nous prendrons contact avec vous lors du traitement de votre demande.', 'msg_success');
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));
				
			} else {
				$this->Session->setFlash(__('La demande n\'a pu être transmise !'));
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
		}
    } 

    // AJOUTER UN DEMANDE de la page DEMANDES
	public function add2() {
		if ($this->request->is('post')) {
			$this->request->data['Demande']['ddn'] = $this->Formatage->dateFRtoUS($this->request->data['Demande']['ddn']);
			$this->Demande->create();
			if ($this->Demande->save($this->request->data)) {

				// Liste des emails des administrateurs et gestionnaires DAHLIR
				$this->loadModel('ProfilR');
				$destinataires = $this->ProfilR->find('list', array(
					'recursive' => 1,
					'conditions' => array(
						'ProfilR.profil_id' => array(1,2)
					),'fields' => array('User.email')
				));

				//debug($destinataires); die;

				// ALERT EMAIL -> AU GESTIONNAIRE DAHLIR
				$email = new CakeEmail('default');
				$email->from(array('extranet@dahlir.fr' => 'Extranet Dahlir 43'));
				//$email->to($this->request->data['Demande']['email']);
				$email->to($destinataires);


				$email->viewVars(array(
						'Name' => $this->request->data('Demande.name'),
						'Firstname' => $this->request->data('Demande.first_name')
				));
				$email->subject('Extranet DAHLIR 43 - Nouvelle demande');
				$email->template('new_demande','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}

				$this->Session->setFlash('La demande a été transmise à notre équipe. Nous prendrons contact avec vous lors du traitement de votre demande.', 'msg_success');
				return $this->redirect(array('controller' => 'demandes', 'action' => 'index'));
				
			} else {
				$this->Session->setFlash(__('La demande n\'a pu être transmise !'));
				return $this->redirect(array('controller' => 'demandes', 'action' => 'index'));
			}
		}
    } 

    // SUPPRIMER UN DEMANDE
    public function delete($id = null) {

	    $this->Demande->id = $id;
	    if (!$this->Demande->exists()) {
	        throw new NotFoundException(__('Demande invalide'));
	    }
	    if ($this->Demande->delete()) {
	        $this->Session->setFlash('Le demande a été supprimée', 'msg_delete');
	        return $this->redirect(array('action' => 'index'));
	    }
	    $this->Session->setFlash(__('Le demande n\'a pas été supprimé'));
	    return $this->redirect(array('action' => 'index'));
	}   

	// VOIR / MODIFIER UNE ADAPTATION
	public function view($id = null) {
		if ( $this->request->is( 'ajax' ) ) {
			$this->Demande->recursive = 2;
		    $id = $this->request->query[ 'id' ];	   
		    $demande = $this->Demande->findById($id);
		    $this->set(compact('demande'));
		    //debug($adaptation); die;
		}
		   
 		if ($this->request->is(array('post', 'put'))) {
	        $this->Demande->id = $id;
	        $this->request->data['Demande']['ddn'] = date('Y-m-d', strtotime($this->request->data['Demande']['ddn']));
	        if ($this->Demande->save($this->request->data)) {
	            $this->Session->setFlash('La demande a été modifié', 'msg_enreg_ok');
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('La demande n\'a pas été modifié avec succès !'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $demande;
	        $this->set(compact('demande'));

	    }

	    $this->set(compact('demande'));

	}        
   

	// RECHERCHER UN DEMANDE
	function searchDemande(){
		if ($this->request->is('ajax')) {
			Configure::write ( 'debug', 0);
			$this->autoRender=false;

			$demandes=$this->Demande->find('all',array(
					'conditions'=> array(
							'Demande.name LIKE'=>''.$_GET['term'].'%',
							'Demande.dahlir_id'=> $this->Session->read('dahlir')
					)
			));
			
			
			$i=0;
			foreach($demandes as $demande){
				$response[$i]['id']=$demande['Demande']['id'];
				$response[$i]['label']=$demande['Demande']['name'].' '.$demande['Demande']['first_name'];
				$i++;
			}
			
			echo json_encode($response);
		}
	}

}
?>