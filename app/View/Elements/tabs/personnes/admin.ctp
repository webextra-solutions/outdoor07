<?= $this->Form->input('active', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Actif</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
));?>
<hr/>
<?= $this->Form->input('encadrant', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Encadrant</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
));?>

<?= $this->Form->input('accompagnateur', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Accompagnateur</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
));?>

<?= $this->Form->input('pratiquant', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Pratiquant</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
));?>
<hr/>

<?= $this->Form->input('licence_ok', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Licence 2018 OK</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
));?>

 <?=$this->Form->input('type_licence', array(       
        'type' => 'select',
        'options' => array(1 => 'Licence Dirigeant/Cadre', 2 => 'Licence compétition Jeune', 3 => 'Licence compétition adulte', 4 => 'Licence loisir'),
        'label' => 'Type licence',
        'empty' => 'sélectionner',
    ));?>


