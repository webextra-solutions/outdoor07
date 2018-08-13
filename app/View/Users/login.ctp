<!-- JAVASCRIPT -->
<script type="text/javascript">
    $(function() {

      function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        
        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
      }
      // Reposition when a modal is shown
      $('.modal').on('show.bs.modal', reposition);

        
      <? if($id == 1 or $id == 3){?> 
      $("#login").modal();
      <? }?>

   

      

      <? if($id == 2){?> 
      $("#activeUser2").modal();     
      <? }?>

      <? if($id == 8){?> 
      $("#activeUser2").modal();     
      <? }?>

      <? if($id == 'resetPwd'){?> 
      $("#resetPwd").modal();   

      <? }?>

      <? if($id == 7){?> 
        $("#jnh").val(1);  
        $("#activeUser2").modal();     
      <? }?>

    

      <? if($id == 5){?> 
      $("#newUser").modal();
      <? }?>

   

  

      

      


      

      

      // BOITE DE DIALOGUE - Voir FAQ
      /*$("#loginMission").click(function(){
        $("#module_id").val(3);            
      });

      // BOITE DE DIALOGUE - Voir FAQ
      $("#loginFormation").click(function(){
        $("#module_id").val(2);            
      });*/
     




   
      
      /*$('#newUser').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
        $("#newUserChoix").modal('hide');
      });

      $('#newUser').on('hidden.bs.modal', function (e) {
        $("#newUserChoix").modal('show');
      });


      $('#newUserStagiaire').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
        $("#newUserChoix").modal('hide');
      });*/


      




     


      // PWD LOST
      $('#lostPwd').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
      });

       $('#resetPwd').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
      });

      $('#lostPwd').on('hidden.bs.modal', function (e) {
        $("#login").modal('show');
      });


      $("#SignupForm").validate({
        rules: {
          'data[Signup][nom]': {required:true},
          'data[Signup][prenom]': {required:true},
          'data[Signup][ddn]': {required:true, dateFR:true},
          'data[Signup][civilite]': {required:true},
          'data[Signup][email]': {required:true, email:true},
          'data[Signup][licence_ffh]': {required:true},
          'data[Signup][structure]': {required:true},
          'data[Signup][demande]': {required:true}

        },
        submitHandler: function(form) {
            
              form.submit();          
        
          
        }
    });


    $("#ResetForm").validate({
    rules: {   
      'data[User][password]': {required:true, minlength: 8}

    },
    submitHandler: function(form) {
         
          form.submit();          
    
      
    }
});




     $("#SavePresence").validate({
        rules: {
          'data[PersonnesSeance][personne_id]': {required:true},
          'data[PersonnesSeance][presence]': {required:true}
         

        },
        submitHandler: function(form) {
            
        $('#SavePresence').on('submit', function(e) {
          e.preventDefault();
          $.ajax({
            url: serveur + "/seances/addPresence",
            type: 'POST',
            dataType: "JSON",
            contentType: false, // obligatoire pour de l'upload
                  processData: false, // obligatoire pour de l'upload
            data: new FormData(this),         
            async: true,
            dataExpression: true,
            complete: function(){
              $("#content2, .popup_finish").fadeIn('slow');
              //$("#content2, .popup_finish").delay(2000).fadeOut('slow');        
            }
          });
        });
        
          
        }
    });


    

        
   

      

              
    });
