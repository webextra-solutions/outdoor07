<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Menu <i class="glyphicon glyphicon-chevron-right"></i> <?= $menu['Menu']['name'];?></h4>
</div>

<?= $this->Form->create('Menu', array(
    'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
        'class' => 'col col-md-3 control-label'
    ),
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control input-sm'
    ),
    'class' => 'form-horizontal'
    )); 
?>

<div class="modal-body">
    <?= $this->Form->input('Menu.id');?>
    <?= $this->Form->hidden('Menu.module_id');?>

    <?= $this->Form->input('Menu.name', array('label' => 'Libellé')); ?>
    <hr/>
    <?= $this->Form->input('active', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Actif </label>',
            'label' => false,
            'class' => false
        ));
    ?>

     <?= $this->Form->input('new', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Nouveau !</label>',
            'label' => false,
            'class' => false
        ));
    ?>

     <?= $this->Form->input('blank', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Ouverture dans une nouvelle fenêtre </label>',
            'label' => false,
            'class' => false
        ));
    ?>
    <hr/>

   	<?= $this->Form->input('Menu.controller', array('label' => 'Controlleur')); ?>
   	<?= $this->Form->input('Menu.action', array('label' => 'Action')); ?>
    <?= $this->Form->input('Menu.icone', array('label' => 'Icone')); ?>

    <?= $this->Form->input('Menu.order', array('label' => 'Ordre')); ?>
    <hr/>    

     <?= $this->Form->input('Profil', array(
        'multiple' => 'checkbox',
        'before' => '<label class = "col col-md-3 control-label">Profils concernés</label>',
        'label'=> false
        )); ?> 
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button><?php echo $this->Form->end(); ?>
</div>
</div>

