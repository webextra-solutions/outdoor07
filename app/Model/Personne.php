<?php
// app/Model/Personne.php

class Personne extends AppModel {
	public $hasOne = array('User');	
	public $hasMany = array('PersonnesSeance','Event');		
	public $virtualFields = array(
		'FN' => 'CONCAT(Personne.name, " ", Personne.first_name)'	
	);
	public $order = array('Personne.name' => 'ASC');

	public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
      
        $this->virtualFields['UCR'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM  personnes P  where P.id = %s.user_create_id',$this->alias);
        $this->virtualFields['UMY'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM  personnes P  where P.id = %s.user_modify_id',$this->alias);
       
    }

    public $actsAs = array(
		'Uploader.Attachment' => array(
	        'photo' => array(
	        	'tempDir' => TMP,
	            'overwrite' => true,
	            'transforms' => array(	                
	                
	                'photo_view' => array(
	           			'uploadDir' => 'img/uploads/personne_img/img_view/',
	                    'class' => 'resize',
	                    'overwrite' => true,
	                    'self' => false,	                    
	                    'width' => 300,
	                    'height' => 300,	              
	                    'nameCallback' => 'formatNameView',
	                    'finalPath' => '/img/uploads/personne_img/img_view/'
	                ),
	                'photo_thumb' => array(
	           			'uploadDir' => 'img/uploads/personne_img/img_thumb/',
	                    'class' => 'resize',
	                    'overwrite' => true,
	                    'self' => false,	                    
	                    'width' => 100, 
	                    'height' => 100,       
	                    'nameCallback' => 'formatNameThumb',
	                    'finalPath' => '/img/uploads/personne_img/img_thumb/'
	                )
		            
		        )
		    )
	    )
	);

	public function formatNameView($name, $file) {
	    return sprintf('%s', $this->getID());
	}

	public function formatNameThumb($name, $file) {
	    return sprintf('%s', $this->getID());
	}

}
?>