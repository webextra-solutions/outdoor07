<?php  
class FilterComponent extends Component { 
  
    public $components = array('Session');
  
    function filter($filtre){
  
           $filterStat = ''; 

            // FILTRE Annéee
                if($filtre['Filter']['annee'] != ''){ 
                    $filterStat .= "AND YEAR(Event.debut) = ".$filtre['Filter']['annee']; 
                    $this->Session->write('annee',$filtre['Filter']['annee']);
                } else { 
                   $this->Session->delete('annee');
                }

            // FILTRE DEBUT
                if($filtre['Filter']['debut'] != ''){ 
                    $filterStat .= " AND Event.debut >=".$this->Formatage->dateFRtoUS($filtre['Filter']['debut']); 
                    $this->Session->write('debut',$filtre['Filter']['debut']);
                } else { 
                    $this->Session->delete('debut');
                }

            // FILTRE FIN
                if($filtre['Filter']['fin'] != ''){ 
                    $filterStat .= " AND Event.fin >=".$this->Formatage->dateFRtoUS($filtre['Filter']['fin']); 
                    $this->Session->write('fin',$filtre['Filter']['fin']);
                } else { 
                    $this->Session->delete('fin');
                }

            // FILTRE Type
                if($filtre['Filter']['type'] != ''){ 
                    $filterStat .= " AND Event.types_event_id = ".$filtre['Filter']['type']; 
                    $this->Session->write('type',$filtre['Filter']['type']);
                } else { 
                    $this->Session->delete('type');
                }


            // FILTRE Département
                if($filtre['Filter']['departement'] != ''){ 
                    $filterStat .= " AND Event.departement_id = ".$filtre['Filter']['departement']; 
                    $this->Session->write('departement',$filtre['Filter']['departement']);                    
                } else {                
                    $this->Session->delete('departement');
                }

            // FILTRE Région
                if($filtre['Filter']['region'] != ''){ 
                    $filterStat .= " AND Event.region_id = ".$filtre['Filter']['region']; 
                    $this->Session->write('region',$filtre['Filter']['region']);                    
                } else {                
                    $this->Session->delete('region');
                }

            // FILTRE SPORT
                if($filtre['Filter']['sport'] != ''){ 
                    $model = ClassRegistry::init('EventsSport');
                    $eventsSport = $model->find('list', array(
                        'conditions' => array('sport_id' => $filtre['Filter']['sport']),
                        'fields' => array('EventsSport.event_id'),
                        'group' => 'EventsSport.event_id'
                    ));

                    $filterStat .= "  AND Event.id IN(".implode(',',$eventsSport).")"; 
                    $this->Session->write('sport',$filtre['Filter']['sport']);
                } else {                
                    $this->Session->delete('sport');
                }
            





            return  $filterStat;


    	
    } 

    

    
} 
?>