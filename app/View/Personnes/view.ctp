<script type="text/javascript">
  $(function() {



    // GLISSER / DEPLACER DES TABS
        $( "#sortable" ).sortable({
              revert: true,
              update: function() { 
               // callback quand l'ordre de la liste est changé
              var order = $('#sortable').sortable('serialize'); // récupération des données à envoyer
              $.post(serveur+'/tabs/ajax_sortable_tabs', order);
            }
        });

    // TAB ACTIVE
      $(".tab").click(function(){
        $('.tabActive').val($(this).attr("rel"));
      });

      $('#binImg').click(function(){
      document.location= "<?= serveur;?>/personnes/deletePhoto/<?= $personne['Personne']['id'];?>";
   });


});

</script>




<? // INFOS CREATION MODIFICATION
  $infos_content = 'créé(e) le : <b>'.$this->Formatage->dateHrFR($personne['Personne']['created']).'</b> • par <b>'.$personne['Personne']['UCR'].'</b> •';
  $infos_content .= 'modifiée le : <b>'.$this->Formatage->dateHrFR($personne['Personne']['modified']).'</b> • par <b>'.$personne['Personne']['UMY'].'</b>';
  
?>






<? $titre = '';?>

<? $titre .= '<table class="sansTrait">';?>
<? $titre .= '<tr>';?>
<? $titre .= '<td width="110"><div id="thumbImg" style="position:relative;">'.$this->Html->Image($this->Formatage->photoThumb($personne['Personne']['photo_thumb']), array('width' => 100));?>




<? $titre .= '<div id="pencilImg" class="btnHover1" data-toggle="modal" data-target="#modifPhoto" ><i class="glyphicons pencil" alt="Ajouter / Remplacer la photo"></i></div>';?>
<? $titre .= '<div id="binImg" class="btnHover2"><i class="glyphicons bin" alt="supprimer"></i></div>';?>







<? $titre .= '<td>'.$personne['Personne']['name'].' '.$personne['Personne']['first_name'];?>

<? if(empty($personne['Personne']['ddn'])){ $titre .= '<h6><span  class="gly_rouge">Date de naissance non connue</span></h6>';} else {$titre .= '<h6>Né(e) le '.$personne['Personne']['ddn'].' • '.$this->Formatage->age($this->Formatage->dateUS($personne['Personne']['ddn'])).' ans</h6>';}?>
<? $titre .= '</td>';?>

<? $titre .= '<td width="50">'.$this->Html->link('<button type="button" title="retour à la liste des personnes" class="btn btn-default btn-sm" "data-toggle" = "tooltip", "data-placement" = "bottom">
  <span class="glyphicons left_arrow"></span>
</button>', array('action' => 'index'), array('escape'=>false)).'</td>';?>
<? $titre .= '</tr></table>';?>


    
    
<? $this ->assign('title_content', $titre);?>





<div class="row">

    <div class="col-md-11">

<?= $this->Form->create('Personne', array(
        'novalidate' => true,
        'type' => 'file',
        'id'=>'PersonneForm',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-4 control-label'
            ),
            'wrapInput' => 'col col-md-8',
            'class' => 'form-control input-sm',
            'disabled' => false
        ),
        'class' => 'form-horizontal'
    )); ?>
    <?= $this->Form->hidden('tabActive', array('class' => 'tabActive', 'value' => $tabActive));?>
  
    <?= $this->Form->hidden('user_modify_id', array('value' => $this->Session->read('user_id')));?>
    <?= $this->Form->hidden('id', array('value' => $personne['Personne']['id']));?>


