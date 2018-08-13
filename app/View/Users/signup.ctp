	<?php
			echo $this->Form->create('AskUser');
			echo $this->Form->input('civilite', array(
															      'options' => array('M' => 'Monsieur', 'Me' => 'Madame'),
															      'empty' => 'Sélectionner'
															  ));
			echo $this->Form->input('nom', array('label' =>  __('Nom ')));
			echo $this->Form->input('prenom', array('label' =>  __('Prénom ')));
			echo $this->Form->input('ddn', array(
																'label' =>  __('Date de naissance '),
																'dateFormat' => 'DMY',
																'minYear' => 1930,
																'maxYear' => 2000,
																'separator' => false,
																'class' => 'ddn'));
			
			echo $this->Form->input('structure', array('label' =>  __('Votre structure')));
			echo $this->Form->input('email', array('label' =>  'Email', 'type' => 'email'));
			echo $this->Form->input('password', array('label' =>  'Mot de passe', 'type' => 'password'));
			echo $this->Form->input('password2', array('label' =>  'Confirmer  mot de passe', 'type' => 'password'));
			echo $this->Form->end('S\'inscrire');
		?>