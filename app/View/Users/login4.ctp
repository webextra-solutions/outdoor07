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

        
      <? if($id == 1){?> 
      $("#login").modal();
      <? }?>


      
      $('#newUser').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
      })

      $('#newUser').on('hidden.bs.modal', function (e) {
        $("#login").modal('show');
      })

      $('#lostPwd').on('show.bs.modal', function (e) {
        $("#login").modal('hide');
      })

      $('#lostPwd').on('hidden.bs.modal', function (e) {
        $("#login").modal('show');
      })

        
   

      

              
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
          <a href="https://videos.handisport.org" target="_blank">
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
        <h3 class="modal-title" id="myModalLabel">Créer un compte</h3>
      </div>

      <div class="modal-body">

       <?= $this->Form->create('Signup', array(
          'controller' => 'signups',
          'action' => 'signup',
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
             
        <?= $this->Form->input('licence_ffh', array(
                      'options' => array(1 => 'Oui',0 => 'Non'),
                      'empty' => 'Sélectionner', 
                      'label' => 'Êtes-vous (ou avez-vous été) licencié à la FFH ?',
                      'class' => 'form-control input-sm'
                  ));?>



        <?= $this->Form->input('email', array('placeholder' => '')); ?>
        <?= $this->Form->input('structure', array('label' =>  'Votre structure', 'placeholder' => 'ex : Comité Handisport du Rhône'));?><hr/>

        

        <?= $this->Form->input('demande', array('label' =>  'Précisions', 'type'=>'textarea', 'placeholder' => 'Décrivez brièvement l\'objet de votre demande en expliquant, notamment, les motifs des modules souhaités',));?>

        
        <hr/>
        <div class="form-group">
        <label class="col col-md-4 control-label"></label>
        <div class="col col-md-8">

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
    <div class="modal-footer"> <button   type="submit" class="btn btn-md">ENVOYER</button><?php echo $this->Form->end(); ?></div>

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



