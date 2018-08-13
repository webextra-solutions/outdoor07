<?php

class PratiquantsController extends AppController {

	public function afterFilter() {
		if(!is_null(AuthComponent::user('id'))){
			$this->loadModel('User');
			$this->User->Connection-> create();
		    $this->User->Connection-> save(array(
		        'user_id' => $this->Auth->User('id'),
		        'profil_id' => $this->Session->read('profilR_id'),
		        'module_id' => $this->Session->read('module_id'),
		        'controller' => $this->request->controller,
		        'action' => $this->request->action
		    ));
		}	
	}

	// AJOUTER UN PARTICIPANT A LA DELEGATION
	public function add() {
		if ($this->request->is('post')) {

			
			$this->loadModel('EventsPrestation');
			$eventsP = $this->EventsPrestation->find('all', array('conditions' => array('event_id' =>$this->request->data['Pratiquant']['event_id'])));

			$fiche_annuaire = $this->Pratiquant->Annuaire->find('first', array('conditions' => array('user_id' => $this->Session->read('user_id'))));

			$this->request->data['Pratiquant']['annuaire_id'] = $fiche_annuaire['Annuaire']['id'];

			$this->loadModel('Convoque');
			$fiche_convoque = $this->Convoque->find('count', array('conditions' => array('annuaire_id' => $fiche_annuaire['Annuaire']['id'])));
			if($fiche_convoque == 1){
				$this->request->data['Pratiquant']['convoque'] = 1;
			}

			$this->Pratiquant->create();
			if ($this->Pratiquant->saveAll($this->request->data)) {
				foreach($eventsP as $key => $row){
						$this->Pratiquant->PratiquantsPrestation->create();
						$data = array(
							'participant_id' => $this->Pratiquant->id,
							'event_id' => $this->request->data['Pratiquant']['event_id'],
							'events_prestation_id' => $row['EventsPrestation']['id']
						);
						$this->Pratiquant->PratiquantsPrestation->save($data);
				}


				$this->loadModel('EventsGestionnaire');
				$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $this->request->data['Pratiquant']['event_id'])));
				$this->loadModel('User');
				$destinataires = $this->User->ProfilR->find('list', array(
					'conditions' => array(
						'ProfilR.module_id' => $this->Session->read('module_id'),
						'ProfilR.user_id' => $gestionnaires
					),
					'contain' => array('User'),
					'fields' => array('User.email'),
					'group' => array('User.email')
				));	

				// ALERT EMAIL								
				$event = $this->Pratiquant->Event->findById($this->request->data['Pratiquant']['event_id']);
				$this->Pratiquant->contain('Annuaire', 'Personne');
				$participant = $this->Pratiquant->findById($this->Pratiquant->id);

