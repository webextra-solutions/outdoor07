
<?php $this ->assign('title_content', 'Menu <i class="glyphicons chevron-right"></i> Module '.$module['Module']['name'].' <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#newMenu"><i class="glyphicons plus"></i></button>');?>




<table cellspacing="0">
    <tr >
        <th>ID</th>
        <th>ICONE</th>
        <th>LIBELLE</th>
        <th>ORDRE</th>

        <th></th>
        <th></th>
    </tr>

    <?php  $i = 1; foreach ($menus as $row): ?>
    <tr>

       	<td width="30px"><?php  echo $row['Menu']['id']; ?></td>
        <td width="40px"><i class="glyphicons <?= $row['Menu']['icone'];?>" title="Information"></i></td>
        <td class="lien menus" rel="<?= $row['Menu']['id']; ?>"><?php  echo $row['Menu']['name']; ?></td>
        <td><?php  echo $row['Menu']['order']; ?></td>
 
       <td align="right" width="30"><button type="button" class="btn btn-default btn-xs menus" rel="<?= $row['Menu']['id']; ?>"><i class="glyphicon glyphicons zoom_in"></i></button></td>
        <td align="right" width="30"> 
            <?php 
            
            echo $this->Form->postLink('<i class="glyphicons bin"></i> ', 
                array('controller' => 'menus', 'action' => 'delete', $row['Menu']['id'], $module['Module']['id']), 
                array(
                    'class'=>'btn btn-danger btn-xs',
                    'escape' => false, 
                    'title' => 'supprimer', 
                    'data-toggle'=>'tooltip', 
                    'data-placement'=>'left'),
                  
                'Etes-vous sûr de vouloir supprimer ce menu ?'
            );?>

        </td>      

       
    </tr>
    
    
    
    <?php endforeach; ?>
    <?php unset($result); ?>

</table>

<!-- BOITE DE DIALOGUE - NOUVEAU MENU-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="newMenu" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-plus-sign"></i> Nouveau menu</h4>
      </div>
      <div class="modal-body">


        <?= $this->Form->create('Menu', array(
            'controller' => 'menus',
            'action' => 'add',
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


    <?= $this->Form->hidden('Menu.module_id', array('value' => $module['Module']['id']));?>

    <?= $this->Form->input('Menu.name', array('label' => 'Libellé')); ?>
    <hr/>
    <?= $this->Form->input('active', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Actif </label>',
            'label' => false,
            'class' => false
        ));
    ?>

    <?= $this->Form->input('new', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Nouveau !</label>',
            'label' => false,
            'class' => false
        ));
    ?>

    <?= $this->Form->input('blank', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Ouverture dans une nouvelle fenêtre </label>',
            'label' => false,
            'class' => false
        ));
    ?>
    <hr/>

    <?= $this->Form->input('Menu.controller', array('label' => 'Controlleur')); ?>
    <?= $this->Form->input('Menu.action', array('label' => 'Action')); ?>
    <?= $this->Form->input('Menu.icone', array('label' => 'Icone')); ?>

    <?= $this->Form->input('Menu.order', array('label' => 'Ordre')); ?>
    <hr/>    

     <?= $this->Form->input('Profil', array(
        'multiple' => 'checkbox',
        'before' => '<label class = "col col-md-3 control-label">Profils concernés</label>',
        'label'=> false
        )); ?> 


    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - VOIR LE MENU -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="voirMenu" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="ajaxData">
        

          
        </div>
        
    </div> 
</div>

