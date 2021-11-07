<?php

App::uses('CakeEmail', 'Network/Email');
// app/Controller/UsersController.php
class UsersController extends AppController {



	public $helpers = array('GoogleMap','Formatage');
	public $paginate = array('limit' => 50);

	public function beforeFilter() {
		parent::beforeFilter();
  		$this->set('login', $this->Auth->user('username'));
	  	$this->set('id', $this->Auth->user('id'));
		$id = $this->Auth->user('id');
	}



	public function afterFilter() {
		if(!is_null(AuthComponent::user('id'))){
			$this->User->Connection-> create();
		    $this->User->Connection-> save(array(
		        'user_id' => $this->Auth->User('id'),
		        'profil_id' => $this->Session->read('profil_user_id'),
		        'module_id' => $this->Session->read('module_id'),
		        'controller' => $this->request->controller,
		        'action' => $this->request->action
		    ));
		}
	}

	public function create_pdf(){

		$users = $this->User->find('all');

		$this->set(compact('users'));

		$this->layout = '/pdf/default';

		$this->render('/Pdf/my_pdf_view');
	}



    // S'IDENTIFIER
	public function login($id = null, $key = null,$username = null) {



		//$this->User->id = 1;
		/*$this->User->save(array(
			'username' => 'L.LEBELLEC',
			'password' => 'outdoor07',
			'personne_id' => 59
		));*/

		//die;


		if($id == 2  or $id == 7 or $id == 8 or $id == 'resetPwd'){
            if($this->User->find('first', array('conditions' => array('key' => $key)))) {
               $this->set(compact('key'));
            } else {
                $this->Session->setFlash('La clé pour réinitialiser votre mot de passe n\'est pas valide! Rappel : votre lien d\'activation ne peut être utilisé qu\'une seule fois !','msg_false');
                //$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
                $this->redirect(array('controller' => 'users', 'action' => 'login', 1));
            }
		}


		$this->loadModel('Seance');
		$seances = $this->Seance->find('all', array(
			'conditions' => array(
				'date >' => date('Y-m-d'),
				'published' => 1
			),
			'order' => array('date' => 'ASC')
		));
		$this->set(compact('seances'));

		$this->loadModel('Module');
		$extranet_off = $this->Module->find('all', array(
			'conditions' => array(
				'extranet_off' => 1,
				'id' => 1
			),
			'fields' => array('extranet_off', 'extranet_off_title', 'extranet_off_details','extranet_off_open')
		));

		$this->set(compact('extranet_off'));
		$this->set(compact('id'));

		if(isset($username)){ $this->set(compact('username'));}

		$this->loadModel('Module');
		$modules = $this->Module->find('list', array(
			'conditions' => array(
				'Module.id' => array(3)
			)
		));
		//debug($modules); die;
		$this->set(compact('modules'));

		$this->layout = 'defaultLogin';
		if ($this->request->is('post')) {


			$this->Auth->authenticate = array(
			        'Form' => array(
			                'scope' => array('User.active' => 1)
			        )
			);




			if ($this->Auth->login()) {





				$last_connection = $this->User->Connection-> find('first', array(
					'fields' => array('created_last'),
					'conditions' => array(
			            'Connection.user_id' => $this->Auth->User('id'),
			            'controller' => 'users',
			            'action' => 'login'
			        )
		        ));



		        $this->User->contain('Personne');
				$user = $this->User->findById($this->Auth->user('id'));
				$this->Session->write('prenom_nom_user', $user['Personne']['first_name'].' '.$user['Personne']['name']);
				$this->Session->write('nom_prenom_user', $user['Personne']['first_name'].' '.$user['Personne']['name']);
				$this->Session->write('super_admin', $user['User']['super_admin']);

				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_connexion', date('Y-m-d H:i:s'));
				$this->Session->write('user_id', $this->Auth->user('id'));
				$this->Session->write('personne_id', $this->Auth->user('personne_id'));


				//Configure::write('debug', $core['Module']['core']);


				// SESSION ANNES EN COURS
				$debutSaison = date('Y').'-09-01';
				$finSaison = (date('Y')+1).'-08-31';

				if(date('Y-m-d') >= $debutSaison){
					$saisonEnCoursMoins1 = (date('Y')-1).'/'.date('y');
					$saisonEnCours = date('Y').'/'.(date('y')+1);
					$anneeEnCours = date('Y')+1;
				} else {
					$saisonEnCours = (date('Y')-1).'/'.date('y');
					$saisonEnCoursMoins1 = (date('Y')-2).'/'.(date('y')-1);
					$anneeEnCours = date('Y');
				}

				$this->Session->write('saisonEnCours', $saisonEnCours);
				$this->Session->write('anneeEnCours', $anneeEnCours);
				$this->Session->write('saisonEnCoursMoins1', $saisonEnCoursMoins1);
				$this->Session->write('anneeEnCoursMoins1', $anneeEnCours-1);


				// INSERT TABLE CONNECTIONS
					// PROFIL ACTIF
	                $this->User->ProfilR->contain('Profil','Structure');
	                $profil = $this->User->ProfilR->find('first', array(
	                    'fields' => array('ProfilR.id','Profil.name', 'ProfilR.structure_id', 'ProfilR.profil_id'),
	                    'conditions' => array(
	                        'user_id' => $this->Auth->user('id'),
	                        'module_id' => array(1,3),
	                        'selected' => 1
	                    )
	                ));


	                $this->Session->write('profilR_id', $profil['ProfilR']['id']);
	                $this->Session->write('profil_user_id', $profil['ProfilR']['profil_id']);

	                $this->Session->write('profil_structure_id',$profil['ProfilR']['structure_id']);




	                $this->User->Connection-> create();
	                $this->User->Connection-> save(array(
	                    'user_id' => $user['User']['id'],
	                    'profil_id' => $profil['ProfilR']['id'],
	                    'module_id' => 1,
	                    'controller' => strtolower($this->request->controller),
	                    'action' => $this->request->action
	                ));



	                $profil2 = $this->User->ProfilR->find('all', array(
	                    'contain' => array('Module'),
	                    'conditions' => array(
	                        'ProfilR.user_id' => $this->Auth->user('id'),
	                        'Module.type_module' => 'module',
	                        'ProfilR.module_id !=' => 1
	                    )
	                ));

	                $profilVerif = $this->User->ProfilR->find('count', array(
	                    'conditions' => array(
	                        'ProfilR.module_id' => $this->request->data('User.module_id'),
	                        'ProfilR.user_id' => $this->Auth->user('id'),
	                        'ProfilR.active' => 1
	                    )
	                ));



					//$this->Session->write('emailAdmnin', 'samuel.ginot@free.fr');
					//return $this->redirect($this->Auth->redirectUrl());

		            if($this->request->data('User.module_id') == 0){
		            	$this->Flash->set('Votre droit utilisateur n\'est pas activé sur ce module !',array('element' => 'false'));
		            } else if($this->request->data('User.module_id') == 1 and $profilVerif >= 1){
		            	$this->Flash->set('Bienvenue sur l‘extranet Outdoor 07 ! Vous êtes désormais connecté',array('element' => 'success'));
		            	$this->redirect('../accueils/index/1');
		            }


			} else {
				$this->Flash->set('Identifiant et/ou mot de passe incorrect',array('element' => 'false'));

			}
		}
	}





