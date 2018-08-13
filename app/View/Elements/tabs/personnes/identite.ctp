<div class="row">

  <div class="col-md-6">
     <?=$this->Form->input('Personne.civilite', array(       
        'type' => 'select',
        'options' => array('M' => 'Monsieur', 'Me' => 'Madame/Mademoiselle'),
        'label' => 'Civilité',
        'empty' => 'sélectionner'
    ));?>
    <?= $this->Form->input('Personne.name', array('type' => 'text','label' => 'Nom')); ?>
    <?= $this->Form->input('Personne.first_name', array('type' => 'text','label' => 'Prénom')); ?>
    <?=$this->Form->input('Personne.ddn', array(       
        'type' => 'text',
        'placeholder' => 'jj/mm/aaaa',
        'label' => 'Date de naissance',
        'beforeInput' => '<div id="ddn"><div class="input-group date">',
        'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
    ));?>


    <?= $this->Form->input('Personne.tel_fixe', array('label' => '<i class="glyphicons iphone"></i> Fixe', 'placeholder' => '00 00 00 00 00')); ?>
    <?= $this->Form->input('Personne.tel_gsm', array('div' => 'form-group','label' => '<i class="glyphicons iphone"></i> Mobile', 'placeholder' => '00 00 00 00 00')); ?>
    <?= $this->Form->input('Personne.email', array('div' => 'form-group','type' => 'text','label' => 'Email'));?>
    <?= $this->Form->input('Personne.email2', array('div' => 'form-group','type' => 'text','label' => 'Email 2'));?>

    <? if($personne['Personne']['email2'] == 'test'){ echo 'test';}?>
  </div>
    <div class="col-md-6">
    <?= $this->Form->input('Personne.adresse', array('label' => 'Adresse', 'placeHolder' => 'N°, type et libellé de voie')) ;?>  
    <?= $this->Form->input('Personne.adresse_comp', array('label' => 'Adresse | Complément', 'placeHolder' => 'Lieu-dit')) ;?> 

    <?= $this->Form->input('Personne.code_postal', array('id' => "cp", 'type' => 'hidden')) ;?> 
    <?= $this->Form->input('Personne.commune', array('id' => "commune", 'type' => 'hidden')) ;?>     
    <?= $this->Form->input('Personne.ville', array(
      'class' => 'search-commune7 form-control input-sm', 
      'onClick' => 'this.value=""', 
      'id' => 'commune', 
      'placeHolder' => 'CODE POSTAL COMMUNE',
      'value' => $personne['Personne']['code_postal'].' '.$personne['Personne']['commune']
    )) ;?>

    <?= $this->Form->input('Personne.commentaires', array('label' => 'Commentaires')); ?>
  </div>
</div>
   



