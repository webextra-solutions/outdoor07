
 <!-- JAVASCRIPT -->
    <script type="text/javascript">
        $(function() {



          // RECHERCHER UN ENFANT
        $('.search-child').autocomplete({
          minLength    : 1,
          source        : serveur+'/personnes/searchChild',

          select: function(event, ui) {
            window.location.href = serveur+'/seances/presence/'+ui.item.id;
          }
        });








        });
    </script>


<div style="margin: 1% 10% 3% 10%; font-size: 130% !important;" class="row">


<div class="col-md-12" id="bloc_1"  style="margin-bottom: 2%;">


          <table>
            <tr><td style="padding-right: 2%;" width="100px;"><?= $this->Html->Image('logos/logo_outdoor.png', array('width' => 68)); ?></td>

         <td style="width: 100%;"> <h1>Espace Parents</h1>
          <h4>Ecole Multisports • Outdoor 07 • Saison <?php echo $this->Formatage->currentSeason();?></h4></td>
          <td  align="center" style="font-size:80%;" class="lien" onclick="document.location='<?= serveur;?>/users/login'"><br/><br/><i class="glyphicons exit x3"></i><br/>Espace Dirigeants</td></tr></table>

</div>

<div class="col-md-5" id="bloc_1"  style="margin-bottom: 2%;">


<h3>Bienvenue à tous !</h3><br/>
<h5>
  <span class="gly_gris" style="padding: 1%;"><b>1</b></span> Rechercher votre enfant, ci-dessous<br/><br/>
<span class="gly_gris" style="padding: 1%;"><b>2</b></span> Retrouver ainsi les séances à venir (modalités pratiques, lieux de rdv, ...)<br/><br/>
<span class="gly_gris" style="padding: 1%;"><b>3</b></span> Renseignez la présence de vos enfants sur les séances à venir
</h5>

<hr/>

 <?= $this->Form->input('search-enfant', array(
      'label' => false, 'placeholder' => 'Votre enfant...',
      'type' => 'text',
      'class' => 'form-control input-md search-child',
      'afterInput' => '<span class="help-block" style="font-size:80%;">Tapez les première lettre du nom de votre enfant, puis sélectionnez dans la liste</span>'

      )) ;?>


</div>

