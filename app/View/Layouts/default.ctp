<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


$cakeDescription = __d('cake_dev', 'Extranet Outddor 07');


?>
<!DOCTYPE html>
<html>
<head>




	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription; ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php


		echo $this->Html->meta('favicon.ico','/img/favicon-16x16.png', array('type' => 'icon'));



		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		

		if($_SERVER['SERVER_PORT'] == '8888'){
			echo $this->Html->script('jquery-1.11.1.min');
			echo $this->Html->script('jqUI/jquery-ui-1.10.3.custom');
		} else {
		
			echo $this->Html->script('https://code.jquery.com/jquery-1.11.3.min.js');
			echo $this->Html->script('https://code.jquery.com/ui/1.12.0/jquery-ui.min.js');
			echo $this->Html->script('https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js');
		}
		

		// BOOTSTRAP 4
		/*echo $this->Html->css("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css");
		echo $this->Html->script("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js");*/
		

		echo $this->Html->script('jquery.validate.js');
		echo $this->Html->script('jquery.metadata.js');
		echo $this->Html->script('additional-methods.js');
		

		echo $this->Html->script('navigation');
		echo $this->Html->script('ui-datepicker');
		echo $this->Html->script('ui-autocomplete');
		echo $this->Html->script('ui-dialog');

		

		// bootstrap
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('bootstrap-datepicker');
		echo $this->Html->script('locales/bootstrap-datepicker.fr');
		

		echo $this->Html->script('modernizr');

		// APPEL CSS
		echo $this->Html->css('extranet-v3');
		
		// CSS - EN FONCTION DU MODULE
		echo $this->Html->css('extranet-v3-'.$this->Session->read('module_id').'');		



		echo $this->Html->css('login');
		echo $this->Html->css('buttons');
		echo $this->Html->css('jquery-ui-1.10.3.custom');
		//cho $this->Html->css('http://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('glyphicons2');
		echo $this->Html->css('datepicker');

		echo $this->Html->script('bootstrap-switch');


		echo $this->Html->css('bootstrap-switch');
		
	?>



    <script type="text/javascript">
        $(function() {

            $('#wait_save').hide();

        });
    </script>





</head>
<body>

<!-- BOITE DE DIALOGUE - ALERT -->
<div class="modal fade bs-example-modal-md modalBulle" style="z-index:1000000000 !important;" tabindex="-1" id="alertForm" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicons circle_exclamation_mark rge"></i> <span id="headerAlert"></span></h4>Pour la/les raisons ci-dessous
      </div>
       <div class="modal-body">
       <div  id="alerts"></div><br/>
       NB : Pensez à <b>sauvegarder vos informations</b>.
       </div> 
    </div>
  </div>
</div>

<!-- BOITE DE DIALOGUE - CONFIRM -->
<div class="modal fade bs-example-modal-md modalBulle" tabindex="-1" style="z-index:1000000000 !important;" id="confirmForm2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicons circle_question_mark"></i> Êtes-vous sûr de vouloir continuer ?</h4>
      </div>
       <div class="modal-body" id="confirm"> 
       </div> 
       <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary btn-sm" id="confirmOui">Oui</button>
      </div>
    </div>
  </div>
</div>





<? if($_SERVER['REMOTE_ADDR'] == '88.162.211.174' and $this->Session->read('extranet_off') == 1){?>
<div align="center" style="font-size:20px; background-color:#F00; height:85px; float:left; padding:20px 100px 20px 100px; color:#FFF;"><i class="glyphicons circle_exclamation_mark"></i> Extranet FERMÉ !</div>

<? }?>
	
	
	<!-- BLOC - Menu Dock -->
	<?= $this->element('menuDock', array(), array('Cache' => true));?>


	<!-- BLOC - Menu Module -->
	<? if(!is_null(AuthComponent::user('id'))){
		if($this->Session->read('module_id') == 1 or $this->Session->read('module_id') == 4){
		} else {
			echo $this->element('menu_module', array(), array('Cache' => true));
		}
	}?>


	<div id="container" style="display: table; clear:both; width: 100%;">
		
		
				
		<div <? if($this->Session->read('module_id') == 1 or $this->Session->read('module_id') == 4){ }else {?>id="contentRight"<? }?>>
		
			<?php 
			if(!is_null(AuthComponent::user('id'))){ 	
					
					// BLOC - Fil d'Ariane
					//echo $this->element('fil_ariane');
					
					// BLOC - TITRE PAGE + BOUTON
					echo $this->element('titre_content'); 


					

				}
			?>
						
			<div class="content">
				<?php echo $this->Flash->render(); ?>
				<?php echo $this->fetch('content'); ?>	
			</div>
			
		</div>
		
	
		
	</div>


		<div id="footer">
		 Version 1.0 • 2017 • Contact :
   			<?php  echo $this->Text->autoLinkEmails('<i class="glyphicon glyphicon-envelope"></i> samuel.ginot@gmail.com', array('escape' => false));?>   

	</div>
	
<!-- BOITE DE DIALOGUE - WAIT SAVE-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" id="wait_save" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
     <div class="modal-body" align="center">
     
     <?= $this->Html->image('icons/icon_loader.gif', array('alt' => 'En attente de chargement', 'border' => '0', 'height' => 50));?><br/><br/>Traitement en cours ...
      </div>
    </div>
  </div>
</div>

</body>
</html>
