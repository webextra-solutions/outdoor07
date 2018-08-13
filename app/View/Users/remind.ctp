<div id="EspacePrive">

	<div class="titre_prive">Identifiant / Mot de passe oublié</div>
	
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Session->flash(); ?>


	<div class="connexion">
			<?= $this->Form->create('User', array(
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
    
   

    
    <?= $this->Form->input('email'); ?>
 
   

   
    <div class="form-group">
        <?php echo $this->Form->submit('Envoyer', array(
            'div' => 'col col-md-9 col-md-offset-3',
            'class' => 'btn btn-default'
        )); ?>
    </div>
    <?php echo $this->Form->end(); ?>
	</div>
	
	<div align='center' class="connexion">
		<?php 				
			echo $this->Html->link(
	        				'Identifiant et/ou mot de passe oublié', 
	        				array('action' => 'remind')
					);?>
		 |
		<?php 				
							echo $this->Html->link(
		        				'Créer un compte', 
		        				array('controller' => 'Signups', 'action' => 'signup')
						);?>
		 |
		<?php 				
			echo $this->Text->autoLinkEmails('extranet@handisport.org');
		?>
	</div>

</div>

<?php echo $this->element('espace-public');?>