</script>



 

  <div id="bloc_1" style="width: 30%; margin: 5% 35% 0 35%;">


 
   
          <h2>Espace Dirigeants</h2>
          <h5>Outdoor 07 • Ecole Multisports • Saison 2017/2018</h5><hr/>
            <?= $this->Flash->render();?>

        <?= $this->Form->create('User', array(
            'inputDefaults' => array(
                'div' => 'form-group',       
                'class' => 'form-control'
            )
        )); ?>

        <?= $this->Form->hidden('module_id', array('id' => 'module_id', 'value' => 1)); ?>
        <? if(isset($username)){ echo $this->Form->input('username', array('label' => 'Adresse Email','value' => $username));} else {echo $this->Form->input('username', array('label' => 'Adresse Email'));} ?>
        <?= $this->Form->input('password', array('label' =>  'Mot de passe'));?>


     <button   type="submit" class="btn btn-md btn-primary" style="width: 100%;">CONNEXION</button><?php echo $this->Form->end(); ?>

     <br/>
    
        <!-- <hr/>
        <div  data-toggle="modal" data-target="#newUser">CRÉER UN COMPTE</div> -->
       <!-- <div class="btn2" data-toggle="modal" data-target="#newUserStagiaire">CRÉER UN COMPTE STAGIAIRE (TEST BETA)</div>
        <hr/>-->

        <div class="row">

       

        <div class="col-md-4">
              <div  align="center" width= "120px" class="lien" data-toggle="modal" data-target="#lostPwd"><br/><br/><i class="glyphicons envelope x2"></i><br/>Id/mdp oublié</div>
        </div> 
        

         <div class="col-md-4">
              <div  align="center" width= "120px" class="lien" onclick="document.location='mailto:samuel.ginot@free.fr'"><br/><br/><i class="glyphicons circle_question_mark x2"></i><br/>Besoin d'aide</div>
        </div> 

        <div class="col-md-4">
              <div  align="center" width= "120px" class="lien" onclick="document.location='<?= serveur;?>/seances/presence'"><br/><br/><i class="glyphicons group x2"></i><br/>Espace Parents</div>
        </div> 

</div><br/><br/><br/>

<div align="center" style="color:#CCC;">
     version 1.0 • 2017  
  </div>
     

      
    
  </div>












<!-- BOITE DE DIALOGUE - PWD LOST -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="lostPwd" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h4 class="modal-title" id="myModalLabel">Identifiant et/ou mot de passe oublié</h4>
      </div>

     <div class="modal-body">
      <?= $this->Form->create('User', array(
        'url' => 'remind',
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
    <?= $this->Form->input('email', array(

      'afterInput' => '<span class="help-block rge">ATTENTION • <u><b>Email rattaché à votre compte !</u></b></span>'));?>
  
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
      </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - RESET PWD -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="resetPwd" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h4 class="modal-title" id="myModalLabel">Réinitialiser votre mot de passe</h4>
      </div>

     <div class="modal-body">

     <?php echo $this->Session->flash(); ?>
      <?= $this->Form->create('User', array(

        'id' => 'ResetForm',
        'novalidate' => true,
        'url' => 'reset',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-6 control-label'
            ),
            'wrapInput' => 'col col-md-6',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
      )); ?>
        <?= $this->Form->hidden('key',array('value' => $key));?>
        <?= $this->Form->input('password', array('label' => 'Nouveau mot de passe', 'id' => 'pwdty'));?>
        <?= $this->Form->input('password-confirm', array('type' => 'password', 'label' =>  'Confirmation nouveau mot de passe'));?>       
  
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
      </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - ACTIVE COMPTE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="activeUser2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h4 class="modal-title" id="myModalLabel">Dernière étape ! <i class="glyphicons chevron-right"></i> Activer votre compte</h4>
      </div>

     <div class="modal-body">

     <?php echo $this->Session->flash(); ?>
      <?= $this->Form->create('User', array(
        'url' => 'activeUser',
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-6 control-label'
            ),
            'wrapInput' => 'col col-md-6',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
      )); ?>
        <?= $this->Form->hidden('key', array('value' => $key));?>
        <?= $this->Form->hidden('jnh', array('id' => 'jnh'));?>
        
        <?= $this->Form->input('password', array('label' => 'Choisissez votre mot de passe'));?>
        <?= $this->Form->input('password-confirm', array('type' => 'password', 'label' =>  'Confirmer votre choix de mot de passe'));?>  
  
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
      </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - CREER UN COMPTE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h3 class="modal-title" id="myModalLabel">Créer un compte</h3>
      </div>

        <div class="modal-body">



       

          <?= $this->Form->create('Signup', array(
            'controller' => 'signups',
            'id' => 'SignupForm',
            'novalidate' => true,
       
            'url' => 'signup',
              'inputDefaults' => array(
                  'div' => 'form-group',             
                  'class' => 'form-control'
              )
          )); ?>

          


          <div class="row">

            <div class="col-md-6">
              <?= $this->Form->input('civilite', array(
                  'id' => 'civ',
                  'options' => array('M' => 'Monsieur', 'Me' => 'Madame'),
                  'empty' => 'Sélectionner', 
                  'label' => 'CIVILITÉ ',
                  'class' => 'form-control'
              ));?>
              <?= $this->Form->input('nom', array('label' => 'NOM', 'id' => 'nom')); ?>
              <?= $this->Form->input('prenom', array('label' => 'PRÉNOM', 'id' => 'prenom')); ?>
            </div>
               
            <div class="col-md-6">
              <?= $this->Form->input('ddn', array( 
                    'type' => 'text',
                    'id' => 'ddn_input',
                    'placeholder' => 'dd/mm/aaaa',
                    'label' => 'DATE DE NAISSANCE',
                    'beforeInput' => '<div id="ddn"><div class="input-group date">',
                'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
                ));?>



              <?//= $this->Form->input('structure', array('label' =>  'VOTRE STRUCTURE', 'placeholder' => 'ex : Comité Handisport du Rhône'));?>
              <?= $this->Form->input('email', array('label' => 'EMAIL', 'placeholder' => '')); ?>
            </div>

            <div class="col-md-12">
                <?= $this->Form->input('demande', array('label' =>  'Précisions', 'type'=>'textarea', 'placeholder' => 'Décrivez brièvement l\'objet de votre demande de compte',));?>
            </div>

            <!-- <div class="col-md-12 rge"><h5>N'oubliez pas de cocher la case ci-dessous ! Merci</h5></div>


            <div  align=" center" class="col-md-12 g-recaptcha" data-sitekey="6LerUg8UAAAAADULUQMVyj46zPZldVunLqRbtJXB"></div> -->
          
             
          </div>   
      </div>

     
      
    <div class="modal-footer"> <button   type="submit" class="btn btn-md">ENVOYER</button><?php echo $this->Form->end(); ?></div>

   

  </div>
