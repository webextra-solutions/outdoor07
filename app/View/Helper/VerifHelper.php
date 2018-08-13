<?php
/**
 * Vérification en base de données
 */

class VerifHelper extends Helper {


	/*public function verifStagiaireInfo($stagiaire,$modelName = 'Stagiaire') {


		App::import("Model", $modelName); 
		$model = new $modelName();
		$this->$model->recursive = 0;
		$find = $model->findById($stagiaire);

		$infos = '';

		if($find[$model]['Annuaire']['email'] ==''){
			$infos .= 'Email';
		}

		return $infos;
	
	}*/
	
	
	
	public function verifSignupSession($fsession,$stagiaire,$modelName = 'FsessionSTA') {


		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('list', array(
			'fields' => array('id'),
			'conditions' => array('fsession_id' => $fsession, 'stagiaire_id' => $stagiaire)
		));

		if(count($find) == 1){
			return true;
		} else {
			return false;
		}
	
	}


	public function verifPreRequis($diplome,$stagiaire,$modelName = 'DiplomePR',$modelName2 = 'StagiaireDIP2') {


		App::import("Model", $modelName); 
		App::import("Model", $modelName2); 
		$model = new $modelName();  

		
		$find = $model->find('list', array(
			'fields' => array('prerequis_id'),
			'conditions' => array('diplome_id' => $diplome)
		));



		if(count($find) != 0){

			$model2 = new $modelName2(); 
			$find2 = $model2->find('list', array(
				'fields' => array('diplome_id'),
				'conditions' => array('diplome_id' => $find, 'stagiaire_id' => $stagiaire)
			));

			if(count($find2) == count($find)){
				return 'OK';
			} else {
				return  'NO';
			}
		} else {
			return false;
		}
	
	}

	public function verifPreRequis2($diplome,$stagiaire,$modelName = 'DiplomePR',$modelName2 = 'FsessionSTA',$modelName3 = 'Diplome') {


		App::import("Model", $modelName); 
		App::import("Model", $modelName2); 
		$model = new $modelName();  

		
		$find = $model->find('list', array(
			'fields' => array('prerequis_id'),
			'conditions' => array('diplome_id' => $diplome)
		));



		if(count($find) != 0){

			$model2 = new $modelName2(); 
			$find2 = $model2->find('list', array(
				'contain' => array('Fsession'),
				'fields' => array('diplome'),
				'conditions' => array('Fsession.diplome_id' => $find, 'stagiaire_id' => $stagiaire, 'validation' => 1)
			));

			if(count($find2) == count($find)){
				return 'OK';
			} else {

				$model3 = new $modelName3(); 
				$find3 = $model3->find('list', array(
					'fields' => array('name'),
					'conditions' => array('id' => array_diff($find, $find2))
				));
				return  $find3;
			}
		} else {
			return false;
		}
	
	}


	public function verifDroitFsession($structure,$fsession,$user,$profil,$modelName = 'FsessionOrga') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('count', array(
			'contain' => array('Fsession'),
			'conditions' => array(
				'fsession_id' => $fsession,
				'OR' => array(
					'FsessionOrga.structure_id' => $structure
					//'Fsession.user_create_id' => $user
				)
			)
		));