	// LISTE DES COMPTES UTILISATEURS
	public function index($idModule = null) {






		$this->User->contain('Profil','Personne');

    	$nbUsers = $this->User->find('count');
		$this->set(compact('nbUsers'));

		$this->User->contain('Profil','Personne');
    	$users = $this->User->find('all');



		$this->set('users', $users);

		$this->Session->delete('module_id');
		$this->Session->write('module_id', $idModule);


	}

	// FICHE DETAIL D'UN COMPTE UTILISATEUR
	public function view($id = null, $tabActive = null) {

		$this->set(compact('tabActive'));

		// liste déroulante - Modules Extranet
        $this->loadModel('Module');

        /*if($this->Session->read('super_admin') == 1){*/
	        $modules_list = $this->Module->find('list',array(
	                'fields' => array('id', 'name'),
	                'order' => 'name ASC'));

	         $modules_list2 = $this->Module->find('list',array(
	                'fields' => array('id'),
	                'order' => 'name ASC'));
	    /*} else {
	    	$modules_list = $this->Module->find('list',array(
	        		'conditions' => array(
	        			'Module.id' => $this->Session->read('modulesGF')
	        		),
	                'fields' => array('id', 'name'),
	                'order' => 'name ASC'));

	    	$modules_list2 = $this->Module->find('list',array(
    		'conditions' => array(
    			'Module.id' => $this->Session->read('modulesGF')
    		),
            'fields' => array('id'),
            'order' => 'name ASC'));
	    }*/





        $this->set(compact('modules_list'));

		$this->loadModel('ProfilR');
		$this->ProfilR->contain('User', 'Module', 'Profil', 'Structure');
		$profils = $this->User->ProfilR->find('all', array(
			'conditions' => array(
				'ProfilR.user_id' => $id,
				'ProfilR.module_id' => $modules_list2),
			'fields' => array('ProfilR.module_id', 'Module.id', 'Module.type_module', 'Module.name', 'Profil.name', 'ProfilR.id', 'Profil.id', 'Structure.name','ProfilR.alertes_email','ProfilR.active'),
			'order' => 'Module.name'));



		$nbProfils = $this->User->ProfilR->find('count', array('conditions' => array('ProfilR.user_id' => $id,
				'ProfilR.module_id' => $modules_list2)));
		$this->set('profils', $profils);
		$this->set('nbProfils', $nbProfils);

		$profils_list = $this->User->Profil->find('list',array(
				'conditions' => array(
		        			'Profil.active' => 1
		        		),
                'fields' => array('id', 'name'),
                'order' => 'name ASC'));
        $this->set(compact('profils_list'));

		//debug($profils); die;
		if (!$id) {
	        throw new NotFoundException(__('Utilisateur invalide'));
	    }
		$this->User->contain('Personne');
	    $user = $this->User->findById($id);
	    $this->set(compact('user'));
	    if (!$user) {
	    throw new NotFoundException(__('Demande invalide'));
	    }

	    if ($this->request->is('post') or $this->request->is('put')) {




	        $this->request->data['Personne']['email'] = $this->request->data['User']['email'];

	       // debug($this->request->data); die;


	        if ($this->User->saveAll($this->request->data)) {


	            $this->Flash->set('Les modifications ont été effectuées avec succès !', array('element'=>'success'));
	            return $this->redirect(array('action' => 'view', $id));
	        }

	        $this->Flash->set('Les modifications n\'ont pas été modifiées', array('element'=>'false'));

	    }

	    if (!$this->request->data) {
	        $this->request->data = $user;
	        $this->set(compact('user'));

	    }



		$this->Paginator->settings = array(
				'conditions' => array('Connection.user_id' => $id),
		        'limit' => 100,
		        'fields' => array('created_last','created','controller','action'),
		        'contain' => array(
		        	'ProfilR' => array(
		        		'fields' => array('id'),
		        		'Profil' => array('fields' => array('name')),
		        		'Structure' => array('fields' => array('name'))
		        	)
		        ),
		        'group' => array('Connection.id'),
			'order' => 'Connection.created DESC'
	    	);
		$this->set('connections', $this->paginate('User.Connection'));

		//debug($this->paginate('User.Connection')); die;
	}

