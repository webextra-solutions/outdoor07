<? 
$module1 = $this->requestAction('modules/index');
$module2 = $this->requestAction('modules/index3');
$profil = $this->requestAction('profils/index');
$nbProfil = $this->requestAction('profils/index4');
$profils_list = $this->requestAction('profils/index5');


?>



<div id="menuTop2">

<div class="type_module">


   <div class="module-logo">


        <?= $this->Html->Image('logos/logo_outdoor.png', array('width' => 68)); ?>
     
      
    </div>


  <div class="module-titre">


   
       <div>Espace <br/>Dirigeants</div>
    </div>



  <?php foreach ($module1 as $row): ?>


  	<div <? if(($this->request->controller == $row['Module']['controller'] or $row['Module']['id'] == $this->Session->read('module_id')) and ($this->Session->read('module_id') != 6)){?>class="module<?= $row['ProfilR']['module_id'];?>"<?} else {?> class="module"<? }?>>
  		<?php echo $this->Html->link(
  				' <div style="margin: 14px 0 8px 0; font-size: 22px; color: #000;"><i class="glyphicons '.$row["Module"]["icone"].'"></i></div>
          <div>'.$row['Module']['name2'].'</div>',
  				array('controller' => $row['Module']['controller'], 'action'=>$row['Module']['action'], $row['Module']['id']),
  				array('escape' => false)
  		);?>
  	</div>
  <?php endforeach; ?>
  <?php unset($result); ?>

  <div class="module">
     <?php echo $this->Html->link(
        '<div style="margin: 14px 0 8px 0; font-size: 22px; color: #000;"><i class="glyphicons group"></i></div><div>Espace Parents</div>',
        array('controller' => 'seances', 'action'=>'presence'),
        array('escape' => false, 'target' => 'blank','data-placement' => 'bottom')
    );?>
    </div>


   <?php foreach ($module2 as $row): ?>
     <div class="module">
     <?php echo $this->Html->link(
        '<div style="margin: 14px 0 8px 0; font-size: 22px; color: #000;"><i class="glyphicons '.$row["Module"]["icone"].'"></i></div><div>'.$row['Module']['name2'].'</div>',
        array('controller' => $row['Module']['controller'], 'action'=>$row['Module']['action'], $row['Module']['id']),
        array('escape' => false,'title'=>$row['Module']['name'], 'data-placement' => 'bottom')
    );?>
    </div>
  <?php endforeach; ?>
<?php unset($result); ?>




  <!-- <div  style="float: left;" width="auto" align="center">
    <?//= $this->Html->Image('crussol.JPG', array('width' => 400, 'height'=> 80)); ?>
  </div> -->



 


</div>


<div class="type_extranet"> 

  <div id="connect_infos" >

    <div style="float:left; padding:3px 15px 5px 0; border-radius: 50%;">

      <img src="<?= $this->Formatage->photoThumb($profil['User']['Personne']['photo_thumb']);?>" width="40" alt="" data-original-title="" title="" style="border-radius: 50%;">

</div>
    <div style="float:left; <? if($nbProfil == 1){ ?>padding-right:25px;<? }?>">
      <? //setlocale(LC_TIME, 'fr_FR'); echo $this->Time->format(date('Y-m-d H:i:s'), '%A %e %B %Y - %H:%M');?>
       <b><?= $this->Session->read('prenom_nom_user');?></b><br/>  
      <?= $profil['Profil']['name'];?><? if(!empty($profil['Structure']['name'])){?> - <?= $profil['Structure']['name'];}?> <br/>
     <i>connecté</i>
      
    </div>
      
    <? if($nbProfil > 1){ ?>
    <div style="float:left; margin:auto; padding:15px 0 10px 15px;" align="center">
      <button type="button" title="Changer de profil" class="btn btn-default btn-xs" "data-toggle" = "tooltip", "data-placement" = "bottom" data-toggle="modal" data-target="#changeProfilUser">
        <span class="glyphicons transfer x2"></span>
      </button>
    </div>
    <? }?>


     <div id="power" style="float:right; padding:15px 5px 15px 0;" title="Se déconnecter">


      <?php echo $this->Html->link(
          ' <i class="glyphicons power x2"></i>',
          array('controller' => 'users', 'action'=>'logout'),
          array('escape' => false, 'title' => 'Se déconnecter')
      );?>

      

</div>




  </div>	

 

	

</div>


		



</div>

<? if($this->Session->read('module_id')!=0){?>
<!-- BOITE DE DIALOGUE - CHANGEMENT DROIT UTILISATEUR -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="changeProfilUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Changer de droit-utilisateur</h4>
      </div>
      <div class="modal-body" align="center">
      

 
      <?php foreach ($profils_list as $row):?>

        <?if(empty($row['Structure']['name'])){$structure = 'Aucune Structure';}else {$structure = $row['Structure']['name'];}?>
        <?= $this->Form->postLink('<i class="glyphicons hand_down x2"></i><br/><h7>'.$row['Profil']['name'].'<br/><b>'.$structure.'</b></h7> ', 
                array('controller' => 'users', 'action' => 'changeProfilUser2', $row['ProfilR']['id']), 
                array(
                    'class'=>'btn2 btn2-default',
                    'escape' => false, 
                    'data-toggle'=>'tooltip', 
                    'data-placement'=>'left'
                )
        );?>
           
      <? endforeach; ?>
  

   	
     
	
      </div>
      
    </div>
  </div>
</div>

<? } else {?>

<!-- BOITE DE DIALOGUE - CHANGEMENT DROIT UTILISATEUR -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="changeProfilUser" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Changer de droit-utilisateur</h4>
      </div>
      <div class="modal-body">
      <?= $this->Form->create('User', array(
        'action' => 'changeProfilUser',
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

      <label class="col col-md-3 control-label">Droit-utilisateurs</label>
      <div class="col col-md-9">
        <select name="data[ProfilR][id]" class="form-control input-sm" id="ProfilRId">
          <option value>Sélectionnez</option>
          <?php foreach ($profils_list as $row):?>
            <option value="<?= $row['ProfilR']['id'];?>"><?= $row['Profil']['name'];?> <?= $row['Structure']['name'];?></option>
          <? endforeach; ?>
        </select>
      </div>

     
    
      <?= $this->Form->hidden('ProfilR.selected', array('value' => 1)); ?>
  
     
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Changer</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

<? }?>