<div class="col-md-6 col-md-offset-1" >






 <?php foreach ($pratiquants as $row): ?>

   <div class="bloc_1 row" style="margin-bottom: 2%;">
      <h3><? if($row['Personne']['civilite'] == 'M'){?><i class="glyphicons user gly_bleu x2" title="Garçon"></i><? }?>
                <? if($row['Personne']['civilite'] == 'Me'){?><i class="glyphicons woman gly_rose x2" title="Fille"></i><? }?> <?= $row['Personne']['FN']; ?></h3>
      <?php endforeach; ?>
    </div>

      <?= $this->Flash->render();?>




    <? foreach ($personnes_seances as $row) {?>

      <!-- JAVASCRIPT -->
      <script type="text/javascript">
          $(function() {
            <? if($row['PersonnesSeance']['accompagnement'] != 1){?>
              $('#statut_accomp_<?= $row['PersonnesSeance']['id'];?>').hide();
            <? } else {?>
              $('#statut_accomp_<?= $row['PersonnesSeance']['id'];?>').show();
            <? }?>

            $('#PersonnesSeanceAccompagnement_<?= $row['PersonnesSeance']['id'];?>').change(function(){

              var selected = $(this).val();
              if(selected == 1){
                $('#statut_accomp_<?= $row['PersonnesSeance']['id'];?>').show();
              } else {
                $('#statut_accomp_<?= $row['PersonnesSeance']['id'];?>').hide();
              }

            });

            $("#SavePresence").validate({
                rules: {
                  'data[PersonnesSeance][personne_id]': {required:true},
                  'data[PersonnesSeance][presence]': {required:true},
                  'data[PersonnesSeance][accompagnement]': {required:true},

                },
                submitHandler: function(form) {

                      form.submit();


                }
            });


          });
      </script>


       <div class="bloc_1 row" style="margin-bottom: 2%; <? if($row['PersonnesSeance']['presence'] == 2){?>border-left: 4px solid #F00;<? } else {?> border-left: 4px solid #0ed313;<? }?>" >

          <!-- TITRE -->
          <h4>
            <? if($row['PersonnesSeance']['presence'] == 1){?><i class="glyphicons ok_2 gly_vert x2" title="Sera présent à la séance"></i><? }?>
            <? if($row['PersonnesSeance']['presence'] == 2){?><i class="glyphicons ban gly_rouge x2" title="Ne sera pas présent à la séance"></i><? }?>
            <? if($row['PersonnesSeance']['presence'] == null){?><i class="glyphicons hourglass gly_gris x2" title="Présence non définie"></i><? }?>
            Séance N°<?= $row['Seance']['num'];?>  • <?= $row['Seance']['date'];?>
            <b class="gly_gris" style="float: right;">Groupe <?= $row['PersonnesSeance']['groupe'];?></b>
          </h4>

          <div class="popup_finish bg-success"  style="display: none;"><i class="glyphicons ok_2"></i> Données enregistrées !</div>
          <div class="popup_alert bg-danger"  style="display: none;"><i class="glyphicons circle_exclamation_mark"></i> Enfant !</div>

          <hr/>

          <? if($row['PersonnesSeance']['presence'] == 1){?>
              <div class="popup_finish bg-success"><i class="glyphicons ok_2"></i> Présence renseignée  le <?= $this->Formatage->datehrFR($row['PersonnesSeance']['date_presence']);?> !</div>
          <? }?>

          <? if($row['PersonnesSeance']['presence'] == 2){?>
              <div class="popup_finish bg-danger"><i class="glyphicons ban"></i> Absence renseignée  le <?= $this->Formatage->datehrFR($row['PersonnesSeance']['date_presence']);?> !</div>
          <? }?>

          <!-- Bloc GAUCHE -->
          <div class="col-md-7"  style="font-size: 80%;">
            <? $debut = 'debut_gp'.$row['PersonnesSeance']['groupe'];?>
            <? $fin = 'fin_gp'.$row['PersonnesSeance']['groupe'];?>
            <? $rdv = 'rdv_gp'.$row['PersonnesSeance']['groupe'];?>
            <? $detail = 'autres_informations_gp'.$row['PersonnesSeance']['groupe'];?>
            <div style="border-bottom:1px solid #F0F0F0; padding-bottom: 0.5%; margin-bottom: 0.5%;">Horaires <i class="glyphicons chevron-right"></i> <?= $row['Seance'][$debut];?> à <?= $row['Seance'][$fin];?> </div>
            <div style="border-bottom:1px solid #F0F0F0; padding-bottom: 0.5%; margin-bottom: 1.5%;">Lieu de RDV <i class="glyphicons chevron-right"></i> <?= $row['Seance'][$rdv];?> </div>
            <?= $row['Seance'][$detail];?>
          </div>

          <!-- Bloc DROITE -->
          <div class="col-md-5" style="font-size: 90%;">

            <?= $this->Form->create('Seance', array(
              'id'=>'SavePresence',
              'novalidate' => true,
              'inputDefaults' => array(
                  'div' => 'form-group',
                  'class' => 'form-control input-sm'
              )
            )); ?>

            <?= $this->Form->hidden('PersonnesSeance.id', array('value' => $row['PersonnesSeance']['id']));?>
            <?= $this->Form->hidden('PersonnesSeance.personne_id', array('value' => $row['PersonnesSeance']['personne_id']));?>
            <?= $this->Form->input('PersonnesSeance.presence', array(
              'options' => array(1 => 'Présent', 2 => 'Absent'),
              'empty' => 'Sélectionnez',
              'label' => 'Votre enfant sera',
              'div' => 'required',
              'value' => $row['PersonnesSeance']['presence']
            ));
            ?> <br/>

            <?= $this->Form->input('PersonnesSeance.accompagnement', array(
              'options' => array(1 => 'Oui', 2 => 'Non'),
              'empty' => 'Sélectionnez',
              'label' => 'Vous souhaitez être "Parent accompagnateur sur cette séance"',
              'div' => 'required',
              'value' => $row['PersonnesSeance']['accompagnement'],
              'id' => 'PersonnesSeanceAccompagnement_'.$row['PersonnesSeance']['id']
            ));
            ?><br/>

            <div id="statut_accomp_<?= $row['PersonnesSeance']['id'];?>"?>
              <?= $this->Form->input('PersonnesSeance.statut_accompagnateur', array(
                'options' => array(1 => 'Papa', 2 => 'Maman',3 => 'Frère', 4 => 'Soeur'),
                'empty' => 'Sélectionnez',
                'label' => 'Vous êtes le/la :',
                'value' => $row['PersonnesSeance']['statut_accompagnateur'],
                'div' => 'required'
              ));
              ?> <br/>
            </div>

            <? if($row['Seance']['active_others_persons'] == 1){?>
               <?= $this->Form->input('PersonnesSeance.nb_others_persons', array(
                'options' => $this->Listes->genererListeNb(5),
                'empty' => 'Sélectionnez',
                'label' => 'Vous souhaitez profiter du transport pour d\'autres personnes?',
                'div' => 'required',
                'value' => $row['PersonnesSeance']['nb_others_persons'],
                'id' => 'NbOthersPersons_'.$row['PersonnesSeance']['id']
              ));
              ?><br/>
            <? }?>


            <?=$this->Form->input('PersonnesSeance.commentaires_parents', array(
                'placeholder' => 'Ex: une précaution, une modalité à préciser pour votre enfant sur cet séance',
                'label' => 'Commentaires',
                'value' => $row['PersonnesSeance']['commentaires_parents'],
            ));?>



            <div align="right"><button   type="submit" class="btn btn-md btn-primary" id="BtnSavePresence" ><i class="glyphicons floppy_disk x2"></i><br/>Enregistrer / Modifier</button></div><?php echo $this->Form->end(); ?>
          </div>

      </div>



    <? }?>

</div>
</div>




