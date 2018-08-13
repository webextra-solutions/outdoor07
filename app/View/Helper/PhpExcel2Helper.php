<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Helper for working with PHPExcel class.
 *
 * @package PhpExcel
 * @author segy
 */
class PhpExcel2Helper extends AppHelper {
    /**
     * Instance of PHPExcel class
     *
     * @var PHPExcel
     */
    protected $_xls;

    /**
     * Pointer to current row
     *
     * @var int
     */
    protected $_row = 1;

    /**
     * Internal table params
     *
     * @var array
     */
    protected $_tableParams;

    /**
     * Number of rows
     *
     * @var int
     */
    protected $_maxRow = 0;

    

    /**
     * Write array of data to current row
     *
     * @param array $data
     * @return $this for method chaining
     */
    public function addTableRow($data) {

        $this->_xls = new PHPExcel();
        
        $offset = $this->_tableParams['offset'];

        foreach ($data as $d){
            $this->_xls->getActiveSheet()->setCellValueByColumnAndRow($offset++, $this->_row, $d);
        }

        $this->_row++;
        $this->_tableParams['row_count']++;

        return $this;
    }

   
    
 
}
