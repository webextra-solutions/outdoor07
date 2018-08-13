<script>
	$(function() {

		
	});
</script>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel">
		<? if($extraPOW['Module']['extranet_off'] == 1){?>
			<i class="glyphicons ban"></i> Extranet désactivé !</h4>
		<? } else {?>
			<i class="glyphicons ok_2"></i> Extranet activé !</h4>
		<? }?>
</div>


<?= $this->Form->create('Module', array(
	'action' => 'viewExtranetPOWER',
	'type' => 'file',
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


      <?= $this->Form->hidden('id', array('value' => $extraPOW['Module']['id'])); ?>
      <?= $this->Form->hidden('id', array('value' => $extraPOW['Module']['id'])); ?>
		
		<?= $this->Form->input('extranet_off', array(
		
		  'options' => array(0 => 'ON', 1 => 'OFF'),
		  'empty' => 'Sélectionner', 
		  'label' => 'Power',
		  'class' => 'form-control input-sm',
		));?> 
      <?= $this->Form->input('extranet_off_title', array('label' => 'Titre'));?>
      <?= $this->Form->input('extranet_off_details', array('label' => 'Détails'));?>

      <?= $this->Form->input('extranet_off_open', array( 
        'type' => 'text',
        'placeholder' => 'dd/mm/aaaa',
        'label' => 'Réouverture',
        'beforeInput' => '<div><div class="input-group date">',
        'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
    ));?>

		
		
		
		
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
 		
 		<button type="submit" class="btn btn-primary"><i class="glyphicons floppy_disk"></i></button>

 		<?php echo $this->Form->end(); ?>	
 	</div>
</div>

