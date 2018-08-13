<script type="text/javascript">
  $(function() {
    $("#exist").hide();
    $("#no_exist").hide();
    $("#paramAddPersonne").hide();

       // RECHERCHER UN ENFANT
        $('.search-personne').autocomplete({
          minLength    : 1,
          source        : serveur+'/personnes/searchPersonne',

          select: function(event, ui) { 

            if(ui.item.id != 0){      
              $('#submit-add-personne').attr('disabled', true);
              $('#personne_exist').text(ui.item.label);
              $("#exist").show(); 
              $('#no_exist').hide();  
              $("#paramAddPersonne").show();
               //window.location.href = serveur+'/personnes/view/'+ui.item.id;
            } else {
                $('#no_exist').show(); 
                $("#exist").hide(); 
                $('#submit-add-personne').attr('disabled', false);
                $("#paramAddPersonne").show();

            }


          },
          appendTo : "#newPersonne"
        });
   
  });
</script>


<?php $this ->assign('title_content', 'Personnes ('.count($personnes).')');?>  

<!-- BOUTONS - TITRE -->
<?= $this ->assign('button_content', 
'<div class="button-content"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#newPersonne"><i class="glyphicons plus x2"></i></button></div>');?>



  <table cellspacing="0">
        <tr>
       
          <th></th>
          <th></th>
        <th>Nom/Prénom</th>
        <th>Pratiquant</th>
        <th>Encadrant</th>
        <th>Accompagnateur</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
       </tr>
        <?php foreach ($personnes as $row): ?>

          <tr>

       
           <td width="45px"><?= $this->Html->Image($this->Formatage->photoThumb($row['Personne']['photo_thumb']), array('width' => 45));?></td>
           <td width="45px" align="right"><?= $this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn']));?> <? if(!empty($this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn'])))){?>ans<? }?></td>

           <td width="200" class="lien" onclick="document.location='<?= serveur;?>/personnes/view/<?= $row['Personne']['id'];?>'" ><?= $row['Personne']['name']; ?> <?= $row['Personne']['first_name']; ?></td>
           <td width="80"><? if($row['Personne']['pratiquant'] == 1){?><i class="glyphicons ok_2 gly_vert"></i><? }?></td>
           <td width="80"><? if($row['Personne']['encadrant'] == 1){?><i class="glyphicons ok_2 gly_vert"></i><? }?></td>
          <td><? if($row['Personne']['accompagnateur'] == 1){?><i class="glyphicons ok_2 gly_vert"></i><? }?></td>

          <td><?= $row['Personne']['email']; ?></td>
          <td><?= $row['Personne']['email2']; ?></td>
           <td width="200"><h7>Créée par <b><?= $row['Personne']['UCR']; ?></b></h7><br/><h7>le <?= $this->Formatage->datehrFR($row['Personne']['created']); ?></h7></td>
          <td width="200"><h7>Modifée par <b><?= $row['Personne']['UMY']; ?></b></h7><br/><h7>le <?= $this->Formatage->datehrFR($row['Personne']['modified']); ?></h7></td>
          
           <td align="right" width="30"> 
                      <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                          array('controller' => 'personnes', 'action' => 'view', $row['Personne']['id']), 
                          array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                      );?>
                  </td>

        
        <td align="right" width="30"> 
              <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
            array('action' => 'deletePersonne',  $row['Personne']['id']), 
            array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
            'Etes-vous sûr de vouloir supprimer cette personne ?'
          );?></td>   
        </tr>
        <?php endforeach; ?>
      </table>



<!-- BOITE DE DIALOGUE - NOUVELLE PERSONNE-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newPersonne" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nouvelle personne</h4>
      </div>
      <div class="modal-body">

      <?= $this->Form->create('Personne', array(
        'url' => 'add',
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


      <?= $this->Form->hidden('Personne.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('Personne.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>

      <div class="alert alert-info"><i class="glyphicons circle_info"></i> Vérifions que la personne que vous souhaitez ajouter, n'est pas déjà présente dans la base.</div>

       <?= $this->Form->input('Personne.personne', array(
          'label' => 'Nom / Prénom',
          'class' => 'form-control input-sm search-personne',
          'placeholder' => "Tapez les premières lettres du nom de la personne que vous souhaitez ajouter",
          'type' => 'text'
        ));
      ?>
      

      <div class="alert alert-danger" id="exist"><i class="glyphicons circle_exclamation_mark"></i> <b><span id="personne_exist"></span></b> existe déjà, vous ne pouvez pas l'ajouter à nouveau !</div>


      <div  id="no_exist"><hr/>
        <?=$this->Form->input('Personne.civilite', array(       
            'type' => 'select',
            'options' => array('M' => 'Monsieur', 'Me' => 'Madame/Mademoiselle'),
            'label' => 'Civilité',
            'empty' => 'sélectionner'
        ));?>
        <?= $this->Form->input('Personne.name', array('type' => 'text','label' => 'Nom')); ?>
        <?= $this->Form->input('Personne.first_name', array('type' => 'text','label' => 'Prénom')); ?>

      </div>

     <div id="paramAddPersonne">
      <hr/>
        <?= $this->Form->input('Personne.encadrant', array(
            'type' => 'radio',    
            'before' => '<div><label class="col col-md-3 control-label">Encadrant</label></div>',
            'legend' => false,
            'class' => false,
            'options' => array(
              1 => 'Oui',
              0 => 'Non'  
            )
        ));?>

        <?= $this->Form->input('Personne.accompagnateur', array(
            'type' => 'radio',    
            'before' => '<div><label class="col col-md-3 control-label">Accompagnateur</label></div>',
            'legend' => false,
            'class' => false,
            'options' => array(
              1 => 'Oui',
              0 => 'Non'  
            )
        ));?>

        <?= $this->Form->input('Personne.pratiquant', array(
            'type' => 'radio',    
            'before' => '<div><label class="col col-md-3 control-label">Pratiquant</label></div>',
            'legend' => false,
            'class' => false,
            'options' => array(
              1 => 'Oui',
              0 => 'Non'  
            )
        ));?>
    </div>

     


       
    

         
    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit-add-personne" disabled="disabled">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

