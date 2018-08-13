Cher(e) <b><?= $user;?></b>,

<p>
	Vous avez un ou plusieurs joueurs qualifiés pour le prochain Championnat de France de Boccia NE qui se déroulera à Troyes du 24 au 26 novembre 2017.<br/>
	Aujourd’hui, nous avons le plaisir de vous annoncer que vous pouvez dès à présent réaliser votre déclaration d’engagement définitif en ligne.<br/>
	Avant de procéder à votre inscription, pensez à prendre connaissance de toutes les informations à votre disposition sur le déroulement Championnat.<br/>
	<b>Retrouvez toutes les informations nécessaires ci-dessous.</b><br/>
	A très bientôt !<br/>
	HORDENNEAU Charles

	<hr/>
	DATE LIMITE DE DÉCLARATION D’ENGAGEMENTS DEFINITIFS : <b>15 OCTOBRE 2017</b>
	<hr/>



<? if($active == 0){?>
VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Votre identifiant : <b><?= $username;?></b></li>
	<li> VOTRE LIEN D'ACTIVATION  : <a href="<?= serveur;?>/users/login/2/<?php echo $key;?>"> <b style="color:#F00"> CLIQUER-ICI </b> </a></b></li>
</ul>

<? } else {?>
RAPPEL DE VOS INFORMATIONS DE CONNEXION
<ul>
	<li>Lien : <a href="https://extranet.handisport.org/users/login/1/<?= $username;?>">https://extranet.handisport.org/users/login/1/<?= $username;?></a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
<? } ?>



<hr/>
<p>EN SAVOIR + SUR L'EVENEMENT </p>
<ul>
<? foreach ($docs as $row) {?>
	<li><?= $row['name'];?> - <?= $this->html->link('Télécharger', serveur.$row['url'], array('target' => '_blank'));?></li>
<? }?>
</ul>

<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Charles Hordenneau à : c.hordenneau@handisport.org ou 06 58 59 46 45<hr/>

Fédération Française Handisport<br/>
42 rue Louis Lumière 75020 Paris<br/>
www.handisport.org 














