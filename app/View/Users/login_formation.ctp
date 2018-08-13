<script type="text/javascript">
  $(function() {

    
    $("#applis").hide();
    $("#btn_appli_off").hide();

    $("#btn_appli_on").click(function(){
      $("#applis").fadeIn("slow");
      $("#btn_appli_off").show();
      $("#btn_appli_on").hide();
    });

    $("#btn_appli_off").click(function(){
      $("#applis").fadeOut("slow");
      $("#btn_appli_on").show();
      $("#btn_appli_off").hide();
    });

    // STructure FFH // Hors FFH
    $("#type_ffh").hide();
    $("#dep_ffh").hide();
    $("#structure_ffh").hide();
    $("#structure_hors_ffh").hide();


    $("#licence_ffh").change(function(){

      if($(this).val() == 1){
        $('#structure_ffh2').val('');
        $('#dep_ffh2').val('');
        $('#structure_id').val('');
        $("#type_ffh").show();
        $("#dep_ffh").hide();
        $("#structure_ffh").hide();
        $("#structure_hors_ffh").hide();
      } else {

        $('#structure_ffh2').val('');
        $('#dep_ffh2').val('');
        $('#structure_id').val('');
        $("#type_ffh").hide();
        $("#dep_ffh").hide();
        $("#structure_ffh").hide();
        $("#structure_hors_ffh").show();
      }
      
    });

    // DEP pour structure FFH
    $('#dep_ffh2').change(function(){
      $('#structure_ffh2').val('');
      var selected = $(this).val();

      $("#structure_ffh").show();
      // ajax
      $.ajax({
        type: "POST",
        url: serveur+'/structures/ajax_get_structure',
        data: "ajax=true&dep="+selected+"&type=clu",
        success: function(msg){
          //console.log(msg);
          $('#structure_ffh2 option').filter(function() {
                return +this.value != '';
            }).remove();
          $('#structure_ffh2').append(msg);
        }
      });
    });

    // TYPE pour structure FFH
    $('#type_ffh2').change(function(){
      $('#structure_ffh2').val('');
      $('#dep_ffh2').val('');
      var selected = $(this).val();


      if(selected == 2){
        $("#dep_ffh").hide();
        $("#structure_ffh").show();
        // ajax
        $.ajax({
          type: "POST",
          url: serveur+'/structures/ajax_get_structure',
          data: "ajax=true&type=reg",
          success: function(msg){
            //console.log(msg);
            $('#structure_ffh2 option').filter(function() {
                  return +this.value != '';
              }).remove();
            $('#structure_ffh2').append(msg);
          }
        });
      }

      if(selected == 3){
        $("#dep_ffh").hide();
        $("#structure_ffh").show();
        // ajax
        $.ajax({
          type: "POST",
          url: serveur+'/structures/ajax_get_structure',
          data: "ajax=true&type=cms",
          success: function(msg){
            //console.log(msg);
            $('#structure_ffh2 option').filter(function() {
                  return +this.value != '';
              }).remove();
            $('#structure_ffh2').append(msg);
          }
        });
      }

      if(selected == 1){
        $("#dep_ffh").hide();
        $("#structure_ffh").show();
        // ajax
        $.ajax({
          type: "POST",
          url: serveur+'/structures/ajax_get_structure',
          data: "ajax=true&type=dep",
          success: function(msg){
            //console.log(msg);
            $('#structure_ffh2 option').filter(function() {
                  return +this.value != '';
              }).remove();
            $('#structure_ffh2').append(msg);
          }
        });
      }

      if(selected == 4){

        $("#dep_ffh").show();
        $("#structure_ffh").hide();

      }

    });

    // affect structure ID
    $('#structure_ffh2').change(function(){
      $('#structure_id').val($(this).val());
    });

   
    
  });

</script>


<div id="EspacePrive2">

<br/><br/>