				$email = new CakeEmail();
				$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
				$email->to($destinataires);
				$email->viewVars(array(
						'user' => $participant['Personne']['NF'],
						'event_libelle' => $event['Event']['name']
				));
				$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$participant['Personne']['NF'].' | Nouvelle inscription démarée');
				$email->template('begin_engagement_jnh','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}


				$this->Session->setFlash('L\'inscription a démarrée avec succès !', 'msg_add');				
			} else {
				$this->Session->setFlash('L\'inscription n\'a pas démarrée !', 'msg_false');
			}
			$this->redirect(array('action' => 'view',$this->Pratiquant->id));
		}
	}

	// AJOUTER UNE EPRUEVE A CE PARTICICPANT
	public function addPratiquantEpreuve() {


		if ($this->request->is('post')) {
			$this->Pratiquant->PratiquantsEpreuve->create();
			if ($this->Pratiquant->PratiquantsEpreuve->save($this->request->data)) {
					$this->Session->setFlash('L\'épreuve a été ajoutée avec succès !', 'msg_add');				
			} else {
				$this->Session->setFlash('L\'épreuve n\'a pas été ajoutée !', 'msg_false');
			}
			$this->redirect(array('action' => 'view',$this->request->data['PratiquantsEpreuve']['participant_id'],'epreuves'));
		}
	}


	// ENVOI CONFIRMATION
	public function envoiConfirmation($participant_id, $event_id) {


		if ($this->request->is('post')) {

			$this->request->data['Pratiquant']['confirmation'] = 1;
			$this->request->data['Pratiquant']['id'] = $participant_id;
			$this->request->data['Pratiquant']['date_confirmation'] = date('Y-m-d H:i');
			$this->request->data['Pratiquant']['user_confirmed_id'] = $this->Session->read('user_id');
				

			if ($this->Pratiquant->save($this->request->data)) {


				$this->loadModel('EventsGestionnaire');
				$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $event_id)));
				$this->loadModel('User');
				$destinataires = $this->User->ProfilR->find('list', array(
					'conditions' => array(
						'ProfilR.module_id' => $this->Session->read('module_id'),
						'ProfilR.user_id' => $gestionnaires
					),
					'contain' => array('User'),
					'fields' => array('User.email'),
					'group' => array('User.email')
				));	

				// ALERT EMAIL								
				$event = $this->Pratiquant->Event->findById($event_id);
				$this->Pratiquant->contain('Annuaire', 'Personne');
				$participant = $this->Pratiquant->findById($participant_id);

				$email = new CakeEmail();
				$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
				$email->to(array($participant['Annuaire']['email']));
				//$email->to(array('samuel.ginot@gmail.com'));
				$email->bcc($destinataires);
				$email->viewVars(array(
						'user' => $participant['Personne']['NF'],
						'date_inscription' => $this->Formatage->datehrUStoFR($participant['Pratiquant']['engagement_ended']),
						'convoque' => $participant['Pratiquant']['convoque'],
						'montant_du' => $participant['Pratiquant']['montant_total_du'],
						'delegation_id' => $participant['Pratiquant']['delegation_id'],
						'facture_to_delegation' => $participant['Pratiquant']['facture_to_delegation']

				));
				$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$participant['Personne']['NF'].' | Inscription confirmée');
				$email->template('confirmation_jnh','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}


				$this->Session->setFlash('Le participant a été confimé avec succès !', 'msg_add');				
			} else {
				$this->Session->setFlash('Le participant n\'a pas été confirmé !', 'msg_false');
			}
			$this->redirect(array('action' => 'view',$participant_id,'facturation'));
		}
	}

	// ENVOI VALIDATION
	public function envoiValidation($participant_id, $event_id) {


		if ($this->request->is('post')) {

			$this->loadModel('EventsGestionnaire');
				$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $event_id)));

				//debug($gestionnaires); die;


			$this->Pratiquant->contain('Annuaire', 'Personne');
			$participant = $this->Pratiquant->findById($participant_id);

			if($participant['Pratiquant']['montant_total_du'] == 0){
				$this->request->data['Pratiquant']['confirmation'] = 1;
				$this->request->data['Pratiquant']['id'] = $participant_id;
				$this->request->data['Pratiquant']['date_confirmation'] = date('Y-m-d H:i');
				$this->request->data['Pratiquant']['user_confirmed_id'] = $this->Session->read('user_id');
			}

			$this->request->data['Pratiquant']['validation'] = 1;
			$this->request->data['Pratiquant']['id'] = $participant_id;
			$this->request->data['Pratiquant']['date_validation'] = date('Y-m-d H:i');
			$this->request->data['Pratiquant']['user_validate_id'] = $this->Session->read('user_id');
				

			if ($this->Pratiquant->save($this->request->data)) {


				$this->loadModel('EventsGestionnaire');
				$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $event_id)));
				$this->loadModel('User');
				$destinataires = $this->User->ProfilR->find('list', array(
					'conditions' => array(
						'ProfilR.module_id' => $this->Session->read('module_id'),
						'ProfilR.user_id' => $gestionnaires
					),
					'contain' => array('User'),
					'fields' => array('User.email'),
					'group' => array('User.email')
				));	

				// ALERT EMAIL								
				$event = $this->Pratiquant->Event->findById($event_id);
				
				

				$email = new CakeEmail();
				$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
				$email->to(array($participant['Annuaire']['email']));
				$email->bcc($destinataires);
				$email->viewVars(array(
						'user' => $participant['Personne']['NF'],
						'date_inscription' => $this->Formatage->datehrUStoFR($participant['Pratiquant']['engagement_ended']),
						'convoque' => $participant['Pratiquant']['convoque'],
						'montant_du' => $participant['Pratiquant']['montant_total_du'],
						'delegation_id' => $participant['Pratiquant']['delegation_id'],
						'facture_to_delegation' => $participant['Pratiquant']['facture_to_delegation']

				));
				$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$participant['Personne']['NF'].' | Inscription validée');
				$email->template('validation_jnh','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}


				$this->Session->setFlash('Le participant a été validé avec succès !', 'msg_add');				
			} else {
				$this->Session->setFlash('Le participant n\'a pas été validé  !', 'msg_false');
			}
			$this->redirect(array('action' => 'view',$participant_id,'facturation'));
		}
	}

	// AJOUTER UN PARTICIPANT A LA DELEGATION
	public function addOther() {
		if ($this->request->is('post')) {

			$this->loadModel('Annuaire');

			
			
			// ON vérifie si un participant a déja été inscrit par cet utilisateur
			$participants_deja = $this->Pratiquant->find('all', array(
				'conditions' => array(
					'user_create_id' => $this->request->data['Pratiquant']['user_create_id'],
					'event_id' => $this->request->data['Pratiquant']['event_id']
				)
			));

			// ON vérifie si une delegation a déja été créée par cet utilisateur
			$this->loadModel('Delegation');
			$delegations_deja = $this->Delegation->find('first', array(
				'conditions' => array(
					'user_create_id' => $this->request->data['Pratiquant']['user_create_id'],
					'event_id' => $this->request->data['Pratiquant']['event_id']
				)
			));

			$this->loadModel('EventsPrestation');
			$eventsP = $this->EventsPrestation->find('all', array('conditions' => array('event_id' =>$this->request->data['Pratiquant']['event_id'])));


		
	
			if(count($participants_deja) != 0 and count($delegations_deja) == 0){
				$this->request->data['Delegation']['num'] = $this->Formatage->genererNumDelegation($this->request->data['Pratiquant']['event_id']);
				$this->request->data['Delegation']['user_create_id'] = $this->request->data['Pratiquant']['user_create_id'];
				$this->request->data['Delegation']['user_modify_id'] = $this->request->data['Pratiquant']['user_create_id'];
				$this->request->data['Delegation']['event_id'] = $this->request->data['Pratiquant']['event_id'];
				$this->request->data['Delegation']['name'] = 'JNH-'.$this->Session->read('Auth.User.username');
				$this->request->data['Delegation']['engagement'] = 1;
				
				// Création DELEGATION
				$this->Delegation->create();
				$this->Delegation->save($this->request->data);

				$delegation_id = $this->Delegation->getLastInsertId();

			} else{
				$delegation_id = $delegations_deja['Delegation']['id'];
			}

			


			if($this->request->data['Pratiquant']['personne_id'] != ''){




				if($this->Verif->verifAnnuaire($this->request->data['Pratiquant']['personne_id']) != 'no_found'){
					$this->request->data['Pratiquant']['annuaire_id'] = $this->Formatage->verifTbAnnuaire($this->request->data['Pratiquant']['personne_id']);
				} else {

					$this->loadModel('Personne');
					$personne = $this->Personne->find('first', array('conditions' => array('id' => $this->request->data['Pratiquant']['personne_id'])));

					$this->request->data['Annuaire']['personne_id'] = $this->request->data['Pratiquant']['personne_id'];
					$this->request->data['Annuaire']['controller_origin'] = 'participants';
		   			$this->request->data['Annuaire']['action_origin'] = 'addOther';
		   			if($personne['Personne']['PersonneCivilite'] == 'M'){
						$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/man.png';
						$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/man.png';
					} else {
						$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/woman.png';
						$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/woman.png';
					}

					$this->Annuaire->create();
					$this->Annuaire->save($this->request->data);
					$this->request->data['Pratiquant']['annuaire_id'] = $this->Annuaire->getLastInsertId();
				}

				if(
					$this->Formatage->verifTbPratiquant(
						$this->request->data['Pratiquant']['personne_id'], 
						$this->request->data['Pratiquant']['event_id']
					) == 'no_found'
				){

					$this->request->data['Pratiquant']['personne_id'] = $this->request->data['Pratiquant']['personne_id'];							
					$this->request->data['Pratiquant']['delegation_id'] = $delegation_id;

				} else {
					$this->Session->setFlash('La personne que vous tentez d\'ajouter est déjà inscrite ou en cours d\'inscription !', 'msg_false');
					$this->redirect(array('controller' => 'events', 'action' => 'accueil'));

				}

			} else {

				if(

					$this->Formatage->verifTbPersonne(
						$this->request->data['Personne']['PersonneNom'], 
						$this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn'])
					) == 'no_found'
						){

					$datas = array (
						'PersonneCivilite' => $this->request->data['Personne']['PersonneCivilite'],
						'PersonneNom' => $this->request->data['Personne']['PersonneNom'],
						'PersonnePrenom' => $this->request->data['Personne']['PersonnePrenom'],
						'PersonneDdn' => $this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn']),
						'PersonneNationalite' => '100', // Table: Nationalite
						'PersonnePays' => 'FR',
						'AdressePays' => 'FR'
					);


					try {
						ini_set('soap.wsdl_cache_enabled', 0);
						ini_set('soap.wsdl_cache_ttl', 0);
						if(DB == 'preproduction'){$wsdl = 'http://ffh.ex-alto.com/soap/RequestFederation.wsdl';}
if(DB == 'production'){$wsdl = 'https://licences.handisport.org/soap/RequestFederation.wsdl';}
						$options = array( 'compression' => true, 'exceptions' => false, 'trace' => true );
						$client = new SoapClient( $wsdl, $options );
						// On ajoute la personne, le tableau est applati pour la transmission; le résultat est dans la variable résultat
						$resultat = $client->ajouterPersonne ( serialize( $datas ) );
						$rs = @unserialize( $resultat );
						$this->request->data['Pratiquant']['personne_id'] = $rs['ok']['PersonneId'];
						$this->request->data['Pratiquant']['ws_exalto'] = 1;


						// ALERT EMAIL								
						$event = $this->Pratiquant->Event->findById($this->request->data['Pratiquant']['event_id']);
						$personne = $this->Pratiquant->Personne->findById($this->request->data['Pratiquant']['personne_id']);					
						$email = new CakeEmail();
						$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
						$email->to('s.ginot@handisport.org');
						$email->viewVars(array(
								'personne_id' => $this->request->data['Pratiquant']['personne_id'],
								'personne' => $personne['Personne']['NF'].' né(e) le'.$personne['Personne']['PersonneDdn'],
								'event_libelle' => $event['Event']['name'],
								'user' => $this->Session->read('nom_prenom_user'),
						));
						$email->subject('WS EXALTO | Evenement - add Pratiquant Other JNH 2017 -'.$event['Event']['name'].' | '.$this->request->data['Pratiquant']['personne_id'].' | '.$personne['Personne']['NF'].' | Personne insérée - add Other');
						$email->template('ws_exalto','default');
						$email->emailFormat('html');
						if(alerteEmail){$email->send();}

					} catch (SoapFault $fault) {
						trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
					} 

					$this->request->data['Pratiquant']['delegation_id'] = $delegation_id;
			
					$this->request->data['Annuaire']['controller_origin'] = 'participants';
			   		$this->request->data['Annuaire']['action_origin'] = 'addOther';
			   		if($personne['Personne']['civilite'] == 'M'){
						$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/man.png';
						$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/man.png';
					} else {
						$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/woman.png';
						$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/woman.png';
					}
			
					$this->Annuaire->create();
					$this->request->data['Annuaire']['personne_id'] = $this->request->data['Pratiquant']['personne_id'];
					$this->Annuaire->save($this->request->data);
					$this->request->data['Pratiquant']['annuaire_id'] = $this->Annuaire->getLastInsertId();

					

				} else {

					if($this->Formatage->verifTbAnnuaire($this->Formatage->verifTbPersonne($this->request->data['Personne']['PersonneNom'], $this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn']))) != 'no_found'){
						$this->request->data['Pratiquant']['annuaire_id'] = $this->Formatage->verifTbAnnuaire($this->Formatage->verifTbPersonne($this->request->data['Personne']['PersonneNom'], $this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn'])));
					} else {
						$this->request->data['Annuaire']['controller_origin'] = 'participants';
			   			$this->request->data['Annuaire']['action_origin'] = 'addOther';
						$this->Annuaire->create();
						$this->Annuaire->save($this->request->data);
						$this->request->data['Pratiquant']['annuaire_id'] = $this->Annuaire->getLastInsertId();

					}

					if(
						$this->Formatage->verifTbPratiquant(
							$this->Formatage->verifTbPersonne($this->request->data['Personne']['PersonneNom'], $this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn'])), 
							$this->request->data['Pratiquant']['event_id']
						) == 'no_found'
					){

						$this->request->data['Pratiquant']['personne_id'] = $this->Formatage->verifTbPersonne($this->request->data['Personne']['PersonneNom'], $this->Formatage->dateFRtoUS($this->request->data['Personne']['PersonneDdn']));							
						$this->request->data['Pratiquant']['delegation_id'] = $delegation_id;

					} else {
						$this->Session->setFlash('La personne que vous tentez d\'ajouter est déjà inscrite ou en cours d\'inscription !', 'msg_false');
						$this->redirect(array('controller' => 'events', 'action' => 'accueil'));

					}


				}
			}


		

			$this->loadModel('Convoque');
			$fiche_convoque = $this->Convoque->find('count', array('conditions' => array('personne_id' => $this->request->data['Pratiquant']['personne_id'])));
			if($fiche_convoque == 1){
				$this->request->data['Pratiquant']['convoque'] = 1;
			}

			

			$this->Pratiquant->create();
			if ($this->Pratiquant->save($this->request->data)) {

					foreach($eventsP as $key => $row){
							$this->Pratiquant->PratiquantsPrestation->create();
							$dataEP = array(
								'participant_id' => $this->Pratiquant->id,
								'event_id' => $this->request->data['Pratiquant']['event_id'],
								'events_prestation_id' => $row['EventsPrestation']['id']
							);
							$this->Pratiquant->PratiquantsPrestation->save($dataEP);
					}

					$this->Pratiquant->PratiquantsTransport->create();
					$dataPT = array(
						'participant_id' => $this->Pratiquant->id,
						'event_id' => $this->request->data['Pratiquant']['event_id']
					);
					$this->Pratiquant->PratiquantsTransport->save($dataPT);

					$this->Pratiquant->updateAll(
						array('delegation_id' => $this->request->data['Pratiquant']['delegation_id']),
						array(
							'Pratiquant.user_create_id' => $this->Session->read('Auth.User.id'),
							'Pratiquant.event_id' => $this->request->data['Pratiquant']['event_id']

						)
					);


					$this->loadModel('EventsGestionnaire');
					$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $this->request->data['Pratiquant']['event_id'])));
					$this->loadModel('User');
					$destinataires = $this->User->ProfilR->find('list', array(
						'conditions' => array(
							'ProfilR.module_id' => $this->Session->read('module_id'),
							'ProfilR.user_id' => $gestionnaires
						),
						'contain' => array('User'),
						'fields' => array('User.email'),
						'group' => array('User.email')
					));	

					// ALERT EMAIL								
						$event = $this->Pratiquant->Event->findById($this->request->data['Pratiquant']['event_id']);
						$this->Pratiquant->contain('Annuaire', 'Personne');
						$participant = $this->Pratiquant->findById($this->Pratiquant->id);

						$email = new CakeEmail();
						$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
						$email->to($destinataires);
						$email->viewVars(array(
								'user' => $participant['Personne']['NF'],
								'event_libelle' => $event['Event']['name']
						));
						$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$participant['Personne']['NF'].' | Nouvelle inscription démarée (Autre personne dans délégation)');
						$email->template('begin_engagement_jnh','default');
						$email->emailFormat('html');
						if(alerteEmail){$email->send();}

					$this->Session->setFlash('L\'inscription a démarrée avec succès !', 'msg_add');		
					$this->redirect(array('action' => 'view',$this->Pratiquant->id));		
			} else {
				$this->Session->setFlash('L\'inscription n\'a pas démarrée !', 'msg_false');
				$this->redirect(array('controller' => 'event', 'action' => 'accueil'));
			}
			
		}
	}


	// ANNULER INSCRIPTION
	public function cancelEngagement() {
	    if ($this->request->is('post') or $this->request->is('put')) {


	    	$this->Pratiquant->contain('Annuaire', 'Personne');
			$participant = $this->Pratiquant->findById($this->request->data['Pratiquant']['id']);

	    	$event_id = $participant['Pratiquant']['event_id'];

	    	$this->request->data['Pratiquant']['annulation'] = 1;
			$this->request->data['Pratiquant']['date_annulation'] = date('Y-m-d H:i');
			$this->request->data['Pratiquant']['user_canceled_id'] = $this->Session->read('user_id');

	    	if ($this->Pratiquant->save($this->request->data)) {	

	    		$this->loadModel('EventsGestionnaire');
				$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $event_id)));
				$this->loadModel('User');
				$destinataires = $this->User->ProfilR->find('list', array(
					'conditions' => array(
						'ProfilR.module_id' => $this->Session->read('module_id'),
						'ProfilR.user_id' => $gestionnaires
					),
					'contain' => array('User'),
					'fields' => array('User.email'),
					'group' => array('User.email')
				));	

				// ALERT EMAIL								
				$event = $this->Pratiquant->Event->findById($event_id);
				$email = new CakeEmail();
				$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
				$email->to(array($participant['Annuaire']['email']));
				$email->bcc($destinataires);
				$email->viewVars(array(
						'user' => $participant['Personne']['NF'],
						'date_inscription' => $this->Formatage->datehrUStoFR($participant['Pratiquant']['engagement_ended']),
						'date_annulation' => date('d/m/Y à H:i'),
						'annulation_details' => $this->request->data['Pratiquant']['annulation_details'],
						'convoque' => $participant['Pratiquant']['convoque']

				));
				$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$participant['Personne']['NF'].' | Inscription annulée');
				$email->template('annulation_jnh','default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}

	        	return $this->redirect(array('action' => 'view', $this->request->data('Pratiquant.id'),'identite'));	    	  
			}
		}	
	}	

	// LISTE DES PARTICIPANTS
	public function index($id = null) {
		$this->Session->write('module_id', 3);
		ini_set('memory_limit', '256M');
		
		$this->loadModel('V2participant');
		/*$p1 = $this->V2participant->find('all', array(
			'contain' => array('Personne'),
			'conditions' => array('V2participant.personne_id !=' => ''),
			'order' => array('Email' => 'DESC')

    	));

    	$this->set(compact('p1'));

    
		$p2 = $this->V2participant->find('all', array(
			'conditions' => array('personne_id' => ''),
			'order' => array('Email' => 'DESC')

    	));

    	$this->set(compact('p2'));*/

    	
		$p3 = $this->V2participant->find('all', array(
			'contain' => array('Personne'),
			'order' => array('V2participant.personne_id' => 'ASC', 'V2participant.PersonneDdn' => 'DESC')

    	));

    	$this->set(compact('p3'));


		
	}

		// VOIR / MODIFIER UN PARTICIPANT
	public function view($id = null, $tabActive = null, $msg_action = null) {

		if ($this->request->is(array('post', 'put'))) {	


			//debug($this->request->data); die;

			
			
			$tabActive = $this->request->data['Pratiquant']['tabActive'];
			
			$event = $this->Pratiquant->Event->findById($this->request->data['Pratiquant']['event_id']);
			$participant = $this->Pratiquant->findById($this->request->data['Pratiquant']['id']);


			if($event['Event']['type_engagement'] == 'JNH'){
				if(
					(!empty($this->request->data['Pratiquant']['facture_structure_id']) and empty($this->request->data['Pratiquant']['facture_commune'])) or
					$this->request->data['Pratiquant']['change_facture_structure_id'] == 1

				){

					$str = $this->Pratiquant->Structure->findById($this->request->data['Pratiquant']['facture_structure_id']);
					$this->request->data['Pratiquant']['facture_adresse_ligne3'] = $str['Structure']['AdresseCompA'];
					$this->request->data['Pratiquant']['facture_adresse_ligne2'] = $str['Structure']['AdresseCompB'];
					$this->request->data['Pratiquant']['facture_adresse_ligne4'] = $str['Structure']['AdresseCompC'];
					$this->request->data['Pratiquant']['facture_code_postal'] = $str['Structure']['AdresseCodePostalFR'];
					$this->request->data['Pratiquant']['facture_commune'] = $str['Structure']['AdresseCommune'];
				}
			}
			

			// ENREGISTREMENT UNIQUEMENT
			if($this->request->data['Pratiquant']['finish_engagement'] == 0){
				if ($this->Pratiquant->save($this->request->data)) {


				

					// UNIQUEMENT POUR JNH
					if($event['Event']['type_engagement'] == 'JNH'){


						$this->Pratiquant->Annuaire->id = $this->request->data['Annuaire']['id'];
						$this->Pratiquant->Annuaire->save($this->request->data);


						$this->request->data['PratiquantsTransport']['arr_date'] = $this->Formatage->dateFRtoUS($this->request->data['PratiquantsTransport']['arr_date']);
						$this->request->data['PratiquantsTransport']['rtr_date'] = $this->Formatage->dateFRtoUS($this->request->data['PratiquantsTransport']['rtr_date']);
						$this->Pratiquant->PratiquantsTransport->save($this->request->data);
						$this->Pratiquant->PratiquantsPrestation->updateAll(
								array('active' => 0), 
								array(
									'PratiquantsPrestation.participant_id' => $this->request->data['Pratiquant']['id']
						));

						if(isset($this->request->data['Prestation'])){
							$montant = 0;
							$ch_simple = 0;
							$ch_dble = 0;

							$montantBis = 0;
							$ch_simpleBis = 0;
							$ch_dbleBis = 0;
							
							
							// PRESTATION DEMENDEES
							foreach($this->request->data['Prestation'] as $key => $row){								
								if($row == 1){
									$this->loadModel('PratiquantsPrestation');
									$events_prestations = $this->PratiquantsPrestation->find('first',array('contain' => array('EventsPrestation'),'conditions' => array('PratiquantsPrestation.id' => $key)));
									$montant += $events_prestations['EventsPrestation']['montant'];	
									$key2 = $events_prestations['EventsPrestation']['id'];
									//if($key2 == 24 or $key2 == 28 or $key2 == 32){
									if($key2 == 90 or $key2 == 96 or $key2 == 100){
										$ch_dble += 1;
									}
									if($key2 == 91 or $key2 == 97 or $key2 == 101){
									//if($key2 == 25 or $key2 == 29 or $key2 == 33){
										$ch_simple += 1;
									}			
								}
								$this->Pratiquant->PratiquantsPrestation->id = $key;

								if($participant['Pratiquant']['convoque'] != 1){
									$data = array(
										'active' => $row,
										'facturation' => $row
									);
								} else {
									$data = array(
										'active' => $row
									);
								}
								$this->Pratiquant->PratiquantsPrestation->save($data);
							}

							if($ch_dble == 2){$montant -= 25;}
							if($ch_dble == 3){$montant -= 25;}

							if($ch_simple == 2){$montant -= 0;}
							if($ch_simple == 3){$montant -= 0;}


							$this->request->data['Pratiquant']['montant_total'] = $montant;
		
							if($this->Session->read('profil_code')!= 'GO'){

								if($participant['Pratiquant']['convoque'] == 1){
									$montant_du_convoque = $ch_simple*50;
									$this->request->data['Pratiquant']['montant_total_du'] = $montant_du_convoque;
								} else {
									$this->request->data['Pratiquant']['montant_total_du'] = $montant;
								}
							}


							




							if($this->Session->read('profil_code')== 'GO'){
								//PRESTATIONS FACTUREES
								foreach($this->request->data['PrestationBis'] as $key => $row){
									if($row == 1){
										$this->loadModel('PratiquantsPrestation');
										$events_prestations = $this->PratiquantsPrestation->find('first',array('contain' => array('EventsPrestation'),'conditions' => array('PratiquantsPrestation.id' => $key)));
										$montantBis += $events_prestations['EventsPrestation']['montant'];	
										$keyBis2 = $events_prestations['EventsPrestation']['id'];

										//if($key2 == 24 or $key2 == 28 or $key2 == 32){
										if($keyBis2 == 90 or $keyBis2 == 96 or $keyBis2 == 100){
											$ch_dbleBis += 1;
										}

										if($keyBis2 == 91 or $keyBis2 == 97 or $keyBis2 == 101){
										//if($key2 == 25 or $key2 == 29 or $key2 == 33){
										
											$ch_simpleBis += 1;
										}						
									}
									$this->Pratiquant->PratiquantsPrestation->id = $key;
									$data = array('facturation' => $row);
									$this->Pratiquant->PratiquantsPrestation->save($data);
								}

								if($participant['Pratiquant']['convoque'] == 1){
									if($ch_simpleBis == 1){$montantBis -= 50;}
									if($ch_simpleBis == 2){$montantBis -= 100;}
									if($ch_simpleBis == 3){$montantBis -= 150;}	


									if($ch_dbleBis == 2){$montantBis -= 25;}
									if($ch_dbleBis == 3){$montantBis -= 25;}

								} else {
									if($ch_dbleBis == 2){$montantBis -= 25;}
									if($ch_dbleBis == 3){$montantBis -= 25;}


									if($ch_simpleBis == 2){$montantBis -= 0;}
									if($ch_simpleBis == 3){$montantBis -= 0;}

								}

								
								$this->request->data['Pratiquant']['montant_total_du'] = $montantBis+$this->request->data['Pratiquant']['montant_supp'];	
								
							}
	
							
							$this->Pratiquant->save($this->request->data);
						

							
						}
					}


					$this->Session->setFlash('Le participant a bien été modifié !', 'msg_enreg_ok');

				} else {
				 	$this->Session->setFlash(__('Le participant n\'a pas été modifié'));
				}

				return $this->redirect(array('action' => 'view', $id,$tabActive));
			}

			// ENREGISTREMENT ET TERMINER INSCRIPTION
			if($this->request->data['Pratiquant']['finish_engagement'] == 1){
				$this->request->data['Pratiquant']['engagement'] = 2;
				$this->request->data['Pratiquant']['engagement_ended'] = date('Y-m-d H:i');

				if ($this->Pratiquant->save($this->request->data)) {	

					// UNIQUEMENT POUR JNH
					if($event['Event']['type_engagement'] == 'JNH'){
						$this->request->data['PratiquantsTransport']['arr_date'] = $this->Formatage->dateFRtoUS($this->request->data['PratiquantsTransport']['arr_date']);
						$this->request->data['PratiquantsTransport']['rtr_date'] = $this->Formatage->dateFRtoUS($this->request->data['PratiquantsTransport']['rtr_date']);
						$this->Pratiquant->PratiquantsTransport->save($this->request->data);
						$this->Pratiquant->PratiquantsPrestation->updateAll(
								array('active' => 0), 
								array(
									'PratiquantsPrestation.participant_id' => $this->request->data['Pratiquant']['id']
						));

						if(isset($this->request->data['Prestation'])){
							$montant = 0;
							$ch_simple = 0;
							$ch_dble = 0;
							
							foreach($this->request->data['Prestation'] as $key => $row){

								if($row == 1){
									$this->loadModel('PratiquantsPrestation');
									$events_prestations = $this->PratiquantsPrestation->find('first',array('contain' => array('EventsPrestation'),'conditions' => array('PratiquantsPrestation.id' => $key)));
									$montant += $events_prestations['EventsPrestation']['montant'];	
									if($key == 169 or $key == 173 or $key == 177){
										$ch_simple += 1;
									}
									if($key == 170 or $key == 174 or $key == 178){
										$ch_dble += 1;
									}								
								}
								$this->Pratiquant->PratiquantsPrestation->id = $key;
								$data = array(
									'active' => $row
								);
								$this->Pratiquant->PratiquantsPrestation->save($data);
							}


							if($ch_simple == 2){$montant -= 25;}
							if($ch_simple == 3){$montant -= 25;}

							if($ch_dble == 2){$montant -= 50;}
							if($ch_dble == 3){$montant -= 50;}

							$this->request->data['Pratiquant']['montant_total'] = $montant;
							$this->Pratiquant->save($this->request->data);

							
						}
					}



					// ALERT EMAIL

					$this->loadModel('EventsGestionnaire');
					$gestionnaires = $this->EventsGestionnaire->find('list', array('fields' => array('user_id'), 'conditions' => array('event_id' => $this->request->data['Pratiquant']['event_id'])));
					$this->loadModel('User');
					$destinataires = $this->User->ProfilR->find('list', array(
						'conditions' => array(
							'ProfilR.module_id' => $this->Session->read('module_id'),
							'ProfilR.user_id' => $gestionnaires
						),
						'contain' => array('User'),
						'fields' => array('User.email'),
						'group' => array('User.email')
					));	
				

					$event = $this->Pratiquant->Event->findById($this->request->data['Pratiquant']['event_id']);		
			
					$email = new CakeEmail();
					$email->from(array($this->Auth->user('email') => 'Extranet Handisport'));
					$email->to($destinataires);
					//$email->bcc($destinataires);
					$email->viewVars(array(
							'user' => $this->Session->read('prenom_nom_user'),
							'participant' => $this->request->data['Personne']['PersonnePrenom'].' '.$this->request->data['Personne']['PersonneNom'],
							'event_libelle' => $event['Event']['name']
					));
					$email->subject('Extranet Handisport | '.$event['Event']['short_name'].' | '.$this->request->data['Personne']['PersonnePrenom'].' '.$this->request->data['Personne']['PersonneNom'].' | Inscription terminée');
					$email->template('end_inscription','default');
					$email->emailFormat('html');
					if(alerteEmail){$email->send();}

					$this->Session->setFlash('Votre inscription a été effectuée avec succès', 'msg_success');
				} else {
				  $this->Session->setFlash(__('Votre inscription n\'a pas été terminée'));
				}

				return $this->redirect(array('action' => 'view', $id,0,'finish_engagement'));
		
			}
			
		} else {

			$this->set(compact('msg_action'));

			$this->Pratiquant->contain('Personne');
			$participant2 = $this->Pratiquant->findById($id);

			$delegations = $this->Pratiquant->Delegation->find('list', array( 
				'conditions' => array('event_id' => $participant2['Pratiquant']['event_id']),
				'fields' => array('id', 'Delegation.name'), 
				'order' => 'Delegation.name ASC'));
			$this->set(compact('delegations'));

			// DOC JNH 2016
			$this->loadModel('EventsDoc');
			$doc_jnh = $this->EventsDoc->find('first', array(
				'conditions' => array(
					'event_id' => 3390,
					'name' => 'Dossier d\'information'
				)
			));
			$this->set(compact('doc_jnh'));

			

			$this->loadModel('GroupR');
			$group_participant = $this->GroupR->find('all', array(
				'contain' => array('Group'),
				'conditions' => array(
					'annuaire_id' => $participant2['Pratiquant']['annuaire_id']
				)
			));
			$this->set(compact('group_participant'));

			$this->GroupR->contain('Annuaire');
			$convoques = $this->GroupR->find('list', array(
				'fields' => array('Annuaire.personne_id'),
				'conditions' => array(
					'convoque_jnh_'.$this->Session->read('anneeEnCours') => 1
				)
			));

			$this->loadModel('Personne');
			$personnes_approchantes = $this->Personne->find('all', array(
				'conditions' => array(
					'id' => $convoques,
					'PersonneNom' => $participant2['Personne']['PersonneNom']
				)
			));
			$this->set(compact('personnes_approchantes'));

			$this->loadModel('Personne');
			$personnes_base_licence = $this->Personne->find('all', array(
				'contain' => array(
					'Annuaire' => array('fields' => array('Annuaire.id','Annuaire.tel_gsm','Annuaire.email')),
					'User' => array('fields' => array('User.id'))
				),
				'conditions' => array(
					'PersonneNom' => $participant2['Personne']['PersonneNom'],
					'PersonnePrenom LIKE' => substr($participant2['Personne']['PersonnePrenom'],0,1).'%'
				),
				'order' => array('PersonnePrenom' => 'ASC')
			));

			$this->set(compact('personnes_base_licence'));


			$conditions = array('controller' => 'participants','action' => 'view');
			if($participant2['Pratiquant']['type'] == 0){$conditions2 = array();}
			if($participant2['Pratiquant']['type'] == 1){$conditions2 = array('pratiquant' => 1);}
			if($participant2['Pratiquant']['type'] == 2){$conditions2 = array('encadrant' => 1);}

			// AFFICHAGE de l'onglet spécial admin si gestionnaire organisateur
			if($this->Session->read('profil_code') != 'GO'){$conditions3 = array('special_admin' => 0);} else {$conditions3 = array();}


			$this->Pratiquant->contain(array(
				'Event' => array(
					'TabsView' => array(
						'TabsViewsLien',
						'conditions' => array_merge($conditions,$conditions2,$conditions3)
					),
					'UserGestion.Personne'
				),

				'PratiquantsDocsAdmin.EventsDoc',
				'PratiquantsRepas.EventsDoc',
				'PratiquantsEpreuve' => array('EventsEpreuve.Epreuve','Classification'),
				'PratiquantsPrestation' => array(
					'EventsPrestation' => array(
						'Prestation',
						'order' => array('date' => 'ASC','order' => 'ASC')
					)
				),
				'PratiquantsStructure',
				'Reglement',
				'TypesRepa',
				'Annuaire',
				'Fonction',
				'Delegation',
				'PratiquantsTransport',
				'Personne',
				'Create.Personne', 
				'Confirm.Personne',
				'Modify.Personne',
				'Validate.Personne',
				'Canceled.Personne',
				'Structure'));
			$participant = $this->Pratiquant->findById($id);
		    $this->set(compact('participant'));


		    $licences = $this->Check->checklicence($participant['Pratiquant']['personne_id'], null, $this->Session->read('anneeEnCours'));
	    	$this->set(compact('licences'));



	    	$this->loadModel('EventsEpreuve');
			$eventsEpreuves = $this->EventsEpreuve->find('list', array( 
				'fields' => array('id'), 
				'conditions' => array('event_id' => $participant2['Pratiquant']['event_id'])
			));

			$this->loadModel('EventsEpreuve');
			$epreuves = $this->EventsEpreuve->find('list', array( 
				'contain' => array('Epreuve'),
				'fields' => array('id','Epreuve.Name'), 
				'conditions' => array('event_id' => $participant2['Pratiquant']['event_id'])
			));
			$this->set(compact('epreuves'));
		  

		    $this->loadModel('ClassificationsEventsEpreuve');
		    $this->ClassificationsEventsEpreuve->contain('Classification');
			$classifications = $this->ClassificationsEventsEpreuve->find('list', array(
				'conditions' => array('events_epreuve_id' => $eventsEpreuves),
				'fields' => array('classification_id', 'Classification.name'), 
				'order' => 'Classification.name ASC'));
			$this->set(compact('classifications'));	


			$this->loadModel('PratiquantsEpreuve');
			$epreuves_deja = $this->PratiquantsEpreuve->find('list', array( 
				'conditions' => array('PratiquantsEpreuve.participant_id' => $id),
				'fields' => array('PratiquantsEpreuve.events_epreuve_id')
			));


			$this->loadModel('EventsEpreuvesPlanning');
			$epreuves_deja2 = $this->EventsEpreuvesPlanning->find('list', array( 
				'conditions' => array(
					'events_epreuve_id' => $epreuves_deja
				),
				'fields' => array('EventsEpreuvesPlanning.planning_id')
			));

			$this->loadModel('EventsEpreuvesPlanning');
			$epreuves_deja3 = $this->EventsEpreuvesPlanning->find('list', array( 
				'conditions' => array(
					'planning_id' => $epreuves_deja2
				),
				'fields' => array('EventsEpreuvesPlanning.events_epreuve_id')
			));



			$this->loadModel('EventsEpreuve');
		    $this->EventsEpreuve->contain('Epreuve');
			$epr_list = $this->EventsEpreuve->find('list', array( 
				'conditions' => array(
					'EventsEpreuve.event_id' => $participant['Pratiquant']['event_id'],
					'EventsEpreuve.id !=' => $epreuves_deja3),
				'fields' => array('EventsEpreuve.id', 'Epreuve.name'), 
				'order' => 'Epreuve.name ASC'));
			$this->set(compact('epr_list'));

			/*debug($epreuves_deja);
			debug($epreuves_deja2);
			debug($epreuves_deja3);
			debug($epr_list);

			die;*/

		

			$this->loadModel('EventsPrestation');
		    $prestations = $this->EventsPrestation->find('all', array(
		    		'contain' => array('Prestation','PratiquantsPrestation'),
		    		'conditions' => array('EventsPrestation.event_id' => $participant['Pratiquant']['event_id']),
		    		'group' => array('date')
		    ));
		    $this->set(compact('prestations'));


		  

		    $this->loadModel('EventsPrestation');
		    $prestations_list = $this->EventsPrestation->find('list', array(
		    		'contain' => array('Prestation'),
		    		'fields' => array('Prestation.id', 'Prestation.name'),		    		
		    		'conditions' => array('EventsPrestation.event_id' => $participant['Pratiquant']['event_id'])
		    ));
		    $this->set(compact('prestations_list'));

			foreach($prestations as $row){
		   		
		   		$test = $this->EventsPrestation->find('list', array(
		   			'fields' => array('id'),
		    		'conditions' => array(
		    			'EventsPrestation.event_id' => $participant['Pratiquant']['event_id'],
		    			'EventsPrestation.date' => $row['EventsPrestation']['date']
		    		)
			    ));

			    $date = array($row['EventsPrestation']['date']);

			    $test2[] = $this->Pratiquant->PratiquantsPrestation->find('all', array(
			    	'contain' => array(
			    		'EventsPrestation' => array(
			    			'order' => array('order' => 'ASC'),
			    			'Prestation' => array('fields' => 'name','category')
			    		)
			    	),
		    		'conditions' => array(
		    			'PratiquantsPrestation.participant_id' => $participant['Pratiquant']['id'],
		    			'PratiquantsPrestation.events_prestation_id' => $test
		    		)

			    ));

			 




		   }


		   

		  $this->set(compact('test2'));


		}

		if (!$this->request->data) {
	        $this->request->data = $participant;
	        $this->set(compact('participant'));
	    }
	    $this->set(compact('participant'));
	    $this->set(compact('tabActive'));
	}

		function searchPersonne(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;
				$personnes=$this->Personne->find('all',array(
						'conditions'=> array(
								'Personne.PersonneNom LIKE'=>''.$_GET['term'].'%', 
								array('not' => array('Personne.PersonneNom' => null)),
								'Personne.PersonneNom !=' =>''
						),
						'order' => array('Personne.PersonneNom, Personne.PersonnePrenom ASC')
				));
				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['PersonneNom'].' '.$user['Personne']['PersonnePrenom'];
					$response[$i]['prenom']=$user['Personne']['PersonnePrenom'];
					$response[$i]['login']=substr($user['Personne']['PersonnePrenom'], 0,1).'.'.STRTOUPPER($user['Personne']['PersonneNom']);
					$response[$i]['test']=substr($user['Personne']['PersonnePrenom'],0,1).strtoupper($user['Personne']['PersonneNom']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['id']." | ".$user['Personne']['PersonneNom']." ".$user['Personne']['PersonnePrenom']." | ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));
					$i++;
				}
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.PersonneNom LIKE'=>'%'.$this->data['Personne']['PersonneNom'].'%')));
				}
			}
		}


		// VOIR / MODIFIER UNE DATE ANNEXE
	public function viewAjax($id = null) {
		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ]; 
		    $this->loadModel('V2participant');
		    $participant = $this->V2participant->findById($id);
		    $this->set(compact('participant'));
		}
	    if ($this->request->is(array('post', 'put'))) {
	    	$this->loadModel('V2participant');
	    	$this->V2participant->id = $this->request->data('V2participant.id');

	    	$this->request->data['V2participant']['PersonneDdn'] = $this->Formatage->dateFRtoUS($this->request->data['V2participant']['PersonneDdn']);

	        if ($this->V2participant->save($this->request->data)) {
	            $this->Session->setFlash('Le participant a été modifiée avec succès', 'msg_enreg_ok');
	        } else {
	        	$this->Session->setFlash(__('Le participant n\'a pas été modifiée'));
	        }
	        return $this->redirect(array('action' => 'index'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $participant;
	        $this->set(compact('participant'));
	    }
	    $this->set(compact('participant'));
	}


	// SUPPRIMER 
	public function deletePratiquantJnh($id) {
		
		$this->loadModel('V2participant');
		if ($this->V2participant->delete($id)) {
			$this->Session->setFlash('Le participant a bien été supprimé !', 'msg_delete');
		}		
		$this->redirect(array('action' => 'index'));
	}


	// AJAX - Liste déroulante type_evenement
	public function ajax_epreuve_list() {

	
		
		
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->params['data']['id'];
			$event_id = $this->params['data']['event_id'];
			$participant_id = $this->params['data']['participant_id'];
			$this->layout = null;
			if($id > 0) {
				// get pages
				$this->loadModel('ClassificationsEventsEpreuve');
				$epreuvesR = $this->ClassificationsEventsEpreuve->find('list',array(
					'fields' => array('ClassificationsEventsEpreuve.events_epreuve_id'), 
					'conditions' => array(
						'ClassificationsEventsEpreuve.classification_id' => $id
					)
				));



				$this->loadModel('Pratiquant');
				$participant = $this->Pratiquant->find('first',array(
					'contain' => array('Personne','Event'),
					'fields' => array('Personne.PersonneDdn','Personne.PersonneCivilite','Event.type_engagement'), 
					'conditions' => array(
						'Pratiquant.id' => $participant_id
					)
				));


				$this->loadModel('PratiquantsEpreuve');
				$epreuves_deja = $this->PratiquantsEpreuve->find('list', array( 
					'conditions' => array('PratiquantsEpreuve.participant_id' => $participant_id),
					'fields' => array('PratiquantsEpreuve.events_epreuve_id')
				));

				$this->loadModel('EventsEpreuvesPlanning');
				$epreuves_deja2 = $this->EventsEpreuvesPlanning->find('list', array( 
					'conditions' => array(
						'events_epreuve_id' => $epreuves_deja
					),
					'fields' => array('EventsEpreuvesPlanning.planning_id')
				));

				$this->loadModel('EventsEpreuvesPlanning');
				$epreuves_deja3 = $this->EventsEpreuvesPlanning->find('list', array( 
					'conditions' => array(
						'planning_id' => $epreuves_deja2
					),
					'fields' => array('EventsEpreuvesPlanning.events_epreuve_id')
				));


				$epr_deja_conditions = array(
					'EventsEpreuve.id !=' => $epreuves_deja3
				);


				if($participant['Personne']['PersonneCivilite'] == 'M'){
					$sexe_conditions = array('EventsEpreuve.open_man = 1');					
				} else {
					$sexe_conditions = array('EventsEpreuve.open_woman = 1');
				}

				$autres_conditions = array(
					'EventsEpreuve.id' => $epreuvesR,
					'EventsEpreuve.event_id' => $event_id
				);


				

				if($participant['Event']['type_engagement'] == 'CUP5'){

					$age_conditions = array(
						'EventsEpreuve.ddn_max <=' => $participant['Personne']['PersonneDdn'],
						'EventsEpreuve.ddn_min >=' => $participant['Personne']['PersonneDdn']
					);
				} else {
					$age_conditions = array(
						//'EventsEpreuve.ddn_max <=' => $participant['Personne']['PersonneDdn'],
						//'EventsEpreuve.ddn_min >=' => $participant['Personne']['PersonneDdn']
					);

				}

			

				$conditions = array_merge($age_conditions,$sexe_conditions,$autres_conditions,$epr_deja_conditions);



				$this->loadModel('EventsEpreuve');
				$this->EventsEpreuve->contain('Epreuve');
				$epreuves = $this->EventsEpreuve->find('all',array(
					'fields' => array('EventsEpreuve.id','EventsEpreuve.nameSport','Epreuve.name'), 
					'conditions' => $conditions, 
					'order' => array('Epreuve.name')));
				$this->set(compact('epreuves'));


			}
		}
		
	}

	// VOIR / MODIFIER UN DOCUMENT du PARTICIPANT
	public function viewPratiquantDoc($id = null) {
		
		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ]; 
		    $this->Pratiquant->PratiquantsDoc->contain('EventsDoc');
		    $participantDoc = $this->Pratiquant->PratiquantsDoc->findById($id);
		    $this->set(compact('participantDoc'));
		    $this->set(compact('view'));
		}
	    if ($this->request->is(array('post', 'put'))) {

	    	$this->Pratiquant->PratiquantsDoc->id = $this->request->data('PratiquantsDoc.id');    	
	        if ($this->Pratiquant->PratiquantsDoc->save($this->request->data)) {	        	
            	$this->Session->setFlash('Le document a été modifié avec succès !', 'msg_enreg_ok');
            } else {
            	 $this->Session->setFlash(__('Le documentn\'a pas été modifié'));
            }
           
            	return $this->redirect(array('action' => 'view', $this->request->data('PratiquantsDoc.participant_id'),'docs_admin'));
           
        }
       
	    

	    if (!$this->request->data) {
	        $this->request->data = $participantDoc;
	        $this->set(compact('participantDoc'));
	    }
	}

	// SUPPRIMER UN PARTICIPANT
	public function deletePratiquant($id, $event_id) {
		
		$participant = $this->Pratiquant->find('first', array(
		    	'conditions' => array(
		    		'Pratiquant.id' => $id)
		    	)
		    );
	    if(empty($participant)){
	    	$this->Session->setFlash('Vous ne pouvez pas supprimer ce participant', 'msg_false');
	    }
		if ($this->Pratiquant->delete($participant['Pratiquant']['id'])) {
			$this->Session->setFlash('Le participant a bien été supprimé !', 'msg_delete');
		}
		if($this->Session->read('profil_code')=='GO'){	
			$this->redirect(array('controller' => 'events', 'action' => 'viewGestion',$event_id, 'participants'));
		} else {
			$this->redirect(array('controller' => 'events', 'action' => 'accueil'));
		}
	}

	// AJOUTER UN MENU SPECIFIQUE
	public function addMenuSpecifique() {
	    if ($this->request->is('post') or $this->request->is('put')) {  	
	    	$this->request->data['PratiquantsDoc']['type'] = pathinfo($this->request->data['PratiquantsDoc']['url']['name'], PATHINFO_EXTENSION);	
	        if ($this->Pratiquant->PratiquantsDoc->save($this->request->data)) {
	            $this->Session->setFlash('Le menu spécifique a bien été ajouté !', 'msg_enreg_ok');
	        } else {
	        	$this->Session->setFlash('Le menu spécifique n\'a pas pu être ajouté pour l‘une des raisons suivantes : Il existe déjà, son format et/ou sa taille sont incorrects !', 'msg_false');
	        }
            return $this->redirect(array('action' => 'view', $this->request->data('PratiquantsDoc.participant_id'),'repas'));
	    }    
	}


	// SUPPRIMER UN MENU SPECIFIQUE
	public function deleteMenuSpecifique($id, $participant_id) {
			$this->Pratiquant->PratiquantsDoc->id = $id;
			if ($this->Pratiquant->PratiquantsDoc->delete()) {
				$this->Session->setFlash('Le menu spécifique a bien été supprimé !', 'msg_delete');	
			}
	
		return $this->redirect(array('action' => 'view', $participant_id,'repas'));
	}

	// SUPPRIMER UNE EPREUVE DU PARTICIPANT
	public function deleteEpreuvePratiquant($id, $participant_id) {
			$this->Pratiquant->PratiquantsEpreuve->id = $id;
			if ($this->Pratiquant->PratiquantsEpreuve->delete()) {
				$this->Session->setFlash('L\'épreuve a bien été supprimée de ce participant !', 'msg_delete');	
			}
	
		return $this->redirect(array('action' => 'view', $participant_id,'epreuves'));
	}	


	// RECHERCHER UN PARTICIPANT
	function searchPratiquant(){
		if ( $this->RequestHandler->isAjax() ) {
   			Configure::write ( 'debug', 2 );
   			$this->autoRender=false;
   			$this->Pratiquant->contain('Personne');
			$participants=$this->Pratiquant->find('all',array(
				'conditions'=>array(
					'OR' => array(
						'CONCAT(Personne.PersonneNom," ",Personne.PersonnePrenom) LIKE'=> $_GET['term'].'%',
						'Personne.PersonneNom LIKE'=> $_GET['term'].'%',
						'Pratiquant.id LIKE'=> $_GET['term'].'%'
					),
					'event_id' => 7004


				)

			));
				$i=0;
				foreach($participants as $participant){
					$response[$i]['id']=$participant['Pratiquant']['id'];
					$response[$i]['value']=$participant['Personne']['PersonneNom']." ".$participant['Personne']['PersonnePrenom'];
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$annuaire['Annuaire']['profile_pictures']."/><span class=\"annuairename\">".$annuaire['Annuaire']['annuairename']."</span>";
					$response[$i]['label']= $participant['Personne']['PersonneNom']." ".$participant['Personne']['PersonnePrenom'];
				$i++;
				}
			echo json_encode($response);
		}else{
			if (!empty($this->data)) {
				$this->set('participants',$this->paginate(array('Personne.PersonneNom LIKE'=>'%'.$this->data['Personne']['PersonneNom'].'%')));
			}
		}
	}

	// EDITION FACTURE
	public function editionFactureJnh($participant_id){
		$participant = $this->Pratiquant->find('first',array(						
			'conditions' => array('Pratiquant.id' =>  $participant_id),
			'contain' => array('Personne','Event','Structure','Reglement')	
		)); 
		$this->set(compact('participant'));


		$this->Pratiquant->id = $participant_id; 
		$this->request->data['Pratiquant']['factured'] = date('Y-m-d H:i');  	
	    $this->Pratiquant->save($this->request->data);

		
		
		$this->layout = '/pdf/default';	 
		$this->render('/pdf/edition_facture_jnh_indiv');	 
	}


	// VERIFICATION JNH
	public function verifJnh(){

		//if($this->Session->read('user_id') ==23){ Configure::write('debug',2);}
		$participants = $this->Pratiquant->find('all',array(	
			'fields' => array('id','prestation','engagement_ended'),	
				//'conditions' => array('Pratiquant.event_id' =>  7004,'Pratiquant.personne_id' =>  34455),
						
			'conditions' => array('Pratiquant.event_id' =>  7004,'Pratiquant.engagement' => 2),
			'contain' => array(
				'PratiquantsTransport' => array(
					'fields' => array('arr_date','rtr_date','arr_heure','rtr_heure')
				),
				'PratiquantsPrestation' => array(
					'conditions' => array('PratiquantsPrestation.active' => 1),
					'fields' => array('PratiquantsPrestation.id'),
					'EventsPrestation' => array(
						'fields' => array('EventsPrestation.id','EventsPrestation.date'),
						'Prestation' => array('fields' => array('Prestation.name'))
					)
				),

				'PratiquantsPrestation2' => array(
					'conditions' => array('PratiquantsPrestation2.active' => 1, 'PratiquantsPrestation2.events_prestation_id' => array(90,91,96,97,100,101)),
					'fields' => array('PratiquantsPrestation2.id'),
					'EventsPrestation' => array(
						'fields' => array('EventsPrestation.id','EventsPrestation.date'),
						'Prestation' => array('fields' => array('Prestation.name'))
					)
				),

				'PratiquantsPrestation3' => array(
					'conditions' => array('PratiquantsPrestation3.active' => 1, 'PratiquantsPrestation3.events_prestation_id' => array(87,88,92,93,98,99,102)),
					'fields' => array('PratiquantsPrestation3.id'),
					'EventsPrestation' => array(
						'fields' => array('EventsPrestation.id','EventsPrestation.date'),
						'Prestation' => array('fields' => array('Prestation.name'))
					)
				),
				'Personne' => array('fields' => array('NF'))
			),
			'order' => array('Pratiquant.engagement_ended' => 'DESC')	
		)); 

		$this->set(compact('participants'));

		//debug($participants); die;
		
	}

	

	    
	
}

?>