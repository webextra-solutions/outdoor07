
<!-- TITRE PAGE -->
<?php $this ->assign('title_content', $user['Personne']['FN']);?>

<!-- BOUTONS - TITRE -->
<?= $this ->assign('button_content', 
'<div class="button-content">'.$this->Html->link('<button type="button" title="retour à la liste des comptes" class="btn btn-default btn-sm" "data-toggle" = "tooltip", "data-placement" = "bottom">
  <span class="glyphicons left_arrow"></span>
</button>', array('action' => 'index',5), array('escape'=>false)).'</div>');?>

<!-- BULLE INFO - AUCUN DROIT-UTILISATEUR AFFECTE A CE COMPTE -->
<div class="alert alert-info">
	créé(e) le : <b><?= $this->Formatage->dateHrFR($user['User']['created']);?></b> |  
	modifié le : <b><?= $this->Formatage->dateHrFR($user['User']['modified']);?></b> |  
	Dernière connexion le : <b><?= $this->Formatage->dateHrFR($user['User']['last_connexion']);?></b></div>

<!-- BULLE INFO - CREATION ET MODIFICATION -->
<? if($nbProfils == 0){?>
<div class="alert alert-warning"><i class="glyphicon glyphicon-exclamation-sign" style="margin-right: 10px;"></i><b>ATTENTION</b> : Aucun droit-utilisateur n'a été affecté à ce compte !</div>
<? }?>

<?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-1 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    )); ?>

    <?= $this->Form->hidden('Personne.id');?>
    <?= $this->Form->hidden('id');?>

<div class="row">
<div class="col-md-10">

<!-- TABS -->
<ul class="nav nav-tabs">
	<li <?if($tabActive == 0){?>class="active"<? }?>><a href="#general" data-toggle="tab">Général</a></li>
	<li <?if($tabActive == 1){?>class="active"<? }?>><a href="#profils" data-toggle="tab">Droits-utilisateur (<?= $nbProfils;?>)</a></li>
	<? if($this->Session->read('user_id') == 1){?><li <?if($tabActive == 2){?>class="active"<? }?>><a href="#connections" data-toggle="tab">Connexions</a></li><? }?>
</ul>

<div class="tab-content">

	<!-- TAB 1 - GENERAL -->
	<div class="tab-pane <?if($tabActive == 0){?>active<? }?>" id="general">
	    <?//= $this->Form->input('structure', array('label' => 'Structure', 'id' => 'search-structure', 'placeholder' => 'Taper les premières lettres puis sélectionner dans la liste')); ?>
	    <? if($this->Session->read('user_id')==23){?><?= $this->Form->input('annuaire_id', array('label' => 'Annuaire ID','type' => 'text')); ?><? }?>
	    <?= $this->Form->input('username', array('label' => 'Identifiant', 'id' => 'login')); ?>


	    <? 
	    $type_email = explode('@',$user['User']['email']);
	    if($type_email[1] =='v2-formation.fr'){?>

	    <div class="alert-danger"><br/>
	    	<?= $this->Form->input('email', array('placeholder' => 'Email à associer au compte','label' => 'Email<br/>ATTENTION • Email factice')); ?>
	    </div>

	    <?} else{?>
	    	<?= $this->Form->input('email', array('placeholder' => 'Email à associer au compte')); ?>
	    <? }?>

	     <? if($this->Session->read('user_id')==23){?>
	     <?= $this->Form->input('personne_id', array('label' => 'Personne ID','type' => 'text')); ?>
	     <?} else{?>
	    <?= $this->Form->hidden('personne_id', array('id' => 'PersonneId')); ?><? }?>
	    
	    <?= $this->Form->input('active', array(
		        'wrapInput' => 'col col-md-9 col-md-offset-1',
		        'label' => array('class' => null),
		        'class' => false,
		        'type' => 'checkbox'
		    ));		
		?>
    </div>

	<!-- TAB 2 - DROITS UTILISATEURS-->    
	<div class="tab-pane <?if($tabActive == 1){?>active<? }?>" id="profils">
		<table cellspacing="0">
		    <tr>
			    <th></th>
			    <th></th>
					<th>Module</th>
			        <th>Profil</th>
			        <th>Structure</th>
					<th></th>
					<th></th>
			</tr>

		    <?php  $i = 1; foreach ($profils as $row): ?>
		    <tr >
		       <td width="20"><? if($row['ProfilR']['active'] == 1){?><i class="glyphicons ok_2" title="profil actif"></i><?} else {?><i class="glyphicons ban" title="profil inactif"></i><? }?></td>
		       <td width="20"><?php if ($row['ProfilR']['alertes_email'] == 1): ?><i class="glyphicons electricity"></i><?php endif ?></td>
		       <td width="200"><?php  echo $row['Module']['name']; ?></td>
		       <td width="250" <? if($this->Session->read('user_id')==	1){?>class="lien profilUser" rel="<?= $row['ProfilR']['id']; ?>"<? }?>><?php  echo $row['Profil']['name']; ?></td>
		       <td><?php  echo $row['Structure']['name']; ?></td>
		       <td align="right" width="30"><? if($this->Session->read('user_id')==	1){?><button type="button" class="btn btn-default btn-xs profilUser" rel="<?= $row['ProfilR']['id']; ?>"><i class="glyphicons zoom_in"></i></button><? }?></td> 
		       
				<td align="right" width="30"> 
					<? if($this->Session->read('user_id')==	1){?>
				        <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
							array('action' => 'deleteProfilUser',  $row['ProfilR']['id'], $user['User']['id']), 
							array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
							'Etes-vous sûr de vouloir supprimer ce droit-utilisateur ?'
						);?>
					<? }?>  
				</td> 
				
			
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($result); ?>  
		</table>
	</div>

	<? if($this->Session->read('user_id') == 1){?>
	<!-- TAB 3 - CONNECTIONS-->    
	<div class="tab-pane <?if($tabActive == 2){?>active<? }?>" id="connections">
		<table cellspacing="0">
		    <tr >
				<th></th>
				<th><?php echo $this->Paginator->sort('created', 'Date'); ?></th>

		        <th>Controlleur</th>
		        <th>Action</th>
		        <th>Profil Utilisateur</th>
		        
		   

		        <? if($this->Session->read('super_admin') == 1){?>
		        <th></th>
		        <? }?>
		    </tr>

		    <?php  $i = 1; foreach ($connections as $row): ?>
		    <tr>
		    	
		       	<td width="20px"><i class="glyphicons chevron-right"></i></td>
		       	<td width="130px"><?php  echo $this->Formatage->dateHrFR($row['Connection']['created']); ?></td>
		        <td><?php  echo $row['Connection']['controller']; ?></td>
		        <td><?php  echo $row['Connection']['action']; ?></td>
		        <td><?php  echo $row['ProfilR']['Profil']['name'].' - '.$row['ProfilR']['Structure']['name']; ?></td>
		        
		    </tr>
		    
		    
		    
		    <?php endforeach; ?>
		    <?php unset($result); ?>
   
		</table>
	</div>
	<? }?>