<? if($_SERVER['REMOTE_ADDR'] != '88.162.211.174' and count($extranet_off) !=0){?>
    
   

<div class="panel panel-danger" style="margin-top:3%;">
        <div class="panel-heading" align="center"><i class="glyphicons cleaning x2"></i><br/><br/><b><?= $extranet_off[0]['Module']['extranet_off_title'];?></b></div>
        <div class="panel-body" align="center">
          <?= $extranet_off[0]['Module']['extranet_off_details'];?><hr/>
          Réouverture prévue le <br/><h4><?= $this->Formatage->datehrFR($extranet_off[0]['Module']['extranet_off_open']);?></h4><hr/>
          Merci de votre compréhension.<hr/>
          Les applications ci-dessous restent, pour autant, accessibles.</div>
    </div>


<? } else {?>
	
	<?php //echo $this->Session->flash('auth'); ?>
	
  

	<div class="connexion" style="display:inline;">

    <div class="row">
      <div class="col-md-7">
      <div  style="border-radius:3px; border:5px solid #0071bd; padding:2%;">

        <h4><i class="glyphicons circle_info" style="color:#0071bd;"></i> NOUVEAU !</h4>
        <i class="glyphicons chevron-right"></i> S'inscrire à une formation<br/>
        <i class="glyphicons chevron-right"></i> Consulter votre parcours de formation<br/>
        <i class="glyphicons chevron-right"></i> Etc...<br/><hr/>

          <b>Vous avez déjà un compte ?</b><br/>Connectez-vous dès maintenant pour accèder à votre espace !<br/><br/>
          <b>Vous n'avez pas encore de compte ?</b><br/> Créer un compte tout de suite.<br/><br/>
      </div>
      </div>

      <div class="col-md-5">

      <?php echo $this->Session->flash();?>

      <?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',       
            'class' => 'form-control',
            'disabled' => false
        ),
        'class' => 'form-horizontal'
      )); ?>

      <?= $this->Form->hidden('Fsession.id', array('value' => $fsession)); ?>
      <?= $this->Form->input('username', array('label' => false, 'placeholder' => 'Identifiant', 'value' => $username)); ?>
      <?= $this->Form->input('password', array('label' =>  false, 'placeholder' => 'Mot de passe'));?>

      <div class="form-group">
        <button   type="submit" class="btn btn-federation btn-md btn-block"><i class="glyphicons right_arrow"></i> Se connecter</button><?php echo $this->Form->end(); ?> <hr/>
        <div class="btn btn-default btn-xs btn-block" data-toggle="modal" data-target="#lostPwd"><i class="glyphicons envelope"></i> Identifiant / Mot de passe oublié</div>
        <div class="btn btn-default btn-xs btn-block" data-toggle="modal" data-target="#newUser"><i class="glyphicons circle_plus"></i> Créer votre compte</div>
      </div>
      </div>
    </div>


    
    
	</div>

<? }?>
 
	
	
</div>


<div class="row" style="margin-left:0px; margin-right:0px; border-top:1px solid #CCC; padding-left:1%; background-color:#F0F0F0;" align="center">
 
  <div class="col-md-6" align="right"><h4>Autres Applications</h4></div>
  <div class="col-md-6" style="cursor:pointer;" id="btn_appli_on" align="left"><h4><i class="glyphicons show_thumbnails"></i></h4></div>
  <div class="col-md-6" style="cursor:pointer;" id="btn_appli_off" align="left"><h4><i class="glyphicons show_thumbnails"></i></h4></div>
</div>

<div class="row" style="margin-left:0px; margin-right:0px;  border-top:1px solid #CCC; background-color:#F0F0F0;" id="applis">
  <div class="col-md-4">
    <a href="http://109.2.237.110/sites/Calendrier/Lists/Calendrier%20Officiel%20Comptitions%20%20Evvements/AllItems.aspx" target="_blank">
      <div class="row module" >
       <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_calendrier.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>CALENDRIER DES ÉVÉNEMENTS</h4>
        <span class="detail_module">Tous les évènements handisport en France en 1 clic ! Descriptions, compte-rendus, résultats,...</span></div>
      </div>    
    </a>

    <a href="../affiliations/carte" target="_blank">
      <div class="row module" >
      <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_oupratiquer.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>OÙ PRATIQUER</h4>
        <span class="detail_module">Trouver un club, un comité, ... Accèder aux informations de la structure handisport près de chez vous (Handicaps accueillis, sports proposés, lieux de pratiques, coordonnées, localisation,...)</span></div>
      </div>    
    </a>  

    <a href="https://licences.handisport.org" target="_blank">
      <div class="row module">
        <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_licence.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
          <h4>LICENCES AFFFILIATIONS LABELS</h4>
          <span class="detail_module">Accèder à toutes les données concernant votre structure handisport. S'affilier, prendre une licence, déposer un dossier label club,...</span></div>
      </div>
    </a>

     

  </div>

   <div class="col-md-4">

   <a href="https://webmail.handisport.org" target="_blank">  
      <div class="row module">
       <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_mail.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>WEBMAIL</h4>
        <span class="detail_module">Accès direct à votre messagerie handisport. Consulter / Ajouter vos emails, votre calendrier, vos contacts, vos tâches</span></div>
      </div>
    </a>

    <a href="https://extranet2.handisport.org/cnfh/login.php" target="_blank">
      <div class="row module" >
       <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_formation.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>EXTRANET FORMATION</h4>
        <span class="detail_module">Gérer, déclarer vos formations fédérales handisport (Accès sécurisé)</span></div>
      </div>    
    </a>

  

