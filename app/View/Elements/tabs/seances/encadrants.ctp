<script type="text/javascript">// JavaScript POUR - Events/view.cyp
  $(function() {
    // RECHERCHER UN PARTICIPANT
    $('#search-pratiquants').autocomplete({
      minLength    : 1,
      source        : serveur+'/pratiquants/searchPratiquant',
      select:  function(event, ui) { 
       window.location.href = serveur+'/pratiquants/view/'+ui.item.id+'/general';
      } 
    });
  });
</script>





 
<div class="row">

  <div class="col-md-6">

      <table cellspacing="0">
            <tr>
              <th colspan="6"><h4>GROUPE • Moins de 11 ans </h4></th>
              <th  align="right"><h4><b class="gly_gris"><?= count($encadrants_gp1);?></b></h4></th>            
            </tr>
            <?php foreach ($encadrants_gp1 as $row): ?>

              <tr>

              <td width="35px">
                <? if($row['PersonnesSeance']['presence'] == 1){?><i class="glyphicons user gly_vert x2" title="Sera présent"></i><? }?>
                <? if($row['PersonnesSeance']['presence'] == 2){?><i class="glyphicons user gly_rouge x2" title="Sera absent"></i><? }?>
                <? if(empty($row['PersonnesSeance']['presence'])){?><i class="glyphicons user gly_off x2" title="pas de réponse"></i><? }?></td>
              <td width="35px">
                <? if($row['PersonnesSeance']['presence_eff'] == 1){?><i class="glyphicons user gly_vert x2" title="Présent"></i><? }?>
                <? if($row['PersonnesSeance']['presence_eff'] == 2){?><i class="glyphicons user gly_rouge x2" title="Absent"></i><? }?>
                <? if(empty($row['PersonnesSeance']['presence_eff'])){?><i class="glyphicons user gly_off x2" title="En attente"></i><? }?></td>
               <td width="45px">
                <? if($row['Personne']['civilite'] == 'M'){?><i class="glyphicons user gly_bleu x2" title="Garçon"></i><? }?>
                <? if($row['Personne']['civilite'] == 'Me'){?><i class="glyphicons woman gly_rose x2" title="Fille"></i><? }?></td>

                 <td width="45px" align="right"><?= $this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn']));?> <? if(!empty($this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn'])))){?>ans<? }?></td>
               <td class="lien" onclick="document.location='<?= serveur;?>/pratiquants/view/<?= $row['PersonnesSeance']['id'];?>'" ><?= $row['PersonnesSeance']['PNF']; ?></td>
              
               <td align="right" width="30"> 
                          <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                              array('controller' => 'personnes', 'action' => 'view', $row['PersonnesSeance']['personne_id'], 'identite'), 
                              array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                          );?>
                      </td>

            
            <td align="right" width="30"> 
                  <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                array('action' => 'deletePratiquant',  $row['PersonnesSeance']['id'], $row['PersonnesSeance']['seance_id']), 
                array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                'Etes-vous sûr de vouloir supprimer ce pratiquant ?'
              );?></td>   
            </tr>
            <?php endforeach; ?>
          </table>
  </div>

  <div class="col-md-6">

        <table cellspacing="0">
              <tr>
              <th colspan="6"><h4>Accompagnateurs</h4></th>
              <th  align="right"><h4><b class="gly_gris"><?= count($encadrants_gp2);?></b></h4></th>            
            </tr>
            
           </tr>
              <?php foreach ($encadrants_gp2 as $row): ?>

                <tr>

                <td width="35px">
                  <? if($row['PersonnesSeance']['presence'] == 1){?><i class="glyphicons user gly_vert x2" title="Sera présent"></i><? }?>
                  <? if($row['PersonnesSeance']['presence'] == 2){?><i class="glyphicons user gly_rouge x2" title="Sera absent"></i><? }?>
                  <? if(empty($row['PersonnesSeance']['presence'])){?><i class="glyphicons user gly_off x2" title="pas de réponse"></i><? }?></td>
                <td width="35px">
                  <? if($row['PersonnesSeance']['presence_eff'] == 1){?><i class="glyphicons user gly_vert x2" title="Présent"></i><? }?>
                  <? if($row['PersonnesSeance']['presence_eff'] == 2){?><i class="glyphicons user gly_rouge x2" title="Absent"></i><? }?>
                  <? if(empty($row['PersonnesSeance']['presence_eff'])){?><i class="glyphicons user gly_off x2" title="En attente"></i><? }?></td>
                 <td width="45px">
                  <? if($row['Personne']['civilite'] == 'M'){?><i class="glyphicons user gly_bleu x2" title="Garçon"></i><? }?>
                  <? if($row['Personne']['civilite'] == 'Me'){?><i class="glyphicons woman gly_rose x2" title="Fille"></i><? }?></td>
                 <td width="45px" align="right"><?= $this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn']));?> <? if(!empty($this->Formatage->age($this->Formatage->dateUS($row['Personne']['ddn'])))){?>ans<? }?></td>
                 <td class="lien" onclick="document.location='<?= serveur;?>/pratiquants/view/<?= $row['PersonnesSeance']['id'];?>'" ><?= $row['PersonnesSeance']['PNF']; ?></td>
                
                 <td align="right" width="30"> 
                            <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                                array('controller' => 'pratiquants', 'action' => 'view', $row['PersonnesSeance']['id']), 
                                array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                            );?>
                        </td>

              
              <td align="right" width="30"> 
                    <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                  array('action' => 'deletePratiquant',  $row['PersonnesSeance']['id'], $row['PersonnesSeance']['seance_id']), 
                  array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                  'Etes-vous sûr de vouloir supprimer ce pratiquant ?'
                );?></td>   
              </tr>
              <?php endforeach; ?>
            </table>
    </div>
</div>