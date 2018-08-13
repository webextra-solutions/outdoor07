<h3>Cher(e) <?php echo $PersonnePrenom.' '.$PersonneNom;?>,</h3>
<ul>
	<li>Votre identifiant : <b><?php echo $username;?></b></li>
	<li>Réinitialiser votre mot de passe : <b></b><a href="<?= serveur;?>/users/login/resetPwd/<?= $key;?>">cliquer ici</a></b></li>
</ul>

