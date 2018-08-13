<?php
class MenuR extends AppModel {
	public $useTable = 'menus_profils';
	public $belongsTo = array('Menu', 'Profil');

	
}
?>