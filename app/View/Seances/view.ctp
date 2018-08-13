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

      $("#SeanceForm").submit(function(){    
       $('#wait_save').modal(); 
    });


       $(".btnPresenceEffective").click(function(){    
         $('#wait_save').modal(); 
      });

    // BOITE DE DIALOGUE - Voir FAQ
    $(".bascules").click(function(){

      var selected =$(this).attr("rel").split('-');

            $("#personne").text(selected[0]);
             $("#PersonnesSeanceId").val(selected[1]);
            $("#basculeGroupe").modal();
            

        
    });


});

</script>

<? echo $this->Html->script('tinymce/tinymce.min');?>

<script type="text/javascript">
   tinymce.init({
       plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table contextmenu paste"
      ],
      selector: "textarea",
      toolbar:["undo redo | bold italic underline | alignleft aligncenter alignright | link image"],
      menubar : '',
      statusbar : false,
      language : 'fr_FR',
   });

</script>



<? 
    

    // INFOS CREATION MODIFICATION
    $infos_content = 'Session de formation créée ';

?>





<!-- BOUTONS - TITRE -->
<?= $this ->assign('button_content', 
'<div class="button-content">'.$this->Html->link('<button type="button" title="retour à la liste des séances" class="btn btn-default btn-sm" "data-toggle" = "tooltip", "data-placement" = "bottom">
  <span class="glyphicons chevron-left"></span>
</button>', array('action' => 'index'), array('escape'=>false)).'</div>');?>




<? 
    //TITRE PAGE
    $title = '';

    $title .= '<ul class="nav nav-pills" style="width:400px;">';

    $title .= '<li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="border:none !important;">';

    if($seance['Seance']['published'] == 1 and $this->Formatage->dateUS($seance['Seance']['date']) >= date('Y-m-d')){$title .='<i class="glyphicons calendar x2 gly_vert" title="Séance publiée"></i>';}
     
    $title .= ' Session n°'.$seance['Seance']['num'].' • '.$seance['Seance']['date'];
     $title .= ' <span class="caret"></span></a>';

    $title .= ' <ul class="dropdown-menu" width="300px">';

    foreach ($seances as $row) {
      $title .= '<li style="padding:1%;"><a href="../'.$row['Seance']['id'].'/personnes">Session n°'.$row['Seance']['num'].' • '.$row['Seance']['date'].'</a></li>';
    }
    
   
     $title .= '</ul></li></ul>';
   
     


    
    
    $this ->assign('title_content', $title);
?>




<div class="row">

    <div class="col-md-11">

<?= $this->Form->create('Seance', array(
        'novalidate' => true,
        'type' => 'file',
        'id'=>'SeanceForm',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control input-sm',
            'disabled' => false
        ),
        'class' => 'form-horizontal'
    )); ?>
    <?= $this->Form->hidden('tabActive', array('class' => 'tabActive', 'value' => $tabActive));?>
  
    <?= $this->Form->hidden('user_modify_id', array('value' => $this->Session->read('user_id')));?>
    <?= $this->Form->hidden('id', array('value' => $seance['Seance']['id']));?>


<!-- TABS -->
<ul class="nav nav-tabs" <? if($this->Session->read('profil_code') == 'GD'){?> id="sortable"<? }?>>
  <? foreach ($tabs as $row): ?> 


    
    <li <? if(($row['TabsView']['order'] == 1 and $tabActive == null)  or $tabActive == $row['TabsView']['name2']){?>class="active"<? }?> id="SORTABLE_<?= $row['TabsView']['id'];?>">
      <a href="#tab<?= $row['TabsView']['id'];?>" data-toggle="tab" id="<?= $row['TabsView']['id'];?>" rel="<?= $row['TabsView']['name2'];?>" class="tab" > 
        <? if($row['TabsView']['nb'] == 1 and $row['TabsView']['name2'] == 'pratiquants'){?><span class="badge"><?= count($pratiquants_gp1)+count($pratiquants_gp2);?></span><? }?>
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
     <?= $this->element('tabs/seances/'.$row['TabsView']['name2']);?>
    </div>
  <?php endforeach; ?>
</div>


<hr/>





  



<? if($this->request->action == 'view'){ echo '<div class="infos_content">'.$infos_content.'</div>';}?>

</div>

<div class="col-md-1" align="center">
  <button type="submit" class="btn btn-primary btn-sm submitSimple" ><i class="glyphicons floppy_disk x2"></i><br/>Enregistrer</button> <hr/> <?= $this->Form->end();?>

  <?= $this->Form->postLink('<button class="btn btn-success btn-sm submitSimple" ><i class="glyphicons group x2"></i><br/>Présence<br/> Effective <br/>TOUS</button>', 
                        array('action' => 'allPresenceEffective', $seance['Seance']['id']), 
                        array(                            
                            'escape' => false, 
                            'title' => 'Mettre tout le monde présent', 
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir mettre tout le monde présent ?'
                );?>
  <hr/>

  <!--  <?= $this->Form->postLink('<button class="btn btn-success btn-sm submitSimple" ><i class="glyphicons group x2"></i><br/>Présence<br/>prévisionnelle<br/> TOUS</button>', 
                        array('action' => 'allPresencePrev', $seance['Seance']['id']), 
                        array(                            
                            'escape' => false, 
                            'title' => 'Mettre tout le monde présent', 
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir mettre tout le monde présent ?'
                );?>
  <hr/>-->
  <?= $this->Form->postLink('<button class="btn btn-danger btn-sm " ><i class="glyphicons bin x2"></i><br/>Supprimer</button>', 
                        array('action' => 'delete', $seance['Seance']['id']), 
                        array(                            
                            'escape' => false,
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir supprimer cette séance ?'
                );?>
  <hr/>
  <? if($seance['Seance']['published'] == 0 or $this->Formatage->dateUS($seance['Seance']['date']) < date('Y-m-d')){ 
    echo $this->Form->postLink('<button class="btn btn-success btn-sm " ><i class="glyphicons calendar x2"></i><br/>Publier</button>', 
                        array('action' => 'publish', $seance['Seance']['id']), 
                        array(                            
                            'escape' => false,
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir publier cette séance ?'
                );}?>

  <? if($seance['Seance']['published'] == 1 and $this->Formatage->dateUS($seance['Seance']['date']) >= date('Y-m-d')){ 
    echo $this->Form->postLink('<button class="btn btn-danger btn-sm " ><i class="glyphicons calendar x2"></i><br/>Dépublier</button>', 
                        array('action' => 'unpublish', $seance['Seance']['id']), 
                        array(                            
                            'escape' => false,
                            'data-toggle'=>'tooltip', 
                            'data-placement'=>'left'),
                        'Etes-vous sûr de vouloir dépublier cette séance ?'
                );}?>
                <hr/>

  <?/*= $this->html->link('<button class="btn btn-info btn-sm " ><i class="glyphicons file_export x2"></i><br/>Export PDF</button>', 
            array('action' => 'export_pdf',$seance['Seance']['id']), 
            array(
               'disabled' => true,                           
                'escape' => false,
                'data-toggle'=>'tooltip', 
                'data-placement'=>'left')
    );*/?> <br/><br/>

  <?= $this->html->link('<button class="btn btn-info btn-sm " ><i class="glyphicons file_export x2"></i><br/>Export EXCEL</button>', 
            array('action' => 'export_excel',$seance['Seance']['id']), 
            array(                            
                'escape' => false,
                'data-toggle'=>'tooltip', 
                'data-placement'=>'left')
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
        
        <?= $this->Form->hidden('by_view', array('value' => 'Seance')); ?>
        <?= $this->Form->hidden('fsession_id', array('value' => $seance['Seance']['id'])); ?>

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

        $("#SeanceOrgaHorsFFH").hide();
        $("#SeanceOrgaName").hide();

        $("#reference1").click(function(){
            $('#SeanceOrgaName label').html('Organisateur');
            $("#SeanceOrgaName").show();
            $("#SeanceOrgaHorsFFH").hide();
            
        });

        $("#reference0").click(function(){
            $('#SeanceOrgaName label').html('Structure FFH de référence <i class="glyphicons circle_question_mark" title="Club/comité/commission FFH impliqués dans l’organisation et servant de structure de référence"></i>');
            $("#SeanceOrgaName").show();
            $("#SeanceOrgaHorsFFH").show();

        });     

        });


    </script>

      <?= $this->Form->create('Seance', array(
        'action' => 'addSeanceOrga',
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

        
        
      <?= $this->Form->input('SeanceOrga.ffh', array(
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

      <div id="SeanceOrgaHorsFFH">
          <?= $this->Form->input('SeanceOrga.structure_hors_ffh', array(
                'label' => 'Organisateur non affilié à la FFH',          
                'id' => 'StructureHorsFFH'
           ));?>
        </div>

    <div id="SeanceOrgaName"> 
      <?= $this->Form->input('SeanceOrga.structure_id', array('type' => 'hidden', 'id' => 'StructureId')) ;?> 
        <?= $this->Form->input('StructureName', array(
              'placeholder' => 'Taper les premières lettres, puis sélectionner dans la liste',
              'label' => 'Organisateur',
              'class' => 'search-structureSeance form-control input-sm',
              'div' => 'form-group required'
         ));?>
    </div>
     
      <?= $this->Form->hidden('id', array('value' => $seance['Seance']['id'])); ?>
      <?= $this->Form->hidden('SeanceOrga.fsession_id', array('value' => $seance['Seance']['id'])); ?>
      <?= $this->Form->hidden('SeanceOrga.user_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('Seance.search_orga', array('value' => 0)); ?>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>







<!-- BOITE DE DIALOGUE - NOUVEL PARTICIPANT-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newpersonnes" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Ajouter une personne à cette séance</h4>
      </div>
      <div class="modal-body">

      <?= $this->Form->create('Seance', array(
        'url' => 'addPersonneSeance',
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


      <?= $this->Form->hidden('PersonnesSeance.seance_id', array('value' => $seance['Seance']['id'])); ?>
      <?= $this->Form->hidden('PersonnesSeance.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
      <?= $this->Form->hidden('PersonnesSeance.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>
      
      <?= $this->Form->input('PersonnesSeance.personne_id', array(
                'options' => $this -> App -> listePersonnes(),                       
                'empty' => 'Sélectionnez', 
                'label' => 'Personne',
                'class' => 'form-control input-sm'
              ));
              ?>

       <?= $this->Form->input('PersonnesSeance.type', array(
                'options' => $this -> Listes -> typePersonne(),                       
                'empty' => 'Sélectionnez', 
                'label' => 'Type',
                'class' => 'form-control input-sm'
              ));
              ?>

        <?= $this->Form->input('PersonnesSeance.groupe', array(
                'options' => $this -> Listes -> groupEcole(),                       
                'empty' => 'Sélectionnez', 
                'label' => 'Groupe',
                'class' => 'form-control input-sm'
              ));
              ?>


       
    

         
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - ANNULER LA SESSION-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="cancelSeance" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><? if($seance['Seance']['cancel'] == 0){?>Annuler<? }else {?>Rétablir<? }?> cette session de formation</h4>
            </div>
            <div class="modal-body">

            <? if($seance['Seance']['cancel'] == 0){?>
            <!-- BULLE INFO - ALerte EMAIL -->
            <!-- <div class="alert alert-info">
            <i class="glyphicons circle_info"></i> Une mention annulation apparaitra sur le calendrier public des sessions de formation<br/>
            </div> -->
            <? }?>

            <!-- BULLE INFO - ALerte EMAIL -->
            <div class="alert alert-info">
            <i class="glyphicons envelope"></i> Un email sera transmis aux utilisateurs concernés (stagiaires, intervenants, CNFH) pour les en informer. <br/><br/><b>Précision :</b> seul le CNFH connaitra le motif de votre annulation.
            </div>

            <?= $this->Form->create('Seance', array(
            'action' => 'cancelSeance',
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
            <? if($seance['Seance']['cancel'] == 0){ $cancelValue = 1; }else { $cancelValue = 0;}?>
            <?= $this->Form->hidden('id', array('value' => $seance['Seance']['id'])); ?>
            <?= $this->Form->hidden('canceled_user_id', array('value' => $this->Session->read('user_id'))); ?>
            <?= $this->Form->hidden('cancel', array('value' => $cancelValue)); ?>

            <? if($seance['Seance']['cancel'] == 0){?>
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
                    <button type="submit" class="btn btn-<? if($seance['Seance']['cancel'] == 0){?>danger<? } else {?>success<? }?>">Valider</button><?php echo $this->Form->end(); ?>
                </div>
        </div>
    </div>
</div>


<!-- BOITE DE DIALOGUE - BASCULE GROUPE-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="basculeGroupe" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><span id="personne"></span></h4>
            </div>
            <div class="modal-body">

          
            <?= $this->Form->create('Seance', array(
            'url' => 'moveGroupeSeance',
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
           
            <?= $this->Form->hidden('PersonnesSeance.seance_id', array('value' => $seance['Seance']['id'])); ?>
            <?= $this->Form->hidden('PersonnesSeance.id'); ?>
           
            <?php echo $this->Form->input('PersonnesSeance.groupe', array(
                'type' => 'select',
                'label' => 'Basculer vers',
                'empty' => 'Sélectionner',
                'options' => $this->Listes->groupEcole()
                    )); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Valider</button><?php echo $this->Form->end(); ?>
                </div>
        </div>
    </div>
</div>








