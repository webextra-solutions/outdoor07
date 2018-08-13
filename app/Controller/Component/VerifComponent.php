<?php  
class VerifComponent extends Component { 
  
	public function verifStagiaire($PersonneId) {
		$modelName = 'Stagiaire';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'fields' => array('id'),
			'conditions' => array('personne_id' => $PersonneId)
		));

		if(count($find) == 1){
			return $find[$modelName]['id'];
		} else {
			return 'no_found';
		}
	}



	// VERIFIE PRESENCE DANS LA BASE ANNUAIRE
	public function verifAnnuaire($personne_id){
		$modelName = 'Annuaire';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Annuaire.id'), 
			'conditions' => array(
				'personne_id' => $personne_id
			)
		))){
			return $find[$modelName]['id'];
		} else {
			return 'no_found';
		}
	}

	// VERIFIE PRESENCE DANS LA BASE PARTICICPANT
	public function verifParticipant($personne_id,$event_id){
		$modelName = 'Participant';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Participant.id'), 
			'conditions' => array(
				'personne_id' => $personne_id,
				'event_id' => $event_id
			)
		))){
			return $find['Participant']['id'];
		} else {
			return 'no_found';
		}
	}


	// VERIFIE USER
	public function verifUser($personne_id){
		$modelName = 'User';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('User.id'), 
			'conditions' => array(
				'personne_id' => $personne_id,
			)
		))){
			return $find['User']['id'];
		} else {
			return 'no_found';
		}
	}


	// VERIFIE USER ACTIVE
	public function verifUserActive($personne_id){
		$modelName = 'User';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('User.id'), 
			'conditions' => array(
				'personne_id' => $personne_id,
				'active' => 1
			)
		))){
			return $find['User']['id'];
		} else {
			return 'no_found';
		}
	}


	// VERIFIE INTERVENANT
	public function verifInterv($personne_id){
		$modelName = 'Interv';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Interv.id'), 
			'conditions' => array(
				'personne_id' => $personne_id,
			)
		))){
			return $find['Interv']['id'];
		} else {
			return 'no_found';
		}
	}


	// VERIFIE PROFIL USER
	public function verifProfilUser($user_id,$profil){
		$modelName = 'ProfilR';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('ProfilR.id'), 
			'conditions' => array(
				'user_id' => $user_id,
				'profil_id' => $profil
			)
		))){
			return $find['ProfilR']['id'];
		} else {
			return 'no_found';
		}
	}

	// VERIFIE USER
	public function verifUserEmail($email){
		$modelName = 'User';
		App::import("Model", $modelName); 
		$model = new $modelName();  

		$find = $model->find('first', array(
			'fields' => array('User.id'), 
			'conditions' => array(
				'email' => $email,
			)
		));

		if(count($find) >=1){
			return true;
		} else {
			return false;
		}
	}


	// VERIFIE USER
	public function verifUserFull($email,$nom,$ddn){
		$modelName = 'User';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'contain' => array('Personne' => array('fields' => array('PersonneNom', 'PersonnePrenom', 'PersonneDdn'))),
			'fields' => array('User.id','User.active','User.email'), 
			'conditions' => array(
				'OR' => array(
					'email' => $email,
					'AND' => array(
						'PersonneNom' => $nom,
						'PersonneDdn' => date('Y-m-d', strtotime(str_replace('/', '-',$ddn)))
					)
				)
			)
		));


		if(count($find) >= 1){

			$type_email = explode('@',$find['User']['email']);

			if($type_email[1] == 'v2-formation.fr'){
				return 'v2-formation';
			} else {
				return 'deja';
			}
		} else {
			return false;
		}
	}


	// VERIFIE USER
	public function verifUserFull2($email,$nom,$ddn){
		$modelName = 'User';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'contain' => array('Personne' => array('fields' => array('PersonneNom', 'PersonnePrenom', 'PersonneDdn'))),
			'fields' => array('User.id','User.active','User.email'), 
			'conditions' => array(
				'OR' => array(
					'email' => $email,
					'AND' => array(
						'PersonneNom' => $nom,
						'PersonneDdn' => date('Y-m-d', strtotime(str_replace('/', '-',$ddn)))
					)
				)
			)
		));


		if(count($find) >= 1){

			return $find['User']['id'];
			
		} else {
			return false;
		}
	}


	public function verifDroitFsession($structure,$fsession,$user,$stagiaire,$interv,$modelName = 'FsessionOrga') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('count', array(
			'conditions' => array(
				'fsession_id' => $fsession,
				'OR' => array(
					'structure_id' => $structure
					//'user_create_id' => $user
				)
			)
		));

		App::import("Model", 'FsessionSTA'); 
		$model2 = new FsessionSTA(); 
		$find2 = $model2->find('count', array(
			'conditions' => array(
				'stagiaire_id' => $stagiaire,
				'fsession_id' => $fsession	
			)
		));

		App::import("Model", 'FsessionINT'); 
		$model3 = new FsessionINT(); 
		$find3 = $model3->find('count', array(
			'conditions' => array(
				'interv_id' => $interv,
				'fsession_id' => $fsession	
			)
		));

	

		if($find == 1 or $find2 == 1 or $find3 == 1){
			return false;
		} else {
			return true;
		}	
	}


	public function verifFullFsession($fsession_id,$nbStag,$modelName = 'Fsession') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('first', array(
			'contain' => array('Diplome' => array('fields' => array('Diplome.nb_stag_max'))),
			'conditions' => array(
				'fsession_id' => $fsession_id,
			)
		));

		if($nbStag >= $find['Diplome']['nb_stag_max']){
			return true;
		} else {
			return false;
		}

		//return $find['Diplome']['nb_stag_max'];	
	}




	public function verifPersonne($nom_indiv,$prenom_indiv, $modelName = 'Personne') {

		

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('list', array(
			'fields' => array('id'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonnePrenom' => $prenom_indiv)
		));

		if(count($find) == 1){
			return implode(',',$find);
		} else {
			return '';
		}
	
	}

	public function verifPersonne2($nom_indiv,$prenom_indiv, $modelName = 'Personne') {

		

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('list', array(
			'fields' => array('id','AdresseMail'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonnePrenom' => $prenom_indiv)
		));

		if(count($find) == 1){
			return $find;
		} else {
			return '';
		}
	
	}

	
	

	public function verifPersonne3($nom_indiv,$prenom_indiv,$ddn, $modelName = 'Personne') {

		

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'fields' => array('id'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonnePrenom' => $prenom_indiv, 'PersonneDdn' => $ddn)
		));

		if(count($find) == 1){
			return $find['Personne']['id'];
		} else {
			return '';
		}
	
	}

	public function verifDroit($module,$user,$modelName = 'ProfilR') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('count', array(
			'conditions' => array(
				'user_id' => $user,
				'module_id' => $module
			)
		));

	

		if($find >= 1){
			return true;
		} else {
			return false;
		}	
	}


	public function isValidRecaptcha($code, $ip = null)
		{
		    if (empty($code)) {
		        return false; // Si aucun code n'est entré, on ne cherche pas plus loin
		    }

		    if($_SERVER['HTTP_HOST'] == 'extranet.handisport.org'){ 
		    	$secret = '6LerUg8UAAAAAPPzSIn4IYZ2xm4ITfP5KreoSfm-';
		    } else {
				$secret = '6LeodSIUAAAAAACSQC8kU1357ZAH6sRjqd6ZxIOv';
			}

		    $params = array(
		    	'secret'    => $secret,
		        'response'  => $code
			);
		    if( $ip ){
		        $params['remoteip'] = $ip;
		    }
		    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
		    if (function_exists('curl_version')) {
		        $curl = curl_init($url);
		        curl_setopt($curl, CURLOPT_HEADER, false);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
		        $response = curl_exec($curl);
		    } else {
		        // Si curl n'est pas dispo, un bon vieux file_get_contents
		        $response = file_get_contents($url);
		    }

		    if (empty($response) || is_null($response)) {
		        return false;
		    }

		    $json = json_decode($response);
		    return $json->success;
		}

    
} 
?>