</div>
</div>


<!-- BOITE DE DIALOGUE - CREER UN COMPTE STAGIAIRE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newUserStagiaire" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h3 class="modal-title" id="myModalLabel"><h5>Extranet • Formations Handisport</h5><h3>Créer mon espace Stagiaire et/ou intervenant</h3></h3>
      </div>

      <div class="modal-body">
        <div class="row">
         <?= $this->Form->create('Signup', array(
            'controller' => 'signups',
            'id' => 'SignupForm',
            'novalidate' => true,
       
            'action' => 'addUserStagiaire',
              'inputDefaults' => array(
                  'div' => 'form-group',             
                  'class' => 'form-control input-sm'
              )
          )); ?>

          <div class="col-md-6">
           
            <?= $this->Form->input('civilite', array(
                'id' => 'civ',
                'div' => 'required',
                'options' => array('M' => 'Monsieur', 'Me' => 'Madame'),
                'empty' => 'Sélectionner', 
                'label' => array('text' => 'CIVILITÉ ')
            ));?>
         
            <?= $this->Form->input('nom', array('label' => 'NOM', 'id' => 'nom', 'div' => 'required')); ?>
            <?= $this->Form->input('prenom', array('label' => 'PRÉNOM', 'id' => 'prenom', 'div' => 'required')); ?>
            <?= $this->Form->hidden('origin', array('value' => 'SignupAddUserStagiaire')); ?>
            

            <label>DATE DE NAISSANCE</label>
            <div class="input-group">

            <div class="input-group-btn">
              <?= $this->Form->input('ddn_day', array(
                'div' => 'required',
                'options' => $this->Listes->genererListeYear(1,31),
                'empty' => 'Jour', 
                'label' => false
            ));?>
            </div> 
             <div class="input-group-btn">
              <?= $this->Form->input('ddn_month', array(
                'div' => 'required',
                'options' => array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril','05' => 'Mai','06' => 'Juin','07' => 'Juillet','08' => 'Août','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre'),
                'empty' => 'Mois', 
                'label' => false
            ));?>
            </div> 
             <div class="input-group-btn">
             <?= $this->Form->input('ddn_year', array(
                'div' => 'required',
                'options' => $this->Listes->genererListeYear(1920,2016),
                'empty' => 'Année', 
                'label' => false
            ));?>
            </div>
            </div>

           




          </div>

          <div class="col-md-6">
            <?= $this->Form->input('structure', array('label' =>  'VOTRE STRUCTURE • Facultatif', 'placeholder' => 'ex : Comité Handisport du Rhône', 'div' => ''));?>
            <?= $this->Form->input('email', array('label' => 'EMAIL', 'placeholder' => '', 'div' => 'required')); ?>
            <?= $this->Form->input('password', array('id' => 'pwdty', 'label' => 'MOT DE PASSE (8 caractères minimum)', 'div' => 'required'));?>
            <?= $this->Form->input('password-confirm', array('id' => 'pwd-confirm', 'type' => 'password', 'label' =>  'CONFIRMATION - MOT DE PASSE', 'div' => 'required'));?> 
          </div>

          <div class="col-md-12">
            <?= $this->Form->input('licence_ffh', array(
                            'options' => array(1 => 'Oui',0 => 'Non'),
                            'empty' => 'Sélectionner', 
                            'div' => 'required',
                            'label' => 'ÊTES-VOUS (ou avez-vous été) LICENCIÉ À LA FFH ?',
                            'class' => 'form-control input-sm'
                        ));?>

        
          
          </div>

         
       </div>
          
        
      </div>

     
         
      <div class="modal-footer"> <button   type="submit" class="btn btn-md" id="btnAddUserGI">ENVOYER</button><?php echo $this->Form->end(); ?></div>

    </div>

  </div>