<!-- TABS -->
<ul class="nav nav-tabs" <? if($this->Session->read('profil_code') == 'GD'){?> id="sortable"<? }?>>
  <? foreach ($tabs as $row): ?> 


    
    <li <? if(($row['TabsView']['order'] == 1 and $tabActive == null)  or $tabActive == $row['TabsView']['name2']){?>class="active"<? }?> id="SORTABLE_<?= $row['TabsView']['id'];?>">
      <a href="#tab<?= $row['TabsView']['id'];?>" data-toggle="tab" id="<?= $row['TabsView']['id'];?>" rel="<?= $row['TabsView']['name2'];?>" class="tab" > 
        <? if($row['TabsView']['nb'] == 1 and $row['TabsView']['name2'] == 'seances'){?><span class="badge"><?= count($personne['PersonnesSeance']);?></span><? }?>
        <? if($row['TabsView']['nb'] == 1 and $row['TabsView']['name2'] == 'events'){?><span class="badge"><?= count($personne['Event']);?></span><? }?>
        <?= $row['TabsView']['name'];?> 
        <? if($row['TabsView']['add_button'] == 1){?><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#new<?= $row['TabsView']['name2'];?>"><i class="glyphicons plus"></i></button><? }?>         
      </a>
    </li>
    
  <?php endforeach; ?>

    <? if($this->Session->read('user_id') == 1){?>
      <li ><a href="#newTabR" data-toggle="modal" class="tab" ><i class="glyphicons plus"></i> Tab</a></li>
       <li > <?php echo $this->Html->link(
        '<i class="glyphicons list"></i>',
        array('controller' => 'tabs', 'action' => 'index'),
        array('escape' => false)
    );?></li>

    <? }?>
</ul>


<div class="tab-content">
  <?foreach ($tabs as $row): ?>
    <div class="tab-pane <? if(($row['TabsView']['order'] == 1 and $tabActive == null) or $tabActive == $row['TabsView']['name2']){?>active<? }?>" id="tab<?= $row['TabsView']['id'];?>">
     <?= $this->element('tabs/personnes/'.$row['TabsView']['name2']);?>
    </div>
  <?php endforeach; ?>
</div>


<hr/>





  



<? if($this->request->action == 'view'){ echo '<div class="infos_content">'.$infos_content.'</div>';}?>

</div>

<div class="col-md-1" align="center">
  <button type="submit" class="btn btn-primary btn-sm submitSimple" ><i class="glyphicons floppy_disk x2"></i><br/>Enregistrer</button> <hr/> <?= $this->Form->end();?>

  <?= $this->Form->postLink('<button class="btn btn-danger btn-sm " ><i class="glyphicons bin x2"></i><br/>Supprimer</button>', 
                        array('action' => 'delete', $personne['Personne']['id']), 
                        array(                            
                            'escape' => false,
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir supprimer cette personne ?'
                );?>

</div>

</div>

<!-- BOITE DE DIALOGUE - NOUVELLE TAB-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="newTabR" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-plus-sign"></i> Nouvelle TabR</h4>
      </div>
      <div class="modal-body">


        <?= $this->Form->create('Tab', array(
            'action' => 'addTabR',
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
        <?= $this->Form->hidden('TabR.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
        <?= $this->Form->hidden('TabR.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>
        
        <?= $this->Form->hidden('by_view', array('value' => 'Personne')); ?>
        <?= $this->Form->hidden('fsession_id', array('value' => $personne['Personne']['id'])); ?>

        <?= $this->Form->input('TabR.tab_id', array(
         'options' => $this->Listes->Liste('Tab', 'name', 'id'),
          'class' => 'form-control input-sm',
          'empty' => 'Sélectionner',
          'label' => array('class' => 'col col-md-3 control-label')
         ));?>
        <?= $this->Form->hidden('TabR.controller', array('value' => $this->request->controller)); ?>
        <?= $this->Form->hidden('TabR.action', array('value' => $this->request->action)); ?> 
        <?= $this->Form->input('TabR.order', array('label' => 'Ordre')); ?> 
         <?= $this->Form->input('TabR.nb', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Count </label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.add_button', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Bouton Add</label>',
            'label' => false,
            'class' => false
        ));
        ?>

        

    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - NOUVEL ORGANISATEUR-->
<div class="modal fade bs-example-modal-lg modalBulle" tabindex="-1" id="neworgas" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> Nouvel organisateur</h4>
      </div>
      <div class="modal-body">
      
    

    <script type="text/javascript">
        $(function() {

        $("#PersonneOrgaHorsFFH").hide();
        $("#PersonneOrgaName").hide();

        $("#reference1").click(function(){
            $('#PersonneOrgaName label').html('Organisateur');
            $("#PersonneOrgaName").show();
            $("#PersonneOrgaHorsFFH").hide();
            
        });

        $("#reference0").click(function(){
            $('#PersonneOrgaName label').html('Structure FFH de référence <i class="glyphicons circle_question_mark" title="Club/comité/commission FFH impliqués dans l’organisation et servant de structure de référence"></i>');
            $("#PersonneOrgaName").show();
            $("#PersonneOrgaHorsFFH").show();

        });     

        });


    </script>

      <?= $this->Form->create('Personne', array(
        'action' => 'addPersonneOrga',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-4 control-label'
            ),
            'wrapInput' => 'col col-md-8',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
        )); ?>

        
        
      <?= $this->Form->input('PersonneOrga.ffh', array(
            'type' => 'radio',
            'before' => '<label class="col col-md-4 control-label">Organisateur affilié FFH</label>',
            'legend' => false,
            'id' => 'reference',
            'class' => 'multisport',
            'options' => array(
              1 => 'Oui',
              0 => 'Non'
            )
      )); ?>

      <div id="PersonneOrgaHorsFFH">
          <?= $this->Form->input('PersonneOrga.structure_hors_ffh', array(
                'label' => 'Organisateur non affilié à la FFH',          
                'id' => 'StructureHorsFFH'
           ));?>
        </div>

    <div id="PersonneOrgaName"> 
      <?= $this->Form->input('PersonneOrga.structure_id', array('type' => 'hidden', 'id' => 'StructureId')) ;?> 
        <?= $this->Form->input('StructureName', array(
              'placeholder' => 'Taper les premières lettres, puis sélectionner dans la liste',
              'label' => 'Organisateur',
              'class' => 'search-structurePersonne form-control input-sm',
              'div' => 'form-group required'
         ));?>
    </div>
     
      <?= $this->Form->hidden('id', array('value' => $personne['Personne']['id'])); ?>
      <?= $this->Form->hidden('PersonneOrga.fsession_id', array('value' => $personne['Personne']['id'])); ?>
      <?= $this->Form->hidden('PersonneOrga.user_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('Personne.search_orga', array('value' => 0)); ?>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>







<!-- BOITE DE DIALOGUE - NOUVEL INTERVENANT-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="newteam_peda" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Affecter un intervenant</h4>
      </div>
      <div class="modal-body">

      <?= $this->Form->create('Personne', array(
        'action' => 'addPersonneInterv',
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


      <?= $this->Form->hidden('PersonneINT.fsession_id', array('value' => $personne['Personne']['id'])); ?>
      <?= $this->Form->hidden('PersonneINT.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->input('PersonneINT.intervenant', array(
            'label' => 'Nom / Prénom',
            'class' => 'form-control input-sm',
            'placeholder' => "Tapez les premières lettres du nom de votre intervenant",
            'id' => 'searchInterv',
            'onclick' => 'this.value=""'
          ));
        ?>
       <?= $this->Form->hidden('PersonneINT.interv_id', array('id' => 'IntervId')); ?>


        <div id="newInterv"><hr/>
            <div class="panel panel-info">
                <div class="panel-heading">Créer un nouvel intervenant</div>
                <div class="panel-body">
                    <?= $this->Form->input('PersonneINT.intervenant', array(
                        'label' => 'Nom / Prénom',
                        'class' => 'form-control input-sm',
                        'placeholder' => "Tapez les premières lettres du nom de la personne",
                        'id' => 'search-personneForInterv',
                        'onclick' => 'this.value=""'
                      ));
                    ?>
                    <?= $this->Form->hidden('Interv.personne_id', array('id' => 'IntervPersonneId')); ?>

                    <!-- AJOUT NOUVELLE PERSONNE -->
                    <div id="newPersonneInterv">
                        <div class="alert alert-danger">
                            <b>ATTENTION AUX DOUBLONS !</b><br/>
                            Afin de prévenir la création de doublon dans la base de donnée :<br/><br/>

                            <i class="glyphicons chevron-right"></i> Avez-vous bien orthographier la personne que vous recherchez ?<br/>
                            <i class="glyphicons chevron-right"></i> N'hésitez pas à recommencer votre recherche dans le champ ci-dessus.<br/>

                            Si c'est bien le cas, vous pouvez créer cette nouvelle personne en renseignant les champs ci-dessous.<br/>
                            Pour cela soyez-sûr des informations dont vous disposez.<br/><br/>

                            Merci d'avance pour votre vigilance !
                        </div>

                        <?= $this->Form->input('Personne.civilite', array(
                            'id' => 'civ',
                            'options' => array('M' => 'Monsieur', 'Me' => 'Madame'),
                            'empty' => 'Sélectionner', 
                            'label' => 'Civilité '
                        ));?>
                        <?= $this->Form->input('Personne.name', array('label' => 'Nom', 'id' => 'nom')); ?>
                        <?= $this->Form->input('Personne.first_name', array('label' => 'Prénom', 'id' => 'prenom')); ?>
                     
                        <?= $this->Form->input('Personne.ddn', array( 
                              'type' => 'text',
                              'id' => 'ddn_input',
                              'placeholder' => 'dd/mm/aaaa',
                              'label' => 'Date de naissance',
                              'beforeInput' => '<div id="ddn"><div class="input-group date">',
                          'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
                          ));?>
                    </div>

                   

                </div>
            </div>
        </div>

           


     
        <div id="RP">

     <?= $this->Form->input('Annuaire.email', array(
        'label' => 'Email',
        'afterInput' => '<span class="rge">PRATIQUE ! <i class="glyphicons chevron-right"></i> En remplissant ce champ, un compte-utilisateur sera créé pour cet intervenant <u>s\'il ne dispose pas encore de compte</u></span>'
     )); ?>

     <?= $this->Form->input('PersonneINT.resp_peda', array(
                'type' => 'checkbox',
                'before' => '<label class = "col col-md-4 control-label">Responsable pédagogique </label>',
                'label' => false,
                'class' => false
            ));?>   

            </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Affecter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - ANNULER LA SESSION-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="cancelPersonne" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><? if($personne['Personne']['cancel'] == 0){?>Annuler<? }else {?>Rétablir<? }?> cette session de formation</h4>
            </div>
            <div class="modal-body">

            <? if($personne['Personne']['cancel'] == 0){?>
            <!-- BULLE INFO - ALerte EMAIL -->
            <!-- <div class="alert alert-info">
            <i class="glyphicons circle_info"></i> Une mention annulation apparaitra sur le calendrier public des sessions de formation<br/>
            </div> -->
            <? }?>

            <!-- BULLE INFO - ALerte EMAIL -->
            <div class="alert alert-info">
            <i class="glyphicons envelope"></i> Un email sera transmis aux utilisateurs concernés (stagiaires, intervenants, CNFH) pour les en informer. <br/><br/><b>Précision :</b> seul le CNFH connaitra le motif de votre annulation.
            </div>

            <?= $this->Form->create('Personne', array(
            'action' => 'cancelPersonne',
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
            <? if($personne['Personne']['cancel'] == 0){ $cancelValue = 1; }else { $cancelValue = 0;}?>
            <?= $this->Form->hidden('id', array('value' => $personne['Personne']['id'])); ?>
            <?= $this->Form->hidden('canceled_user_id', array('value' => $this->Session->read('user_id'))); ?>
            <?= $this->Form->hidden('cancel', array('value' => $cancelValue)); ?>

            <? if($personne['Personne']['cancel'] == 0){?>
            <?php echo $this->Form->input('cancel_categorie', array(
                'type' => 'select',
                'label' => 'Motif - Catégorie',
                'empty' => 'Sélectionner',
                'options' => array(
                    1 => 'Effectifs participants insuffisants',
                    2 => 'Effectifs intervenants insuffisants',
                    3 => 'Ressources financières insuffisantes',
                    4 => 'Conditions climatiques',
                    5 => 'Disponibilité des locaux',
                    6 => 'Autre (précisez ci-dessous)'
                    )
                    )); ?>
                    <?= $this->Form->input('cancel_details', array('value' => '','label' => 'Détails, motifs', 'placeholder' => 'Inscrivez-ici, si necessaire, les élèments qui motivent votre décision')); ?>
                <? } else {?>
                    <?= $this->Form->hidden('cancel_details', array('value' => '')); ?>
                    <?= $this->Form->hidden('cancel_categorie', array('value' => '')); ?>

                <? }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-<? if($personne['Personne']['cancel'] == 0){?>danger<? } else {?>success<? }?>">Valider</button><?php echo $this->Form->end(); ?>
                </div>
        </div>
    </div>
</div>


<!-- BOITE DE DIALOGUE - NOUVEL EVENT-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newevents" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nouvel événement</h4>
      </div>
      <div class="modal-body">

      <?= $this->Form->create('Seance', array(
        'url' => 'addPersonneEvent',
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


      <?= $this->Form->hidden('Event.personne_id', array('value' => $personne['Personne']['id'])); ?>
      <?= $this->Form->hidden('Event.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('Event.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>

      <?=$this->Form->input('Event.name', array(
          'placeholder' => 'Ex:',
          'label' => 'Libellé'
      ));?>

      <?=$this->Form->input('Event.details', array(
          'placeholder' => 'Ex:',
          'label' => 'Description'
      ));?>
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

<!-- BOITE DE DIALOGUE - NOUVEL PHOTO -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="modifPhoto" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Ajouter / Remplacer la photo de cette personne</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('Personne', array(
        'type' => 'file',
        'url' => 'changePhoto',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control input-sm',
            
        ),
        'class' => 'form-horizontal',
         'enctype' => 'multipart/form-data'
      )); ?>
      <?= $this->Form->input('Personne.id', array('value' => $personne['Personne']['id']));?>


      <?= $this->Form->input('Personne.photo', array(
        'type' => 'file', 
        'label' => 'Photo', 
        'afterInput' => '<span class="help-block"><i class="glyphicons circle_info"></i> Formats autorisés : PNG, JPG, JPEG</span>',));?>

  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>







