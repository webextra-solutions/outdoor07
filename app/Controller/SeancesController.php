<?php

App::uses('CakeEmail', 'Network/Email');
class SeancesController extends AppController {

	public function afterFilter() {
		if(!is_null(AuthComponent::user('id'))){
			$this->loadModel('Connection');
			$this->Connection-> create();
		    $this->Connection-> save(array(
		        'user_id' => $this->Auth->User('id'),
		        'profil_id' => $this->Session->read('profilR_id'),
		        'module_id' => $this->Session->read('module_id'),
		        'controller' => $this->request->controller,
		        'action' => $this->request->action
		    ));
		}	
	}

	function searchSeance(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 2 );
				$this->autoRender=false;
				$seances=$this->Seance->find('all',array(
						'conditions'=> array(							
								'Seance.num LIKE'=>''.$_GET['term'].'%'
						),
						'order' => array('Seance.num ASC')
				));
				$i=0;
				foreach($seances as $seance){
					$response[$i]['id']=$seance['Seance']['id'];
					$response[$i]['value']='Séance n°'.$seance['Seance']['num'];
					$response[$i]['value']='Séance n°'.$seance['Seance']['num'].' • '.$seance['Seance']['date'];
					$i++;
				}
				
	            
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('seances',$this->paginate(array('Seance.num LIKE'=>'%'.$this->data['Seance']['num'].'%')));
				}
			}
		}


	// LISTE DES NEWS DU MODULE
	public function accueil($id = null) {

		$this->Session->delete('module_id');
		$this->Session->write('module_id', 2);

		/*$this->Paginator->settings = array('contain' => 'Seance.User.Personne', 'group' => 'SeanceR.article_id');*/

		$this->set('seances', $this->paginate('Seance'));


	}


	// PAGE PUBLIC PRESENCE
	public function presence($id = null) {

		if ( $this->request->is( 'post' ) ) {	
			//debug($this->request->data); die;
			$personne_seance = $this->Seance->PersonnesSeance->find('first', array(
				'conditions' => array(
					'id' => $this->request->data['PersonnesSeance']['id']
				),
			));

			$this->request->data['PersonnesSeance']['date_presence'] = date('Y-m-d H:i');
			$this->Seance->PersonnesSeance->id = $personne_seance['PersonnesSeance']['id'];


			if ($this->Seance->PersonnesSeance->save($this->request->data)) { 
				$this->Flash->set('Données enregistrées ! N\'oubliez pas les autres séances s\'il y en a !',array('element' => 'success'));		 
			}else {
				$this->Flash->set('Les données n‘ont pas été enregistrées avec succès !',array('element' => 'false'));
			}
		}  


		$this->layout = 'defaultLogin';

		/*$seances = $this->Seance->find('all', array(
			'conditions' => array(
				//'date >' => date('Y-m-d'),
				'published' => 1
			),
			'order' => array('date' => 'ASC')
		));*/

		$seances_list = $this->Seance->find('list', array(
			'conditions' => array(
				'date >=' => date('Y-m-d'),
				'published' => 1
			),
			'fields' => array('id')
		));
		$this->loadModel('Personne');
		$pratiquants = $this->Personne->find('all', array(
			'contain' => array(
				'PersonnesSeance' => array(
					'conditions' => array(
						'seance_id' => $seances_list
					),
					'Seance'
				)
			),
			'conditions' => array(
				'id' => $id,
			),
			'order' => array('FN' => 'ASC')
		));		
		$this->set(compact('pratiquants'));	

		$this->loadModel('PersonnesSeance');
		$personnes_seances = $this->PersonnesSeance->find('all', array(
			'contain' => array(
				'Personne',
				'Seance'
			),
			'conditions' => array(
				'PersonnesSeance.personne_id' => $id,
				'Seance.date >=' => date('Y-m-d'),
				'Seance.published' => 1
			),
			'order' => array('Seance.date' => 'ASC')
		));		
		$this->set(compact('personnes_seances'));	



		/*if (!$this->request->data) {
	        $this->request->data = $seances;
	        $this->set(compact('seances'));
	    }
	    
	    $this->set(compact('seances'));*/
	}

	// LISTE DES NEWS DU MODULE
	public function index($id = null) {

		$this->Session->delete('module_id');
		$this->Session->write('module_id', 2);

		$this->Paginator->settings = array(
			'contain' => array('Presents','Encadrants','Prevus'),
			'limit' => 100,
			'order' => array('num' => 'DESC'));

		$this->set('seances', $this->paginate('Seance'));



		// Liste - SEANCES A VENIR  
		$seancesAvenir = $this->Seance->find('list',array(
			'conditions' => array(
				'date >' => date('Y-m-d'),
				'published' => 1
			),
			 'fields' => array('id')));

		// DESTINATIRE DE L'EMAIl EN FONCTON DE LA CIBLE DE LA NEWS
		$this->loadModel('PersonnesSeance');
		$destinataires = $this->PersonnesSeance->find('count', array(
			'conditions' => array(
				'PersonnesSeance.type' => 1,
				'PersonnesSeance.seance_id' => current($seancesAvenir),
				'Personne.email !=' => '',
				'PersonnesSeance.email' => null
			),
			'contain' => array('Personne'),
			//fields' => array('Personne.email'),
			'order' => array('PersonnesSeance.id' => 'ASC')
		));
		$this->set(compact('destinataires'));


		// DESTINATIRE DE L'EMAIl EN FONCTON DE LA CIBLE DE LA NEWS
		$this->loadModel('PersonnesSeance');
		$destinataires2 = $this->PersonnesSeance->find('count', array(
			'conditions' => array(
				'PersonnesSeance.type' => 1,
				'PersonnesSeance.seance_id' => current($seancesAvenir),
				'Personne.email !=' => '',
				'PersonnesSeance.presence' => '',
				'PersonnesSeance.email_rappel' => null
			),
			'contain' => array('Personne'),
			//fields' => array('Personne.email'),
			'order' => array('PersonnesSeance.id' => 'ASC')
		));
		$this->set(compact('destinataires2'));

		/*foreach ($destinataires as $row) {

		
					$this->loadModel('PersonnesSeance');
					//$this->PersonnesSeance->id = $row['PersonnesSeance']['id'];
					//$this->PersonnesSeance->save(array('email' => date('Y-m-d H:i')));

					$this->PersonnesSeance->updateAll(
						
						array('PersonnesSeance.email' =>  "'".date('Y-m-d H:i:s')."'"),
						array('PersonnesSeance.seance_id' => $seancesAvenir, 'PersonnesSeance.personne_id' => $row['PersonnesSeance']['personne_id'])
					);

		}*/

		





		/*$seances2 = $this->Seance->find('all');
		$this->loadModel('Personne');
		$pratiquants = $this->Personne->find('all', array(
			//'contain' => array('Personne'),
			'conditions' => array(
				'pratiquant' => 1
			)
		));	

		$this->Seance->query('TRUNCATE table personnes_seances;');	

		foreach ($seances2 as $row) {

			foreach ($pratiquants as $row2) {
				

				if($row2['Personne']['civilite'] == 'M'){
				 	$thumb = 'user';
				 } else {
				 	$thumb = 'woman';
				 }

				$this->loadModel('PersonnesSeance');
				$this->PersonnesSeance->create();
				$this->PersonnesSeance->save(
					array(
						'personne_id' => $row2['Personne']['id'],
						'seance_id' => $row['Seance']['id'],
						'type' => 1,
						'user_create_id' => 1,
						'user_modify_id' => 1,
						'groupe' => $row2['Personne']['groupe']
					)

				);


				$this->loadModel('Personne');
				$this->Personne->id = $row2['Personne']['id'];
				$this->Personne->save(
					array(
						'photo_thumb' => $thumb,
						'created' => date('Y-m-d'),
						'modified' => date('Y-m-d'),
						'user_create_id' => 1,
						'user_modify_id' => 1
					)

				);

			}
		}*/

	}

	// METTRE PRESENCE A TOUS
	public function allPresenceEffective($seance_id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		

		if ($this->Seance->PersonnesSeance->updateAll(
			array('presence_eff' => 1),
			array('seance_id' => $seance_id)
		)) {
			$this->Flash->set('L’action s’est déroulée avec succès !', array('element' => 'success'));
			$this->redirect(array('action' => 'view',$seance_id,'personnes'));
		}	
	}

	// METTRE PRESENCE A TOUS
	public function presenceEffective($id,$presence,$seance_id) {
		
		if ($this->Seance->PersonnesSeance->updateAll(
			array('presence_eff' => $presence),
			array('PersonnesSeance.id' => $id)
		)) {
			$this->Flash->set('L’action s’est déroulée avec succès !', array('element' => 'success'));
			$this->redirect(array('action' => 'view',$seance_id,'personnes'));
		}	
	}

	// METTRE PRESENCE A TOUS
	public function presencePrev($id,$presence,$seance_id) {
		
		if ($this->Seance->PersonnesSeance->updateAll(
			array('presence' => $presence),
			array('PersonnesSeance.id' => $id)
		)) {
			$this->Flash->set('L’action s’est déroulée avec succès !', array('element' => 'success'));
			$this->redirect(array('action' => 'view',$seance_id,'personnes'));
		}	
	}


	// NE PLUS AFFICHER L'ARTICLE EN POPU
	public function skipPopupProfil() {

		$this->loadModel('ProfilR');
    	$this->ProfilR->updateAll(
		    array('popup_accueil_etat' => 0),
		    array('ProfilR.id' => $this->Session->read('profilR_id'))
		);

		$this->Session->delete('profil_popup');
		$this->Session->write('profil_popup', 0);

		if($this->Session->read('module_id') == 2){return $this->redirect(array('controller' => 'diplomes','action' => 'accueil'));}
		if($this->Session->read('module_id') == 3){return $this->redirect(array('controller' => 'events','action' => 'accueil'));}

	}

	// VOIR / MODIFIER UNE SEANCE
	public function view($id = null, $tabActive = null) {

		$this->Session->delete('module_id');
		$this->Session->write('module_id', 2);

		$this->set(compact('tabActive'));
		   
	    //$this->Seance->contain('Profil');
	    $seance = $this->Seance->findById($id);
		//$this->set('profils', $this->Seance->Profil->find('list', array('conditions' => array('Profil.active' => 1))));
	    $this->set(compact('seance'));


	    $seances = $this->Seance->find('all',array('order' => array('date' => 'ASC')));
	    $this->set(compact('seances'));
	

	   //debug($fsession); die;
		$this->loadModel('TabsView');
		$tabs = $this->TabsView->find('all', array(
				'conditions' => array(
					'controller' => 'seances',
					'action' => 'view'
				))
		);		
		$this->set(compact('tabs'));


		// GROUPES
		for ($i=1; $i <= $seance['Seance']['nb_groups']; $i++) { 
	
			${"pratiquants_gp$i"} = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp'.$i));	

			${"nb_pratiquants_gp$i"} = $this->Seance->PersonnesSeance->find('count', array(
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i,
					'PersonnesSeance.presence' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('nb_pratiquants_gp'.$i));

			${"nb_pratiquants_gp_eff$i"} = $this->Seance->PersonnesSeance->find('count', array(
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i,
					'PersonnesSeance.presence_eff' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('nb_pratiquants_gp_eff'.$i));

			${"nb_pratiquants_gp_prev$i"} = $this->Seance->PersonnesSeance->find('count', array(
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i,
					'PersonnesSeance.presence' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('nb_pratiquants_gp_prev'.$i));


			${"encadrants_gp$i"} = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp'.$i));


			${"accomps_gp$i"} = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => $i,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp'.$i));
		}

	  
	    if ($this->request->is(array('post', 'put'))) {	  
	        $this->Seance->id = $id;
	        if ($this->Seance->save($this->request->data)) {

	        	/*if($this->request->data('Seance.popup') == 1){
		        	$this->loadModel('ProfilR');
		        	$this->ProfilR->updateAll(
					    array('popup_accueil_etat' => 1),
					    array('module_id' => 3)
					);
				}
				if($this->request->data('Seance.popup') == 0){
					$this->loadModel('ProfilR');
		        	$this->ProfilR->updateAll(
					    array('popup_accueil_etat' => 0),
					    array('module_id' => 3)
					);

				}*/

	           $this->Flash->set('La séance a été modifiée avec succès !',array('element' => 'save'));
	           return $this->redirect(array('action' => 'view', $id,$this->request->data['Seance']['tabActive']));
	        } else {
	        	$this->Flash->set('La séance n\'a pas été modifiée',array('element' => 'false'));
	        }

	        $tabActive = $this->request->data['Seance']['tabActive'];
	    }


	    

	    if (!$this->request->data) {
	        $this->request->data = $seance;
	        $this->set(compact('seance'));
	        $this->set(compact('tabActive'));
	    }


	    
	   
	}

	// VOIR UNE NEWS 2
	public function view2($id = null) {

		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ];
		    $news = $this->Seance->findById($id);
		    $this->set(compact('news'));
		}

	    

	    if (!$this->request->data) {
	        $this->request->data = $news;
	        $this->set(compact('news'));
	    }
	    
	    $this->set(compact('news')); 
	}

	// VOIR UNE NEWS POPUP
	public function view3($id = null) {

		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ];
		    $news = $this->Seance->findById($id);
		    $this->set(compact('news'));
		}

	    

	    if (!$this->request->data) {
	        $this->request->data = $news;
	        $this->set(compact('news'));
	    }
	    
	    $this->set(compact('news')); 
	}

	// SUPPRIMER UNE NEWS
	public function delete($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		
		if ($this->Seance->delete($id)) {
			$this->Flash('La séance a bien été supprimée !', array('element' => 'false'));
			$this->redirect(array('action' => 'index'));
		}		
	}

	// SUPPRIMER UNE NEWS
	public function publish($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		$this->Seance->id = $id;
		if ($this->Seance->save(array('published' => 1))) {
			$this->Flash('La séance a bien été publiée !', array('element' => 'success'));
			$this->redirect(array('action' => 'view',$id,'general'));
		}		
	}

	// SUPPRIMER UNE NEWS
	public function unpublish($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		$this->Seance->id = $id;
		if ($this->Seance->save(array('published' => 0))) {
			$this->Flash('La séance a bien été dépubliée !', array('element' => 'false'));
			$this->redirect(array('action' => 'view',$id,'general'));
		}		
	}


	// AJOUTER UNE NEWS
	public function add() {

		if ($this->request->is('post')) {

			//debug($this->request->data); die;


			$lastNum = $this->Seance->find('first', array('fields' => array('num'),'order' => array('num' => 'DESC')));

			$this->request->data['Seance']['num'] = $lastNum['Seance']['num']+1;

			if($this->request->data['Seance']['type_add'] == 1){

				$this->Seance->contain(array('PersonnesSeance'));
				$seance = $this->Seance->findById($this->request->data['Seance']['add_num']);

				$this->request->data['Seance']['besoins_materiels'] = $seance['Seance']['besoins_materiels'];

				$this->request->data['Seance']['nb_groups'] = $seance['Seance']['nb_groups'];


				$this->request->data['Seance']['rdv_gp1'] = $seance['Seance']['rdv_gp1'];
				$this->request->data['Seance']['rdv_gp2'] = $seance['Seance']['rdv_gp2'];
				$this->request->data['Seance']['rdv_gp3'] = $seance['Seance']['rdv_gp3'];

				$this->request->data['Seance']['debut_gp1'] = $seance['Seance']['debut_gp1'];
				$this->request->data['Seance']['debut_gp2'] = $seance['Seance']['debut_gp2'];
				$this->request->data['Seance']['debut_gp3'] = $seance['Seance']['debut_gp3'];

				$this->request->data['Seance']['fin_gp1'] = $seance['Seance']['fin_gp1'];
				$this->request->data['Seance']['fin_gp2'] = $seance['Seance']['fin_gp2'];
				$this->request->data['Seance']['fin_gp3'] = $seance['Seance']['fin_gp3'];

				$this->request->data['Seance']['date_gp1'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);
				$this->request->data['Seance']['date_gp2'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);
				$this->request->data['Seance']['date_gp3'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);

				$this->request->data['Seance']['active_others_persons'] = $seance['Seance']['active_others_persons'];
				$this->request->data['Seance']['active_montant_supp'] = $seance['Seance']['active_montant_supp'];

			



				$this->Seance->create();
				if ($this->Seance->save($this->request->data)) {



					foreach ($seance['PersonnesSeance'] as $row) {
						$datas = array(
							'personne_id' => $row['personne_id'],
							'seance_id' => $this->Seance->id,
							'user_create_id' => $this->request->data['Seance']['user_create_id'],
							'user_modify_id' => $this->request->data['Seance']['user_modify_id'],
							'groupe' => $row['groupe'],
							'type' => $row['type']
						);
						$this->Seance->PersonnesSeance->create();
						$this->Seance->PersonnesSeance->save($datas);
					}
					$this->Flash('La séance a été ajoutée avec succès !', array('element' => 'success'));
					$this->redirect(array('action' => 'view', $this->Seance->id, 'general'));
				} else {
					$this->Flash('La séance n‘a pas été ajoutée !', array('element' => 'false'));
				}


			} else {

				$this->request->data['Seance']['date_gp1'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);
				$this->request->data['Seance']['date_gp2'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);
				$this->request->data['Seance']['date_gp3'] = $this->Formatage->dateFRtoUS($this->request->data['Seance']['date']);


				$this->Seance->create();
				if ($this->Seance->save($this->request->data)) {
					$this->Flash('La séance a été ajoutée avec succès !', array('element' => 'success'));
					$this->redirect(array('action' => 'view', $this->Seance->id, 'general'));
				} else {
					$this->Flash('La séance n‘a pas été ajoutée !', array('element' => 'false'));
				}

			}
			
		}
	}


	// AVERTIR SEANCES A VENIR
	public function emailSeances() {

		//Configure::write ( 'debug', 2 );


		// Liste - SEANCES A VENIR  
		$seances = $this->Seance->find('list',array(
			'conditions' => array(
				'date >' => date('Y-m-d'),
				'published' => 1
			),
			 'fields' => array('id')));

		// DESTINATIRE DE L'EMAIl EN FONCTON DE LA CIBLE DE LA NEWS
		$this->loadModel('PersonnesSeance');
		$destinataires = $this->PersonnesSeance->find('all', array(
			'conditions' => array(
				'PersonnesSeance.type' => 1,
				'PersonnesSeance.seance_id' => current($seances),
				'Personne.email !=' => '',
				'PersonnesSeance.email' => null
			),
			'contain' => array('Personne'),
			//fields' => array('Personne.email'),
			'order' => array('PersonnesSeance.id' => 'ASC'),
			'limit' =>  15
		));

		
		//debug($destinataires); die;
		


		$envoi = 0; foreach ($destinataires as $row) {

			

			// ENVOI DU MAIL						
			$email = new CakeEmail();
			$email->from(array($this->Auth->User('email') => 'Extranet Outdoor 07'));
			if(!empty($row['Personne']['email2'])){
				$email->to(array($row['Personne']['email'],$row['Personne']['email2']));				
			} else{
				$email->to($row['Personne']['email']);
			}

			//$email->bcc('samuel.ginot@gmail.com');
			$email->viewVars(array(
					'first_name' => $row['Personne']['first_name'],
					'id' => $row['Personne']['id']
			));
			$email->subject('Ecole des sports - Outdoor 07 - Séances à venir !');
			$email->template('alert_presence','parents');
			$email->emailFormat('html');
			if(alerteEmail){
				if($email->send()){

					$envoi++;
					$this->loadModel('PersonnesSeance');
					//$this->PersonnesSeance->id = $row['PersonnesSeance']['id'];
					//$this->PersonnesSeance->save(array('email' => date('Y-m-d H:i')));

					$this->PersonnesSeance->updateAll(
						
						array('PersonnesSeance.email' =>  "'".date('Y-m-d H:i:s')."'"),
						array('PersonnesSeance.seance_id' => $seances, 'PersonnesSeance.personne_id' => $row['PersonnesSeance']['personne_id'])
					);

					//debug($row['PersonnesSeance']['id'].'-'.$row['Personne']['email'].' - ok');
				} else {
					///debug($row['PersonnesSeance']['id'].'-'.$row['Personne']['email'].' - erreur');

				};				
			}

			/*try{
			    $email->send();
			    debug($row['PersonnesSeance']['id'].'-'.$row['Personne']['email']);
			} catch(Exception $e){
			    echo $e->getMessage();
			}*/


				
		}

		//die;*/

		if($envoi != 0){
			$this->Flash->set($envoi.' envois effectués',  array('element' => 'warning_send'));
		} else {
			$this->Flash->set('envois terminés',  array('element' => 'success_send'));
		}
		$this->redirect(array('action' => 'index'));	
	}




	// AVERTIR RAPPEL SEANCES A VENIR
	public function emailRappelSeances() {

		Configure::write ( 'debug', 2 );

		// Liste - SEANCES A VENIR  
		$seances = $this->Seance->find('list',array(
			'conditions' => array(
				'date >' => date('Y-m-d'),
				'published' => 1
			),
			 'fields' => array('id')));

	


		// DESTINATIRE DE L'EMAIl EN FONCTON DE LA CIBLE DE LA NEWS
		$this->loadModel('PersonnesSeance');
		$destinataires = $this->PersonnesSeance->find('all', array(
			'conditions' => array(
				'PersonnesSeance.type' => 1,
				'PersonnesSeance.seance_id' => current($seances),
				'Personne.email !=' => '',
				//'PersonnesSeance.personne_id' => array(45,31),
				'PersonnesSeance.presence' => '',
				'PersonnesSeance.email_rappel' => null
			),
			'contain' => array('Personne'),
			'fields' => array('Personne.email','Personne.first_name', 'PersonnesSeance.id'),
			'order' => array('PersonnesSeance.id' => 'ASC'),
			'limit' => 15
		));

		
		//debug(implode(',',$destinataires)); die;
		//debug($destinataires); die;
		


		$envoi = 0; foreach ($destinataires as $row) {

			

			// ENVOI DU MAIL						
			$email = new CakeEmail();
			$email->from(array($this->Auth->User('email') => 'Extranet Outdoor 07'));
			if(!empty($row['Personne']['email2'])){
				$email->to(array($row['Personne']['email'],$row['Personne']['email2']));				
			} else{
				$email->to($row['Personne']['email']);
			}

			//$email->to('samuel.ginot@gmail.com');
			$email->viewVars(array(
					'first_name' => $row['Personne']['first_name'],
					'id' => $row['Personne']['id']
			));
			$email->subject('Ecole des sports - Outdoor 07 - Séances à venir !');
			$email->template('alert_presence','parents');
			$email->emailFormat('html');
			if(alerteEmail){
				if($email->send()){
					$this->loadModel('PersonnesSeance');
					//$this->PersonnesSeance->id = $row['PersonnesSeance']['id'];
					//$this->PersonnesSeance->save(array('email_rappel' => date('Y-m-d H:i')));

					$this->PersonnesSeance->updateAll(
						
						array('PersonnesSeance.email_rappel' =>  "'".date('Y-m-d H:i:s')."'"),
						array('PersonnesSeance.seance_id' => $seances, 'PersonnesSeance.personne_id' => $row['PersonnesSeance']['personne_id'])
					);

					//debug($row['PersonnesSeance']['id'].'-'.$row['Personne']['email'].' - OK');
				}else{

					//debug($row['PersonnesSeance']['id'].'-'.$row['Personne']['email'].' - NO');
				};				
			}


				
		}

		

		

		$this->Flash->set('L\'email a été renvoyé avec succès pour chacun des enfants • '.$envoi.' renvois effectués',  array('element' => 'success_send'));
		$this->redirect(array('action' => 'index'));

		
	}	


	// ENVOYER LA NEWS
	public function alertNews($id) {

		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}



		// Liste - PROFIl NEWS     
		$profils = $this->Seance->SeanceR->find('list',array('conditions' => array('article_id' => $id), 'fields' => array('profil_id')));

		$news = $this->Seance->find('all', array(
				'conditions' => array('Seance.id' => $id)
		));


		// DESTINATIRE DE L'EMAIl EN FONCTON DE LA CIBLE DE LA NEWS
		$this->loadModel('User');
		$destinataires = $this->User->ProfilR->find('list', array(
					'conditions' => array(
						'ProfilR.profil_id' => $profils,
						'ProfilR.module_id' => 3,
						'ProfilR.alertes_email' => 1
					),
					'recursive' => 2,
					'fields' => array('User.email'),
					'group' => array('User.email')
				));

		// ENVOI DU MAIL	
				
		$email = new CakeEmail();
		$email->from(array($this->Auth->User('email') => 'Extranet Handisport'));
		$email->to(emailAdmin);
		$email->bcc($destinataires);
		$email->viewVars(array(
				'news_name' => $news[0]['Seance']['name'],
				'news_details' => $news[0]['Seance']['details'],
				'news_declarant' => $this->Session->read('prenom_nom_user'),
		));
		$email->subject('Extranet Handisport - News / Gestion des événements handisport');
		$email->template('add_news','default');
		$email->emailFormat('html');
		if(alerteEmail){$email->send();}

		$this->Session->setFlash('L\'email a été envoyé avec succès !', 'msg_send');
		$this->redirect(array('action' => 'index'));

		
	}	



	// AJOUT Presence
	public function addPresenceByAjax($id = null) {
		$this->autoRender=false;
		if ( $this->request->is( 'ajax' ) ) {	
			if ($this->Seance->PersonnesSeance->save($this->request->data)) { 
				echo"test";			 
			}		    
		}   
	}

		// AJOUTER UN DROIT UTILISATEUR
	public function addPersonneSeance() {


	    if ($this->request->is('post') or $this->request->is('put')) {

	    	//debug($this->request->data); die;

	    	
				if($this->Seance->PersonnesSeance->save($this->request->data)){

				}

				return $this->redirect(array('action' => 'view', $this->request->data('PersonnesSeance.seance_id'),'personnes'));

	       

	          
	    }    
	}

	// BASCUEL GROUPE PERSONNE
	public function moveGroupeSeance() {


	    if ($this->request->is('post') or $this->request->is('put')) {

	    	//debug($this->request->data); die;

	    	
				if($this->Seance->PersonnesSeance->save($this->request->data)){

					$this->Flash->set('La personne a bien été transférée de groupe pour cette s"ance !', array('element' => 'success'));

				}

				return $this->redirect(array('action' => 'view', $this->request->data('PersonnesSeance.seance_id'),'personnes'));

	       

	          
	    }    
	}		

	// SUPPRIMER UNE NEWS
	public function deletePersonneSeance($id,$seance_id) {
		if ($this->Seance->PersonnesSeance->delete($id)) {
			$this->Flash->set('La personne a bien été désaffectée de la séance !', array('element' => 'delete'));
			return $this->redirect(array('action' => 'view', $seance_id,'personnes'));
		}		
	}

	// SUPPRIMER UN accompagnateur de la seance
	public function deleteAccompSeance($id,$seance_id) {
		$this->Seance->PersonnesSeance->id = $id;
		if ($this->Seance->PersonnesSeance->save(array('accompagnement' => NULL, 'statut_accompagnteur' => NULL))) {
			$this->Flash->set('L‘accompagnateur a bien été désaffecté de la séance !', array('element' => 'delete'));
			return $this->redirect(array('action' => 'view', $seance_id,'personnes'));
		}		
	}


	 // EXPORTS  EN PDF
	public function export_pdf(){

		

			$title_export = "";
		
		    $seance = $this->Seance->findById($id);
		    $this->set(compact('seance'));

			$pratiquants_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp1'));	

			$pratiquants_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp2'));	

			$pratiquants_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp3'));

			$encadrants_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp1'));

			$encadrants_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp2'));	

			$encadrants_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp3'));	

			$accomps_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp1'));

			$accomps_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp2'));

			$accomps_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp3'));


			
			$this->set(compact('title_export'));
			$this->layout = '/pdf/default';	 
			$this->render('/pdf/liste_persons_seance');	 
		
	}

	// EXPORTS  EN EXCEL
	public function export_excel($id){

	
			$title_export = "";
		
		    $seance = $this->Seance->findById($id);
		    $this->set(compact('seance'));

		    $pratiquants_all = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id']
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_all'));

			$pratiquants_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp1'));	

			$pratiquants_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp2'));	

			$pratiquants_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp3'));

			$pratiquants_gp4 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 4
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('pratiquants_gp4'));

			$encadrants_all = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id']
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_all'));

			$encadrants_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp1'));

			$encadrants_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp2'));	

			$encadrants_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp3'));	

			$encadrants_gp4 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 2,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 4
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('encadrants_gp4'));

			$accomps_all = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_all'));

			$accomps_gp1 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 1,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp1'));

			$accomps_gp2 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 2,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp2'));

			$accomps_gp3 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 3,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp3'));

			$accomps_gp4 = $this->Seance->PersonnesSeance->find('all', array(
				'contain' => array('Personne'),
				'conditions' => array(
					'type' => 1,
					'seance_id' => $seance['Seance']['id'],
					'PersonnesSeance.groupe' => 4,
					'accompagnement' => 1
				),
				'order' => array('PNF' => 'ASC')
			));		
			$this->set(compact('accomps_gp4'));


			
			$this->set(compact('title_export'));
			$this->render('/excel/liste_personnes_seance');	 
		
	
	}


}
?>