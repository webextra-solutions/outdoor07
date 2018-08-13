<?php
// app/Model/Personne.php

class Personne extends AppModel {

	
	public $hasMany = array('PersonnesSeance');
	public $hasOne = array('User');
		
	public $virtualFields = array(
		
		'FN' => 'CONCAT(Personne.PersonnePrenom, " ", Personne.PersonneNom)'	
	);
	public $order = array('Personne.PersonneNom' => 'ASC');
	
}
?>