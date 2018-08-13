<?php
// app/Model/Event.php

class Tab extends AppModel {
	public $belongsTo = array('User');
	public $order = 'name ASC';

}
?>