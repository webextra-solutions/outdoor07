<?php
class PersonnesSeance extends AppModel {

	//public $hasAndBelongsToMany = array('Personne','Seance');
	public $belongsTo = array('Personne','Seance');
	public $order = array('PersonnesSeance.created' => 'DESC');

	public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['PNF'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM  personnes P  where P.id = %s.personne_id',$this->alias);
      
        $this->virtualFields['UCR'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM users U LEFT JOIN personnes P ON P.id = U.personne_id where U.id = %s.user_create_id',$this->alias);
        $this->virtualFields['UMY'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM users U LEFT JOIN personnes P ON P.id = U.personne_id where U.id = %s.user_modify_id',$this->alias);
       
    }

   

	
}
?>