</div>
<div class="col-md-4">

    <a href="https://agora.handisport.org" target="_blank">  
      <div class="row module" >
       <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_agora.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>AGORA</h4>
        <span class="detail_module">Accéder à votre espace collaboratif handisport.</span></div>
      </div>    
    </a>  

      <a href="https://formation.handisport.org" target="_blank">
      <div class="row module" >
       <div class="col-md-4 bulle"><?php echo $this->Html->image('icons/icon_login_formation.png', array('alt' => '', 'border' => '0', 'width' => '90'));?></div>
       <div class="col-md-8">
        <h4>OÙ SE FORMER - Le calendrier</h4>
        <span class="detail_module">Le calendrier des formations fédérales handisport. S'inscrire en ligne.</span></div>
      </div>    
    </a>

    
  </div>
</div>





<!-- BOITE DE DIALOGUE - IDENTIFIANT / MOT DE PASSE OUBLIE -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="lostPwd" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Identifiant et/ou mot de passe oublié</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-info">Tapez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.</div>
      <?= $this->Form->create('User', array(
      	'action' => 'remind',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    	)); ?>
    <?= $this->Form->input('email');?>
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - CREER UN COMPTE -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="newUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Créer votre compte - Espace Stagiaire Handisport</h4>
      </div>
      <div class="modal-body">

     
        

     
     <?= $this->Form->create('Signup', array(
      'novalidate' => true,
     	'controller' => 'signups',
     	'action' => 'signupStagiaire',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-8',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    )); ?>


    <?= $this->Form->hidden('specialStagiaire', array('value' => 1)); ?>
    <?= $this->Form->hidden('structure_id', array('id' => 'structure_id')); ?>
     
    
    <?= $this->Form->input('civilite', array(
                  'options' => array('M' => 'Monsieur', 'Me' => 'Madame'),
                  'empty' => 'Sélectionner', 
                  'label' => 'Civilité ',
                  'class' => 'form-control input-sm'
              ));?>

    
    <?= $this->Form->input('nom', array('label' => 'Nom')); ?>
    <?= $this->Form->input('prenom', array('label' =>  'Prénom '));?>

     <?= $this->Form->input('ddn', array( 
        'type' => 'text',
        'placeholder' => 'dd/mm/aaaa',
        'label' => 'Date de naissance',
        'beforeInput' => '<div id="ddn"><div class="input-group date">',
        'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
    ));?>

      <?= $this->Form->input('email', array('placeholder' => '')); ?>
    

    <hr/>
     

       <?= $this->Form->input('licence_ffh', array(
                  'options' => array(1 => 'Oui',0 => 'Non'),
                  'id' => 'licence_ffh',
                  'empty' => 'Sélectionner', 
                  'label' => 'Êtes-vous (ou avez-vous été) licencié à la FFH ?',
                  'class' => 'form-control input-sm'
              ));?>


    <div id="type_ffh">
      <?= $this->Form->input('type_ffh', array(
              'options' => array(1 => 'Comité départemental', 2 => 'Comité régional', 3 => 'Commission sportive', 4 => 'Club ou Section'),
              'id' => 'type_ffh2',
              'empty' => 'Sélectionnez', 
              'label' => 'Type de structure',
              'class' => 'form-control input-sm'
            ));
      ?>
    </div>

    <div id="dep_ffh">
      <?= $this->Form->input('departement', array(
              'options' => $dep,
              'id' => 'dep_ffh2',
              'empty' => 'Sélectionnez', 
              'label' => 'Département',
              'class' => 'form-control input-sm'
            ));
      ?>
    </div>

    <div id="structure_ffh">
      <?= $this->Form->input('structure', array(
          'id' => 'structure_ffh2',
          'type' => 'select',
          'empty' => 'Sélectionner', 
          'label' => 'Votre structure',
          'class' => 'form-control input-sm'
      ));?>
    </div>


    <div id="structure_hors_ffh">
      <?= $this->Form->input('structure', array(
        'label' =>  'Votre structure', 
        'id' => 'structure_hors_ffh2',
        'placeholder' => 'ex : Dax Tennis-club',
        'afterInput' => '<span class="help-block">Si vous n\'appartenez à aucune structure, inscrivez "Aucune"</span>'
        ));?>
    </div>
    



  
<hr/>
   


    <div class="form-group">
    <label class="col col-md-3 control-label"></label>
    <div class="col col-md-9">

     <?= $this->Recaptcha->display(array(
      'recaptchaOptions' => array(
          'theme' => 'blackglass',
          'lang' => 'fr'
        )
      )
    );?>
    </div>
    
    </div>


  
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


