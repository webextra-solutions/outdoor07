<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public $recursive = -1;
	public $actsAs = array('Containable');

	public function dateFormatAfterFind($dateString) {
    	return date('d/m/Y', strtotime($dateString));
	}

	public function dateFormatBeforeSave($dateString) {
	    return date('Y-m-d', strtotime(str_replace('/', '-',$dateString))); 
	}

	public function beforeSave($options = array()) {


		if (isset($this->data[$this->alias]['know_ddn'])) {

			if ($this->data[$this->alias]['know_ddn'] == 1) {

				if (isset($this->data[$this->alias]['ddn_day'])) {
				    if (!empty($this->data[$this->alias]['ddn_day'])) {
				        $this->data[$this->alias]['ddn'] = $this->data[$this->alias]['ddn_year'].'-'.$this->data[$this->alias]['ddn_month'].'-'.$this->data[$this->alias]['ddn_day'];

				        // debug($this->data[$this->alias]); die;
				    }
				}
			} else if ($this->data[$this->alias]['know_ddn'] == 0) {
				 $this->data[$this->alias]['ddn'] = '1900-01-01';
			}

		}

		

	    if (!empty($this->data[$this->alias]['date_gp1']) and $this->data[$this->alias]['date_gp1'] != '0000-00-00 00:00:00') {
	        $this->data[$this->alias]['date_gp1'] = $this->dateFormatBeforeSave($this->data[$this->alias]['date_gp1']);
	        $this->data[$this->alias]['date'] = $this->dateFormatBeforeSave($this->data[$this->alias]['date_gp1']);

	        
	    }

	    if (!empty($this->data[$this->alias]['date_gp2']) and $this->data[$this->alias]['date_gp2'] != '0000-00-00 00:00:00') {
	        $this->data[$this->alias]['date_gp2'] = $this->dateFormatBeforeSave($this->data[$this->alias]['date_gp2']);
	        
	    }

	    if (!empty($this->data[$this->alias]['date_gp3']) and $this->data[$this->alias]['date_gp3'] != '0000-00-00 00:00:00') {
	        $this->data[$this->alias]['date_gp3'] = $this->dateFormatBeforeSave($this->data[$this->alias]['date_gp3']);
	        
	    }

        if (!empty($this->data[$this->alias]['date_gp4']) and $this->data[$this->alias]['date_gp3'] != '0000-00-00 00:00:00') {
            $this->data[$this->alias]['date_gp4'] = $this->dateFormatBeforeSave($this->data[$this->alias]['date_gp4']);

        }

	    if (!empty($this->data[$this->alias]['ddn']) and $this->data[$this->alias]['ddn'] != '0000-00-00 00:00:00') {

	    	$this->data[$this->alias]['ddn'] = $this->dateFormatBeforeSave($this->data[$this->alias]['ddn']);

	    }

	    return true;
	}


	public function afterFind($results, $primary = false) {
	   	foreach ($results as $key => $val) {  		
			if (isset($val[$this->alias]['ddn'])) {				
				$results[$key][$this->alias]['ddn_day'] = substr($val[$this->alias]['ddn'],8,2);
				$results[$key][$this->alias]['ddn_month'] = substr($val[$this->alias]['ddn'],5,2);
				$results[$key][$this->alias]['ddn_year'] = substr($val[$this->alias]['ddn'],0,4);				
			}

			if (isset($val[$this->alias]['date'])) {
				if ($val[$this->alias]['date'] == '1970-01-01 00:00:00') {
					$results[$key][$this->alias]['date'] = '';
				} else {	 
					$results[$key][$this->alias]['date'] = $this->dateFormatAfterFind(
						$val[$this->alias]['date']
					);
				}
			}

			if (isset($val[$this->alias]['date_gp1'])) {
				if ($val[$this->alias]['date_gp1'] == '1970-01-01 00:00:00') {
					$results[$key][$this->alias]['date_gp1'] = '';
				} else {	 
					$results[$key][$this->alias]['date_gp1'] = $this->dateFormatAfterFind(
						$val[$this->alias]['date_gp1']
					);
				}
			}

			if (isset($val[$this->alias]['date_gp2'])) {
				if ($val[$this->alias]['date_gp2'] == '1970-01-01 00:00:00') {
					$results[$key][$this->alias]['date_gp2'] = '';
				} else {	 
					$results[$key][$this->alias]['date_gp2'] = $this->dateFormatAfterFind(
						$val[$this->alias]['date_gp2']
					);
				}
			}

			if (isset($val[$this->alias]['date_gp3'])) {
				if ($val[$this->alias]['date_gp3'] == '1970-01-01 00:00:00') {
					$results[$key][$this->alias]['date_gp3'] = '';
				} else {	 
					$results[$key][$this->alias]['date_gp3'] = $this->dateFormatAfterFind(
						$val[$this->alias]['date_gp3']
					);
				}
			}

            if (isset($val[$this->alias]['date_gp4'])) {
                if ($val[$this->alias]['date_gp4'] == '1970-01-01 00:00:00') {
                    $results[$key][$this->alias]['date_gp4'] = '';
                } else {
                    $results[$key][$this->alias]['date_gp4'] = $this->dateFormatAfterFind(
                        $val[$this->alias]['date_gp4']
                    );
                }
            }

			if (isset($val[$this->alias]['ddn'])) {
				if ($val[$this->alias]['ddn'] == '1970-01-01 00:00:00') {
					$results[$key][$this->alias]['ddn'] = '';
				} else {	 
					$results[$key][$this->alias]['ddn'] = $this->dateFormatAfterFind(
						$val[$this->alias]['ddn']
					);
				}
			}

    	}
    	return $results;	    
	}



	
}
