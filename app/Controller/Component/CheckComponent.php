<?php  
class CheckComponent extends Component { 
  
	// vérification Licence
    function CheckLicence($id, $typeLicence, $saison){ 

    	$model = ClassRegistry::init('Licence');

    	
    	$licences = $model->find('all', array(
    		'contain' => array('Structure'),
    		'fields' => array('SaisonAnnee', 'Structure.name', 'Structure.StructureNom', 'LicenceType','DateInscription'),
    		'conditions' => array(
    			'personne_id' => $id,
    			'SaisonAnnee' => $saison
    		)
    	));
        return $licences;        
    } 

    


    
} 
?>