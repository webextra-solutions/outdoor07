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


    $('h4').tooltip();

  });
</script>



 
<div class="row">

  <? for ($i=1; $i <= $seance['Seance']['nb_groups']; $i++) { 

          if($seance['Seance']['nb_groups'] == 4){$col = 3;}
          if($seance['Seance']['nb_groups'] == 3){$col = 4;}
          if($seance['Seance']['nb_groups'] == 2){$col = 6;}


          ?>

  <div class="col-md-<?= $col;?>">

      <table cellspacing="0">
            <tr>
              <th colspan="9"><h4>GROUPE <?= $i;?></h4></th></tr>


            <!-- ENCADRANTS GP -->
            <tr>              
              <td colspan="8" bgcolor="#F0F0F0" style="padding: 1%;"><h5>Encadrants</h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_gris"><?= count(${"encadrants_gp$i"});?></b></h5></td>

            <?php foreach (${"encadrants_gp$i"} as $row): ?>
              <tr>
                <td width="35px">
                  <? if($row['PersonnesSeance']['presence'] == 1){?><i class="glyphicons user gly_vert x2" title="Sera présent"></i><? }?>
                  <? if($row['PersonnesSeance']['presence'] == 2){?><i class="glyphicons user gly_rouge x2" title="Sera absent"></i><? }?>
                  <? if(empty($row['PersonnesSeance']['presence'])){?><i class="glyphicons user gly_off x2" title="pas de réponse"></i><? }?></td>
                <td width="35px">
                  <? if($row['PersonnesSeance']['presence_eff'] == 1){?><i class="glyphicons user gly_vert x2" title="Présent"></i><? }?>
                  <? if($row['PersonnesSeance']['presence_eff'] == 2){?><i class="glyphicons user gly_rouge x2" title="Absent"></i><? }?>
                  <? if(empty($row['PersonnesSeance']['presence_eff'])){?><i class="glyphicons user gly_off x2" title="En attente"></i><? }?></td>
                 <td width="35px">
                  <? if($row['Personne']['civilite'] == 'M'){?><i class="glyphicons user gly_bleu x2" title="Garçon"></i><? }?>
                  <? if($row['Personne']['civilite'] == 'Me'){?><i class="glyphicons woman gly_rose x2" title="Fille"></i><? }?></td>
                <td></td>
                <td></td>
                <td class="lien" onclick="document.location='<?= serveur;?>/personnes/view/<?= $row['PersonnesSeance']['personne_id'];?>'" ><?= $row['PersonnesSeance']['PNF']; ?></td>
                <td></td>    
                <td align="right" width="30"> 
                    <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                        array('controller' => 'personnes', 'action' => 'view', $row['PersonnesSeance']['personne_id'], 'identite'), 
                        array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                    );?>
                </td> 
                <td align="right" width="30"> 
                      <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                    array('action' => 'deletePersonneSeance',  $row['PersonnesSeance']['id'], $row['PersonnesSeance']['seance_id']), 
                    array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                    'Etes-vous sûr de vouloir supprimer cette personne de la séance ?'
                  );?></td>   
              </tr>
            <?php endforeach; ?>
            <tr><td colspan="9" height="10px" bgcolor="#FFFFFF"></td></tr>

            

            <!-- ACCOMPAGNATEURS GP 1 -->
            <tr>              
              <td colspan="8" bgcolor="#F0F0F0" style="padding: 1%;"><h5>Accompagnateurs</h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_gris"><?= count(${"accomps_gp$i"});?></b></h5></td>

            <?php foreach (${"accomps_gp$i"} as $row): ?>
              <tr>
                <td width="35px"><i class="glyphicons user gly_vert x2" title="Sera présent"></i></td>
                <td width="35px">
                  <? if($row['PersonnesSeance']['presence_eff'] == 1){?><i class="glyphicons user gly_vert x2" title="Présent"></i><? }?>
                  <? if($row['PersonnesSeance']['presence_eff'] == 2){?><i class="glyphicons user gly_rouge x2" title="Absent"></i><? }?>
                  <? if(empty($row['PersonnesSeance']['presence_eff'])){?><i class="glyphicons user gly_off x2" title="En attente"></i><? }?></td>
                <td width="35px">
                  <? if($row['Personne']['civilite'] == 'M'){?><i class="glyphicons user gly_bleu x2" title="Garçon"></i><? }?>
                  <? if($row['Personne']['civilite'] == 'Me'){?><i class="glyphicons woman gly_rose x2" title="Fille"></i><? }?></td>
                <td width="35px" colspan="2" align="right"><span class="gly_gris"><?= $this->Listes->statutAccomp($row['PersonnesSeance']['statut_accompagnateur']); ?></span></td>
                <td class="lien" onclick="document.location='<?= serveur;?>/personnes/view/<?= $row['PersonnesSeance']['personne_id'];?>'" ><?= $row['PersonnesSeance']['PNF']; ?></td>
                <td></td>
                <td align="right" width="30"> 
                          <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                              array('controller' => 'personnes', 'action' => 'view', $row['PersonnesSeance']['personne_id'], 'identite'), 
                              array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                          );?>
                      </td>
                <td align="right" width="30"> 
                    <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                      array('action' => 'deleteAccompSeance',  $row['PersonnesSeance']['id'], $row['PersonnesSeance']['seance_id']), 
                      array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                      'Etes-vous sûr de vouloir supprimer cet accompagntauer de la séance ?'
                    );?>                 
                </td> 
            </tr>
            <?php endforeach; ?>
            <tr><td colspan="8" height="10px" bgcolor="#FFFFFF"></td></tr>



            <!-- ENFANTS GP 1 -->
             <tr>              
              <td colspan="6" bgcolor="#F0F0F0" style="padding: 1%;"><h5>Enfants</h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_gris"><?= count(${"pratiquants_gp$i"});?></b></h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_orange"><?= ${"nb_pratiquants_gp_prev$i"};?></b></h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_vert"><?= ${"nb_pratiquants_gp_eff$i"};?></b></h5></td></tr>


              <?php ${"persons_supp_gp$i"} = 0; foreach (${"pratiquants_gp$i"} as $row): ?>
               <? ${"persons_supp_gp$i"} += $row['PersonnesSeance']['nb_others_persons'];?>

                <tr>

                  <td width="35px">

                    <? if($row['Personne']['civilite'] == 'M'){$sexe = 'user'; }?>
                    <? if($row['Personne']['civilite'] == 'Me'){$sexe = 'woman'; }?>


                    <? if($row['PersonnesSeance']['presence'] == 1){?><i class="glyphicons <?= $sexe;?> gly_vert x2 btnPresenceEffective" title="Sera Présent, changer?" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presencePrev/<?= $row['PersonnesSeance']['id'];?>/2/<?= $row['PersonnesSeance']['seance_id'];?>'" ></i><? }?>
                    <? if($row['PersonnesSeance']['presence'] == 2){?><i class="glyphicons <?= $sexe;?> gly_rouge x2 btnPresenceEffective" title="Sera Absent, changer?" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presencePrev/<?= $row['PersonnesSeance']['id'];?>/1/<?= $row['PersonnesSeance']['seance_id'];?>'"></i><? }?>
                    <? if(empty($row['PersonnesSeance']['presence'])){?><i class="glyphicons <?= $sexe;?> gly_off x2" title="En attente" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presencePrev/<?= $row['PersonnesSeance']['id'];?>/1/<?= $row['PersonnesSeance']['seance_id'];?>'"></i><? }?></td>
                  <td width="35px">
                    <? if($row['PersonnesSeance']['presence_eff'] == 1){?><i class="glyphicons <?= $sexe;?> gly_vert x2 btnPresenceEffective" title="Présent, changer?" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presenceEffective/<?= $row['PersonnesSeance']['id'];?>/2/<?= $row['PersonnesSeance']['seance_id'];?>'" ></i><? }?>
                    <? if($row['PersonnesSeance']['presence_eff'] == 2){?><i class="glyphicons <?= $sexe;?> gly_rouge x2 btnPresenceEffective" title="Absent, changer?" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presenceEffective/<?= $row['PersonnesSeance']['id'];?>/1/<?= $row['PersonnesSeance']['seance_id'];?>'"></i><? }?>
                    <? if(empty($row['PersonnesSeance']['presence_eff'])){?><i class="glyphicons <?= $sexe;?> gly_off x2" title="En attente" style="cursor: pointer;" onclick="document.location='<?= serveur;?>/seances/presenceEffective/<?= $row['PersonnesSeance']['id'];?>/1/<?= $row['PersonnesSeance']['seance_id'];?>'" ></i><? }?></td>

                  <? if($seance['Seance']['payante'] == 1){?>
                    <td width="35px">
                      <? if($row['PersonnesSeance']['paiement'] == 0){?><i class="glyphicons euro gly_rouge x2" title="Non payé"></i><? }?>
                      <? if($row['PersonnesSeance']['paiement'] == 1){?><i class="glyphicons euro gly_vert x2" title="Paiement OK"></i><? }?></td>
                  <? }?>

                  <td width="35px">
                    <? if(!empty($row['PersonnesSeance']['commentaires_parents'])){?><i class="glyphicons chat gly_rouge x2" title="<?= $row['PersonnesSeance']['commentaires_parents'];?>"></i><? }?>
                    <? if(empty($row['PersonnesSeance']['commentaires_parents'])){?><i class="glyphicons chat gly_gris x2" title="Aucun commentaire parent"></i><? }?></td>

                  <? if($seance['Seance']['payante'] == 0){?>

                    <td width="35px"></td>

                  <? }?>
                  <td width="35px"><? if($row['PersonnesSeance']['nb_others_persons'] != 0){?><div class="gly_gris" align="center" title="Personnes supplémentaires"><?= $row['PersonnesSeance']['nb_others_persons'];?></div><? }?></td>
                  <td class="lien" onclick="document.location='<?= serveur;?>/personnes/view/<?= $row['PersonnesSeance']['personne_id'];?>'" ><?= $row['PersonnesSeance']['PNF']; ?></td>
                  <td align="right" width="30"> 
                              <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                                  array('controller' => 'personnes', 'action' => 'view', $row['PersonnesSeance']['personne_id'], 'identite'), 
                                  array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                              );?>
                          </td>

                 <td align="right" width="30"> <button type="button" class="btn btn-default btn-xs bascules" rel="<?= $row['Personne']['FN']; ?>-<?= $row['PersonnesSeance']['id']; ?>"><i class="glyphicons share"></i></button></td>
                 <td align="right" width="30"> 
                        <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                      array('action' => 'deletePersonneSeance',  $row['PersonnesSeance']['id'], $row['PersonnesSeance']['seance_id']), 
                      array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                      'Etes-vous sûr de vouloir supprimer cette personne de la séance ?'
                    );?></td>   
                </tr>
            <?php endforeach; ?>
            <tr>              
              <td colspan="9" style="padding: 1%;"></td> </tr>

            <!-- PERSONNES SUPP GP 1 -->
            <tr>              
              <td colspan="8" bgcolor="#F0F0F0" style="padding: 1%;"><h5>Personnes supplémentaires</h5></td>
              <td bgcolor="#F0F0F0" style="padding-left: 1%;"><h5><b class="gly_gris"><?= ${"persons_supp_gp$i"};?></b></h5></td> </tr>
      </table>
    </div>

    <? }?>




</div>