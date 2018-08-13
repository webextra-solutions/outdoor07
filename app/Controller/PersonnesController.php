<?php

class PersonnesController extends AppController {
	
		function searchPersonne(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 2 );
				$this->autoRender=false;
				$personnes=$this->Personne->find('all',array(
						'conditions'=> array(
							'OR' => array(
								'Personne.name LIKE'=>''.$_GET['term'].'%',
								'Personne.first_name LIKE'=>''.$_GET['term'].'%',
								'CONCAT(Personne.name," ",Personne.first_name) LIKE'=> $_GET['term'].'%'
							), 
							array('not' => array('Personne.name' => null)),
							'Personne.name !=' =>''
						),
						'order' => array('Personne.name, Personne.first_name ASC')
				));


				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name'].' '.$user['Personne']['first_name'];
					$response[$i]['prenom']=$user['Personne']['first_name'];
				
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['name']." ".$user['Personne']['first_name'];
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune personne trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
	            
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}


		// RECHERCHER UNE COMMUNE
		    function searchCommune(){
		        if ( $this->RequestHandler->isAjax() ) {
		            Configure::write ( 'debug', 2);
		            $this->autoRender=false;
		            $this->loadModel('Commune');
		            $communes=$this->Commune->find('all',array(
		            	'fields' => array('id', 'codepostal', 'libelle2'),
		                'conditions'=> array(
		                    'OR' => array(
			                    array('Commune.codepostal LIKE' => ''.$_GET['term'].'%'),
			                    array('Commune.libelle2 LIKE'=>''.$_GET['term'].'%')
		            		)
		            	),

		            'order' => array('Commune.codepostal ASC')
		            ));
		            $i=0;
		            foreach($communes as $commune){
		                $response[$i]['id']=$commune['Commune']['id'];
		                $response[$i]['value']=$commune['Commune']['codepostal'].' '.$commune['Commune']['libelle2'];
		                $response[$i]['label']=$commune['Commune']['codepostal'].' '.$commune['Commune']['libelle2'];
		                $response[$i]['cp']=$commune['Commune']['codepostal'];
		                $response[$i]['commune']=$commune['Commune']['libelle2'];
		                $i++;
		            }
		            if(empty($reponse)){
		                $response[$i]['value'] = 'Aucune réponse trouvée';
		            }
		            echo json_encode($response);

		        }else{
		            if (!empty($this->data)) {
		                $this->set('communes',$this->paginate(array('Commune.libelle2 LIKE'=>'%'.$this->data['Commune']['libelle2'].'%')));
		            }
		        }
		    }

    

		function searchChild(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 2);
				$this->autoRender=false;
				$personnes=$this->Personne->find('all',array(
						'conditions'=> array(
							'OR' => array(
								'Personne.name LIKE'=>''.$_GET['term'].'%',
								'Personne.first_name LIKE'=>''.$_GET['term'].'%',
								'CONCAT(Personne.name," ",Personne.first_name) LIKE'=> $_GET['term'].'%'
							), 
							array('not' => array('Personne.name' => null)),
							'Personne.name !=' =>'',
							'Personne.pratiquant' => 1
						),
						'order' => array('Personne.name, Personne.first_name ASC')
				));



				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name'].' '.$user['Personne']['first_name'];
					$response[$i]['prenom']=$user['Personne']['first_name'];
				
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['name']." ".$user['Personne']['first_name'];
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune personne trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
	            
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}


		function searchPersonneParam($exception = null){
			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 2 );
				$this->autoRender=false;

				$exception = $this->request->query[ 'exception' ];

				$this->loadModel($exception);
				// Liste - Elément     
				$exceptions = $this->$exception->find('list',array(
					'fields' => array($exception.'.personne_id'),
					'conditions' => array(
						'NOT' => array(
							$exception.'.personne_id' => null
						)
					)
					
				));

				if($exception != null){
					$personnes=$this->Personne->find('all',array(
							'conditions'=> array(
								'OR' => array(
									'Personne.name LIKE'=>''.$_GET['term'].'%',
									'CONCAT(Personne.name," ",Personne.first_name) LIKE'=> $_GET['term'].'%'
								), 
								array('not' => array('Personne.id' => $exceptions)),
								//array('not' => array('Personne.name' => null)),
								'Personne.name !=' =>''
							),
							'order' => array('Personne.name, Personne.first_name ASC')
					));
				} else {
					$personnes=$this->Personne->find('all',array(
							'conditions'=> array(
								'OR' => array(
									'Personne.name LIKE'=>''.$_GET['term'].'%',
									'CONCAT(Personne.name," ",Personne.first_name) LIKE'=> $_GET['term'].'%'
								), 
								array('not' => array('Personne.name' => null)),
								'Personne.name !=' =>''
							),
							'order' => array('Personne.name, Personne.first_name ASC')
					));
				}

				


				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name'].' '.$user['Personne']['first_name'];
					$response[$i]['prenom']=$user['Personne']['first_name'];
					$response[$i]['login']=substr($user['Personne']['first_name'], 0,1).'.'.STRTOUPPER($user['Personne']['name']);
					$response[$i]['test']=substr($user['Personne']['first_name'],0,1).strtoupper($user['Personne']['name']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['id']." | ".$user['Personne']['name']." ".$user['Personne']['first_name']." | ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune personne trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
	            
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}


		function searchPersonne2(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;
				$personnes=$this->Personne->find('all',array(
						'conditions'=> array(
								'Personne.name LIKE'=>''.$_GET['term'].'%', 
								array('not' => array('Personne.name' => null)),
								'Personne.name !=' =>''
						),
						'order' => array('Personne.name, Personne.first_name ASC')
				));
				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name'].' '.$user['Personne']['first_name'];
					$response[$i]['prenom']=$user['Personne']['first_name'];
					$response[$i]['nom']=$user['Personne']['name'];
					$response[$i]['ddn']=$user['Personne']['PersonneDdn'];
					$response[$i]['login']=substr($user['Personne']['first_name'], 0,1).'.'.STRTOUPPER($user['Personne']['name']);
					$response[$i]['test']=substr($user['Personne']['first_name'],0,1).strtoupper($user['Personne']['name']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['id']." | ".$user['Personne']['name']." ".$user['Personne']['first_name']." | ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune réponse trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
          
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}

		function searchPersonneDdn(){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;
				$personnes=$this->Personne->find('all',array(
						'conditions'=> array(
								'Personne.name LIKE'=>''.$_GET['term'].'%', 
								array('not' => array('Personne.name' => null)),
								'Personne.name !=' =>''
						),
						'order' => array('Personne.name, Personne.first_name ASC')
				));
				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name']." ".$user['Personne']['first_name']." | Ddn : ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));
					$response[$i]['prenom']=$user['Personne']['first_name'];
					$response[$i]['login']=substr($user['Personne']['first_name'], 0,1).'.'.STRTOUPPER($user['Personne']['name']);
					$response[$i]['test']=substr($user['Personne']['first_name'],0,1).strtoupper($user['Personne']['name']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					if($this->Session->read('user_id') == 23){$response[$i]['label']=$user['Personne']['id']." | ".$user['Personne']['name']." ".$user['Personne']['first_name']." | Ddn : ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));}					
					else {$user['Personne']['name']." ".$user['Personne']['first_name']." | Ddn : ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));}

					$i++;
				}
				if(empty($reponse[$i])){
	                $response[$i]['value'] = 'Aucune personne trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
          
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}


		function searchPersonne3($type_participant,$age_min, $age_max){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;



				// Exception pour Charles - JNAH
				if($type_participant == 1 and $this->Session->read('user_id') == 116){
					$personnes=$this->Personne->find('all',array(
							'conditions'=> array(
									'Personne.name LIKE'=>''.$_GET['term'].'%', 
									array('not' => array('Personne.name' => null)),
									'Personne.name !=' =>'',
									//'Personne.PersonneDdn <= ' => ''.$age_min.'',
									//'Personne.PersonneDdn >= ' => ''.$age_max.''
							),
							'order' => array('Personne.name, Personne.first_name ASC')
					));
				} 

				if($type_participant == 1 and $this->Session->read('user_id') != 116){
					$personnes=$this->Personne->find('all',array(
							'conditions'=> array(
									'Personne.name LIKE'=>''.$_GET['term'].'%', 
									array('not' => array('Personne.name' => null)),
									'Personne.name !=' =>'',
									'Personne.PersonneDdn <= ' => ''.$age_min.'',
									'Personne.PersonneDdn >= ' => ''.$age_max.''
							),
							'order' => array('Personne.name, Personne.first_name ASC')
					));
				}

				if($type_participant == 2){
					$personnes=$this->Personne->find('all',array(
							'conditions'=> array(
									'Personne.name LIKE'=>''.$_GET['term'].'%', 
									array('not' => array('Personne.name' => null)),
									'Personne.name !=' =>''
							),
							'order' => array('Personne.name, Personne.first_name ASC')
					));
				}
				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Personne']['id'];
					$response[$i]['value']=$user['Personne']['name'].' '.$user['Personne']['first_name'];
					$response[$i]['prenom']=$user['Personne']['first_name'];
					$response[$i]['login']=substr($user['Personne']['first_name'], 0,1).'.'.STRTOUPPER($user['Personne']['name']);
					$response[$i]['test']=substr($user['Personne']['first_name'],0,1).strtoupper($user['Personne']['name']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Personne']['id']." | ".$user['Personne']['name']." ".$user['Personne']['first_name']." | ".date('d/m/Y', strtotime($user['Personne']['PersonneDdn']));
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune réponse trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
          
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Personne.name LIKE'=>'%'.$this->data['Personne']['name'].'%')));
				}
			}
		}


		function searchPersonne4($type_participant,$age_min, $age_max){

			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;

				if($type_participant == 1){
					$this->loadModel('Licence');


					$personnes=$this->Licence->find('all',array(
							'conditions'=> array(
									'Licence.name LIKE'=>''.$_GET['term'].'%', 
									array('not' => array('Licence.name' => null)),
									'Licence.name !=' =>'',
									'Licence.SaisonAnnee >=' => $this->Session->read('anneeEnCours')
							),
							'order' => array('Licence.name, Licence.first_name ASC')
					));
				}

				if($type_participant == 2){
					$personnes=$this->Licence->find('all',array(
							'conditions'=> array(
									'Licence.name LIKE'=>''.$_GET['term'].'%', 
									array('not' => array('Licence.name' => null)),
									'Licence.name !=' =>'',
									'Licence.SaisonAnnee >=' => $this->Session->read('anneeEnCours')
							),
							'order' => array('Licence.name, Licence.first_name ASC')
					));
				}
				$i=0;
				foreach($personnes as $user){
					$response[$i]['id']=$user['Licence']['personne_id'];
					$response[$i]['value']=$user['Licence']['name'].' '.$user['Licence']['first_name'];
					$response[$i]['prenom']=$user['Licence']['first_name'];
					$response[$i]['login']=substr($user['Licence']['first_name'], 0,1).'.'.STRTOUPPER($user['Licence']['name']);
					$response[$i]['test']=substr($user['Licence']['first_name'],0,1).strtoupper($user['Licence']['name']);
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$user['Licence']['personne_id']." | ".$user['Licence']['name']." ".$user['Licence']['first_name']." | ".date('d/m/Y', strtotime($user['Licence']['PersonneDdn']));
					$i++;
				}
				if(empty($reponse)){
	                $response[$i]['value'] = 'Aucune réponse trouvée - Cliquez ici';
	                $response[$i]['id']=0;
	            }
          
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('users',$this->paginate(array('Licence.name LIKE'=>'%'.$this->data['Licence']['name'].'%')));
				}
			}
		}


	// AJOUTER UNEPERSONNE
	public function add() {

		if ($this->request->is('post')) {

			if($this->request->data['Personne']['civilite'] == 'M'){
						$this->request->data['Personne']['photo_thumb'] = '/img/uploads/personne_img/img_thumb/man.png';
					} else {
						$this->request->data['Personne']['photo_thumb'] = '/img/uploads/personne_img/img_thumb/woman.png';
					}
		
				$this->Personne->create();
				if ($this->Personne->save($this->request->data)) {

					
					$this->Flash('La personne a été ajoutée avec succès !', array('element' => 'success'));
					$this->redirect(array('action' => 'view', $this->Personne->id, 'identite'));
				} else {
					$this->Flash('La personne n‘a pas été ajoutée ! Veuillez compléter sa fiche le plus précisément possible. Merci', array('element' => 'false'));
				}
		}


	
	}




		
	


		function index(){
			$personnes = $this->Personne->find('all');
			$this->set(compact('personnes'));
		}

		// VOIR / MODIFIER UNE PERSONNE
		public function view($id = null, $tabActive = null) {
   
		    $this->Personne->contain(array('PersonnesSeance.Seance','Event'));
		    $personne = $this->Personne->findById($id);
			//$this->set('profils', $this->Personne->Profil->find('list', array('conditions' => array('Profil.active' => 1))));
		    $this->set(compact('personne'));
		
		   //debug($fsession); die;
			$this->loadModel('TabsView');
			$tabs = $this->TabsView->find('all', array(
					'conditions' => array(
						'controller' => 'personnes',
						'action' => 'view'
					))
			);		
			$this->set(compact('tabs'));


		    if ($this->request->is(array('post', 'put'))) {


		    

		    	$tabActive = $this->request->data['Personne']['tabActive'];  

		        if ($this->Personne->save($this->request->data)) {
		        	$user = $this->Personne->User->findByPersonneId($this->request->data['Personne']['id']);

			    	if($user){
			    		
			    		$this->Personne->User->updateAll(
						    array('User.email' => '"'.$this->request->data['Personne']['email'].'"', 'User.username' => '"'.$this->request->data['Personne']['email'].'"'),
						    array('User.id' => $user['User']['id'])
						);
			    	}


		            $this->Flash->set('La personne a été modifiée avec succès', array('element' => 'save'));
		        } else {
		         $this->Flash->set('La personne n’a été modifiée', array('element' => 'false'));
		        }
		    }


		    $this->set(compact('tabActive'));

		    if (!$this->request->data) {
		        $this->request->data = $personne;
		        $this->set(compact('personne'));
		    }
		    
		    $this->set(compact('personne'));
		}

		public function addPersonneEvent() {


		    if ($this->request->is('post') or $this->request->is('put')) {

		    	
					if($this->Personne->Event->save($this->request->data)){
							$this->Flash->set('L‘événement a été ajouté avec succès', array('element' => 'add'));
					}

					return $this->redirect(array('action' => 'view', $this->request->data('Event.personne_id'),'events'));    
		    }    
		}

		// VOIR / MODIFIER UN EVENT
		public function viewEvent($id = null, $view = null) {
		
			if ( $this->request->is( 'ajax' ) ) {
			    $id = $this->request->query[ 'id' ]; 
			    $event = $this->Personne->Event->findById($id);
			    $this->set(compact('event'));
			}
		    if ($this->request->is(array('post', 'put'))) {
		    	$this->Personne->Event->id = $this->request->data('Event.id');    	
		        if ($this->Personne->Event->save($this->request->data)) {	        	
	            	$this->Flash->set('L‘événement a été modifié avec succès', array('element' => 'save'));
	            } 

	           
	            	return $this->redirect(array('action' => 'view', $this->request->data('Event.personne_id'),'events'));
	           
	        }
	       
		    

		    if (!$this->request->data) {
		        $this->request->data = $event;
		        $this->set(compact('event'));
		    }
		    $this->set(compact('event'));
		}

		// SUPPRIMER UN EVENT
		public function deletePersonneEvent($idEvent, $idPersonne) {
			$this->Personne->Event->id = $idEvent;
			if ($this->Personne->Event->delete()) {
				$this->Flash->set('L‘événement a été supprimé', array('element' => 'delete'));
			}
	        return $this->redirect(array('action' => 'view', $idPersonne,'events'));	       
		}	


		// SUPPRIMER lA PERSONNE
	public function delete($id) {
		if (!$this->request->is('post')) {
			throw new NotFoundException();
		}

		
		if ($this->Personne->delete($id)) {
			$this->Flash('La personnée a bien été supprimée !', array('element' => 'false'));
			$this->redirect(array('action' => 'index'));
		}		
	}



	// CHANGER PHOTO DE lA pERSONNE
	public function changePhoto($id = null) {
		 if ($this->request->is(array('post', 'put'))) {



	        $this->Personne->id = $id;
	        if ($this->Personne->save($this->request->data)) {     
 				$this->Flash('La photo a été ajoutée / modifiée avec succès !', array('element' => 'success'));            
	        } else{   
		       	$errors = $this->Personne->validationErrors;
		       	$msg_errors = '';
		       	foreach($errors['photo_file'] as $error){
		       		$msg_errors .= $error;
		       	}	     
		        $this->Flash($msg_errors, array('element' => 'false'));
	    	}
	       
	        return $this->redirect(array('action' => 'view', $this->request->data('Personne.id')));
	        
	        
	    }
	}

	// SUPPRIMER PHOTO DE LA PERSONNE
	public function deletePhoto($id = null) {
		 if ($this->request->is('get')) {
	        $this->Personne->id = $id;
	        $photo = $this->Personne->findById($id);

	        if($photo['Personne']['civilite'] == 'M'){
				$this->request->data['Personne']['photo_thumb'] = '/img/uploads/personne_img/img_thumb/man.png';
				$this->request->data['Personne']['photo_view'] = '/img/uploads/personne_img/img_view/man.png';
			} else {
				$this->request->data['Personne']['photo_thumb'] = '/img/uploads/personne_img/img_thumb/woman.png';
				$this->request->data['Personne']['photo_view'] = '/img/uploads/personne_img/img_view/woman.png';
			}


	        if ($this->Personne->save($this->request->data)) {  
	        	$this->Personne->deleteFiles($id);
 				$this->Flash('La photo a été supprimée avec succès !',array('element' => 'delete'));             
	        } else{    
	        $this->Flash('La photo n\'a pas été supprimée',array('element' => 'false'));    
	    	}

	    	
	        	 return $this->redirect(array('action' => 'view', $photo['Personne']['id'], 'identite'));
	        
	       
	    }	    
	} 





	

		
		






	
	

	

	

	
	


	

	
	


	

	
}

?>