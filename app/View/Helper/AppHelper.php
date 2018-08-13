<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {


	// DESACTIVER FORMULAIRE EN FONCTION DU DROIT
	public function disabled($profil_session, $profil){
		if (in_array($profil_session, $profil)) {
			$disabled = 'false';
		} else {
			$disabled = 'true';
		}
		return $disabled;
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
	public function listePersonnes(){	
		App::import("Model", "Personne"); 
		$model = new Personne();  
		$find = $model->find('list', array(
			'fields' => array('id', 'FN'),
			'order' => array('FN' => 'ASC')
		));
		return $find;		
	}

	// Liste des departements
	public function listeSeances(){	
		App::import("Model", "Seance"); 
		$model = new Seance();  
		$find = $model->find('list', array(
			'fields' => array('id', 'SEAN'),
			'order' => array('date' => 'DESC')
		));
		return $find;		
	}

}
