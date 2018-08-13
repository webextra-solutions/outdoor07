<?php  
class FormatageComponent extends Component { 
  
  
	// FORMATAGE TELEPHONE
	public function telef($number = '', $separator = ' ')
	{
		$chunks = array();
		for($i = 0; $i < strlen($number); $i += 2)
		{
			$chunks[] = substr($number, $i, 2);
		}
		return implode($separator, $chunks);
	
	}

    function dateFRtoUS ($date){ 
        return date('Y-m-d', strtotime(str_replace('/', '-',$date)));        
    } 

    // FORMATAGE DATE FR -> DATE US
	public function dateFRHRtoUS($date){

		return date('Y-m-d H:i', strtotime(str_replace('/', '-',$date)));   
	}

    // FORMATAGE DATE US -> DATE FR
	public function dateUStoFR($dateUS){
		return date('d/m/Y', strtotime($dateUS));
	}

	// FORMATAGE DATE US -> DATE FR
	public function datehrUStoFR($dateUS){
		return date('d/m/Y à H:i', strtotime($dateUS));
	}

	// ANNEE
	public function year($date){
		return date('Y', strtotime($date));
	}

    // Enlever les accents
	public function wd_remove_accents($str, $charset='utf-8'){
	    $str = htmlentities($str, ENT_NOQUOTES, $charset);
	    
	    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
	    
	    return $str;
	}

	// LISTE DEROULANTE de CHIFFRES
	public function genererListeNb($nb){

		$listNb = array(); 
		for($i=0;$i < $nb;$i++) { 
			$listNb[i] = $i;
		}
		return $listNb;
	}

	public function get_lundi_from_week($week,$year,$format="d/m/Y") {

		$firstDayInYear=date("N",mktime(0,0,0,1,1,$year));
		if ($firstDayInYear<5)
		$shift=-($firstDayInYear-1)*86400;
		else
		$shift=(8-$firstDayInYear)*86400;
		if ($week>1) $weekInSeconds=($week-1)*604800; else $weekInSeconds=0;
		$timestamp=mktime(0,0,0,1,1,$year)+$weekInSeconds+$shift;
		$timestamp_vendredi=mktime(0,0,0,1,7,$year)+$weekInSeconds+$shift;

		return date('Y-m-d',$timestamp);

	}


	// LISTE DEROULANTE de CHIFFRES
	public function genererNumDelegation($event_id){
		$modelName = 'Delegation';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array('fields' => array('Max(num) as numMax'), 'conditions' => array('event_id' => $event_id)));
		return $find[0]['numMax']+1;
	}


	// VERIFIE PRESENCE DANS LA BASE PERSONNE
	public function verifTbPersonne($nom,$ddn){
		$modelName = 'Personne';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Personne.id'), 
			'conditions' => array(
				'PersonneNom' => $nom,
				'PersonneDdn' => $ddn
			)
		))){
			return $find['Personne']['id'];
		} else {
			return 'no_found';
		}
	}

	public function verifPersonne($nom_indiv,$prenom_indiv, $modelName = 'Personne') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'fields' => array('id'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonneDdn' => $prenom_indiv)
		));

		if(count($find) == 1){
			return $find[$modelName]['id'];
		} else {
			return '';
		}
	}

	public function verifStagiaire($PersonneId) {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'fields' => array('id'),
			'conditions' => array('personne_id' => $PersonneId)
		));

		if(count($find) == 1){
			return $find[$modelName]['id'];
		} else {
			return '';
		}
	}



	// VERIFIE PRESENCE DANS LA BASE ANNUAIRE
	public function verifTbAnnuaire($personne_id){
		$modelName = 'Annuaire';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Annuaire.id'), 
			'conditions' => array(
				'personne_id' => $personne_id
			)
		))){
			return $find['Annuaire']['id'];
		} else {
			return 'no_found';
		}
	}

	// VERIFIE PRESENCE DANS LA BASE PARTICICPANT
	public function verifTbParticipant($personne_id,$event_id){
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

	// VERIFIE PRESENCE DANS LA BASE BENEVOLE
	public function verifTbBenevole($nom,$ddn){
		$modelName = 'Benevole';
		App::import("Model", $modelName); 
		$model = new $modelName();  
		if($find = $model->find('first', array(
			'fields' => array('Benevole.id'), 
			'conditions' => array(
				'name' => $nom,
				'ddn' => $ddn
			)
		))){
			return $find['Benevole']['id'];
		} else {
			return 'no_found';
		}
	}

	// CREATION USERNAME
	function username($prenom, $nom, $modelName = 'User'){

		$username = strtoupper(substr(strtr(utf8_encode($prenom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'),0,1).'.'.
		strtr(utf8_encode($nom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')); 

		$username2 = strtoupper(substr(strtr(utf8_encode($prenom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'),0,2).'.'.
		strtr(utf8_encode($nom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')); 

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('first', array(
			'fields' => array('User.id','User.email'), 
			'conditions' => array(
				'username' => $username
			)
		));

		if(count($find) >= 1){

			//$type_email = explode('@',$find['User']['email']);

			
				return $username2;
		

		} else {
			return $username;
		}
	}


	public function ddnMax($age,$event_debut) {	
		$date = new DateTime($event_debut); $interval = new DateInterval('P'.$age.'Y');
		$date->sub($interval); 
		return $date->format('Y-m-d');
	}


	public function verifPersonne3($nom_indiv,$ddn_indiv, $modelName = 'Personne') {

		

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('all', array(
			'fields' => array('id','PersonneNom','PersonnePrenom','PersonneDdn'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonneDdn' => $ddn_indiv)
		));

		if(count($find) >= 1){
			$result = '';

			foreach ($find as $row) {
				$result .= '<span style="color:#F00">'.$row['Personne']['id'].' | '.$row['Personne']['PersonneNom'].' | '.$row['Personne']['PersonnePrenom'].' | '.$row['Personne']['PersonneDdn'].'</span><br/>';
			}

			return $result;
			
		} else {
			return '';
		}
	
	}

	public function verifPersonne4($nom_indiv,$prenom_indiv, $modelName = 'Personne') {

		

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('all', array(
			'fields' => array('id','PersonneNom','PersonnePrenom','PersonneDdn'),
			'conditions' => array('PersonneNom' => $nom_indiv, 'PersonnePrenom' => $prenom_indiv)
		));

		if(count($find) >= 1){
			$result = '';

			foreach ($find as $row) {
				$result .= '<span style="color:#428bca">'.$row['Personne']['id'].' | '.$row['Personne']['PersonneNom'].' | '.$row['Personne']['PersonnePrenom'].' | '.$row['Personne']['PersonneDdn'].'</span><br/>';
			}

			return $result;
			
		} else {
			return '';
		}
	
	}

	public function verifPersonne5($nom_indiv,$prenom_indiv,$ddn_indiv, $modelName = 'Personne') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('all', array(
			'fields' => array('id','PersonneNom','PersonnePrenom','PersonneDdn'),
			'conditions' => array('PersonneNom' => $nom_indiv,'PersonnePrenom' => $prenom_indiv, 'PersonneDdn' => $ddn_indiv)
		));

		if(count($find) >= 1){
			$result = '';

			foreach ($find as $row) {
				$result .= '<span style="color:#a8d007">'.$row['Personne']['id'].' | '.$row['Personne']['PersonneNom'].' | '.$row['Personne']['PersonnePrenom'].' | '.$row['Personne']['PersonneDdn'].'</span><br/>';
			}

			return $result;
			
		} else {
			return '';
		}
	
	}


	




    
} 
?>