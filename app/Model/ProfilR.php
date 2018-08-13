<?php
class ProfilR extends AppModel {
	public $useTable = 'profils_users';
	public $belongsTo = array('User', 'Profil', 'Module','Structure');

	public $virtualFields = array(
   	 'bilto' => 'CONCAT(ProfilR.id, " ", ProfilR.id)',
	
		'PNF' => 'SELECT CONCAT(personnes.first_name, " ", personnes.name) FROM users LEFT JOIN personnes ON personnes.id = users.personne_id WHERE users.id = ProfilR.user_id'
	);

	


	public function beforeSave($options = array()){

	
		

	}

	public function geQueries ()
    {
        $dbo = $this->getDatasource();
        return $dbo -> _queriesLog;
    }


}
?>