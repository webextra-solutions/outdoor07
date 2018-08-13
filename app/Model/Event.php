<?php
class Event extends AppModel {
	public $order = array('created' => 'DESC');
	

	public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
      
        $this->virtualFields['UCR'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM  personnes P  where P.id = %s.user_create_id',$this->alias);
        $this->virtualFields['UMY'] = sprintf('SELECT CONCAT(P.name, " ", P.first_name) FROM  personnes P  where P.id = %s.user_modify_id',$this->alias);
       
    }
		
}
?>