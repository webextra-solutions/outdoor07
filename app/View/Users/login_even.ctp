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

      $('#ddn .input-group.date').datepicker({
          language: "fr",
          endDate: "-15y",
        startView: 2
      });

      $("#jnh2016").modal();

        
      <? if($id == 1){?> 
      $("#login").modal();
      <? }?>

      <? if($id == 2){?> 
      $("#activeUser").modal();
      <? }?>

       <? if($id == 3){?> 
      $("#newUser").modal();
      <? }?>


      $('#confirmForm').on('show.bs.modal', function (e) {
      
        $("#newUser").modal('hide');
      })


      $('#newUser').on('show.bs.modal', function (e) {
      
        $("#jnh2016").modal('hide');
      })

      $('#newUser').on('hidden.bs.modal', function (e) {
        $("#jnh2016").modal('show');
      })

      $('#lostPwd').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
      })

      $('#lostPwd').on('hidden.bs.modal', function (e) {
        $("#login").modal('show');
      })

 /* $("#nom").keydown(function(){$( "#nom_error" ).empty();});
  $("#prenom").keydown(function(){$( "#prenom_error" ).empty();});
  $("#ddn_input").keydown(function(){$( "#ddn_error" ).empty();});*/

  // VERIFICATION AVANT VALIDATION INTENTION
 /* $("#btnAddUserGI").click(function(){

    $( ".error_text" ).empty();
    error = '';

    if($('#civ').val() == ''){
      error += "Champ obligatoire";
      error_text_civ = "Champ obligatoire";
    }

    if($('#nom').val() == ''){
      error += "Champ obligatoire";
      error_text_nom = "Champ obligatoire";
    }

    if($('#prenom').val() == ''){
      error += "Champ obligatoire";
      error_text_prenom = "Champ obligatoire";
    }

    if($('#ddn_input').val() == ''){
      error += "Champ obligatoire";
      error_text_ddn = "Champ obligatoire";
    }

 


    if (error == ""){
        $("#confirmForm").modal();      
        $("#BtnConfirmForm").click(function(){    
          $('#SignupForm').submit();        
        });

    } else {
      $( "#civ_error" ).append( error_text_civ );
      $( "#nom_error" ).append( error_text_nom );
      $( "#prenom_error" ).append( error_text_prenom );
      $( "#ddn_error" ).append( error_text_ddn );
      return false;
        
    } 
  });
*/

$("#SignupForm").validate({
    rules: {
      'data[Signup][nom]': {required:true},
      'data[Signup][prenom]': {required:true},
      'data[Signup][ddn]': {required:true, dateFR:true},
      'data[Signup][civilite]': {required:true},
      'data[Signup][email]': {required:true, email:true},
      'data[Signup][password]': {required:true, minlength: 8},
      'data[Signup][licence_ffh]': {required:true},

      'data[Signup][password-confirm]': {
        equalTo: "#pwdty"
      }

    },
    submitHandler: function(form) {
      $("#confirmForm").modal();
          $("#BtnConfirmForm").click(function(){    
          form.submit();          
      });
      
    }
});


        
   

      

              
    });
</script>


