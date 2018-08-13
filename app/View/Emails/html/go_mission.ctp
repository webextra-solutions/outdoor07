Cher(e) <b><?= $user;?></b>,

<p>Le module de déclaration des missions fédérales évolue !</p>

Vous êtes destinataire de ce mail car vous avez déjà été amené à déclarer une mission fédérale.<br/>

La procédure de déclaration évolue légèrement désormais.<br/><br/>En effet, vos futures déclarations se feront en vous connectant à votre compte "Extranet Handisport".<br/><br/>




<? if($active == 0){?>
Pas d'inquiétude, votre compte est déjà créé, vous avez juste à l'activer.


<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
Samuel GINOT</p>
<hr/>


VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>IMPORTANT : </b>Afin de terminer l'activation de votre compte-utilisateur  : </b><a href="<?= serveur;?>/users/login/2/<?php echo $key;?>">cliquer ici</a></b></li>
</ul>

<? } else {?>

<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
Samuel GINOT</p>
<hr/>


RAPPEL DE VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Lien : <a href="<?= serveur;?>/users/login/3">https://extranet.handisport.org/users/login/3</a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
<? } ?>
















