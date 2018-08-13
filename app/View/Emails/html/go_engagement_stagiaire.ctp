Cher(e) <b><?= $user;?></b>,<br/><br/>

Vous vous êtes récemment inscrit(e) à une session de formation organisée par notre Fédération.<br/>Nous vous informons que suite à la mise en place d’un nouvel outil de gestion de nos formations, vous disposez désormais d’un espace personnel afin de pouvoir suivre votre inscription.<br/>
Pour cela, veuillez suivre les modalités ci-dessous.<br/><br/>

<p>A très bientôt !<br/>
L’équipe du CNFH</p>


<hr/>

<? if($active == 0){?>
VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Votre identifiant : <b><?= $username;?></b></li>
	<li> VOTRE LIEN D'ACTIVATION  : <a href="<?= serveur;?>/users/login/8/<?php echo $key;?>"> <b style="color:#F00"> CLIQUER-ICI </b> </a></b></li>
</ul>

<? } else {?>
RAPPEL DE VOS INFORMATIONS DE CONNEXION
<ul>
	<li>Lien : <a href="<?= serveur;?>/users/login/1">https://extranet.handisport.org/users/login/1</a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
<? } ?>



<hr/><b>BESOIN D'AIDE</b><br/> Contacter Jonathan ROBERT à : j.robert@handisport.org ou 01 40 31 45 05<br/>

Fédération Française Handisport - 
42 rue Louis Lumière 75020 Paris -
www.handisport.org 