	// AJOUTER UN DROIT UTILISATEUR
	public function addProfilUser() {

		/*$regDep = $this->User->ProfilR->find('all', array(
							'conditions' => array(
								'profil_id' => 3,
								'module_id' => 3,
								'region' => 0)
						));





		foreach ($regDep as $row) {

			$this->loadModel('Structure');
			$this->loadModel('Region');

			$structure = $this->Structure->findById($row['ProfilR']['structure_id']);



			$this->User->ProfilR->id = $row['ProfilR']['id'];
			$this->User->ProfilR->save(array('region' => $structure['Structure']['StructureCode']));



		}

		die;*/

	    if ($this->request->is('post') or $this->request->is('put')) {




	    	$profils = $this->User->ProfilR->findByUserId($this->request->data('User.id'));


			if($this->request->data('ProfilR.profil_id') != 8){
	    	// RECUPERATION DE LA REGION ET DU DEPARTEMENT
		    	$this->loadModel('Structure');
				$regDep = $this->Structure->find('all', array(
							'conditions' => array('id' => $this->request->data('ProfilR.structure_id')),
							'fields' => array('StructureCodeRegion', 'StructureCodeDepartement'),
							'recursive' => 0
						));

			}

	    	$this->User->id = $this->request->data('User.id');


	    	if(count($profils) == 0){



	    		$this->User->ProfilR->create();
				$this->User->ProfilR->save(array(
					'module_id' => 1,
					'user_id' => $this->request->data('User.id'),
					'profil_id' =>$this->request->data('ProfilR.profil_id'),
					'structure_id' =>$this->request->data('ProfilR.structure_id'),
					'selected' => 1,
					'active' => $this->request->data('ProfilR.active')
				));

				$this->User->ProfilR->create();
				$this->User->ProfilR->save(array(
					'module_id' => 4,
					'user_id' => $this->request->data('User.id'),
					'profil_id' =>$this->request->data('ProfilR.profil_id'),
					'structure_id' =>$this->request->data('ProfilR.structure_id'),
					'selected' => 1,
					'active' => $this->request->data('ProfilR.active')
				));

				$this->User->ProfilR->create();
				$this->User->ProfilR->save(array(
					'module_id' => 7,
					'user_id' => $this->request->data('User.id'),
					'profil_id' =>$this->request->data('ProfilR.profil_id'),
					'structure_id' =>$this->request->data('ProfilR.structure_id'),
					'selected' => 1,
					'active' => $this->request->data('ProfilR.active')
				));

				$this->User->ProfilR->create();
				$this->User->ProfilR->save(array(
					'module_id' => $this->request->data('ProfilR.module_id'),
					'user_id' => $this->request->data('User.id'),
					'profil_id' =>$this->request->data('ProfilR.profil_id'),
					'structure_id' =>$this->request->data('ProfilR.structure_id'),
					'selected' => 1,
					'alertes_email' => 1,
					'region' => $regDep[0]['Structure']['StructureCodeRegion'],
					'departement' => $regDep[0]['Structure']['StructureCodeDepartement'],
					'active' => $this->request->data('ProfilR.active')
				));

	    	} else {

	    		if($this->request->data('ProfilR.profil_id') == 8){

	    			$this->User->ProfilR->create();
					$this->User->ProfilR->save(array(
						'module_id' => $this->request->data('ProfilR.module_id'),
						'user_id' => $this->request->data('User.id'),
						'profil_id' =>$this->request->data('ProfilR.profil_id'),
						'structure_id' =>$this->request->data('ProfilR.structure_id'),
						'selected' => 1,
						'alertes_email' => 1,
						'active' => $this->request->data('ProfilR.active')
					));

	    		} else {

		    		$this->User->ProfilR->create();
					$this->User->ProfilR->save(array(
						'module_id' => $this->request->data('ProfilR.module_id'),
						'user_id' => $this->request->data('User.id'),
						'profil_id' =>$this->request->data('ProfilR.profil_id'),
						'structure_id' =>$this->request->data('ProfilR.structure_id'),
						'selected' => 1,
						'alertes_email' => 1,
						'region' => $regDep[0]['Structure']['StructureCodeRegion'],
						'departement' => $regDep[0]['Structure']['StructureCodeDepartement'],
						'active' => $this->request->data('ProfilR.active')
					));
				}

	    	}




	            $this->Session->setFlash('Le droit-utilisateur a bien été ajouté !', 'msg_enreg_ok');

	        return $this->redirect(array('action' => 'view', $this->request->data('User.id'),1));
	    }
	}

