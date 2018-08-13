<?php  
class StatComponent extends Component { 
  

    function statFind($model, $conditions, $fields){ 

    	$req = $this->$model->find('count', array(
    			'conditions' => $conditions
    			'fields' => $fields
    	));
        return $req;        
    } 

    

    
} 
?>