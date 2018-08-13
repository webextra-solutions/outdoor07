<? 
$module1 = $this->requestAction('modules/index');
$module2 = $this->requestAction('modules/index3');
$profil = $this->requestAction('profils/index');
$nbProfil = $this->requestAction('profils/index4');
$profils_list = $this->requestAction('profils/index5');


?>





<div class="type_extranet"> 
<?php foreach ($module2 as $row): ?>

  <? if($this->Session->read('module_id') == $row['Module']['id']){?>
    <div class="module<?= $row['Module']['id'];?>" data-toogle="tooltip" title="<?= $row["Module"]["name"];?>" data-placement="bottom">
        <div style="margin: 14px 0 8px 0; font-size: 25px; color: #000;"><i class="glyphicons <?= $row["Module"]["icone"];?>" ></i></div>
        
    </div>

  <? } else {?>
     <div class="module_extranet">
     <?php echo $this->Html->link(
        '<div style="margin: 14px 0 8px 0; font-size: 25px; color: #000;"><i class="glyphicons '.$row["Module"]["icone"].'"></i></div>',
        array('controller' => $row['Module']['controller'], 'action'=>$row['Module']['action'], $row['Module']['id']),
        array('escape' => false,'title'=>$row['Module']['name'], 'data-placement' => 'bottom')
    );?>
    </div>
  <? }?>


<?php endforeach; ?>
<?php unset($result); ?>
</div>	
	