	// CHANGER UN DROIT UTILISATEUR
	public function changeProfilUser() {
	    if ($this->request->is('post') or $this->request->is('put')) {

	    	$this->User->ProfilR-> updateAll(
				array('ProfilR.selected' => 0),
				array(
					'ProfilR.module_id' => $this->Session->read('module_id'),
					'ProfilR.user_id' => $this->Session->read('user_id'),
				)
			);

			$this->loadModel('Module');
			$ctrl = $this->Module->findById($this->Session->read('module_id'));

	    	$this->User->ProfilR->id = $this->request->data('ProfilR.id');
	        if ($this->User->ProfilR->save($this->request->data)) {
	            $this->Session->setFlash('Le droit-utilisateur a bien été changé !', 'msg_enreg_ok');
	        } else {
	        	$this->Session->setFlash('Le droit-utilisateur n\'a pas pu être changé !', 'msg_false');
	        }
	        return $this->redirect(array('controller' =>$ctrl['Module']['controller'], 'action' =>$ctrl['Module']['action'], $this->Session->read('module_id')));
	    }
	}








	// SUPPRIMER UN COMPTE UTILISATEUR
	public function delete($id = null) {
		if (!$this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Flash->set('Le compte-utilisateur a bien été supprimé !', array('element' => 'delete'));
			$this->redirect(array('action' => 'index',5));
		}
		$this->Flash->set('User was not deleted', array('element' => 'false'));
		$this->redirect(array('action' => 'index'));
	}


