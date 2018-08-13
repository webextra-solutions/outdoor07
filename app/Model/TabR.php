<?php
// app/Model/Event.php

class TabR extends AppModel {
	public $useTable = 'pages_tabs';
	public $belongsTo = array(
	'Event',
	'Tab',
	'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_create_id'
        ),
        'Modify' => array(
            'className' => 'User',
            'foreignKey' => 'user_modify_id'
        )
    );



}
?>