<?php echo $this->Html->addCrumb('Menus', '/menus');?>
<?php $this ->assign('title_content', $nbMenu.' Menus');?>
<?php $this ->assign('title_buttons', $this->Html -> Image('icons/icon_ajout.png', array('width' => '30', 'id' =>'btnAddMenu', 'title' => 'Ajouter un menu')));?>
<div class="dialog-edit" title="Fiche - Menu"></div>



		<div class="dialog-addMenu" title="Ajouter Un menu">
			<?php echo $this->Form->create('Menu', array('controller' => 'Menus', 'action' => 'addMenu', 'id' => 'formAddMenu'));?>
			<?php echo $this->Form->input('name', array('label'=>'Libellé :'));?>
			<?php echo $this->Form->input('controller', array('label'=>'Contrôleur :'));?>
			<?php echo $this->Form->input('action', array('label'=>'Action :'));?>
			<?php echo $this->Form->end();?>
		</div>


		<?php 
			//PAGINATION
			echo $this->Formatage->afficherPagination($this->element('pagination'),$nbRow,20); 
			
		?>

		<table cellspacing="0">
		    <tr >
				<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
				<th><?php echo $this->Paginator->sort('name', 'LIBELLE'); ?></th>
		        <th><?php echo $this->Paginator->sort('created', 'CREATION'); ?></th>
		        <th></th>
		        <th></th>
		    </tr>

		    <?php  $i = 1; foreach ($menus as $row): ?>
		    <tr  onclick="document.location='view/1'">
		       	<td width="40px"><?php  echo $row['Menu']['id']; ?></td>
		        <td><?php  echo $row['Menu']['name']; ?></td>
		        <td><?php  echo $this->Formatage->datehrFR($row['Menu']['created']); ?></td>
		        <td align="right"> 
		        	<?php echo $this->Html->link(
			        				$this->Html->image('icons/icon_jumelles.png', array('alt' => '', 'border' => '0', 'title' => 'voir/modifier', 'width'=>'20')), 
			        				array('action' => 'view', $row['Menu']['id']), 
									array('escape' => false)
		        				);?></td>
		        				
		        <td align="right"> 
		        	<?php echo $this->Html->link(
			        				$this->Html->image('icons/icon_suppr.png', array('alt' => '', 'border' => '0', 'title' => 'supprimer', 'width'=>'20')), 
			        				array('action' => 'delete', $row['Menu']['id']), 
									array('class'=>'ajax-btn','escape' => false)
		        				);?></td>

		        
		    </tr>
		    
		    
		    
		    <?php endforeach; ?>
		    <?php unset($result); ?>
   
		</table>
		
		<?php 
			echo $this->Formatage->afficherPagination($this->element('pagination'),$nbRow,20); 
		?>
		
		
