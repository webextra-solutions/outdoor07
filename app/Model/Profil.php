<?php
// app/Model/Profil.php

class Profil extends AppModel {
	
	public $hasAndBelongsToMany = array('User');
	public $hasMany = array('ProfilR');

	public $validate = array(
			'name' => array(
	            'required' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'Le nom de famille est obligatoire'
	            )
        	)
	);
	
}
?>