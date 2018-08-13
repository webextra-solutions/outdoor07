<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?= $tabR['Tab']['name'];?></h4>
</div>


<?= $this->Form->create('Tab', array(
    'action' => 'viewTabR',
    'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
        'class' => 'col col-md-2 control-label'
    ),
    'wrapInput' => 'col col-md-10',
    'class' => 'form-control input-sm'
    ),
    'class' => 'form-horizontal'
    )); 
?>

<div class="modal-body">

    <?= $this->Form->input('TabR.id');?>
    <?= $this->Form->hidden('TabR.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>
    <?= $this->Form->input('TabR.nameRech', array(
        'label' => 'Evénement',
        'class' => 'form-control input-sm',
        'placeholder' => "Tapez les premières lettres de votre événement puis sélectionnnez",
        'id' => 'searchEventForTab',
        'value' => $tabR['Event']['name']
      ));
    ?>
    <?= $this->Form->hidden('TabR.event_id', array('id' => 'EventId')); ?>

    <?= $this->Form->input('TabR.tab_id', array(
     'options' => $this->Listes->Liste('Tab', 'name', 'id'),
      'class' => 'form-control input-sm',
      'empty' => 'Sélectionner',
      'label' => array('class' => 'col col-md-2 control-label')
     ));?>
    <?= $this->Form->input('TabR.controller', array('label' => 'Controller')); ?>
    <?= $this->Form->input('TabR.action', array('label' => 'Action')); ?> 
    <?= $this->Form->input('TabR.order', array('label' => 'Ordre')); ?> 
     <?= $this->Form->input('TabR.nb', array(
        'type' => 'checkbox',
        'before' => '<label class = "col col-md-2 control-label">Count </label>',
        'label' => false,
        'class' => false
    ));
    ?>

    <?= $this->Form->input('TabR.add_button', array(
        'type' => 'checkbox',
        'before' => '<label class = "col col-md-2 control-label">Bouton Add</label>',
        'label' => false,
        'class' => false
    ));
    ?>

     <?= $this->Form->input('TabR.intention', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">Intention</label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.engagement', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">Engagement</label>',
            'label' => false,
            'class' => false
        ));
        ?>

    <?= $this->Form->input('TabR.pratiquant', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">Pratiquant</label>',
            'label' => false,
            'class' => false
        ));
        ?>

         <?= $this->Form->input('TabR.encadrant', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">encadrant</label>',
            'label' => false,
            'class' => false
        ));
        ?>

    <?= $this->Form->input('TabR.special_admin', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">Spécial Admin</label>',
            'label' => false,
            'class' => false
        ));
        ?>

     <?= $this->Form->input('TabR.diplomante', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-2 control-label">Diplomante</label>',
            'label' => false,
            'class' => false
        ));
        ?>

   
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary" title="Enregistrer"><i class="glyphicons floppy_disk"></i></button><?php echo $this->Form->end(); ?>    
</div>
</div>

