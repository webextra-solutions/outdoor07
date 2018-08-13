
<!-- TITRE PAGE -->
<?php $this ->assign('title_content', '<i class="glyphicons user" style="margin-right: 10px;"></i>'.$user['Personne']['PersonnePrenom'].' '.$user['Personne']['PersonneNom']);?>



<!-- BULLE INFO - AUCUN DROIT-UTILISATEUR AFFECTE A CE COMPTE -->
<div class="alert alert-info">
	créé(e) le : <b><?= $this->Formatage->dateHrFR($user['User']['created']);?></b> |  
	modifié le : <b><?= $this->Formatage->dateHrFR($user['User']['modified']);?></b> |  
	Dernière connexion le : <b><?= $this->Formatage->dateHrFR($user['User']['last_connexion']);?></b></div>

<!-- BULLE INFO - CREATION ET MODIFICATION -->
<? if($nbProfils == 0){?>
<div class="alert alert-warning"><i class="glyphicons ban" style="margin-right: 10px;"></i><b>ATTENTION</b> : Aucun droit-utilisateur n'a été affecté à ce compte !</div>
<? }?>

<div class="row">
<div class="col-md-10">

<?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-2 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    )); ?>


<!-- TABS -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#general" data-toggle="tab">Général</a></li>
	<!-- <li ><a href="#fonction" data-toggle="tab">Fonction</a></li> -->
	<li ><a href="#profils" data-toggle="tab">Droits-utilisateur (<?= $nbProfils;?>)</a></li>
	<? if($user['User']['rtt'] == 1){?><li ><a href="#rtts" data-toggle="tab">RTTS (<?= count($rtts);?>)</a></li><? }?>
</ul>

<div class="tab-content">

	<!-- TAB 1 - GENERAL -->
	<div class="tab-pane active" id="general">
	    <?//= $this->Form->input('structure', array('label' => 'Structure', 'id' => 'search-structure', 'placeholder' => 'Taper les premières lettres puis sélectionner dans la liste')); ?>
	    <?= $this->Form->input('username', array('label' => 'Identifiant', 'id' => 'login', 'readonly' => true)); ?>
	    <?= $this->Form->input('email', array('label' => 'Email associé à votre compte', 'placeholder' => 'Email à associer au compte')); ?>
	     <? if($this->Session->read('user_id') == 23){ echo $this->Form->input('url_depart', array('label' => 'URL après connexion', 'placeholder' => 'Ex: delegations/view/56'));} ?>
	    <?= $this->Form->hidden('personne_id', array('id' => 'PersonneId')); ?>    
    </div>

	<!-- TAB 2 - FONCTION -->
	<div class="tab-pane" id="fonction">

		<?= $this->Form->input('referent_id', array('label' => 'Votre référent FFH', 'type' => 'text', 'value' => $referent['Personne']['PersonnePrenom'].' '.$referent['Personne']['PersonneNom'])); ?>	    
    </div>


	<!-- TAB 3 - DROITS UTILISATEURS-->    
	<div class="tab-pane" id="profils">
		<table cellspacing="0">
		    <tr>
			    <th></th>
					<th>Module</th>
			        <th>Profil</th>
			        <th>Structure</th></tr>

		    <?php  $i = 1; foreach ($profils as $row): ?>
		    <tr>
		       <td width="20"><i class="glyphicons chevron-right"></i></td>
		       <td width="200"><?php  echo $row['Module']['name']; ?></td>
		       <td width="250"><?php  echo $row['Profil']['name']; ?></td>
		       <td><?php  echo $row['Structure']['name']; ?></td>
		       
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($result); ?>  
		</table>
	</div>

	<!-- TAB 4 - RTTS-->    
	<div class="tab-pane" id="rtts">

		<!-- BULLE INFO - RTT -->
		<div class="alert alert-info">
			10 Rtts / Semestre<br/>
			Votre Référent : <b><?= $referent['Personne']['PersonnePrenom'].' '.$referent['Personne']['PersonneNom'];?></b> <i class="glyphicons envelope"></i> 
		</div>

		<table cellspacing="0">
		    <tr>
			    <th></th>
			    <th></th>
					<th>RTT</th>
			        <th>Créé le</th>
			        <th>Modifié le</th>
					<th></th>
			        <th></th></tr>

		    <?php  $i = 1; foreach ($rtts as $row): ?>
		    <tr>
		       <td width="20"><i class="glyphicons chevron-right"></i></td>
		       <td width="30"><?php  echo $i++; ?></td>
		       <td width="200"><?php  echo $this->Formatage->dateFR($row['Rtt']['rtt']); ?></td>
		       <td width="250"><?php  echo $this->Formatage->dateFR($row['Rtt']['created']); ?></td>
		       <td><?php  echo $this->Formatage->dateFR($row['Rtt']['modified']); ?></td>
		       <td><?php  echo $this->Formatage->dateFR($row['Rtt']['validate']); ?></td>
		       <td align="right" width="30"> 
			        <?php if($row['Rtt']['etat'] != 1){echo $this->Html->link('<i class="glyphicons ok_2"></i> ', 
						array('action' => 'view', $row['Rtt']['id']), 
						array('class'=>'btn btn-success btn-xs','escape' => false, 'title' => 'valider le RTT', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
					);}?></td>
				<td align="right" width="30"> 
			        <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
						array('action' => 'deleteProfilUser',  $row['Rtt']['id'], $user['User']['id']), 
						array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
						'Etes-vous sûr de vouloir supprimer ce RTT ?'
					);?></td>   
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($result); ?>  
		</table>
	</div>

