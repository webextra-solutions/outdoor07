<?php
/**
 * Helper pour le formatage des textes et nombres et dates
 */

class ListesHelper extends Helper {


	// Liste des catégories de docuement pour les sessions de formation
	public function sports($data = null){
		$liste = array(1 => 'Raid Multisport', 2 => 'VTT', 3 => 'Course d\'orientation', 4 => 'Canoë');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des catégories de docuement pour les sessions de formation
	public function groupEcole($data = null){
		$liste = array(1 => 'Groupe 1', 2 => 'Groupe 2',3 => 'Groupe 3',4 => 'Groupe 4',5 => 'Groupe 5');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des catégories de docuement pour les sessions de formation
	public function typePersonne($data = null){
		$liste = array(1 => 'Enfant', 2 => 'Encadrant');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des catégories de docuement pour les sessions de formation
	public function typeLicence($data = null){
		$liste = array(1 => 'Licence Dirigeant/Cadre', 2 => 'Licence compétition Jeune', 3 => 'Licence compétition adulte', 4 => 'Licence loisir');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des catégories de docuement pour les sessions de formation
	public function statutAccomp($data = null){
		$liste = array(1 => 'Papa', 2 => 'Maman',3 => 'Frère', 4 => 'Soeur');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des catégories de docuement pour les sessions de formation
	public function categDocInterv($data = null){
		$liste = array(1 => 'CV', 2 => 'Autre',3 => 'Signature');

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

	public function iconeDocument($data = null){
		$liste = array(
			1 => 'file', 2 => 'camera', 3 => 'film'
		);

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}



	public function typeRessource($data = null){
		$liste = array(
			1 => 'Document',
			2 => 'Photo',
			3 => 'Vidéo'
		);

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	public function modeTransportByEven($type_even,$data = null){
		if($type_even == 'CUP5'){
			$liste = array(1 => 'Avion', 2 => 'Train', 3 => 'Minibus/bus', 4 => 'Voiture');
		} else {
			$liste = array(1 => 'Avion', 2 => 'Train', 3 => 'Minibus/bus', 4 => 'Voiture');
		}

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


	// Liste des catégories d'exprience de l'intervenant
	public function categExpInterv($data = null){
		$liste = array(1 => 'Professionnelle', 2 => 'Bénévole');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// fonction représentant fédéral
	public function fonctionsRF($data = null){
		$liste = array(
			1 => 'Président(e)',
			2 => 'Vice-président(e)',
			3 => 'Vice-président(e) délégué(e)',
			4 => 'Secrétaire',
			5 => 'Secrétaire adjoint(e)',
			6 => 'Trésorier(e)',
			7 => 'Trésorier(e) adjoint(e)',
			8 => 'Membre comité directeur'
		);

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des type de diplôme
	public function categDipStagiaire($data = null){
		$liste = array(1 => 'Diplôme d\'état (inscrit au RNCP)', 2 => 'Diplôme fédéral', 3 => 'Diplôme universitaire');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des type de diplôme
	public function niveauDipStagiaire($data = null){
		$liste = array(1 => 'Niveau 1', 2 => 'Niveau 2', 3 => 'Niveau 3', 4 => 'Niveau 4', 5 => 'Niveau 5');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des type de diplôme
	public function couleurs($data = null){
		$liste = array('#000' => 'Noir', '#01B0F0' => 'Bleu', '#CCC' => 'Gris', '#F00' => 'Rouge', '#1D702D' => 'Vert', '#FF5900' => 'Orange', '#FDD131' => 'Jaune', '#6B1A6A' => 'Violet', '#E82759' => 'Rose', "#FFF" => 'Blanc');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}


	// Liste des type de diplôme
	public function tailleTeeshirt($data = null){
		$liste = array(1 => 'XS',2 => 'S', 3 => 'M', 4 => 'L', 5 => 'XL', 6 => '2XL', 7 => '3XL',8=>'4XL');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des type de diplôme
	public function modeRemboursement($data = null){
		$liste = array(1 => 'CB', 2 => 'Espèces', 3 => 'Virement', 4 => 'Chèque', 5 => 'Prélèvement automatique');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des familles d'épreuve
	public function familleEpreuve($data = null){
		$liste = array(0 => 'Aucune', 1 => 'Athlétisme', 2 => 'Natation', 3 => 'Force/vitesse', 4 => 'Duelle', 5 => 'Précision');

		if(isset($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des types de session de formation
	public function typeFsession($data = null){
		$liste = array(2 => 'Modulaire', 3 => 'Diplomante');

		//$liste = array(3 => 'Diplomante');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}


	// Liste des types de session de formation
	public function typeFsessionProfil($profil,$data = null){
		if($profil == 'GF'){$liste = array(2 => 'Modulaire', 3 => 'Diplomante');} else {$liste = array(3 => 'Diplomante');}


		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}

	// Liste des types de session de formation
	public function federation($data = null){
		App::import("Model", 'Federation');
		$model = new Federation();
		$liste = $model->find('list', array('fields' => array('id', 'name')));

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}

	}


	// Liste des departements
	public function liste($modelName,$champ,$id){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'fields' => array('id', $champ),
			'order' => array($champ.' ASC')
		));
		return $find;
	}

	// Liste des departements
	public function listeConditions($modelName,$champ,$conditionChamp,$conditionValeur,$id){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'conditions' => array($conditionChamp => $conditionValeur),
			'fields' => array('id', $champ),
			'order' => array($champ.' ASC')
		));
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

	// Liste des departements
	public function listeDiplomeForSession($modelName,$champ,$condition){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'fields' => array('id', $champ),
			'conditions' => array('types_dip_id' => $condition)

		));

		if(!empty($id)){
			return $find[$id];
		} else {
			return $find;
		}
	}



	// Liste des sites de transports
	public function listeSitesTransport($modelName,$champ,$event_id){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array('conditions' => array('event_id' => $event_id),'fields' => array('id', $champ)));
			return $find;

	}

	// Liste des departements
	public function liste3($modelName,$champ,$id,$exceptions){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'fields' => array('id', $champ),
			'order' => 'name ASC',
			'conditions' => array('id !=' => $exceptions)
		));
		return $find;
	}

	// Liste des departements
	public function licenciesByStructure($structure,$saison,$typeLicence,$discipline,$modelName = 'Licence'){
		App::import("Model", $modelName);
		$model = new $modelName();

		if(!empty($discipline)){$conditionsDiscipline = array('DisciplineCode' => $discipline);} else {$conditionsDiscipline = array();}
		if(!empty($typeLicence)){$conditionsTypeLicence = array('licenceType' => $typeLicence);} else {$conditionsTypeLicence = array();}
		if(!empty($saison)){$conditionsSaison = array('SaisonAnnee' => $saison);} else {$conditionsSaison = array();}
		if(!empty($structure)){$conditionsStructure = array('structure_id' => $structure);} else {$conditionsStructure = array();}

		$conditions = array_merge($conditionsDiscipline,$conditionsTypeLicence,$conditionsSaison,$conditionsStructure);
		$find = $model->find('list', array(
			'fields' => array('personne_id', 'FN'),
			'conditions' => $conditions,
			'order' => array('PersonneNom' => 'ASC')
		));

		return $find;

	}


	// Liste des departements
	public function listeActive($modelName,$champ,$id = null){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'fields' => array('id', $champ),
			'conditions' => array('active' => 1)
		));

		if(!empty($id)){
			return $find[$id];
		} else {
			return $find;
		}
	}

	// Liste des departements
	public function listeDiplomes($modelName = 'Diplome'){
		App::import("Model", $modelName);
		$model = new $modelName();
		$find = $model->find('list', array(
			'fields' => array('id', 'name'),
			'conditions' => array('active' => 1,'thematique_id' => 1)
		));


		return $find;

	}

	// LISTE DEROULANTE de CHIFFRES
	public function genererListeNb($nb){

		$listNb = array();
		for($i=1;$i <= $nb;$i++) {
			$listNb[$i] = $i;
		}
		return $listNb;
	}




	// LISTE DEROULANTE de CHIFFRES
	public function genererListeYear($min, $max){

		$listNb = array();
		for($i=$min;$i <= $max;$i++) {
			$listNb[$i] = $i;
		}
		return $listNb;
	}


	// LISTE DEROULANTE de CHIFFRES
	public function genererListeSaison($min, $max){

		$listNb = array();
		for($i=$min;$i <= $max;$i++) {
			$listNb[$i] = ($i-1).'/'.$i;
		}
		return $listNb;
	}

	// LISTE DEROULANTE de CHIFFRES
	public function genererListeYearAvecAucun($min, $max){

		$listNb = array();
		$listNb[] = 'Aucune';
		for($i=$min;$i <= $max;$i++) {
			$listNb[] = $i;
		}
		return $listNb;
	}


	// LISTE DEROULANTE de CHIFFRES
	public function genererListeYear2($min, $max){

		$listNb = array();
		for($i=$min;$i <= $max;$i++) {
			$listNb[$i] = $i;
		}
		return $listNb;
	}


	// LISTE DES REGIONS
	public function regions(){
		App::import("Model", 'Structure');
		$model = new Structure();

		$reg = $model->find('list',array(
				'fields' => array('StructureCode', 'Region'),
				'conditions' => array('StructureType' => 'LIG', 'StructureEtat' => 'A'),
				'order' => 'name ASC'));
		return $reg;
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
	public function departements2($region = null){
		App::import("Model", 'Departement');
		$model = new Departement();
		if(!empty($region)){
			$dep = $model->find('list',array(
				'conditions' => array('StructureRegion' => $region),
	        	'fields' => array('DEP', 'numName'),
				'order' => 'numName'
	        ));
		} else {
			$dep = $model->find('list',array(
	        	'fields' => array('DEP', 'numName'),
				'order' => 'numName'
	        ));

		}
		return $dep;
	}

	// LISTE DES DEPARTEMENTS
	public function regionOfDepratement($departement){
		App::import("Model", 'Departement');
		$model = new Departement();

		$dep = $model->find('list',array(
			'conditions' => array('id' => $departement),
        	'fields' => array('StructureRegion')
        ));

		return $dep;
	}







}
