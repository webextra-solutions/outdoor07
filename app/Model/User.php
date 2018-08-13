<?php
// app/Model/User.php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	public $belongsTo = array('Personne');
	

	public $hasAndBelongsToMany = array('Profil');
	public $hasMany = array(
		
		'ProfilR', 
		
		'Connection',
	
      );

	/*public $virtualFields = array(
		'IDNF' => 'SELECT CONCAT(personnes.name," ",personnes.PersonneDdn) FROM personnes where id = User.personne_id'
		
	);*/

	



	
	
	
	

	public function confirmPassword(){
		if($this->data['User']['password-confirm'] == $this->data['User']['password']){
			return true;
		} else {
			return false;
		}
	}
	


	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {

			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	
	
}
?>