</div>
</div>



<!-- BOITE DE DIALOGUE - CREER UN COMPTE - OPTIONS -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="newUserChoix" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h3 class="modal-title" id="myModalLabel">Extranet Handisport • Créer votre compte !</h3>
      </div>

        <div class="modal-body">

         

          Vous êtes sur le point de créer un compte-utilisateur sur l'extranet handisport et nous vous en remercions !<br/>
          Veuillez sélectionner votre profil de création parmi les 2 choix ci-dessous :<br/><br/>





          <div class="row">

         
               
            <div class="col-md-6" align="center">
              <div style="background-color: #555; padding: 8px; border-radius: 3px;">
                <div align="left">
                  <h5 style="line-height: 18px;">Stagiaire et/ou Intervenant<br/>FORMATION<br/>HANDISPORT</h5><hr/>
                  • Inscription en ligne<br/>
                  • Parcours formation<br/>
                  • Edition attestation<br/><br/>
                </div>
                <button   type="submit" class="btn btn-sm" data-toggle="modal" data-target="#newUserStagiaire">Continuer</button>
              </div>
            </div> 

            <!-- <div class="col-md-4" align="center">
              <div style="background-color: #555; padding: 8px; border-radius: 3px;">
                <div align="left">
                  <h5 style="line-height: 18px;">Inscriptions<br/>JNH<br/>ENGHIEN 2017</h5><hr/>
                  • Inscription en ligne<br/><br/>
                  <h3 class="rge" align="center">CLÔTURÉE !</h3>
                </div>
                <button   type="submit" class="btn btn-sm" onclick="document.location='http://journees-nationales.handisport.org'">Continuer</button>
              </div>
            </div> -->

            <div class="col-md-6" align="center">
              <div style="background-color: #555; padding: 8px; border-radius: 3px;">
                <div align="left">
                  <h5 style="line-height: 18px;">Gestionnaire<br/>CRH/CDH/Commission<br/>EVENEMENTS & MISSIONS</h5><hr/>
                  • Publier un évenement (calendrier)<br/>
                  • Appels à projets - séjours sportifs<br/>
                  • Déclarer une mission fédérale<br/><br/>
                </div>
                <button   type="submit" class="btn btn-sm" data-toggle="modal" data-target="#newUser">Continuer</button>
              </div>
            </div>   
      </div>

     
    

   

  </div>
</div>
</div>









<!-- BOITE DE DIALOGUE - CONFIRMATION -->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="confirmForm" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Etes vous sûr de vouloir continuer ?</h4>
      </div>
      

       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="BtnConfirmForm" class="btn btn-primary">Confirmer</button>
      </div>

    
      
    </div>
  </div>
</div>


<div class="fond_popup_save" id="content2" style=" display: none;"></div>
<div class="popup_save bg-primary" style="display: none;"><i class="glyphicons floppy_saved x2"></i><br/>Les données<br/>ont été enregistrées<br/>avec succès !</div>
<div class="popup_finish bg-success" style="display: none;"><i class="glyphicons ok_2 x2"></i><br/>Les données<br/>ont été enregistrées<br/>avec succès !<hr/>Votre pré-inscription est terminée !</div>









