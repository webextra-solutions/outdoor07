<?php
class Menu extends AppModel {

		public $hasAndBelongsToMany = array('Profil');
		public $belongsTo = array('Module');
		public $hasMany = array('MenuR');

		public $order = 'Menu.order ASC';
}
?>