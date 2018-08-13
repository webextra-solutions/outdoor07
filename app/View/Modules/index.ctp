
<?php $this ->assign('title_content', 'Modules Extranet ('.$nbModules.')');?>


<table cellspacing="0">
    <tr >
        <th>ID</th>
        <th>LIBELLE</th>
        <th>ORDRE</th>

        <th></th>
        <th></th>
    </tr>

    <?php  $i = 1; foreach ($modules as $row): ?>
    <tr>

       	<td width="40px"><?php  echo $row['Module']['id']; ?></td>
        <td class="lien" onclick="document.location='<?= serveur;?>/modules/view/<?= $row['Module']['id'];?>'"><?= $row['Module']['name']; ?></td>
        <td><?php  echo $row['Module']['order']; ?></td>
 
        

        <td align="right" width="30"> 
                    <?php echo $this->Html->link('<i class="glyphicon glyphicons zoom_in"></i> ', 
                        array('action' => 'view', $row['Module']['id']), 
                        array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                    );?>
        </td>
        <td align="right" width="30"> 
            <?php 
            
            echo $this->Form->postLink('<i class="glyphicons bin"></i> ', 
                array('action' => 'delete', $row['Module']['id']), 
                array(
                    'class'=>'btn btn-danger btn-xs',
                    'escape' => false, 
                    'title' => 'supprimer', 
                    'data-toggle'=>'tooltip', 
                    'data-placement'=>'left'),
                  
                'Etes-vous sûr de vouloir supprimer ce module ?'
            );?>

        </td>      

       
    </tr>
    
    
    
    <?php endforeach; ?>
    <?php unset($result); ?>

</table>