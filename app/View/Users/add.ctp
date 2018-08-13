
<script type="text/javascript">
  $(function() {


  // Recherche Structure 2
    $('#search-structureWidthCPSF').autocomplete({
      minLength    : 3,
      source        : serveur+'/structures/searchStructure',
      select:  function(event, ui) { 
        $('#StructureId').val(ui.item.id);
      }
    });

       // RECHERCHER UN ENFANT
        $('#search-personne67').autocomplete({
          minLength    : 1,
          source        : serveur+'/personnes/searchPersonne',

          select:  function(event, ui) { 
            $('#PersonneId').val(ui.item.id);
          }
        });
  });
</script>

<?php $this ->assign('title_content', 'Ajouter un compte');?>




 <?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-2 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    )); ?>
    
    
    <?= $this->Form->input('nom', array('label' => 'Nom', 'id' => 'search-personne67', 'placeholder' => 'Taper les premières lettres puis sélectionner dans la liste')); ?>

    <?//= $this->Form->input('email', array('placeholder' => 'Email à associer au compte')); ?>


    <?= $this->Form->hidden('personne_id', array('id' => 'PersonneId')); ?>
    <?= $this->Form->hidden('user_id', array('value' => $this->Session->read('user_id'))); ?>
    <?= $this->Form->hidden('selected', array('value' => 1)); ?>
    <?= $this->Form->hidden('active', array('value' => 0)); ?>

  
    
    <?= $this->Form->input('profil_id', array(
          'options' => $profils_list,
          'empty' => 'Sélectionner', 
          'label' => 'Profil',
          'class' => 'form-control input-sm'
      ));?>

      


   
    <div class="form-group">
        <?php echo $this->Form->submit('Créer le compte', array(
            'div' => 'col col-md-9 col-md-offset-2',
            'class' => 'btn btn-success'
        )); ?>
    </div>


    <?php echo $this->Form->end(); ?>
</div>