<div class="row">

  <div  id="colonne1">

    <div class="title_col1" id="title_col1"><b>ACCÈS SÉCURISÉ</b> <i class="glyphicons chevron-right"></i> Admin</div>
    <div class="blocRotated-l">
      <div class="bloc_col1" id="bloc_left">

        <!-- LICENCES HANDISPORT -->
        <a href="https://licences.handisport.org" target="_blank">
          <div class="row">
            <div class="cercle" align="center"><i class="glyphicons rotation_lock"></i></div>
            <div>
              <h4>LICENCES & LABEL CLUB</h4>
              <span class="detail_module">Consulter et modifier les données<br/>de votre structure handisport</span>
            </div>
          </div>
        </a>

        <!-- EXTRANET EVENEMENTS HANDISPORT -->
        <a href="#" data-toggle="modal" data-target="#login">
          <div class="row">
            <div class="cercle" align="center"><i class="glyphicons rotation_lock"></i> </div>
            <div>
              <h4>ÉVÉNEMENTS</h4>
              <span class="detail_module">Ajouter, publier, modifier<br/> vos événements handisport</span>
            </div>
          </div>
        </a>


        <!-- EXTRANET FORMATIONS HANDISPORT -->
        <a href="https://extranet2.handisport.org/cnfh/login.php" target="_blank">
          <div class="row">
            <div class="cercle" align="center"><i class="glyphicons rotation_lock"></i> </div>
            <div>
              <h4>FORMATIONS</h4>
              <span class="detail_module">Déclarer, administrer vos formations<br/>fédérales handisport</span>
            </div>
          </div>
        </a>

        <!-- MISSIONS FEDERALES -->
        <a href="https://missions.handisport.org" target="_blank">
          <div class="row">
            <div class="cercle" align="center"><i class="glyphicons rotation_lock"></i></div>
            <div>
              <h4>MISSIONS FÉDÉRALES</h4>
              <span class="detail_module">Déclaration obligatoire : réprésentation<br/> fédérale mission à l'étranger</span>
            </div>
          </div>
        </a>

      </div>
    </div>

  </div>

  <div id="colonne2">

    <div class="title_col1" id="title_col2"><b>ACCÈS DIRECT</b> <i class="glyphicons chevron-right"></i> Consulter</div>
    <div class="blocRotated-r">
      <div class="bloc_col1" id="bloc_right">

        <div class="col-md-6">
          <!-- OU PRATIQUER -->
          <a href="https://annuaire.handisport.org" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons map"></i></div>
              <div>
                <h4>OÙ PRATIQUER ?</h4>
                <span class="detail_module">Trouver un club près de chez vous<br/>contacter une structure handisport</span>
              </div>
            </div>
          </a> 

          <!-- CALENDRIER EVENEMENTS HANDISPORT -->
          <a href="https://extranet.handisport.org/events/calendar" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons calendar"></i></div>
              <div>
                <h4>CALENDRIER ÉVÉNEMENTS</h4>
                <span class="detail_module">Tous les événements handisport<br/>descriptions, compte-rendus, résultats</span>
              </div>
            </div>
          </a>    

          <!-- OU SE fORMER -->
          <a href="https://formation.handisport.org" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons calendar"></i></div>
              <div>
                <h4>CALENDRIER FORMATIONS</h4>
                <span class="detail_module">Trouver une formation<br/>s'inscrire en ligne</span>
              </div>
            </div>
          </a>

          <!-- AGORA -->
          <a href="https://agora.handisport.org" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons conversation"></i></div>
              <div>
                <h4>AGORA</h4>
                <span class="detail_module">Espace collaboratif handisport<br/>mutaliser et partager vos idées</span>
              </div>
            </div>
          </a>

        </div>

        <div class="col-md-6">

          <!-- WEB MAIL-->
          <a href="https://webmail.handisport.org/owa" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons envelope"></i></div>
              <div>
                <h4>WEBMAIL</h4>
                <span class="detail_module">Votre messagerie handisport<br/>lien entre votre structure et la FFH</span>
              </div>
            </div>
          </a>

          <!-- SITE WEB -->
          <a href="http://www.handisport.org" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons cluster"></i></div>
              <div>
                <h4>HANDISPORT.ORG</h4>
                <span class="detail_module">Site officiel de la Fédération<br/>actualités, tout savoir sur handisport</span>
              </div>
            </div>
          </a> 

          <!-- FLICKR -->
          <a href="https://www.flickr.com/photos/handisport/collections/" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons camera"></i></div>
              <div>
                <h4>PHOTOTHÈQUE</h4>
                <span class="detail_module">Plus de 1500 photos à consulter<br/>ou à télécharger</span>
              </div>
            </div>
          </a>

           <!-- VIDOES-->
          <a href="https://vimeo.com/user38870903" target="_blank">
            <div class="row">
              <div class="cercle" align="center"><i class="glyphicons display"></i></div>
              <div>
                <h4>PLATEFORME VIDÉOS</h4>
                <span class="detail_module">Plateforme vidéo de la Fédération.<br/>téléchargements autorisés
              </div>
            </div>
          </a>
                   
        </div>
       
      </div>
    </div>

  </div>


