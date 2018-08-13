<script type="text/javascript">    
    $(function(){
        
      // Recherche Structure
      $('#searchEventForTab').autocomplete({
        minLength    : 3,
        source        : serveur+'/events/searchMyEvent',
        select:  function(event, ui) { 
          $('#EventId').val(ui.item.id);
        },
        appendTo : '#newTabR'
      }); 

      // BOITE DE DIALOGUE - Voir Stat
        $(".tabs").click(function(){
        $("#voirTabR").modal();
        $.get(serveur+'/tabs/viewTabR',{id : $(this).attr("rel")},function(data){
                $('#ajaxDataTabR').empty().append(data);
        });
        return false;
});



    });
</script>

<?php $this ->assign('title_content', 'Tabs');?>  



<ul class="nav nav-tabs">
    <li <? if($tabActive == 0){?>class="active"<? }?>><a href="#tabsR" data-toggle="tab" id="0">Tabs R <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#newTabR"><i class="glyphicons plus"></i></button></a></li>  
    <li <? if($tabActive == 1){?>class="active"<? }?>><a href="#tabsList" data-toggle="tab" id="1">Tabs <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#newTab"><i class="glyphicons plus"></i></button></a></li>
    
</ul>

<div class="tab-content">

    <!-- TAB - TAB -->
    <div class="tab-pane <?if($tabActive == 1){?>active<? }?>" id="tabsList">       
        <table cellspacing="0">
            <tr >
                <th></th>
                <th><?php echo $this->Paginator->sort('name', 'LIBELLE'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id', 'DECLARE PAR'); ?></th>
                <th><?php echo $this->Paginator->sort('created', 'CREATION'); ?></th>
                <th><?php echo $this->Paginator->sort('modified', 'MODIFICATION'); ?></th>
                <th></th>
                <th></th>
            </tr>

            <?php  $i = 1; foreach ($tabs as $row): ?>
            <tr>               
                <td width="20"><i class="glyphicons chevron-right"></i></td>
                <td class="lien tabs" rel="<?= $row['Tab']['id']; ?>"><?= $row['Tab']['name']; ?></td>
                <td><?= $row['User']['Personne']['FN']; ?></td>
                
                <td><?php  echo $this->Formatage->dateFR($row['Tab']['created']); ?></td>
                <td><?php  echo $this->Formatage->dateFR($row['Tab']['modified']); ?></td>
                <td align="right" width="30"><button type="button" class="btn btn-default btn-xs tabs<? if($this->Session->read('profil_id') != 4){?>2<? }?>" rel="<?= $row['Tab']['id']; ?>"><i class="glyphicons zoom_in"></i></button></td>
                <?php if ($this->Session->read('profil_id') == 4): ?>
                    <td align="right" width="30"> 
                        <?= $this->Form->postLink('<i class="glyphicons bin"></i> ', 
                                array('action' => 'delete', $row['Tab']['id']), 
                                array(
                                    'class'=>'btn btn-danger btn-xs',
                                    'escape' => false, 
                                    'title' => 'supprimer', 
                                    'data-toggle'=>'tooltip', 
                                    'data-placement'=>'left'),
                                'Etes-vous sûr de vouloir supprimer cette tabs ?'
                        );?>
                    </td>
                <?php endif ?>                    
            </tr>
            <?php endforeach; ?>
            <?php unset($result); ?>
        </table>
    </div>

    <!-- TAB - TABR -->
    <div class="tab-pane <?if($tabActive == 0){?>active<? }?>" id="tabsR">   

    <!-- NAV BAR RECHERCHE -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?= $this->Form->create('Tab', array(
                    'id'=>'UserFilter',
                    'inputDefaults' => array('div' => 'form-group'),
                    'class' => 'navbar-form navbar-left'
                )); ?>


                    <div class="form-group">  

                        <?= $this->Form->input('controller', array(
                                  'options' => $controllers,
                                  'empty' => 'Sélectionner', 
                                  'label' => false,
                                  'class' => 'form-control input-sm',
                                  'id' => 'controller'
                                ));
                        ?>

                        <?= $this->Form->input('action', array(
                                  'options' => $actions,
                                  'empty' => 'Sélectionner', 
                                  'label' => false,
                                  'class' => 'form-control input-sm',
                                  'id' => 'action'
                                ));
                        ?>

                        <?= $this->Form->input('tab', array(
                                  'options' => $this->Listes->Liste('Tab', 'name','id'),
                                  'empty' => 'sélectionner', 
                                  'label' => false,
                                  'class' => 'form-control input-sm',
                                  'id' => 'tab'
                                ));
                        ?>

                         <?= $this->Form->input('event_id', array(
                                  'options' => $events,
                                  'empty' => 'sélectionner', 
                                  'label' => false,
                                  'class' => 'form-control input-sm',
                                  'id' => 'event'
                                ));
                        ?>
         
                    <input type="button" id="reset" class="btn btn-default btn-sm" value="Effacer" />
                    <input type="submit" class="btn btn-primary btn-sm" value="Appliquer" /></div>

                <?= $this->Form->end();?>

      
            </div>

         

        </div>

        <!-- /.container-fluid -->
    </nav>  

    
        <table cellspacing="0">
            <tr >
                <th></th>
                <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?php echo $this->Paginator->sort('order', 'ORDER'); ?></th>
                <th><?php echo $this->Paginator->sort('event_id', 'EVENT'); ?></th>
                <th><?php echo $this->Paginator->sort('controller', 'CONTROLLER'); ?></th>
                <th><?php echo $this->Paginator->sort('action', 'ACTION'); ?></th>
                <th><?php echo $this->Paginator->sort('name', 'LIBELLE'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id', 'DECLARE PAR'); ?></th>
                <th><?php echo $this->Paginator->sort('created', 'CREATION'); ?></th>
                <th><?php echo $this->Paginator->sort('modified', 'MODIFICATION'); ?></th>
                <th></th>
                <th></th>
            </tr>

            <?php  $i = 1; foreach ($tabsR as $row): ?>
            <tr>               
                <td width="20"><i class="glyphicons chevron-right"></i></td>
                <td><?= $row['TabR']['id']; ?></td>
                <td><?= $row['TabR']['order']; ?></td>
                <td><?= $row['Event']['name']; ?></td>
                <td><?= $row['TabR']['controller']; ?></td>
                <td><?= $row['TabR']['action']; ?></td>
                <td class="lien tabs" rel="<?= $row['TabR']['id']; ?>"><?= $row['Tab']['name']; ?></td>
                <td><?= $row['User']['Personne']['FN']; ?></td>
                
                <td><?php  echo $this->Formatage->dateFR($row['Tab']['created']); ?></td>
                <td><?php  echo $this->Formatage->dateFR($row['Tab']['modified']); ?></td>
                <td align="right" width="30"><button type="button" class="btn btn-default btn-xs tabs" rel="<?= $row['TabR']['id']; ?>"><i class="glyphicons zoom_in"></i></button></td>
                <?php if ($this->Session->read('profil_id') == 4): ?>
                    <td align="right" width="30"> 
                        <?= $this->Form->postLink('<i class="glyphicons bin"></i> ', 
                                array('action' => 'deleteTabR', $row['TabR']['id']), 
                                array(
                                    'class'=>'btn btn-danger btn-xs',
                                    'escape' => false, 
                                    'title' => 'supprimer', 
                                    'data-toggle'=>'tooltip', 
                                    'data-placement'=>'left'),
                                'Etes-vous sûr de vouloir supprimer cette tabR ?'
                        );?>
                    </td>
                <?php endif ?>                    
            </tr>
            <?php endforeach; ?>
            <?php unset($result); ?>
        </table>
    </div>


</div>





<!-- BOITE DE DIALOGUE - VOIR LA TABR -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="voirTabR" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="ajaxDataTabR">
        
        </div>
        
    </div> 
</div>

<!-- BOITE DE DIALOGUE - NOUVELLE TAB-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="newTab" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-plus-sign"></i> Nouvelle Tab</h4>
      </div>
      <div class="modal-body">


        <?= $this->Form->create('Tab', array(
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
        <?= $this->Form->hidden('Tab.user_id', array('value' => $this->Session->read('user_id'))); ?>
        <?= $this->Form->input('Tab.name', array('label' => 'Libellé')); ?>
        <?= $this->Form->input('Tab.name2', array('label' => 'Libellé 2')); ?> 

    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>


<!-- BOITE DE DIALOGUE - NOUVELLE TAB-->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" id="newTabR" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-plus-sign"></i> Nouvelle TabR</h4>
      </div>
      <div class="modal-body">


        <?= $this->Form->create('Tab', array(
            'action' => 'addTabR',
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
        <?= $this->Form->hidden('TabR.user_create_id', array('value' => $this->Session->read('user_id'))); ?>
        <?= $this->Form->hidden('TabR.user_modify_id', array('value' => $this->Session->read('user_id'))); ?>
        <?= $this->Form->input('TabR.nameRech', array(
            'label' => 'Evénement',
            'class' => 'form-control input-sm',
            'placeholder' => "Tapez les premières lettres de votre événement puis sélectionnnez",
            'id' => 'searchEventForTab'
          ));
        ?>
        <?= $this->Form->hidden('TabR.event_id', array('id' => 'EventId')); ?>

        <?= $this->Form->input('TabR.tab_id', array(
         'options' => $this->Listes->Liste('Tab', 'name', 'id'),
          'class' => 'form-control input-sm',
          'empty' => 'Sélectionner',
          'label' => array('class' => 'col col-md-3 control-label')
         ));?>
        <?= $this->Form->input('TabR.controller', array('label' => 'Controller')); ?>
        <?= $this->Form->input('TabR.action', array('label' => 'Action')); ?> 
        <?= $this->Form->input('TabR.order', array('label' => 'Ordre')); ?> 
         <?= $this->Form->input('TabR.nb', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Count </label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.add_button', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Bouton Add</label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.intention', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Intention</label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.engagement', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Engagement</label>',
            'label' => false,
            'class' => false
        ));
        ?>

        <?= $this->Form->input('TabR.pratiquant', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">Pratiquant</label>',
            'label' => false,
            'class' => false
        ));
        ?>

         <?= $this->Form->input('TabR.encadrant', array(
            'type' => 'checkbox',
            'before' => '<label class = "col col-md-3 control-label">encadrant</label>',
            'label' => false,
            'class' => false
        ));
        ?>

    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Ajouter</button><?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

