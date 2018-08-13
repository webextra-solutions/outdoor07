

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




$cakeDescription = __d('cake_dev', 'Extranet - Outdoor 07');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		

		echo $this->Html->meta('favicon.ico','/img/favicon.ico', array('type' => 'icon'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	// APPEL JQUERY
		// APPEL JQUERY
		if($_SERVER['SERVER_PORT'] == '8888'){
			echo $this->Html->script('jquery-1.11.1.min');
			echo $this->Html->script('jqUI/jquery-ui-1.10.3.custom');
		} else {
			echo $this->Html->script('https://code.jquery.com/jquery-1.11.3.min.js');
			echo $this->Html->script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
		}

		echo $this->Html->script('jquery.validate.js');



		// bootstrap
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('bootstrap-datepicker');
		echo $this->Html->script('locales/bootstrap-datepicker.fr');
		
		
				

		echo $this->Html->script('ui-datepicker');
		echo $this->Html->script('ui-autocomplete');
		echo $this->Html->script('ui-dialog');
		echo $this->Html->script('navigation');		
		echo $this->Html->script('modernizr');
		
		// APPEL CSS
		echo $this->Html->css('extranet-v3-login');
		echo $this->Html->css('jquery-ui-1.10.3.custom');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('datepicker');
		echo $this->Html->css('glyphicons2');
		
				
	?>

	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	
	
</head>
<body class="body">







         <!-- <div class="fond_popup_save" id="content2" style="display: none;" ></div> -->
<div class="popup_save bg-primary" style="display: none;"><i class="glyphicons floppy_saved x2"></i><br/>Les données<br/>ont été enregistrées<br/>avec succès !</div>

<? if($this->request->action == 'presence'){?>
	

<? }?>

<? if($this->request->action == 'login2'){?>
	<div style="float:right; padding:0 2% 0 2%;" align="center" width= "120px" class="lien" onclick="document.location='<?= serveur;?>/seances/presence'"><br/><br/><i class="glyphicons user x3"></i><br/>Espace Parents</div>
	<div id="header">	
		<table>
			<tr>
				<td width="520px"><?= $this->Html->Image('logos/logo_outdoor07.jpg', array('width' => '500px')); ?></td>
				<td>
					<h1>Espace Dirigeants</h1>
					<h4>Ecole des Sports • Saison 2017/2018</h4>
		 			<!-- <h5>Pratique ! Renseignez la présence de vos enfants sur les séances à venir en renseignant les formulaires ci-dessous.</h5>--></td>
			</tr>
		</table>
	</div>
<? }?>

	



	

	<div id="container">	



		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>	
	</div>

	
</body>
</html>