	// SUPPRIMER UN DROIT UTILISATEUR
	public function deleteProfilUser($idProfil, $idUser) {
		$this->User->ProfilR->id = $idProfil;
		if ($this->User->ProfilR->delete()) {
			$this->Session->setFlash('Le droit-utilisateur a bien été supprimé !', 'msg_delete');
		}
		$this->redirect(array('action' => 'view', $idUser,1));
	}






	// RECHERCHER UN COMPTE-UTILISATEUR
	public function searchUser(){
			if ( $this->RequestHandler->isAjax() ) {
	   			Configure::write ( 'debug', 2 );
	   			$this->autoRender=false;
	   			$this->User->contain('Personne');
				$users=$this->User->find('all',array('conditions'=>array('Personne.PersonneNom LIKE'=>'%'.$_GET['term'].'%')));
					$i=0;
					foreach($users as $user){
						$response[$i]['id']=$user['User']['id'];
						$response[$i]['value']=$user['Personne']['PersonneNom']." ".$user['Personne']['PersonnePrenom'];
						//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
						$response[$i]['label']=$user['Personne']['PersonneNom']." ".$user['Personne']['PersonnePrenom'];
					$i++;
					}
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.PersonneNom LIKE'=>'%'.$this->data['Personne']['PersonneNom'].'%')));
				}
			}
		}





	// ENVOI MAIL POUR MOT DE PASSE OUBLIE
	public function remind() {
		if($this->request->is('post')) {


			$this->User->set($this->request->data);

			if ($this->User->validates()) {



				if($result = $this->User->find('first', array('conditions' => array('email' => $this->request->data('User.email')), 'fields' => array('id','active')))) {



					if($result['User']['active'] == 1){
						$this->User->contain('Personne');
						$user = $this->User->findById($result['User']['id']);
						//debug($user); die;
						$key = Security::generateAuthKey();

						$this->User->id = $result['User']['id'];
						$this->User->set('key', $key);




						if($this->User->save()) {

							$email = new CakeEmail();
							$email->from(array('samuel.ginot@gmail.com' => 'Extranet Outdoor 07'));
							//$email->to($this->request->data('User.email'));

							$email->to($user['User']['email']);
							$email->viewVars(array(
									'PersonneNom' => $user['Personne']['name'],
									'PersonnePrenom' => $user['Personne']['first_name'],
									'username' => $user['User']['username'],
									'key' => $key
							));
							$email->subject('Extranet Outdoor 07 - Vos informations de connexions');
							$email->template('reset-pwd-user','default');
							$email->emailFormat('html');


							if(alerteEmail){$email->send();}

						}
						$this->Flash->set('Un email vient de vous être envoyé afin que vous puissiez choisir un nouveau mot de passe !',array('element' => 'success_send'));

					} else {
						$this->Flash->set('Compte-utilisateur INACTIF ! Vous ne pouvez pas changer votre mot de passe. Vous aviez du recevoir un email d\'activation. Sinon, veuillez nous contacter à extranet@outdoor07.com',array('element' => 'msg_false'));
					}
				}

				$this->redirect(array('action' => 'login',1));

			} else {
				$errors = $this->User->validationErrors;
				$this->Flash->set('Cette adresse ne correspond à aucun compte-utilisateur !',array('element' => 'false'));


			}

		}

	}


	// REINITIALISATION DU MOT DE PASSE
	public function reset($key = null) {
		$this->layout = 'defaultLogin';

		if($this->request->is('post')) {


			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				if($user = $this->User->find('first', array('conditions' => array('key' => $this->request->data('User.key'))))){

					$this->User->id = $user['User']['id'];
					$this->User->set('password', $this->request->data('User.password'));
					$this->User->set('key', '');

					if($this->User->save()) {

						$this->Flash->set('Votre mot de passe a été modifié avec succès.',array('element' => 'success'));
						$this->redirect(array('action' => 'login',1));
					} else {
						$this->Flash->set('Erreur lors de l\'enregistrement de votre mot de passe',array('element' => 'false'));
						$this->redirect(array('action' => 'login',1));
					}
				}
			} else {
				$errors = $this->User->validationErrors;
			}
		} else if ($this->request->is('get')) {
			$user = $this->User->find('first', array('conditions' => array('key' => $key)));


			if($this->User->find('first', array('conditions' => array('key' => $key)))) {
				$this->request->data['User']['key'] = $user['User']['key'];

			} else {
				$this->Flash->set('La clé pour réinitialiser votre mot de passe n\'est pas valide!',array('element' => 'false'));
				$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
			}
		} else {
			$this->Flash->set('Your token is not valid',array('element' => 'false'));
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
		}
	}


	// CHANGER MOT DE PASSE - UNE FOIS CONNECTE
	public function changePwdUser() {

		if($this->request->is('post')) {

			$user = $this->User->findById($this->Auth->User('id'));

			if(AuthComponent::password($this->request->data('User.password-old')) == $user['User']['password']){

				if($this->request->data('User.password') == $this->request->data('User.password-confirm')){
					$this->User->id = $this->Auth->User('id');
					if($this->User->save($this->request->data)) {
						$this->Session->setFlash('Votre mot de passe a été modifié avec succès.', 'msg_enreg_ok');
					} else {
						$this->Session->setFlash('Erreur lors de l\'enregistrement de votre mot de passe', 'msg_false');
					}

				} else {
					$this->Session->setFlash('Erreur lors de la confirmation de votre mot de passe', 'msg_false');
				}

			} else {
				$this->Session->setFlash('Votre mot de passe actuel est incorrect !', 'msg_false');
			}
			$this->redirect(array('action' => 'profil', 4));

		}
	}

		// AJOUTER UN PRATIQUANT
	/*public function add($id = null) {
		if($id != null) {
			$this->Session->write('itemMenu', 4);
			$this->loadModel('Demande');
			$this->set('demande', $this->Demande->findById($id));
		}


		if ($this->request->is('post')) {
			$this->Integer->create();
			if ($this->Integer->saveAssociated($this->request->data)) {
				$this->Demande->id = $id;
				$data = array('etat' => 1);
				$this->Demande->save($data);
				$this->Session->setFlash(__('Le pratiquant a été ajoutée', 'success'));
				$this->redirect(array('action' => 'index'));


			} else {
				$this->Session->setFlash(__('Le pratiquant n\'a pu être ajoutée !'));
			}
		}


    }
		*/
	// AJOUTER UN COMPTE-UTILISATEUR
	public function addOld($id = null) {
		//$this->loadModel('Module');
		//$this->set('modules', $this->Module->find('list', array('order' => 'Module.order ASC')));

		$profils_list = $this->User->Profil->find('list',array(
            'fields' => array('id', 'name'),
            'order' => 'name ASC'));
    	$this->set(compact('profils_list'));

		if($id != null) {
			$this->loadModel('Signup');
			$this->set('signup', $this->Signup->findById($id));
		}
		if ($this->request->is('post')) {

			$this->loadModel('Annuaire');
			$annuaire = $this->Annuaire->find('first', array('conditions' => array('personne_id' => $this->request->data['User']['personne_id'])));
			$this->loadModel('Personne');
			$personne = $this->Personne->find('first', array('conditions' => array('id' => $this->request->data['User']['personne_id'])));



				$this->User->create();
				if ($this->User->save($this->request->data)) {


					if(count($annuaire) == 0){

						$this->request->data['Annuaire']['controller_origin'] = 'users';
			   			$this->request->data['Annuaire']['action_origin'] = 'add';
			   			if($personne['Personne']['civilite'] == 'M'){
							$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/man.png';
							$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/man.png';
						} else {
							$this->request->data['Annuaire']['photo_thumb'] = '/img/uploads/annuaire_img/img_thumb/woman.png';
							$this->request->data['Annuaire']['photo_view'] = '/img/uploads/annuaire_img/img_view/woman.png';
						}

						$this->Annuaire->create();
						$this->Annuaire->save(
							array(
								'personne_id' => $this->request->data['User']['personne_id'],
								'email' => $this->request->data['User']['email'],
								'active' => 1
							)
						);

						$annuaire_id = $this->Annuaire->id;
					} else {
						$annuaire_id = $annuaire['Annuaire']['id'];
					}

					$this->loadModel('Structure');


					if($this->request->data('User.profil_id') == 2){
						$this->loadModel('Departement');
						$structure = $this->Structure->findById($this->request->data('User.structure_id'));
						$departement = $this->Departement->findById($structure['Structure']['StructureCode']);
					}

					if($this->request->data('User.profil_id') == 3){
						$structure = $this->Structure->findById($this->request->data('User.structure_id'));
					}



					$key = '$this->Password->generatePassword()';
					$this->User->id;
					$this->User->set('password', $this->request->data('User.username'));
					$this->User->set('annuaire_id', $annuaire_id);
					$this->User->save();

					$this->Annuaire->id = $annuaire_id;
					$this->Annuaire->set('user_id', $this->User->id);
					$this->Annuaire->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 1);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', $this->request->data('User.structure_id'));
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 4);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', $this->request->data('User.structure_id'));
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 7);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', $this->request->data('User.structure_id'));
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', $this->request->data['User']['module']);
					$this->User->ProfilR->set('alertes_email', 1);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', $this->request->data('User.structure_id'));
					$this->User->ProfilR->set('active', 1);

					if($this->request->data('User.profil_id') == 2){
						$this->User->ProfilR->set('departement', $departement['Departement']['id']);
						$this->User->ProfilR->set('region', $departement['Departement']['StructureRegion']);
					}
					if($this->request->data('User.profil_id') == 3){
						$this->User->ProfilR->set('region', $structure['Structure']['StructureCode']);
					}
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->save();


					$this->loadModel('Signup');
					$this->Signup->id = $id;
					$this->Signup->save(array('etat' => 1));




					$this->Session->setFlash('Le compte-utilisateur a été ajouté avec succès !', 'msg_enreg_ok');

					$this->redirect(array('controller' => 'users', 'action' => 'view', $this->User->id));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}

		}
	}

	// AJOUTER UN COMPTE-UTILISATEUR
	public function add($id = null) {
		//$this->loadModel('Module');
		//$this->set('modules', $this->Module->find('list', array('order' => 'Module.order ASC')));

		$profils_list = $this->User->Profil->find('list',array(
            'fields' => array('id', 'name'),
            'order' => 'name ASC'));
    	$this->set(compact('profils_list'));


		if ($this->request->is('post')) {


			$this->loadModel('Personne');
			$personne = $this->Personne->find('first', array('conditions' => array('id' => $this->request->data['User']['personne_id'])));

			$this->request->data['User']['username'] = $personne['Personne']['email'];
			$this->request->data['User']['email'] = $personne['Personne']['email'];

				$this->User->create();
				if ($this->User->save($this->request->data)) {






					$key = '$this->Password->generatePassword()';
					$this->User->id;
					$this->User->set('password', $this->request->data('User.username'));

					$this->User->save();


					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 1);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', 1);
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 3);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', 1);
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 7);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', 1);
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();

					$this->User->ProfilR->create();
					$this->User->ProfilR->set('module_id', 2);
					$this->User->ProfilR->set('alertes_email', 1);
					$this->User->ProfilR->set('user_id', $this->User->id);
					$this->User->ProfilR->set('profil_id', $this->request->data('User.profil_id'));
					$this->User->ProfilR->set('structure_id', 1);
					$this->User->ProfilR->set('selected', 1);
					$this->User->ProfilR->set('active', 1);
					$this->User->ProfilR->save();


					$this->Flash->set('Le compte-utilisateur a été ajouté avec succès !',array('element' => 'success'));

					$this->redirect(array('controller' => 'users', 'action' => 'view', $this->User->id));
				} else {
					$this->Flash->set('Le compte-utilisateur n‘a pas été ajouté !',array('element' => 'false'));
				}

		}
	}






	// RENVOI PROCEDURE ACTIVATION COMPTE
	public function emailActiveUser($id=null) {
		if ($this->request->is('get')) {
			$this->User->contain('Personne');
			$user = $this->User->findById($id);
			$this->set('user', $user);

			$key = Security::generateAuthKey();
			$this->User->id = $id;
			$this->User->set('key', $key);
			$this->User->SaveField('key', $key);

			// ALERT EMAIL
			$email = new CakeEmail();
			$email->from(array('samuel.ginot@gmail.com' => 'Extranet Outdoor 07'));
			$email->to($user['User']['email']);
			$email->bcc(array('samuel.ginot@gmail.com'));
			$email->viewVars(array(
				'username' => $user['User']['username'],
				'Personne' => $user['Personne']['FN'],
				'key' => $key
			));
			$email->subject('Extranet Outdoor 07 - Votre demande de compte-utilisateur validée !');
			$email->template('alert_add_user','default');
			$email->emailFormat('html');
			if(alerteEmail){$email->send();}


			$this->Flash->set('Un email d\'activation vient d‘être envoyé à l\'utilisateur',array('element' => 'success'));
			$this->redirect(array('action' => 'view', $this->User->id));
		}

	}



	// RENVOI PROCEDURE ACTIVATION COMPTE
	/*public function emailAllActiveUser() {
		if ($this->request->is('get')) {

			$this->User->ProfilR->contain('User.Personne');
			$users = $this->User->ProfilR->find('all', array(
				'conditions' => array(
					'User.active' => 0,
					'ProfilR.module_id' => 3
				),
				'group' => 'ProfilR.user_id'
			));
			$this->set('users', $users);

			foreach ($users as $row):

			$key = Security::generateAuthKey();
			$this->User->id = $row['User']['id'];
			$this->User->set('key', $key);
			$this->User->SaveField('key', $key);

			if($row['ProfilR']['profil_id'] == 1){ $template = 'alert_add_user_gcs';}
			if($row['ProfilR']['profil_id'] == 2 or $row['ProfilR']['profil_id'] == 3){ $template = 'alert_add_user_gdgr';}

				// ALERT EMAIL
				$email = new CakeEmail();
				$email->from(array($this->Auth->User->email => 'Extranet Outdoor 07'));
				$email->to($row['User']['email']);
				$email->viewVars(array(
						'username' => $row['User']['username'],
						'Personne' => $row['User']['Personne']['PersonneNom'].' '.$row['User']['Personne']['PersonnePrenom'],
						'key' => $key
				));
				$email->subject('Extranet Handisport - Votre demande de compte-utilisateur validée !');
				$email->template($template,'default');
				$email->emailFormat('html');
				if(alerteEmail){$email->send();}

			endforeach;


			$this->Session->setFlash('Un email d\'activation vient être envoyé aux utilisateurs', 'msg_send');
			$this->redirect(array('action' => 'index'));
		}

	}*/





	// ACTIVATION COMPTE PAR L'UTILISATEUR + CHOIX DU MOT DE PASSE
    public function activeUser($key = null) {
        $this->layout = 'defaultLogin';
        $this->Session->destroy();

        if($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                if($user = $this->User->find('first', array('conditions' => array('key' => $this->request->data('User.key'))))){

                    $this->User->id = $user['User']['id'];
                    $this->User->set('password', $this->request->data('User.password'));
                    $this->User->set('key', '');
                    $this->User->set('active', 1);

                    if($this->User->save()) {



                        $this->Flash->set('Votre compte a été activé avec succès. Vous pouvez désormais vous connecter à l\'extranet.',array('element' => 'success'));


                        $this->redirect(array('action' => 'login',1,'',$user['User']['username']));


                    } else {
                        $this->Flash->set('Erreur lors de l\'enregistrement de votre mot de passe',array('element' => 'false'));
                        $this->redirect(array('action' => 'login',0));
                    }
                }
            } else {
                $errors = $this->User->validationErrors;
            }
        }
    }






	// NE PLUS FAIRE APPARAITRE MESSAGE ACCUEIL
	public function skipMsgAccueil() {
		if($this->request->is('ajax')){
			if ($this->request->is(array('post', 'put'))) {
				$this->User->id = $this->Auth->User('id');
				if ($this->User->saveField('msg_accueil',1) ){

					$this->autoRender = false;
				}
			}
		}

	}

	// VOIR PROFIL UTILISATEUR DE L'UTILISATEUR
	public function viewProfilUser($id = null) {

		if ( $this->request->is( 'ajax' ) ) {
		    $id = $this->request->query[ 'id' ];
		    $this->User->ProfilR->contain('User', 'Profil');
		    $profilUser = $this->User->ProfilR->findById($id);
		    $this->set(compact('profilUser'));
		}



	    if ($this->request->is(array('post', 'put'))) {
	        $this->User->ProfilR->id = $id;
	        if ($this->User->ProfilR->save($this->request->data)) {
	            $this->Session->setFlash('Le profil de cet utilisateur a été modifié avec succès', 'msg_enreg_ok');
	            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->request->data['User']['id'],1));
	        }
	        $this->Session->setFlash(__('Le profil de cet utilisateur  n\'a pas été modifié'));

	    }

	    if (!$this->request->data) {
	        $this->request->data = $profilUser;
	        $this->set(compact('profilUser'));
	    }


	    $this->set(compact('profilUser'));

	}





}

?>
