Cher(e) <b><?= $user;?></b>,

<p>
	Cette année se déroule la 5ème édition des Journées Nationales Handisport du 05 au 08 avril 2017 !<br/>
	Venez participer à cet événement incontournable du mouvement handisport.<br/>
	Retrouvez un site entièrement accessible au sein du complexe hôtelier Barrière d'Enghien-Les-Bains, au nord de Paris.<br/><br/>
	Clubs, sections, établissements, comités : <b>c’est notre rendez-vous ! </b><br/>

	Les Journées 2017 seront à nouveau une belle opportunité d’échanger, partager et profiter des forums, retours d’expériences, conférences, formations ou nombreuses tables rondes. 
<hr>
	<b style="color:#F00">NOUVEAU ! CETTE ANNÉE, INSCRIVEZ-VOUS AVEC VOTRE COMPTE EXTRANET HANDISPORT.</b><br/>

	<? if($active == 1){?>
		Vous avez d'ailleurs déjà un compte actif ! Vous n'avez plus qu'à vous connecter. (Rappel de infos de connexion au bas de ce mail) <br/><br/>
	<? } else {?>
		C'est très simple, on vous a créé un compte EXTRANET HANDISPORT, vous devez juste l'activer pour vous inscrire. (lien d'activation au bas de ce mail)<br/><br/>
	<? } ?>

Avec cette procédure, vous avez la possibilité  :<br/>

- <b>D'inscrire plusieurs personnes</b> à partir de votre espace<br/>
- De créer votre propre délégation aux JNH !
<hr/>
N'attendez plus, Inscrivez-vous !<br/>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>


<hr/>

<? if($active == 0){?>
VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Votre identifiant : <b><?= $username;?></b></li>
	<li> VOTRE LIEN D'ACTIVATION  : <a href="<?= serveur;?>/users/login/7/<?php echo $key;?>"> <b style="color:#F00"> CLIQUER-ICI </b> </a></b></li>
</ul>

<? } else {?>
RAPPEL DE VOS INFORMATIONS DE CONNEXION
<ul>
	<li>Lien : <a href="http://journees-nationales.handisport.org/">http://journees-nationales.handisport.org/</a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
<? } ?>



<hr/>
<p>EN SAVOIR + SUR L'EVENEMENT <br/>
<a href="http://www.handisport.org/les-journees-nationales-handisport-2016/">http://www.handisport.org/les-journees-nationales-handisport-2016/</a>

<hr/><b>BESOIN D'AIDE</b><br/> Contacter Anne-Flore ANGOT à : lesjournees@handisport.org ou 01 40 31 45 72<br/>

Fédération Française Handisport - 
42 rue Louis Lumière 75020 Paris -
www.handisport.org 















