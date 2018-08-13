
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?= $profilUser['Profil']['name'];?></h4>
</div>


 <?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control input-sm'
        ),
        'class' => 'form-horizontal'
    	)); ?>

<div class="modal-body">
   	 
    <?= $this->Form->hidden('ProfilR.id', array('value' => $profilUser['ProfilR']['id'])); ?>
    <?= $this->Form->hidden('id', array('value' => $profilUser['ProfilR']['user_id'])); ?>
    <?= $this->Form->input('ProfilR.alertes_email', array(
        	'type' => 'checkbox',
			'before' => '<label class = "col col-md-3 control-label">Alertes Email</label>',
			'label' => false,
			'class' => false
		));
	?>

    <?= $this->Form->input('ProfilR.active', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Actif</label>',
            'label' => false,
            'class' => false
        ));
    ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" class="btn btn-primary"><i class="glyphicons floppy_disk"></i> Enregistrer</button><?php echo $this->Form->end(); ?>
</div>
</div>

