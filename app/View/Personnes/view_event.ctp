<script>
	$(function() {


	});
</script>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel"><?= $event['Event']['name'];?></h4>
</div>




<?= $this->Form->create('Personne', array(
	'url' => 'viewEvent',
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
		<?= $this->Form->hidden('Event.id', array('value' => $event['Event']['id'])); ?>
		<?= $this->Form->hidden('Event.personne_id', array('value' => $event['Event']['personne_id'])); ?>
		<?= $this->Form->hidden('Event.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>
		
		<?= $this->Form->input('Event.name', array(
	      'label' => 'Libellé',
	      'class' => 'form-control input-sm',
	  	));
		?>

		<?= $this->Form->input('Event.details', array(
	      'label' => 'Description',
	      'class' => 'form-control input-sm',
	  	));
		?>
		
	
		
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
 		<button type="submit" class="btn btn-primary"><i class="glyphicons floppy_disk"></i> Enregistrer</button><?php echo $this->Form->end(); ?>
 	</div>
</div>

