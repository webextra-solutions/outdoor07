<div id="EspacePrive">


	
	<?php //echo $this->Session->flash('auth'); ?>
	<?php echo $this->Session->flash(); ?>


	<div align="center">Dernière étape !<h4>ACTIVER VOTRE COMPTE</h4></div>
    <hr/>

        <?= $this->Form->create('User', array(
            'inputDefaults' => array(
                'div' => 'form-group',
               

                'class' => 'form-control input-sm'
            ),
            'class' => 'form-group'
        )); ?>
        <?= $this->Form->hidden('key');?>
        <?= $this->Form->input('password', array('label' => 'Choisissez votre mot de passe'));?>
        <?= $this->Form->input('password-confirm', array('type' => 'password', 'label' =>  'Confirmer votre choix de mot de passe'));?>        

   
    <div class="form-group">

    <button type="submit" class="btn btn-federation btn-md btn-block"><i class="glyphicons right_arrow"></i> Activer</button><?php echo $this->Form->end(); ?>
   
        
    </div>
    
	</div>
 
	
	
</div>



