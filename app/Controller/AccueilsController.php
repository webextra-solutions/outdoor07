<?php
// app/Controller/UsersController.php
class AccueilsController extends AppController {
	
	public function params() {
		$this->Session->delete('module_id');
		$this->Session->write('module_id', 6);


		$this->loadModel('Module');
		$extraPOW = $this->Module->findById(1);
		$this->set(compact('extraPOW'));
	}
	
	public function index() {


		

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
		$this->loadModel('User');
		$user = $this->User->findById($this->Auth->User('id'));
		$msg_accueil = $user['User']['msg_accueil'];
		$this->set(compact('msg_accueil'));

		
		$this->Session->delete('module_id');
		$this->Session->write('module_id', 1);

		$this->loadModel('Seance');
		$seance = $this->Seance->find('first', array(
			'conditions' => array(
				'date >' => date('Y-m-d'),
				'published' => 1
			),
			'order' => array('date' => 'ASC')
		));
		$this->set(compact('seance'));


		


	}

	public function index2() {


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
		$this->loadModel('User');
		$user = $this->User->findById($this->Auth->User('id'));
		$msg_accueil = $user['User']['msg_accueil'];
		$this->set(compact('msg_accueil'));

		
		$this->Session->delete('module_id');
		$this->Session->write('module_id', 1);
		


		if(date('Y-m-d') >= date('Y').'-12-31'){
			$annee = $this->Session->read('anneeEnCoursMoins1');
		} else {
			$annee = $this->Session->read('anneeEnCoursMoins1')-1;
		}



		if($this->Session->read('profil_user_id') == 2){ $filtre = 'Structure.StructureCodeDepartement = '.$this->Session->read('profil_structure_code_departement'); }
		if($this->Session->read('profil_user_id') == 3){ $filtre = 'Structure.StructureCodeRegion = '.$this->Session->read('profil_structure_code_region'); }
		if($this->Session->read('profil_user_id') == 4 or $this->Session->read('profil_user_id') == 7 or $this->Session->read('profil_user_id') == 1 or $this->Session->read('profil_user_id') == 8){ 

			$filtre = '';
			
		}
		
		/*

		$this->loadModel('Affiliation');

		$this->Affiliation->recursive = 0;
		
		$nbAffClub = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'CLU',
						$filtre
				)
				));


		// Réaffiliation CLUBS
		$nbAffClub2 = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'CLU',
						'Affiliation.AffilCode' => 'RAF',
						$filtre
				)
				));


		// Réaffiliation NOUVEAUX
		$nbAffClub3 = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'CLU',
						'Affiliation.AffilCode' => 'AFF',
						$filtre
				)
				));

		$nbAffSec = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'SEC',
						$filtre
				)
				));

		$nbAffSec2 = $this -> Affiliation -> find('count', array(
		'conditions' => array(
				'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
				'Affiliation.AffilEtat' => 'P',
				'Structure.StructureType' => 'SEC',
				'Affiliation.AffilCode' => 'RAF',
				$filtre
		)
		));

		$nbAffSec3 = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'SEC',
						'Affiliation.AffilCode' => 'AFF',
						$filtre
				)
				));

		$nbAffCR = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'LIG',
						$filtre
				)
				));

		$nbAffCD = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'DEP',
						$filtre
				)
				));

		$nbAffCS = $this -> Affiliation -> find('count', array(
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Affiliation.AffilEtat' => 'P',
						'Structure.StructureType' => 'CMS',
						$filtre
				)
				));
			*/      $this->loadModel('Affiliation');

		
		$nbAffTot = $this -> Affiliation -> find('count', array(
			'contain' => array('Structure'),
				'conditions' => array(
						'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						
						$filtre
				)
		));

		$nbAffTotN1 = $this -> Affiliation -> find('count', array(
			'contain' => array('Structure'),
				'conditions' => array(
						'Affiliation.SaisonAnnee' => 2015,
					
						'Affiliation.AffilDate <=' => '2014-'.date('m-d')
				)
		));

		
		/*
		$this->set('nbAffClub',$nbAffClub);
		$this->set('nbAffClub2',$nbAffClub2);
		$this->set('nbAffClub3',$nbAffClub3);
		$this->set('nbAffSec',$nbAffSec);
		$this->set('nbAffSec2',$nbAffSec2);
		$this->set('nbAffSec3',$nbAffSec3);		
		$this->set('nbAffCR',$nbAffCR);
		$this->set('nbAffCD',$nbAffCD);
		$this->set('nbAffCS',$nbAffCS);*/
		$this->set('nbAffTot',$nbAffTot);
		$this->set('nbAffTotN1',$nbAffTotN1);



		$this->loadModel('Licence');

		$this->Licence->recursive = 0;

		// NB LICENCES TOTAL
		$nbLicTot = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						$filtre
				)
		));
		$this->set(compact('nbLicTot'));/*

		// NB LICENCES LOISIRS
		$nbLicLoisirs = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'L',
						$filtre
				)
		));
		$this->set(compact('nbLicLoisirs'));

		// NB LICENCES COMPETITIONS
		$nbLicComp = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'C',
						$filtre
				)
		));
		$this->set(compact('nbLicComp'));

		// NB LICENCES ETABLISSEMENTS
		$nbLicEtab = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'E',
						$filtre
				)
		));
		$this->set(compact('nbLicEtab'));

		// NB LICENCES CADRES
		$nbLicCadres = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'D',
						$filtre
				)
		));
		$this->set(compact('nbLicCadres'));		

		*/
		// NB LICENCES TOTAL N-1

		

	
		$nbLicTotN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.DateInscription <=' => $annee.'-'.date('m-d')
				)
		));
		$this->set(compact('nbLicTotN1'));/*

		// NB LICENCES LOISIRS N-1
		$nbLicLoisirsN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'L',
						$filtre
				)
		));
		$this->set(compact('nbLicLoisirsN1'));

		// NB LICENCES COMPETITIONS N-1
		$nbLicCompN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'C',
						$filtre
				)
		));
		$this->set(compact('nbLicCompN1'));

		// NB LICENCES ETABLISSEMENTS N-1
		$nbLicEtabN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'E',
						$filtre
				)
		));
		$this->set(compact('nbLicEtabN1'));

		// NB LICENCES CADRES N-1
		$nbLicCadresN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.LicenceType' => 'D',
						$filtre
				)
		));
		$this->set(compact('nbLicCadresN1'));	*/	

		$this->loadModel('PassSport');
			$this->PassSport->recursive = 0;

			// NB LICENCES TOTAL
			$nbLicPP = $this -> PassSport -> find('count', array(
					'conditions' => array(
							'PassSport.SaisonAnnee' => $this->Session->read('anneeEnCours'),
							'PassSport.PassSportEtat' => 'A',
							$filtre
					)
			));
			$this->set(compact('nbLicPP'));

					// NB LICENCES TOTAL N-1
			$nbLicPPN1 = $this -> PassSport -> find('count', array(
					'conditions' => array(
							'PassSport.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
							'PassSport.PassSportEtat' => 'A',
							'PassSport.DateDemande <=' => $annee.'-'.date('m-d'),
							$filtre
					)
			));
			$this->set(compact('nbLicPPN1')); 
	}

	// VOIR LICENCES ET AFFILIATIONS
	public function viewLicAff() {



		if ( $this->request->is( 'ajax' ) ) {

			if($this->Session->read('profil_user_id') == 2){ $filtre = 'Structure.StructureCodeDepartement = '.$this->Session->read('profil_structure_code_departement'); }
		if($this->Session->read('profil_user_id') == 3){ $filtre = 'Structure.StructureCodeRegion = '.$this->Session->read('profil_structure_code_region'); }
		if($this->Session->read('profil_user_id') == 4 or $this->Session->read('profil_user_id') == 7){ 

			$filtre = '';
			
		}

			$this->loadModel('Affiliation');

		$nbAffTot = $this -> Affiliation -> find('count', array(
			'conditions' => array(
					'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
					'Affiliation.AffilEtat' => 'P',
					$filtre
			)
		));

		$nbAffTotN1 = $this -> Affiliation -> find('count', array(
			'conditions' => array(
					'Affiliation.SaisonAnnee' => $this->Session->read('anneeEnCours'),
					'Affiliation.AffilEtat' => 'P',
					'Affiliation.AffilDate <=' => $this->Session->read('anneeEnCoursMoins1').'-'.date('m-d'),
					$filtre
			)
		));

		$this->set('nbAffTot',$nbAffTot);
		$this->set('nbAffTotN1',$nbAffTotN1);



		$this->loadModel('Licence');

		$this->Licence->recursive = 0;

		// NB LICENCES TOTAL
		$nbLicTot = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCours'),
						'Licence.LicenceEtat' => 'A',
						$filtre
				)
		));
		$this->set(compact('nbLicTot'));

		$nbLicTotN1 = $this -> Licence -> find('count', array(
				'conditions' => array(
						'Licence.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
						'Licence.LicenceEtat' => 'A',
						'Licence.DateInscription <=' => $this->Session->read('anneeEnCoursMoins1').'-'.date('m-d'),
						$filtre
				)
		));
		$this->set(compact('nbLicTotN1'));

		$this->loadModel('PassSport');
			$this->PassSport->recursive = 0;

			// NB LICENCES TOTAL
			$nbLicPP = $this -> PassSport -> find('count', array(
					'conditions' => array(
							'PassSport.SaisonAnnee' => $this->Session->read('anneeEnCours'),
							'PassSport.PassSportEtat' => 'A',
							$filtre
					)
			));
			$this->set(compact('nbLicPP'));

					// NB LICENCES TOTAL N-1
			$nbLicPPN1 = $this -> PassSport -> find('count', array(
					'conditions' => array(
							'PassSport.SaisonAnnee' => $this->Session->read('anneeEnCoursMoins1'),
							'PassSport.PassSportEtat' => 'A',
							'PassSport.DateDemande <=' => $this->Session->read('anneeEnCoursMoins1').'-'.date('m-d'),
							$filtre
					)
			));
			$this->set(compact('nbLicPPN1')); 


		   
		}
	}

	
}

?>