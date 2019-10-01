
<script type="text/javascript">
    $(function() {

        $('#listeSeance').hide();

        $('#SeanceTypeAdd').change(function(){



         
          var selected = $(this).val(); 
          if(selected == 1){

            $('#listeSeance').show();

          } else {

            $('#listeSeance').hide();

          }
      });


        // TAB ACTIVE
        $(".tab").click(function(){

            alert('test');
           
        });


        




    });

</script>

<?php $this ->assign('title_content', 'Séances ('.count($seances).')');?>    



<? //if(in_array($this->Session->read('user_id'),array(1))){?> 

<? if($destinataires != 0){$disabledEmailSeance = false;} else {$disabledEmailSeance = true;}?>

<!-- BOUTONS - TITRE -->
<?= $this ->assign('button_content', 
'<div class="button-content"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#newSeance"><i class="glyphicons plus x2"></i></button></div>

<div class="button-content">'.
                $this->Html->link('<i class="glyphicons envelope"></i> Avertir <b>RAPPEL</b> - ('.$destinataires2.')', 
                        array('action' => 'emailRappelSeances'), 
                       array('disabled' => false, 'class'=>'btn btn-danger btn-sm','escape' => false, 'title' => 'Rappel Avertir séance à venir (uniquement ceux qui n\'ont pas répondu)', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                     'Etes-vous sûr de vouloir lancer un email de rappel à toutes les enfants qui n\'ont pas mentionné leu réponse ?').'</div>

<div class="button-content">'.
                $this->Html->link('<i class="glyphicons envelope"></i> Avertir ('.$destinataires.')', 
                        array('action' => 'emailSeances'), 
                       array('disabled' => $disabledEmailSeance, 'class'=>'btn btn-default btn-sm','escape' => false, 'title' => 'Avertir séance à venir', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                     'Etes-vous sûr de vouloir lancer l\'email?').'</div>');?>

<? //}?>

 <table cellspacing="0">
    <tr >
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo $this->Paginator->sort('date', 'DATE'); ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

    <?php  $i = 1; foreach ($seances as $row): ?>
    <tr class="lienTR">    
        <td width="35" ><div class="gly_gris" data-toggle="tooltip" data-placement="top" title="Effectifs"><span class="gly_gris"><?= count($row['Encadrants']);?></span></td>
        <td width="35" ><div align="center" class="gly_orange" data-toggle="tooltip" data-placement="top" title="Effectifs prévus"><?= count($row['Prevus']);?></div></td>
        <td width="35" ><div align="center" class="gly_vert" data-toggle="tooltip" data-placement="top" title="Effectifs présents"><?= count($row['Presents']);?></span></div></td>
        
        <td width="35" ><? if($row['Seance']['published'] == 1 and $this->Formatage->dateUS($row['Seance']['date']) >= date('Y-m-d')){?><div class="gly_vert" data-toggle="tooltip" align="center" data-placement="top" title="Séance publiée"><i class="glyphicons calendar"></i></div><? }?></td>
        <td width="100" class="lien" onclick="document.location='<?= serveur;?>/seances/view/<?= $row['Seance']['id'];?>/personnes'">Séance N°<?= $row['Seance']['num']; ?></td>
        <td><?= $row['Seance']['date']; ?></td>
        
        <td width="200"><h7>Créée par <b><?= $row['Seance']['UCR']; ?></b></h7><br/><h7>le <?= $this->Formatage->datehrFR($row['Seance']['created']); ?></h7></td>
        <td width="200"><h7>Modifée par <b><?= $row['Seance']['UMY']; ?></b></h7><br/><h7>le <?= $this->Formatage->datehrFR($row['Seance']['modified']); ?></h7></td>
        <td align="right" width="30">
              <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                array('action' => 'view', $row['Seance']['id'],'personnes'), 
                array('disabled' => false, 'class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
            );?>
                
        </td>
        <?php if ($this->Session->read('profil_id') == 1): ?>
        <td align="right" width="30"> 
                <?= $this->Form->postLink('<i class="glyphicons bin"></i> ', 
                        array('action' => 'delete', $row['Seance']['id']), 
                        array(
                            'class'=>'btn btn-danger btn-xs',
                            'escape' => false, 
                            'title' => 'supprimer', 
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir supprimer cette séance ?'
                );?>
            </td>
        <?php endif ?>                    
    </tr>
    <?php endforeach; ?>
    <?php unset($result); ?>

</table>


<!-- BOITE DE DIALOGUE - NOUVELLE SEANCE-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newSeance" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nouvelle séance</h4>
      </div>
      <div class="modal-body">

      <?= $this->Form->create('Seance', array(
        'url' => 'add',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-4 control-label'
            ),
            'wrapInput' => 'col col-md-8',
            'class' => 'form-control input-sm'
        ),
        'class' => 'form-horizontal'
        )); ?>


      <?= $this->Form->hidden('Seance.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('Seance.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>

      <?=$this->Form->input('Seance.date', array(           
            'type' => 'text',
            'placeholder' => 'jj/mm/aaaa',
            'label' => 'Date',
            'beforeInput' => '<div id="debut"><div class="input-group date">',
            'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
        ));?>
      
      <?= $this->Form->input('Seance.type_add', array(
                'options' => array(1 => 'En dupliquant une autre séance (sélectionner la séance ci-dessous)',2 => 'Séance vièrge'),                       
                'empty' => 'Sélectionnez', 
                'label' => 'Type ajout',
                'class' => 'form-control input-sm'
              ));
              ?>
            <div id="listeSeance">
       <?= $this->Form->input('Seance.add_num', array(
                'options' => $this -> App -> listeSeances(),                       
                'empty' => 'Sélectionnez', 
                'label' => 'Séance support',
                'class' => 'form-control input-sm'
                
              ));
              ?>
          </div>

     


       
    

         
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