</div>

</div>



	

<div class="form-group">
	<div class="col col-md-9">
		<button type="submit" class="btn btn-primary btn-sm"><i class="glyphicons floppy_disk"></i> Enregistrer</button>
		<?= $this->Form->end();?>
		

		<?php if($user['User']['active'] == 0){echo $this->Html->link('<i class="glyphicons envelope"></i> Envoi email d\'activation', 
			array('action' => 'emailActiveUser',$user['User']['id']), 
			array('class'=>'btn btn-warning btn-sm','escape' => false),
			'Etes-vous sûr de vouloir envoyer l‘email d‘activation ?'
		);}?>

	
		
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newProfilUser"><i class="glyphicons plus"></i> Nouveau droit-utilisateur</button>



		
			
		<?php echo $this->Html->link('<i class="glyphicons bin"></i> Supprimer le compte', 
			array('action' => 'delete',$user['User']['id']), 
			array('class'=>'btn btn-danger btn-sm','escape' => false),
			'Etes-vous sûr de vouloir supprimer ce compte-utilisateur ?'
		);?>

		<? echo $this->Html->link('<i class="glyphicons user"></i> Fiche personne', 
			array('controller' => 'personnes', 'action' => 'view',$user['Personne']['id']), 
			array('class'=>'btn btn-primary btn-sm','escape' => false)
		);?>
	</div>
</div>




<!-- BOITE DE DIALOGUE - NOUVEAU DROIT UTILISATEUR -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="newProfilUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nouveau droit-utilisateur</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('User', array(
      	'action' => 'addProfilUser',
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
   	 <?= $this->Form->input('ProfilR.module_id', array(
          'options' => $modules_list,
          'empty' => 'Sélectionner', 
          'label' => 'Module',
          'class' => 'form-control input-sm'
      ));?>

   	 <?= $this->Form->input('ProfilR.profil_id', array(
          'options' => $profils_list,
          'empty' => 'Sélectionner', 
          'label' => 'Profil',
          'class' => 'form-control input-sm'
      ));?>

      <?= $this->Form->input('structure', array('label' => 'Structure', 'id' => 'search-structure2', 'placeholder' => 'Taper les premières lettres puis sélectionner dans la liste')); ?>
      <?= $this->Form->hidden('ProfilR.structure_id', array('id' => 'StructureId')); ?>
      <?= $this->Form->hidden('ProfilR.user_id', array('value' => $user['User']['id'])); ?>
      <?= $this->Form->hidden('id', array('value' => $user['User']['id'])); ?>
      <?= $this->Form->hidden('selected', array('value' => 1)); ?>

      <?= $this->Form->hidden('ProfilR.alertes_email', array('value' => 1)); ?>

      <?= $this->Form->input('ProfilR.active', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Actif</label>',
            'label' => false,
            'class' => false
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

<!-- BOITE DE DIALOGUE - VOIR LE PROFIL UTILISATEUR-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="voirProfilUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="ajaxProfilUser"></div>       
    </div> 
</div>


<!-- BOITE DE DIALOGUE - NOUVEL PHOTO -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="modifPhoto" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Ajouter / Remplacer votre photo</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('Annuaire', array(
      	'action' => 'changePhoto',
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
     	<?= $this->Form->hidden('Annuaire.from_profil', array('value' => 1));?>

    	<?= $this->Form->input('Annuaire.id', array('value' => $user['Personne']['Annuaire']['id']));?>

  		<?= $this->Form->input('Annuaire.photo', array(
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










