<?php

class StructuresController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
		$this->Auth->allow('carte');
		$this->Auth->allow('region');
		$this->Auth->allow('departement');
		$this->Auth->allow('club');
		$this->Auth->allow('test');
		$this->Auth->allow('recherche');
	}
	
		// RECHERCHER UNE STRUCTURE
		function searchStructure(){
			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;
				$structs=$this->Structure->find('all',array(
						'conditions'=> array(
								'Structure.StructureNom LIKE'=>''.$_GET['term'].'%', 
								array('not' => array('Structure.StructureNom' => null)),
								'Structure.StructureNom !=' =>''
						),
						'order' => array('Structure.StructureNom ASC')
				));
				$i=0;
				foreach($structs as $struct){
					$response[$i]['id']=$struct['Structure']['id'];
					$response[$i]['value']=$struct['Structure']['StructureNom'];
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$struct['Structure']['StructureNom'];
					$i++;
				}
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('structs',$this->paginate(array('Structure.StructureNom LIKE'=>'%'.$this->data['Structure']['StructureNom'].'%')));
				}
			}
		}

		// RECHERCHER UNE STRUCTURE HORS FFH
		function searchStructureHorsFFH(){
			if ( $this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 2 );
				$this->autoRender=false;
				$this->loadModel('AnnuairesStructure');
				$structs=$this->AnnuairesStructure->find('all',array(
						'conditions'=> array(
								'structure_hors_ffh LIKE'=>''.$_GET['term'].'%'
						),
						'group' => array('structure_hors_ffh'),
						'order' => array('structure_hors_ffh ASC')
				));
				$i=0;
				foreach($structs as $struct){
					$response[$i]['value']=$struct['AnnuairesStructure']['structure_hors_ffh'];
					//$response[$i]['label']="<img class=\"avatar\" width=\"24\" height=\"24\" src=".$user['User']['profile_pictures']."/><span class=\"username\">".$user['User']['username']."</span>";
					$response[$i]['label']=$struct['AnnuairesStructure']['structure_hors_ffh'];
					$i++;
				}
				echo json_encode($response);
			}else{
				if (!empty($this->data)) {
					$this->set('structs',$this->paginate(array('structure_hors_ffh LIKE'=>'%'.$this->data['AnnuairesStructure']['structure_hors_ffh'].'%')));
				}
			}
		}

		
		
		
		public function carte(){
		
			$reg = $this->Structure->find('list',array(
					'fields' => array('Structure.StructureCode', 'Structure.name',  'Structure.StructureEtat'),
					'conditions' => array('Structure.StructureType' => 'LIG', 'Structure.StructureEtat' => 'A')));
			$this->set(compact('reg'));
		
			$dep = $this->Structure->find('list',array(
					'fields' => array('StructureId', 'name',  'StructureEtat'),
					'conditions' => array('StructureType' => 'DEP', 'StructureEtat' => 'A')));
			$this->set(compact('dep'));
			
			$this->loadModel('Sport');
			$sport = $this->Sport->find('list',array(
					'fields' => array('Sport.DisciplineCode', 'DisciplineLibelle')));
			$this->set(compact('sport'));
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

    // RECHERCHER UNE COMMUNE
    function searchCommune2(){
        if ( $this->RequestHandler->isAjax() ) {
            Configure::write ( 'debug', 2);
            $this->autoRender=false;
            $this->loadModel('Commune');
            $communes=$this->Commune->find('all',array(
            	'fields' => array('id', 'codepostal', 'libelle2'),
                'conditions'=> array(
                    'OR' => array(
	                    array('Commune.codepostal' => ''.$_GET['term']),
	                    array('Commune.libelle2 LIKE'=>''.$_GET['term'].'%')
            		)
            	),

            'order' => array('Commune.codepostal ASC')
            ));
            $i=0;
            foreach($communes as $commune){
                $response[$i]['id']=$commune['Commune']['id'];
                $response[$i]['value']=$commune['Commune']['libelle2'];
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

    // AJAX - Liste déroulante Dynamiques
	function ajax_get_structure() {

		// init
		if ( $this->request->is( 'ajax' ) ) {
			
			$type = $this->params['data']['type'];
			$dep = $this->params['data']['dep'];

			if($type == 'cms'){
				$conditions = array('Structure.StructureType' => 'CMS');
			}

			if($type == 'reg'){
				$conditions = array('Structure.StructureType' => 'LIG');
			}

			if($type == 'dep'){
				$conditions = array('Structure.StructureType' => 'DEP');
			}

			if($type == 'clu'){
				$conditions = array('Structure.StructureCodeDepartement' => $dep, 'Structure.StructureType !=' => 'DEP');
			}
			       
			$structures = array();
			$this->layout = null;

			
				// get pages
				$this->loadModel('Affiliation');
				$this->Affiliation->contain('Structure');
				$structures = $this->Affiliation->find('all',array('fields' => array('Structure.id','Structure.StructureNom'), 'conditions' => $conditions, 'order' => array('Structure.StructureNom')));
				
				$this->set(compact('structures'));
		

			
		} 
	}

	

    
	
}

?>