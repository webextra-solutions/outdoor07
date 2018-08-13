<?php  
class ListesComponent extends Component { 
  
	// Liste des types de session de formation
	public function typeFsession($data = null){	
		$liste = array(1 => 'Mono-modulaire', 2 => 'Multi-modulaires', 3 => 'Diplomante');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}			
		
	}

	public function modeTransport($data = null){	
		$liste = array(1 => 'Avion', 2 => 'Train', 3 => 'Minibus/bus', 4 => 'Voiture');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}			
		
	}

	public function thematique($data = null){	
		$liste = array(
			1 => 'J’encadre la pratique', 
			2 => 'Je développe les services de la fédération', 
			3 => 'J’accompagne les actions de  formation', 
			4 => 'Je manage une structure associative'
		);

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}			
		
	}

	

	// Liste des catégories d'exprience du stgaiaire
	public function categExpStagiaire($data = null){	
		$liste = array(1 => 'Professionnelle', 2 => 'Bénévole');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}			
		
	}

	// Liste des formations
	public function formation($id){	
		$model = ClassRegistry::init('Diplome');
		$find = $model->findById($id);
		return $find['Diplome']['name'];		
	}

	// Liste des formations
	public function sport($id){	
		$model = ClassRegistry::init('Fsport');
		$find = $model->findById($id);
		return $find['Fsport']['name'];		
	}

	// Liste des domaines
	public function domaine($id){	
		$model = ClassRegistry::init('Fdomaine');
		$find = $model->findById($id);
		return $find['Fdomaine']['name'];		
	}

	// Liste des domaines
	public function module($id){	
		$model = ClassRegistry::init('Ue');
		$find = $model->findById($id);
		return $find['Ue']['name'];		
	}


// Liste des departements
	public function liste($modelName,$champ,$id){	
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('list', array('fields' => array('id', $champ)));
		return $find;		
	}

	// Liste des departements
	public function liste2($modelName,$champ,$id){	
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('list', array('fields' => array('id', $champ)));

		if(!empty($id)){
			return $find[$id];
		} else {
			return $find;
		}		
	}

	// LISTE DES DEPARTEMENTS
	public function departements($region = null){
		App::import("Model", 'Departement'); 
		$model = new Departement(); 
		if(!empty($region)){
			$dep = $model->find('list',array(
				'conditions' => array('StructureRegion' => $region),
	        	'fields' => array('id', 'numName'),
				'order' => 'numName'
	        ));
		} else {
			$dep = $model->find('list',array(
	        	'fields' => array('id', 'numName'),
				'order' => 'numName'
	        ));

		}
		return $dep;
	}

	// LISTE DES DEPARTEMENTS
	public function regionOfDepartement($departement){
		App::import("Model", 'Departement'); 
		$model = new Departement(); 
		
		$dep = $model->find('list',array(
			'conditions' => array('id' => $departement),
        	'fields' => array('StructureRegion')
        ));
		
		return $dep[$departement];
	}

    
} 
?>