		if($find == 1 or $profil == 'GF'){
			return false;
		} else {
			return true;
		}	
	}

	
	public function verifOf($structure,$modelName = 'Of') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('count', array(
			'conditions' => array(
				'structure_id' => $structure)
		));

		if($find == 1){
			return true;
		} else {
			return false;
		}	
	}


	public function verifLicences($personne_id, $saison, $modelName = 'Licence') {

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'conditions' => array('SaisonAnnee' => $saison, 'personne_id' => $personne_id)
		));

		if($find != 0){
			return true;
		} else {
			return false;
		}
	
	}


	public function verifAffiliation($structure_id, $saison, $modelName = 'Affiliation') {

		if(date('m') >= 9 and date('m') <= 12){
			$SaisonAnnee = date('Y') + 1;
		} else{
			$SaisonAnnee = date('Y');
		}

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id', 'sport'),
			'conditions' => array('SaisonAnnee' => $SaisonAnnee, 'structure_id' => $structure_id)
		));

		if($find != 0){
			return '<span class="label label-success">Affilié '.$saison.'</span>';
		} else {
			return '<span class="label label-danger">non Affilié</span>';
		}
	
	}

	public function verifProfilStagiaire($personne_id, $modelName = 'Stagiaire') {

		App::import("Model", $modelName); 
		$model = new $modelName();  

		$model->contain('Annuaire');
		$find = $model->findByPersonneId($personne_id);

		if(
			!empty($find['Annuaire']['email']) and
			!empty($find['Annuaire']['tel_gsm']) and
			!empty($find['Annuaire']['pays_naissance']) and
			!empty($find['Annuaire']['dept_naissance']) and
			!empty($find['Annuaire']['ville_naissance']) and
			!empty($find['Annuaire']['adresse_ligne3']) and
			!empty($find['Annuaire']['commune'])

		){
			return true;
		} else {
			return false;
		}

		
	}


	public function verifEncadrantJNAH($delegation_id, $modelName = 'Participant') {

		App::import("Model", $modelName); 
		$model = new $modelName();  

		$model->contain('Annuaire');
		$FE = 6*$model->find('count', array('conditions' => array('type' => 1,'delegation_id' => $delegation_id, 'mobilite_id' => array(1,9))));
		$FM = 3*$model->find('count', array('conditions' => array('type' => 1,'delegation_id' => $delegation_id, 'mobilite_id' => array(2,3))));
		$D = 2*$model->find('count', array('conditions' => array('type' => 1,'delegation_id' => $delegation_id, 'mobilite_id' => array(4,5,6,7))));

		//$nbEncadrantsPEC = ($FE+$FM+$D)/6,0, PHP_ROUND_HALF_UP);

		$nbEncadrantsPEC = round(($FE+$FM+$D)/6,1, PHP_ROUND_HALF_UP);
		$nbEncadrantsPEC2 = round(($FE+$FM+$D)/6,0, PHP_ROUND_HALF_UP);

		$nbEncadrantsPEC3 = $nbEncadrantsPEC-$nbEncadrantsPEC2;


		if($nbEncadrantsPEC3 >0){
			$nbEncadrantsPEC = $nbEncadrantsPEC+1;
		}

		return round($nbEncadrantsPEC,0);

		//return $FE.' '.$FM.' '.$D;


		
	}

	public function verifAnnuaireGroup($group,$user, $modelName = 'GroupG') {


		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id', 'sport'),
			'conditions' => array('group_id' => $group, 'user_id' => $user)
		));

		if($find != 0){
			return true;
		} else {
			return false;
		}
	
	}


	public function verifDroitFicheAnnuaire($id,$user_id,$profil_user_id = null,$modelName = 'Annuaire',$modelName2 = 'GroupR',$modelName3 = 'GroupG') {


		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->findById($id);

		App::import("Model", $modelName2); 
		$model2 = new $modelName2();  
		$groups = $model2->find('list', array(
			'fields' => array('group_id'),
			'conditions' => array('annuaire_id' => $id)
		));

		App::import("Model", $modelName3); 
		$model3 = new $modelName3();  
		$gests = $model3->find('list', array(
			'fields' => array('user_id'),
			'conditions' => array('group_id' => $groups)
		));

		if($find['Annuaire']['private'] != 1 or $find['Annuaire']['user_create_id'] == $user_id or in_array($user_id,$gests) or $profil_user_id == 4){ 
			return false;
		} else {
			return true;
		}
	
	}


	public function verifFinishDelegationJnh($delegation,$modelName = 'Participant',$modelName2 = 'Delegation') {


		App::import("Model", $modelName); 
		$model = new $modelName();  

		App::import("Model", $modelName2); 
		$model2 = new $modelName2();  

		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array('delegation_id' => $delegation)
		));

		$find2 = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array('delegation_id' => $delegation, 'engagement >=' => 2)
		));

		$find3 = $model2->find('count', array(
			'fields' => array('id'),
			'conditions' => array('id' => $delegation, 'engagement >=' => 2)
		));

		if($find == $find2 and $find3 == 0){
			return false;
		} else {
			return true;
		}
	
	}

	// ON VERIFIE SI INTERVENANT DEJA UTILISE SU R SESSION AVNT SUPPRESSION
	public function verifBeforeSupprInterv($interv,$modelName = 'FsessionINT') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array('interv_id' => $interv)
		));
		if($find != 0){
			return true;
		} else {
			return false;
		}
	
	}

	public function verifFullFsession($fsession_id,$nbStag,$modelName = 'Fsession') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		
		$find = $model->find('first', array(
			'contain' => array('Diplome' => array('fields' => array('Diplome.nb_stag_max'))),
			'conditions' => array(
				'Fsession.id' => $fsession_id,
			)
		));


		if(!empty($find['Fsession']['nb_stag_max'])){
			$nbStagMax = $find['Fsession']['nb_stag_max'];
		} else {
			$nbStagMax = $find['Diplome']['nb_stag_max'];
		}

		if($nbStag >= $nbStagMax){
			return true;
		} else {
			return false;
		}

		//return $find['Diplome']['nb_stag_max'];	
	}

	public function verifDocument($verified) {		
		if($verified == 1){
			return '<i class="glyphicons ok_2 gly_vert x2" title="Vérifié"></i>';
		} else {
			return '<i class="glyphicons hourglass gly_orange x2" title="En attente de vérification"></i>';
		}		
	}

	public function verifPubDocument($published) {		
		if($published == 1){
			return '<i class="glyphicons eye_open gly_vert x2" title="Publié"></i>';
		} else {
			return '<i class="glyphicons eye_close gly_rouge x2" title="Non publié"></i>';
		}		
	}


	public function verifModified($modified) {	
		$date = new DateTime(date('Y-m-d')); $interval = new DateInterval('P6M');
		$date->sub($interval); $date1 = $date->format('Y-m-d');
		$date->sub($interval); $date2 = $date->format('Y-m-d');

		//return date('Y-m-d', strtotime($modified)).' • '.$date1;
	
		if(date('Y-m-d', strtotime($modified)) > $date1 ){
			return '<i class="glyphicons pencil gly_vert x2" title="Mise à jour OK • moins de 6 mois"></i>';
		} else if(date('Y-m-d', strtotime($modified)) < $date1 and date('Y-m-d', strtotime($modified)) > $date2){
			return '<i class="glyphicons pencil gly_orange x2" title="Mise à jour moyenne • 6 à 12 mois"></i>';
		} else {
			return '<i class="glyphicons pencil gly_rouge x2" title="Mise à jour mauvaise • plus de 6 mois"></i>';
		}	
	}




}
