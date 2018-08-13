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
      <div  style="border-radius:3px; border:5px solid #e46d15; padding:2%;">

        <h4><i class="glyphicons circle_info" style="color:#e46d15;"></i> MISSIONS FEDERALES HANDISPORT</h4>
        <i class="glyphicons chevron-right"></i> Déclarer plus facilement vos missions fédérales<br/>
        <i class="glyphicons chevron-right"></i> Accéder à l'historique complet de vos missions fédérales<br/><hr/>

          <b>Vous avez déjà un compte ?</b><br/>Connectez-vous dès maintenant, et déclarez votre mission !<br/><br/>
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

      <?= $this->Form->input('username', array('label' => false, 'placeholder' => 'Identifiant')); ?>
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
        <h4 class="modal-title" id="myModalLabel">Créer votre compte</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">       
          <h4><i class="glyphicon glyphicon-chevron-right"></i> Licences | Affiliations | Label Club</h4>
          Vous n'avez pas besoin de créer de compte ici. Rdv sur votre interface habituelle <i class="glyphicon glyphicon-chevron-right"></i><b><?= $this->Text->autoLinkUrls('https://licences.handisport.org', array('target' => 'blank'));?></b>
        </div><br/>

        <div class="alert alert-info">
          <h4><i class="glyphicon glyphicon-chevron-right"></i> Gestion des formations handisports</h4>
          Vous n'avez pas besoin de créer de compte ici. Rdv sur votre interface habituelle <i class="glyphicon glyphicon-chevron-right"></i><b><?= $this->Text->autoLinkUrls('https://extranet2.handisport.org/cnfh/login.php', array('target' => 'blank'));?></b>
        </div><br/>
        
        <div class="alert alert-info">
          <h4><i class="glyphicon glyphicon-chevron-right"></i> Gestion des Evénements handisports</h4>
          <h4><span style="color:#F00;"><b>Ouverture du module au 15 mai environ</b></span></h4>
          En attendant, si vous n'avez pas encore de compte ?<br/>Veuillez remplir, dès maintenant, le formulaire ci-dessous. Dès validation par notre équipe un email vous sera envoyé afin d'activer votre compte.
        </div>


     
     <?= $this->Form->create('Signup', array(
     	'controller' => 'signups',
     	'action' => 'signup',
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
    <?= $this->Form->input('structure', array('label' =>  'Votre structure', 'placeholder' => 'ex : Comité Handisport du Rhône'));?><hr/>

   <?= $this->Form->input('Module', array(
    'multiple' => 'checkbox',
    'before' => '<label class = "col col-md-3 control-label">Module(s) souhaité(s)</label>',
    'label'=> false
    )); ?> 

    <?= $this->Form->input('demande', array('label' =>  'Précisions', 'type'=>'textarea', 'placeholder' => 'Décrivez brièvement l\'objet de votre demande en explicant, notamment, les motifs des modules souhaités',));?>

    <?php /*echo $this->Form->input('Remember me', array(
        'wrapInput' => 'col col-md-9 col-md-offset-3',
        'label' => array('class' => null),
        'class' => false,
        'type' => 'checkbox'
    )); */?>
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