</div>



<!-- BOITE DE DIALOGUE - LOGIN -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" id="login" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h3 class="modal-title" id="myModalLabel">Connexion</h3>
      </div>

      <div class="modal-body">

      
         <?php echo $this->Session->flash();?>

        <?= $this->Form->create('User', array(
            'inputDefaults' => array(
                'div' => 'form-group',       
                'class' => 'form-control'
            )
        )); ?>

      
        <?= $this->Form->input('username', array('label' => 'IDENTIFIANT')); ?>
        <?= $this->Form->input('password', array('label' =>  'MOT DE PASSE'));?>

     <button   type="submit" class="btn btn-md">ENTRER</button><?php echo $this->Form->end(); ?>

     <br/>
     <br/>
       
        <br/>
        <hr/>
        <div class="btn2" data-toggle="modal" data-target="#newUser">CRÉER UN COMPTE</div>
        <hr/>
        <div class="btn2" data-toggle="modal" data-target="#lostPwd">IDENTIFIANT / MOT DE PASSE OUBLIÉ</div>
        <hr/>    


        
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
        <h3 class="modal-title" id="myModalLabel">Créer mon espace</h3>
      </div>

      <div class="modal-body">
        <div class="row">
         <?= $this->Form->create('Signup', array(
            'controller' => 'signups',
            'id' => 'SignupForm',
            'novalidate' => true,
       
            'action' => 'addUserGI',
              'inputDefaults' => array(
                  'div' => 'form-group',             
                  'class' => 'form-control'
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
            <?= $this->Form->input('ddn', array( 
              'div' => 'required',
                'type' => 'text',
                'id' => 'ddn_input',
                'placeholder' => 'jj/mm/yyyy',
                'label' => 'DATE DE NAISSANCE',
               'beforeInput' => '<div id="ddn"><div class="input-group date">',
              'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
            ));?>
          </div>

          <div class="col-md-6">
            <?= $this->Form->input('structure', array('label' =>  'VOTRE STRUCTURE • Facultatif', 'placeholder' => 'ex : Comité Handisport du Rhône'));?>
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
          <div class="modal-footer" align="center">
             <?= $this->Recaptcha->display(array(
              'recaptchaOptions' => array(
                  'theme' => 'blackglass',
                  'lang' => 'fr'
                  )
                )
              );?>
          </div>

        
      </div>
         
      <div class="modal-footer"> <button   type="submit" class="btn btn-md" id="btnAddUserGI">ENVOYER</button><?php echo $this->Form->end(); ?></div>

    </div>

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
    <?= $this->Form->input('email', array('placeholder' => 'Entrer l\'email rattaché à votre compte, afin de réinitialiser votre mot de passe'));?>
  
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
      </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - ACTIVE COMPTE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="activeUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h4 class="modal-title" id="myModalLabel">Dernière étape ! <i class="glyphicons chevron-right"></i> Activer votre compte</h4>
      </div>

     <div class="modal-body">

     <?php echo $this->Session->flash(); ?>
      <?= $this->Form->create('User', array(
        'action' => 'activeUser',
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
        <?= $this->Form->input('password', array('label' => 'Choisissez votre mot de passe'));?>
        <?= $this->Form->input('password-confirm', array('type' => 'password', 'label' =>  'Confirmer votre choix de mot de passe'));?>  
  
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Envoyer</button><?php echo $this->Form->end(); ?>
      </div>
      </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - CONFIRMATION -->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="confirmForm" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Êtes-vous sûr de vouloir continuer ?</h4>
      </div>
       <div class="modal-body">

       Passée cette étape, vous allez recevoir un email afin de terminer l'activation de votre compte.<br/><i class="glyphicons circle_exclamation_mark"></i> En cas de non réception, pensez à regader dans vos courriers indésirables.


       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="BtnConfirmForm" class="btn btn-primary">Confirmer</button>
      </div>

    
      
    </div>
  </div>
</div>

<!-- BOITE DE DIALOGUE - PRESENTATION JNH -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="jnh2016" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicons remove_2"></i></button>
        <h3 class="modal-title" id="myModalLabel">Les Journées Handisport 2016 • Les inscriptions sont ouvertes !</h3><h6>La Chappelle-Sur-Erdre (44) • DU 13/04 au 16/04/2016</h6>
      </div>

      <div class="modal-body">

       <div class="row">
          <div class="col-md-12">

        
          Vous êtes sur le point de vous inscrire aux Journées Nationales Handisport 2016.<br/>
          Ce formulaire est accessible aux personnes déficientes visuelles et auditives (traduction vidéo en LSF).<br/><br/>

           <b class="rge">NOUVEAU ET PRATIQUE, CETTE ANNÉE</b> <i class="glyphicons chevron-right"></i>   Inscrivez-vous individuellement ou par délégation !<br/><br/>

          1 • JE M’INFORME : Avant de vous inscrire, merci de lire attentivement le dossier d'information téléchargeable ci-dessous. Nous nous tenons à votre disposition pour vous accompagner dans votre inscription.<br/><br/>

          2 • JE ME CONNECTE A MON COMPTE EXTRANET HANDISPORT ou  JE CREE MON COMPTE<br/><br/>
          3 • JE M’INSCRIS A TITRE INDIVIDUEL<br/><br/>
          4 • J’INSCRIS DES PARTICIPANTS DANS MA DELEGATION<br/><br/><br/>
          ATTENTION <i class="glyphicons chevron-right"></i> Avant de vous inscrire, vérifiez que votre inscription n’est pas gérée par un autre utilisateur (couple, membres d’un club ou comités etc)<br/><br/>

          N'hésitez pas à nous contacter <i class="glyphicons chevron-right"></i> FFH • Anne-Flore ANGOT • 01 40 31 45 37 • lesjournees@handisport.org<br/><br/>

         



            <div align="right"><br/>
             <?= $this->Html->link('<i class="glyphicons download"></i> '.$doc_jnh['EventsDoc']['name'], 
                        $doc_jnh['EventsDoc']['url'], 
                        array('class'=>'btn btn-md btnBleu','escape' => false, 'target' => '_blank', 'title' => 'Télécharger le document', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                      );?>
            </div>
          </div>
        </div>

        <br/><br/>

        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default"  style="background-color:#333 !important">
              <div class="panel-heading" style="background-color:#333 !important; color:#FFF;"><h5>J'ai déjà un compte • Extranet Handisport</h5><h4>SE CONNECTER <i class="glyphicons chevron_down" style="font-size:80%"></i></h4></div>
              <div class="panel-body">
                <?php echo $this->Session->flash();?>
                <?= $this->Form->create('User', array(
                    'inputDefaults' => array(
                        'div' => 'control-group',       
                        'class' => 'form-control input-sm',
                        'label' => array('class' => 'control-label')
                        ),
                    'class' => 'form-horizontal'
                )); ?>
                <?= $this->Form->input('username', array('label' => 'IDENTIFIANT')); ?>
                <?= $this->Form->input('password', array('label' =>  'MOT DE PASSE'));?>
              </div>
              <div class="modal-footer"><button class="btn btn-md">ENTRER</button><?php echo $this->Form->end(); ?></div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-default"  style="background-color:#333 !important">
              <div class="panel-heading" style="background-color:#333 !important; color:#FFF;"><h5>Je n'ai pas encore de compte • Extranet Handisport</h5><h4>CRÉER VOTRE COMPTE <i class="glyphicons chevron_down" style="font-size:80%"></i></div>
              <div class="panel-body">
                <i class="glyphicons chevron-right"></i> Je crée mon compte en 2 min Chrono !<br/>
                <i class="glyphicons chevron-right"></i> Je m'inscris<br/>
                <i class="glyphicons chevron-right"></i> J'inscris d'autres personnes<br/>
                <i class="glyphicons chevron-right"></i> Je suis à tout moment le statut de mon inscription<br/>
                <i class="glyphicons chevron-right"></i> J'accède aux documents liés au JNH<br/>
              <div class="modal-footer"><button class="btn btn-md" id="btnAddUserGI" data-toggle="modal"  data-target="#newUser">CRÉER</button></div>
            </div>
          </div>
       </div>

    </div>
  </div>
</div>

