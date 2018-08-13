<?php
class TabsView extends AppModel {
	public $useTable = 'tabs_view';
	public $hasMany = array('TabsViewsLien');
}
?>