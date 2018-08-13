<?php  
class SqlComponent extends Component { 
  

    function sqlName($id, $model){ 

    	$req = $this->$model->findById($id, array(
    			'fields' => array('name')
    	));
        return $req['name'];        
    } 

    function statReq($id,$model){ 
    	if($id ==1){
	    	$series1 = $this->Event->find('count', array(
	    			'conditions' => array('sport' => 1)
	    	));

	    	$series2 = $this->Event->find('count', array(
	    			'conditions' => array('sport' => 0)
	    	));
	        return array($series1,$series2);   
	    }     
    } 


    

    
} 
?>