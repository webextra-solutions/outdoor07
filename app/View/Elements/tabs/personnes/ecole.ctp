<div class="row">

  <div class="col-md-6">
    
    <?= $this->Form->input('Personne.tel_urgence1', array('label' => '<i class="glyphicons iphone"></i> Téléphone Urgence 1', 'placeholder' => '00 00 00 00 00')); ?>
    <?= $this->Form->input('Personne.tel_urgence2', array('label' => '<i class="glyphicons iphone"></i> Téléphone Urgence 2', 'placeholder' => '00 00 00 00 00')); ?>
    <?= $this->Form->input('Personne.tel_urgence3', array('label' => '<i class="glyphicons iphone"></i> Téléphone Urgence 3', 'placeholder' => '00 00 00 00 00')); ?>
  </div>
    <div class="col-md-6">

      <?=$this->Form->input('Personne.groupe', array(       
        'type' => 'select',
        'options' => $this->Listes->groupEcole(),
        'label' => 'Groupe école',
        'empty' => 'sélectionner'
    ));?>
   
<?= $this->Form->input('autonomie_depart', array(
    'type' => 'radio',    
    'before' => '<div><label class="col col-md-4 control-label">Autonomie départ séance</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'  
    )
  )); ?>

    <?= $this->Form->input('Personne.sante', array('label' => 'Santé')); ?>
  </div>
</div>
   