</div>

	

<div class="form-group">
	<div class="col col-md-9">
		<button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newProfilUser"><i class="glyphicons floppy_disk"></i> Enregistrer</button>
		<?= $this->Form->end();?>
		

		<?php if($user['User']['active'] == 0){echo $this->Html->link('Envoi email d\'activation', 
			array('action' => 'emailActiveUser',$user['User']['id']), 
			array('class'=>'btn btn-primary btn-sm','escape' => false)
		);}?>
		
		<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#newPwd"><i class="glyphicons restart"></i> Changer de mot de passe</button>	
		<? if($user['User']['rtt'] == 1){?><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newRtt"><i class="glyphicons plus"></i> Nouveau RTT</button><? }?>
		<? if($user['User']['rtt'] == 0 and $this->Session->read('profil_user_id') == 4){
			/*echo $this->Html->link('<i class="glyphicons ok_2"></i> Activer GESTION RTT', 
				array('action' => 'activeRTT',$user['User']['id']), 
				array('class'=>'btn btn-info btn-sm','escape' => false),
				'Etes-vous sûr de vouloir activer la gestion des RTT ?'
			);*/
		
		} else if($user['User']['rtt'] != 0 and $this->Session->read('profil_user_id') == 4){
			/*echo $this->Html->link('<i class="glyphicons ban"></i>  Désactiver GESTION RTT', 
				array('action' => 'removeRTT',$user['User']['id']), 
				array('class'=>'btn btn-danger btn-sm','escape' => false),
				'Etes-vous sûr de vouloir désactiver votre gestion des RTT ?'
			);*/
		}?>

		
		
	</div>
</div>

</div>



<div class="col-md-2" align="right">

    <div style="border-radius:5px; border:1px solid #CCC; width:82px;" align="center">
    <? if(!empty($user['Personne']['Annuaire']['photo_thumb'])){ 

      //echo $this->Image->resize($person['Annuaire']['photo'],100, 100, array(), 200);
        echo $this->Html->image($user['Personne']['Annuaire']['photo_thumb'], array('width' => '80', 'alt' => 'Photo', 'border' => '0'));
    } else {
    	if($user['Personne']['civilite'] == 'M'){ echo '<i class="glyphicons user" style="font-size:630%;"></i>'; } else { echo '<i class="glyphicons woman" style="font-size:630%;"></i>';}
    }?>

    </div>
  	<? if($this->Session->read('Auth.User.id') == 23){?>
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" title="Ajouter / Remplacer la photo" data-target="#modifPhoto" data-toggle = "tooltip" data-placement = "bottom"><i class="glyphicons pencil"></i></button>
      <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
              array('controller' => 'annuaires', 'action' => 'deletePhoto', $user['Personne']['Annuaire']['id'],1), 
              array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
              'Etes-vous sûr de vouloir supprimer cette photo ?'
          );?>
   <? }?>


	
	
</div>
</div>




<!-- BOITE DE DIALOGUE - NOUVEAU MOT DE PASSE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newPwd" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Changer votre mot de passe</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('User', array(
      	'action' => 'changePwdUser',
        'inputDefaults' => array(
            'div' => 'form-group',
           'label' => array(
                'class' => 'col col-md-5 control-label'
            ),
            'wrapInput' => 'col col-md-6',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    	)); ?>
   	 <?= $this->Form->input('password-old', array('label' => 'mot de passe actuel', 'placeholder' => 'Entrer ici votre mot de passe actuel', 'value' => ''));?><hr/>
   	 <?= $this->Form->input('password', array('label' => 'Nouveau mot de passe', 'placeholder' => 'Entrer ici votre nouveau mot de passe', 'value' => ''));?>
   	 	<?= $this->Form->input('password-confirm', array('type'=> 'password', 'label' => 'Confirmer nouveau mot de passe', 'placeholder' => 'Confirmer ici votre nouveau mot de passe', 'value' => ''));?>
     
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

<!-- BOITE DE DIALOGUE - NOUVEAU RTT-->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newRtt" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Nouveau RTT</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('Rtt', array(
      	'action' => 'addRTT',
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
	   	<?= $this->Form->input('rtt', array( 
	        'type' => 'text',
	        'placeholder' => 'dd/mm/aaaa',
	        'label' => 'Date du RTT',
	        'beforeInput' => '<div id="now"><div class="input-group date">',
	        'afterInput' => '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></div></div>'
	    ));?>
     
      <?= $this->Form->hidden('user_id', array('value' => $user['User']['id'])); ?>
	
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





