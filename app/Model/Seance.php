<?php
class Seance extends AppModel {

   

	/*public $hasAndBelongsToMany = array('Profil');
	public $belongsTo = array('User');*/
	public $hasMany = array(
		'PersonnesSeance',
		'Presents' => array(
            'className' => 'PersonnesSeance',
            'conditions' => array('presence_eff' => 1,'type' => 1)
        ),
        'Encadrants' => array(
            'className' => 'PersonnesSeance',
            'conditions' => array('type' => 1)
        ),
        'Prevus' => array(
            'className' => 'PersonnesSeance',
            'conditions' => array('presence' => 1)
        )


	);

   

	public $order = array('date' => 'DESC');

	public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
      
        $this->virtualFields['UCR'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM users U LEFT JOIN personnes P ON P.id = U.personne_id where U.id = %s.user_create_id',$this->alias);
        $this->virtualFields['UMY'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM users U LEFT JOIN personnes P ON P.id = U.personne_id where U.id = %s.user_modify_id',$this->alias);
        $this->virtualFields['SEAN'] = sprintf('CONCAT("N°", Seance.id, " • ", Seance.date)');
       
    }




		
}
?>