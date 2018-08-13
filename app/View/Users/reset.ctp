

<div id="EspacePrive">


	
	<?php //echo $this->Session->flash('auth'); ?>
	<?php echo $this->Session->flash(); ?>


	<div align="center"><h4>Réinitialiser<br/> votre mot de passe</h4></div>
    <hr/>

        <?= $this->Form->create('User', array(
        	'action' => 'reset',
            'inputDefaults' => array(
                'div' => 'form-group',
               

                'class' => 'form-control input-sm'
            ),
            'class' => 'form-group'
        )); ?>
        <?= $this->Form->hidden('key');?>
        <?= $this->Form->input('password', array('label' => 'Nouveau mot de passe'));?>
        <?= $this->Form->input('password-confirm', array('type' => 'password', 'label' =>  'Confirmation nouveau mot de passe'));?>        

   
    <div class="form-group">

    <button type="submit" class="btn btn-federation btn-md btn-block"><i class="glyphicons floppy_disk"></i> Enregistrer</button><?php echo $this->Form->end(); ?>
   
        
    </div>
    
	</div>
 
	
	
</div>
