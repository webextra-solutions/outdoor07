<script type="text/javascript">
	$(function() {

		
		// GLISSER / DEPLACER DES TABS
        $( "#sortableMenu" ).sortable({
              revert: true,
              update: function() { 
               // callback quand l'ordre de la liste est changé
              var order = $('#sortableMenu').sortable('serialize'); // récupération des données à envoyer
              $.post(serveur+'/menus/ajax_sortable_menus', order);
            }
        });

           // RECHERCHER UN ENFANT
        $('.search-personne').autocomplete({
          minLength    : 1,
          source        : serveur+'/personnes/searchPersonne',

          select: function(event, ui) { 
            window.location.href = serveur+'/personnes/view/'+ui.item.id;
          },
          appendTo : "#newSearch"
        });
	});
</script>


<?php 
	$module_active = $this->requestAction('modules/index2');
	$menu = $this->requestAction('menus/index');
?>


<div id="menu_module">

	<!-- <ul class="nav nav-pills nav-stacked" <? if($this->Session->read('profil_code') == 'GF'){?> id="sortableMenu" <? }?> >
		<?php foreach ($menu as $it): ?>
		 	<li  class="test_tooltip 
			  	<? if($this->request->controller == $it['Menu']['controller'] and $this->request->action == $it['Menu']['action']){?>
			  		active menuModuleActive<?= $this->Session->read('module_id');?>
			  	<? } ?>

			  
			  	" id="SORTABLE_MENU_<?= $it['Menu']['id'];?>">

			  	<? if($it['Menu']['id'] == 7){ 
			  		echo $this->Html->link(
					'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
					'#',
					array('escape' => false, 'data-toggle' => 'modal', 'data-target' => '#newSearch'));

				}else if($it['Menu']['id'] == 8){ echo $this->Html->link(
					'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
					array('controller' => $it['Menu']['controller'], 'action'=>$it['Menu']['action'], $this->Session->read('personne_id')),
					array('escape' => false, 'title' => $it['Menu']['title']));
				} else { echo $this->Html->link(
					'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
					array('controller' => $it['Menu']['controller'], 'action'=>$it['Menu']['action']),
					array('escape' => false, 'title' => $it['Menu']['title']));
				}
			  	
				?>

				
			
				<? if($it['Menu']['new'] == 1){?><div style="position: absolute; top:8px; right:30px; background-color:#0ed313; padding: 3px; border-radius: 2px; color: #FFF;">Nouveau !</div><? }?>
				<? if($this->request->controller == $it['Menu']['controller'] and $this->request->action == $it['Menu']['action'] and $it['Menu']['id'] != 43 and $it['Menu']['id'] != 77){?>
					<div style="position: absolute; top:11px; right:0px; "><i class="glyphicons chevron-right"></i></div>
				<? }?>
			</li>
		<?php endforeach ?>

	</ul> -->


	<?php foreach ($menu as $it): ?>
	 	<div  style="float:left; padding: 10px 15px 10px 15px;" class="test_tooltip 
		  	<? if($this->request->controller == $it['Menu']['controller'] and $this->request->action == $it['Menu']['action']){?>
		  		active menuModuleActive<?= $this->Session->read('module_id');?>
		  	<? } ?>

		  
		  	" id="SORTABLE_MENU_<?= $it['Menu']['id'];?>">

		  	<? if($it['Menu']['id'] == 7){ 
		  		echo $this->Html->link(
				'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
				'#',
				array('escape' => false, 'data-toggle' => 'modal', 'data-target' => '#newSearch'));

			}else if($it['Menu']['id'] == 8){ echo $this->Html->link(
				'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
				array('controller' => $it['Menu']['controller'], 'action'=>$it['Menu']['action'], $this->Session->read('personne_id')),
				array('escape' => false, 'title' => $it['Menu']['title']));
			} else { echo $this->Html->link(
				'<i class="glyphicons '.$it['Menu']['icone'].'"></i> '.$it['Menu']['name'],
				array('controller' => $it['Menu']['controller'], 'action'=>$it['Menu']['action']),
				array('escape' => false, 'title' => $it['Menu']['title']));
			}
		  	
			?>

			
		
			<? if($it['Menu']['new'] == 1){?><div style="position: absolute; top:8px; right:30px; background-color:#0ed313; padding: 3px; border-radius: 2px; color: #FFF;">Nouveau !</div><? }?>
			<? if($this->request->controller == $it['Menu']['controller'] and $this->request->action == $it['Menu']['action'] and $it['Menu']['id'] != 43 and $it['Menu']['id'] != 77){?>
				<div style="position: absolute; top:11px; right:0px; "><i class="glyphicons chevron-right"></i></div>
			<? }?>
		</div>
	<?php endforeach ?>

	
	
</div>


<!-- BOITE DE DIALOGUE - NOUVELLE RECHERCHE -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="newSearch" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicons search"></i> RECHERCHER</h4>
      </div>
      <div class="modal-body">

      	<? if($this->Session->read('module_id') == 2){?>
	    	<?= $this->Form->input('search-personne', array('wrapInput' => 'col col-md-12', 'label' => false, 'placeholder' => 'Une personne...', 'type' => 'text', 'class' => 'form-control input-sm space-bottom search-personne')) ;?><br/><br/>
	    	<?= $this->Form->input('search-seance', array('wrapInput' => 'col col-md-12', 'label' => false, 'placeholder' => 'Une séance...', 'type' => 'text', 'class' => 'form-control input-sm space-bottom search-seanceForView')) ;?><br/><br/>
	    	
	    <? }?>

    	
    	<div style="clear:both;"> </div>
      </div>
      
    </div>
  </div>
</div>










