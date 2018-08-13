



<?php $this ->assign('title_content', $nbUsers.' Comptes-utilisateurs');?>

<!-- BOUTONS - TITRE -->
<?= $this ->assign('button_content', 
'<div class="button-content">'.$this->Html->link('<button type="button" title="Ajouter un compte" class="btn btn-success btn-sm" "data-toggle" = "tooltip", "data-placement" = "bottom">
  <span class="glyphicons plus"></span>
</button>', array('action' => 'add'), array('escape'=>false)).'</div>');?>




		


		<table cellspacing="0">
		    <tr >
				<th></th>
		        <th>ID</th>
		        <th>PID</th>

		        <th>NOM</th>
		        <th>PRENOM</th>
		        <th>EMAIL</th>
		        <th></th>
		        <th></th>
		        <? if($this->Session->read('super_admin') == 1){?>
		        <th></th>

		        <? }?>
		    </tr>

		    <?php  $users_actifs = array(); $i = 1; foreach ($users as $row): 

		    $users_actifs[] = $row['Personne']['email'];

		    ?>
		    <tr>
		    	<td width="30px"><?php  if($row['User']['active'] == '0'){  echo '<i class="glyphicons user x2 gly_orange"></i>'; } else {  echo '<i class="glyphicons user x2 gly_vert"></i>';}?></td>
		    	
		       	<td width="40px"><?php  echo $row['User']['id']; ?></td>
		       	<td width="40px"><?php  echo $row['User']['personne_id']; ?></td>

               </td>
		        <td class="lien" onclick="document.location='<?= serveur;?>/users/view/<?= $row['User']['id'];?>'"><?= $row['Personne']['name']; ?></td>
		        <td><?php  echo $row['Personne']['first_name']; ?></td>
		        <td><?php  echo $this->Text->autoLinkEmails($row['User']['email']); ?></td>
		       <td align="right" width="30"> 
			        <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
						array('action' => 'view', $row['User']['id']), 
						array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
					);?>
				</td>
				
				<td align="right" width="30"> 
			        <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
						array('action' => 'delete', $row['User']['id']), 
						array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
						'Etes-vous sûr de vouloir supprimer ce compte-utilisateur ?'
					);?>
				</td>
				
		        
		    </tr>
		    
		    
		    
		    <?php endforeach; ?>
		    <?php unset($result); ?>
   
		</table>

		 <button type="button" class="btn btn-primary btn-sm" onClick="location.href='mailto:<?= implode(',',$users_actifs);?>'" ><i class="glyphicons envelope"></i><br/>Ecrire aux utilisateurs actifs</button>
	
		
		
