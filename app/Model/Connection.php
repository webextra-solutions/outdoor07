<?php
// app/Model/Demande.php
class Connection extends AppModel {
	public $belongsTo = array('User', 'ProfilR' => array('foreignKey' => 'profil_id'));
	public $virtualFields = array(
		'created_last' => 'MAX(Connection.created)'
	);
	

}
?>