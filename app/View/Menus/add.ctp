

<?php echo $this->Html->addCrumb('Paramètres', '/accueils/params');?>
<?php echo $this->Html->addCrumb('Modules Extranet', '/modules');?>
<?php echo $this->Html->addCrumb('Menus - Module - '.$module['Module']['name']);?>
<?php $this ->assign('title_content', 'Ajouter un profil-utilisateur');?>


<?= $this->Form->create('Menu');?>
<?= $this->Form->input('module_id', array('type' => 'hidden', 'value' => $module['Module']['id'])) ;?> 
<?= $this->Form->input('name', array('label' => 'Libellé')) ;?> 
<?= $this->Form->input('icone') ;?> 
<?= $this->Form->input('controller') ;?> 
<?= $this->Form->input('action') ;?> 
<?= $this->Form->input('order', array('label' => 'Ordre')) ;?> 
<?= $this->Form->end('AJOUTER');?>