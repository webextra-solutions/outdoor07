<?php
/**
 * Helper pour le formatage des textes et nombres et dates
 */



class FormatageHelper extends Helper {
	
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


	// FORMATAGE NOMBRE AVEC SEPARATEUR DE MILLIER
	public function millierSep($number){
		App::uses('CakeNumber', 'Utility');
		return CakeNumber::format($number, array('before' => '','places' => 0, 'thousands' => ' '));
	}

	// FORMATAGE DATE FR -> DATE US
	public function dateUS($date){

		return date('Y-m-d', strtotime(str_replace('/', '-',$date)));   
	}

	// FORMATAGE DATE FR -> DATE US
	public function dateUShr($date){

		return date('Y-m-d H:i', strtotime(str_replace('/', '-',$date)));   
	}
	
	// FORMATAGE DATE US -> DATE FR
	public function dateFR($dateUS){
		if($dateUS == '0000-00-00 00:00:00' or $dateUS == '1970-01-01'){
			return '';
		} else {
			return date('d/m/Y', strtotime($dateUS));
		}
	}

	// FORMATAGE DATE US -> DATE FR
	public function dateFRBis($dateUS){
		if($dateUS == '0000-00-00' or $dateUS == '1970-01-01'){
			return '';
		} else {

			
			$JoursFR = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

			return $JoursFR[date('N', strtotime($dateUS))];
		}
	}	

	// FORMATAGE DATE US -> DATE FR
	public function dateFRBis2($dateUS){
		if($dateUS == '0000-00-00' or $dateUS == '1970-01-01'){
			return '';
		} else {

			
			$JoursFR = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
			$MoisFR = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

			return date('d', strtotime($dateUS)).' '.$MoisFR[date('n', strtotime($dateUS))];
		}
	}

	// FORMATAGE DATE US -> DATE FR
	public function dateFRBis3($dateUS){
		if($dateUS == '0000-00-00' or $dateUS == '1970-01-01'){
			return '';
		} else {

			
			$JoursFR = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
			$MoisFR = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

			return $JoursFR[date('N', strtotime($dateUS))].' '.date('d', strtotime($dateUS)).' '.$MoisFR[date('n', strtotime($dateUS))];
		}
	}	
	
		// FORMATAGE DATE US -> DATE FR avec YEAR petit
	public function dateFRy($dateUS){
		return date('d/m/y', strtotime($dateUS));
	}	

	
	// FORMATAGE DATE et HEURE US -> DATE FR
	public function datehrFR($dateUS){
		return date('d/m/Y à H:i', strtotime($dateUS));
	}

	// Affichage Bandeau pagination en fonction d'un nombre de pages
	public function afficherPagination($pagination,$nbResults,$nbPage){
		if($nbResults > $nbPage) {

			return $pagination;
		} else {
			return false;
		}
	}

	// ANNEE
	public function year($date){
		return date('Y', strtotime($date));
	}

	// AFFICHER TAILLE D'UN FICHIER
	function taille($fichier){
		global $size_unit;
		// Lecture de la taille du fichier
		$taille = filesize($fichier);
		// Conversion en Go, Mo, Ko
		if ($taille >= 1073741824) 
		{ $taille = round($taille / 1073741824 * 100) / 100 . " Go"; }
		elseif ($taille >= 1048576) 
		{ $taille = round($taille / 1048576 * 100) / 100 . " Mo"; }
		elseif ($taille >= 1024) 
		{ $taille = round(round($taille / 1024 * 100) / 100,0) . " Ko"; }
		else
		{ $taille = $taille . " o"; } 
		if($taille==0) {$taille="-";}
		return $taille;
	}

	// Jour et Mois en Français
	public function motifAnnulation($data){
		$motifs = array(
					1 => 'Effectifs Participants insuffisants',
					2 => 'Effectifs Encadrants insuffisants',
					3 => 'Effectifs Bénévoles insuffisants',
					4 => 'Effectifs Jury insuffisants',
					5 => 'Ressources financières insuffisantes',
					6 => 'Conditions climatiques',
					7 => 'Aspects réglementaires',
					8 => 'Aspects juridiques',
					9 => 'Conditions de sécurité non conformes',
					10 => 'Disponibilité des locaux',
					11 => 'Pas d\'organisateur',
					12 => 'Autre'
		);		
		return $motifs[$data];
	}
	
