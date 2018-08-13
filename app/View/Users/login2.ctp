<div id="image_fond"><?= $this->Html->image('fonds/fond_kake.jpg', array('width' => '100%', 'height' => 'auto'))?></div>

<div class="col-md-3" id="private">

  <div id="connect_extranet">

    <div align="left">
      <?php echo $this->Html->link(
              //$this->Html->image('headers/header.png', array('alt' => '', 'border' => '0')),
              $this->Html->image('logos/ffh_horiz.png', array('alt' => 'logo ffh', 'border' => '0', 'width' => 200)),
              array('action'=>'login','title' => 'Extranet Handisport V3 - Version en développement'),
              array('escape' => false)
            );
      ?>
    </div>
    <br/>
    <br/>


<div class="titleConnexion"><b>Connexion extranet</b></div>

<div class="sous_titre">Gérer vos évenements handisport</div>


<?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',       
            'class' => 'form-control',
            'disabled' => false
        )
    )); ?>

  
    <?= $this->Form->input('username', array('label' => 'IDENTIFIANT')); ?>
    <?= $this->Form->input('password', array('label' =>  'MOT DE PASSE'));?>

    <button   type="submit" class="btn btn-md">ENTRER</button>

    <?php echo $this->Form->end(); ?>
    <br/>
    <br/>
    <br/>
    <hr/>
    <div class="btn2" data-toggle="modal" data-target="#newUser">CRÉER UN COMPTE</div>
    <hr/>
    <div class="btn2" data-toggle="modal" data-target="#lostPwd">IDENTIFIANT / MOT DE PASSE OUBLIÉ</div>
    <hr/>
    
</div>

<div id="connect_extranet_formation">

  <div class="titleConnexion"><b>Connexion<br/>extranet formation</b></div>
  <a href="https://extranet2.handisport.org/cnfh/login.php" target="_blank"><div class="btn3">CLIQUEZ ICI</div></a>

</div>

</div>


<div   class="col-md-9" id="public">


<div id="bloc_outils">

  <div class="titlePublic"><b>Accès direct</b> <i class="glyphicons chevron-right"></i> Vos outils en ligne</div>

  <hr/>

  <div id="col_left">
     <!-- CALENDRIER EVENEMENTS HANDISPORT -->
    <a href="https://extranet.handisport.org/events/calendar" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons calendar"></i></div>
        <div>
          <h4>CALENDRIER DES ÉVÉNEMENTS</h4>
          <span class="detail_module">Tous les évènements handisport en France en 1 clic !<br/>Descriptions, compte-rendus, résultats,...</span>
        </div>
      </div>
    </a> 

    <!-- OU PRATIQUER -->
    <a href="https://annuaire.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons map"></i></div>
        <div>
          <h4>OÙ PRATIQUER ?</h4>
          <span class="detail_module">Trouver un club près de chez vous<br/>Contacter un comité régional ou départemental</span>
        </div>
      </div>
    </a>

    <!-- LICENCES HANDISPORT -->
    <a href="https://licences.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons group"></i></div>
        <div>
          <h4>LICENCES / AFFIALITIONS / LABEL CLUB</h4>
          <span class="detail_module">Consulter et modifier les données concernant votre structure<br/> handisport, candidater au label club</span>
        </div>
      </div>
    </a>

    <!-- WEB MAIL-->
    <a href="https://webmail.handisport.org/owa" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons envelope"></i></div>
        <div>
          <h4>WEBMAIL @handisport.org</h4>
          <span class="detail_module">Accéder à votre messagerie handisport<br/>Lien officiel entre votre structure et la fédération</span>
        </div>
      </div>
    </a>
    
  </div>
 
  <div id="col_right">
     <!-- SITE WEB -->
    <a href="http://www.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons cluster"></i></div>
        <div>
          <h4>SITE WEB / WWW.HANDISPORT.ORG</h4>
          <span class="detail_module">Site officiel de la fédération<br/>Actualités, tout savoir sur handisport.</span>
        </div>
      </div>
    </a> 

    <!-- OU SE fORMER -->
    <a href="https://formations.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons calendar"></i></div>
        <div>
          <h4>OÙ SE FORMER ? LE CALENDRIER</h4>
          <span class="detail_module">Trouver une formation<br/>S'inscrire en ligne aux prochaines sessions</span>
        </div>
      </div>
    </a>

    <!-- AGORA -->
    <a href="https://agora.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons conversation"></i></div>
        <div>
          <h4>AGORA</h4>
          <span class="detail_module">Espace collaboratif handisport<br/>Partage d'idée, mutualisation des compétences</span>
        </div>
      </div>
    </a>

    <!-- MISSIONS FEDERALES -->
    <a href="https://missions.handisport.org" target="_blank">
      <div class="row">
        <div class="cercle" align="center"><i class="glyphicons handshake"></i></div>
        <div>
          <h4>MISSIONS FÉDÉRALES</h4>
          <span class="detail_module">Déclaration obligatoire :<br/>Mission à l'étranger, réprésentation fédérale</span>
        </div>
      </div>
    </a>

  </div>

  
  <div id="footer_login" align="center" >
      
          Développement <i class="glyphicons chevron-right"></i> © Fédération Française Handisport | version 3.0 | 2015 | Contact :
         <?php  echo $this->Text->autoLinkEmails('<i class="glyphicon glyphicon-envelope"></i> extranet@handisport.org', array('escape' => false));?>     
    </div>
 

  
</div>


</div>