	// Jour et Mois en Français
	public function dateFR2(){
		$JoursFR = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
		$MoisFR = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		return $JoursFR[date('N')].' '.date('d').' '.$MoisFR[date('n')].' '.date('Y');
	}

	
	
	// Jour et Mois en Français
	public function dateFR3($data, $id){		
		if($data == 'MoisFR'){
			$MoisFR = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
			return $MoisFR[$id];
		}
		
		if($data == 'MoisFRCAP'){
			$MoisFRCAP = array('', 'JANVIER', 'FÉVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOÛT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DÉCEMBRE');
			return $MoisFRCAP[$id];
		}
		
		if($data == 'MoisINIFR'){
			$MoisINIFR = array('', 'Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc');
			return $MoisINIFR[$id];
		}

		if($data == 'MoisINIFRCAP'){
			$MoisINIFRCAP = array('', 'JANV', 'FÉV', 'MARS', 'AVR', 'MAI', 'JUIN', 'JUIL', 'AOÛT', 'SEPT', 'OCT', 'NOV', 'DÉC');
			return $MoisINIFRCAP[$id];
		}
	}
	
	// Enlever les accents
	function noACCENT($string){
		return strtr(utf8_encode($string),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
	'-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'); 
	}

	// CREATION USERNAME
	function username($prenom, $nom){
		return strtoupper(substr(strtr(utf8_encode($prenom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'),0,1).'.'.
		strtr(utf8_encode($nom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')); 
	}

	// CREATION USERNAME avec tiret au lieu du point
	function username2($prenom, $nom){
		return strtoupper(substr(strtr(utf8_encode($prenom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'),0,1).'-'.
		strtr(utf8_encode($nom),' àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','-aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')); 
	}

	// DATES CALENDRIER
	public function dateCalendar2($debut, $fin){	
		
		$debut = date('Y-m-d', strtotime(str_replace('/', '-',$debut)));
		$fin = date('Y-m-d', strtotime(str_replace('/', '-',$fin)));

		if(date('Y', strtotime($debut)) != date('Y', strtotime($fin))){
			return strftime('%d %b %Y', mktime(0,0,0,date('n',strtotime($debut)),date('d',strtotime($debut)),date('Y',strtotime($debut)))).
			' <i class="glyphicons chevron-right"></i> '.
			strftime('%d %b %Y', mktime(0,0,0,date('n',strtotime($fin)),date('d',strtotime($fin)),date('Y',strtotime($fin))));
		}
		
		if(date('Y', strtotime($debut)) == date('Y', strtotime($fin))){
			if($debut == $fin){
				return strftime('%d %b %Y', mktime(0,0,0,date('n',strtotime($debut)),date('d',strtotime($debut))));
			} else {
				return strftime('%d %b', mktime(0,0,0,date('n',strtotime($debut)),date('d',strtotime($debut)),date('Y',strtotime($debut)))).
				' <i class="glyphicons chevron-right"></i> '.
				strftime('%d %b %Y', mktime(0,0,0,date('n',strtotime($fin)),date('d',strtotime($fin)),date('Y',strtotime($fin))));
			}
		}
	}


	// DATES CALENDRIER
	public function dateCalendar($debut, $fin){	

		$Mois = array('', 'Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'août', 'sep', 'oct', 'nov', 'déc');
		
		$debut = date('Y-m-d', strtotime(str_replace('/', '-',$debut)));
		$fin = date('Y-m-d', strtotime(str_replace('/', '-',$fin)));

		if(date('Y', strtotime($debut)) != date('Y', strtotime($fin)) or date('Y') != date('Y', strtotime($debut))){
			return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].
			' <i class="glyphicons chevron-right" style="color:#666;"></i>'.
			date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))].' '.date('y', strtotime($fin));
		}
		
		if(date('Y', strtotime($debut)) == date('Y', strtotime($fin))){
			if($debut == $fin){
				return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))];

			} else if(date('m', strtotime($debut)) != date('m', strtotime($fin))){
				return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].
				' <i class="glyphicons chevron-right" style="color:#777;"></i> '.
				date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))];

			} else {
				return date('d', strtotime($debut)).
				' <i class="glyphicons chevron-right" style="color:#777;"></i> '.
				date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))];
			}
		}
	}

	// DATES CALENDRIER
	public function dateCalendar3($debut, $fin){	

		$Mois = array('', 'Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'août', 'sep', 'oct', 'nov', 'déc');
		
		$debut = date('Y-m-d', strtotime(str_replace('/', '-',$debut)));
		$fin = date('Y-m-d', strtotime(str_replace('/', '-',$fin)));

		if(date('Y', strtotime($debut)) != date('Y', strtotime($fin))){
			return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].' '.date('Y', strtotime($debut)).
			' <i class="glyphicons chevron-right" style="color:#666;"></i> '.
			date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))];
		}
		
		if(date('Y', strtotime($debut)) == date('Y', strtotime($fin))){
			if($debut == $fin){
				return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].' '.date('Y', strtotime($debut));
			} else {
				return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].
				' <i class="glyphicons chevron-right" style="color:#777;"></i> '.
				date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))].' '.date('Y', strtotime($fin));
			}
		}
	}

	// DATES CALENDRIER
	public function dateCalendar4($debut, $fin){	

		$Mois = array('', 'Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'août', 'sep', 'oct', 'nov', 'déc');
		
		$debut = date('Y-m-d', strtotime(str_replace('/', '-',$debut)));
		$fin = date('Y-m-d', strtotime(str_replace('/', '-',$fin)));

		if(date('Y', strtotime($debut)) != date('Y', strtotime($fin))){
			return date('d', strtotime($debut)).' '.$Mois[date('n', strtotime($debut))].' '.date('Y', strtotime($debut)).
			' <i class="glyphicons chevron-right" style="color:#666;"></i> '.
			date('d', strtotime($fin)).' '.$Mois[date('n', strtotime($fin))];
		}
		
		if(date('Y', strtotime($debut)) == date('Y', strtotime($fin))){
			if($debut == $fin){
				return date('d', strtotime($debut));
			} else {
				return date('d', strtotime($debut)).
				' <i class="glyphicons chevron-right" style="color:#777;"></i> '.
				date('d', strtotime($fin));
			}
		}
	}


	// Niveau Géo
	public function niveauGeo($data){		
			$niveau = array(0 => 'Non défini', 1 => 'Départemental', 2 => '', 3 => 'Régional', 4 => 'Inter-régional', 5 => 'National', 6 => 'europe','7' => 'monde','8' => 'international (Hors Europe/ Monde)');
			return $niveau[$data];		
	}


	
	// Type de Licence
	public function typeLicence($data){		
			$licence = array('C' => 'Compétition', 'L' => 'Loisir', 'D' => 'Cadre', 'F' => 'Cadre fédérale', 'E' => 'Etablissement');
			return $licence[$data];
		
	}

	// Type de Licence
	public function typeSession($data){		
			$typeSession = array(1 => 'Mono-modulaire', 2 => 'Multi-modulaire', 3 => 'Diplômante' );
			return $typeSession[$data];
		
	}

	// Mois + Année - ONGELET MOIS CALENDREIR A VENIR
	public function moisOnglet($data){		
			$Mois = array('', 'JANVIER', 'FÉVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOÛT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DÉCEMBRE');
			return $Mois[date('n', strtotime($data))].' '.date('Y', strtotime($data));
		
	}

	// LISTE DEROULANTE de CHIFFRES
	public function genererListeNb($nb){

		$listNb = array(); 
		for($i=0;$i <= $nb;$i++) { 
			$listNb[] = $i;
		}
		return $listNb;
	}

	// Liste des catégories de docuement pour les sessions de formation
	public function categDocFsession($data = null){	

		$liste = array(1 => 'Planning', 2 => 'Autre');

		if(!empty($data)){
			return $liste[$data];
		} else {
			return $liste;
		}			
		
	}

	public function get_lundi_vendredi_from_week($week,$year,$format="d/m/Y") {

		$firstDayInYear=date("N",mktime(0,0,0,1,1,$year));
		if ($firstDayInYear<5)
		$shift=-($firstDayInYear-1)*86400;
		else
		$shift=(8-$firstDayInYear)*86400;
		if ($week>1) $weekInSeconds=($week-1)*604800; else $weekInSeconds=0;
		$timestamp=mktime(0,0,0,1,1,$year)+$weekInSeconds+$shift;
		$timestamp_vendredi=mktime(0,0,0,1,7,$year)+$weekInSeconds+$shift;

		return date($format,$timestamp)." au " . date($format,$timestamp_vendredi);

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


	function age($naiss) {
		list($annee, $mois, $jour) = split('[-.]', $naiss);
		$today['mois'] = date('n');
		$today['jour'] = date('j');
		$today['annee'] = date('Y');
		$annees = $today['annee'] - $annee;
		if ($today['mois'] <= $mois) {
			if ($mois == $today['mois']) {
			if ($jour > $today['jour'])
			$annees--;
			}
		else
		$annees--;
		}

		if($naiss == '1970-01-01' or $naiss == '0000_00-00'){
			return '';
		}else {
			return $annees;
		}
	}


	public function compte_a_rebours($end) {

		  $fin_intention = explode('-',date('Y-m-d', strtotime($end)));
		  $fin_intention2 = explode(':',date('H:i', strtotime($end)));
		  $annee = date('Y');
		  $endI = mktime(8, 0, 0, $fin_intention[1], $fin_intention[2], $fin_intention[0]);
		  $tps_restant = $endI - time(); // $noel sera toujours plus grand que le timestamp actuel, vu que c'est dans le futur. ;)

		  //============ CONVERSIONS

		  $i_restantes = $tps_restant / 60;
		  $H_restantes = $i_restantes / 60;
		  $d_restants = $H_restantes / 24;


		  $s_restantes = floor($tps_restant % 60); // Secondes restantes
		  $i_restantes = floor($i_restantes % 60); // Minutes restantes
		  $H_restantes = floor($H_restantes % 24); // Heures restantes
		  $d_restants = floor($d_restants); // Jours restants
		  //==================

		  setlocale(LC_ALL, 'fr_FR');

		  return

		     '<b>'.$d_restants .'</b> jours</strong>, <strong>'. $H_restantes .'</strong> heures,'
		     . ' <strong>'. $i_restantes .'</strong> minutes';

	}

	public function verifAffiliation($structure_id, $modelName = 'Affiliation') {

		if(date('m') >= 9 and date('m') <= 12){
			$SaisonAnnee = date('Y') + 1;
		} else{
			$SaisonAnnee = date('Y');

		}

		$SaisonAnnee2 = ($SaisonAnnee-1).'/'.$SaisonAnnee;

		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id', 'sport'),
			'conditions' => array('SaisonAnnee' => $SaisonAnnee, 'structure_id' => $structure_id)
		));

		if($find != 0){
			return '<span class="label label-success">Affilié '.$SaisonAnnee2.'</span>';
		} else {
			return '<span class="label label-danger">non Affilié</span>';
		}
	
	}


	public function avatar($civilite) {
		if($civilite == 'M'){
			return '<i class="glyphicons user"></i>';
		} else{
			return '<i class="glyphicons woman"></i>';
		}
	
	}

	public function verifDocAdmin($id, $modelName = 'ParticipantsDoc') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'participant_id' => $id,
				'categorie' => 2,
				'url !=' => NULL)
		));
		if($find >= 1){
			return '<i class="glyphicons log_book" title="Docs administratifs complets"></i>';
		} else{
			return '<i class="glyphicons hourglass" title="Docs administratifs incomplets"></i>';
		}
	
	}

	public function verifEpreuve($id, $nbEpr, $modelName = 'ParticipantsEpreuve') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'participant_id' => $id
				)
		));
		if($find >= $nbEpr){
			
			return '<i class="glyphicons ok" title="Epreuve(s) OK"></i>';
		} else{
			
			return '<i class="glyphicons hourglass" title="Epreuve(s) manquant(s)"></i>';
		}
	
	}

	public function verifEpreuve2($id, $nbEpr, $modelName = 'ParticipantsEpreuve') {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'participant_id' => $id
				)
		));
		if($find >= $nbEpr){
			
			return 0;
		} else{
			
			return 1;
		}
	
	}

	public function verifFullTeam($id,$events_epreuve_id) {

		$modelName1 = 'EventsEpreuve';
		App::import("Model", $modelName1);
		$model1 = new $modelName1();  
		 
    	$epreuve = $model1->find('first',array(
    		'conditions' => array(
    			'id' => $events_epreuve_id,
    		)
    	));

    	$modelName2 = 'DelegationsEquipesParticipant';
		App::import("Model", $modelName2); 
		$model2 = new $modelName2();  

		$find = $model2->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'delegations_equipe_id' => $id
				)
		));
		if($find < $epreuve['EventsEpreuve']['nb_min_team']){
			
			return 1;
		} else{
			
			return 0;
		}
	
	}


	public function verifCapTeam($id,$events_epreuve_id) {

		$modelName1 = 'EventsEpreuve';
		App::import("Model", $modelName1);
		$model1 = new $modelName1();  
		 
    	$epreuve = $model1->find('first',array(
    		'conditions' => array(
    			'id' => $events_epreuve_id,
    		)
    	));

    	$modelName2 = 'DelegationsEquipe';
		App::import("Model", $modelName2); 
		$model2 = new $modelName2();  

		$find = $model2->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'id' => $id,
				'capitaine_id' => 0
				)
		));

		

		if($find != 0){
			
			return 1;
		} else{
			
			return 0;
		}
	
	}


	public function ddnMax($age,$event_debut) {	
		$date = new DateTime($event_debut); $interval = new DateInterval('P'.$age.'Y');
		$date->sub($interval); 
		return $date->format('Y-m-d');
	}


	public function verifChampParticipant($champ, $modelName, $delegation_id, $conditions) {
		App::import("Model", $modelName); 
		$model = new $modelName();  
		$find = $model->find('count', array(
			'fields' => array('id'),
			'conditions' => array(
				'delegation_id' => $delegation_id,
				$champ => $conditions
			)
		));
		return $find;
	
	}


	// VERIFIER VALIDAITE PASSPORT ET CNI
	public function verifExpiration($data, $dateMax){
		if($data < $dateMax){
			return '<i class="glyphicons warning_sign x2 rge"></i> ';
		} else {
			return '';
		}
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


	


	function dateDiff($date1, $date2){

		$date1 = strtotime($date1);
		$date2 = strtotime($date2);

	    $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
	    $retour = array();
	 
	    $tmp = $diff;
	    $retour['second'] = $tmp % 60;
	 
	    $tmp = floor( ($tmp - $retour['second']) /60 );
	    $retour['minute'] = $tmp % 60;
	 
	    $tmp = floor( ($tmp - $retour['minute'])/60 );
	    $retour['hour'] = $tmp % 24;
	 
	    $tmp = floor( ($tmp - $retour['hour'])  /24 );
	    $retour['day'] = $tmp;
	 
	    return $retour['day']+1;
	}


	public function photoThumb($thumb) {
		 if($thumb == '/img/uploads/personne_img/img_thumb/man.png'){
		 	return '/img/uploads/personne_img/img_thumb/man2.png';
		 } else if ($thumb == '/img/uploads/personne_img/img_thumb/woman.png'){
		 	return '/img/uploads/personne_img/img_thumb/woman2.png';
		 } else {
		 	return $thumb;
		 }
	
	}

	public function genererNumDiplome($stagiaire_id,$fsession_id,$diplome_id) {
		App::import("Model", 'Diplome'); 
		$model = new Diplome();  
		$find = $model->findById($diplome_id);

		App::import("Model2", 'Fsession'); 
		$model2 = new Fsession();  
		$find2 = $model2->findById($fsession_id);	
		return $find['Diplome']['code'].'-'.$find['Diplome']['dipSportCode'].'-'.$fsession_id.'-'.$find2['Fsession']['year_min_date'].'-'.$stagiaire_id;
		
	
	}







}
