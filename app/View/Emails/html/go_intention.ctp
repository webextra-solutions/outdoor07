Cher(e) <b><?= $user;?></b>,

<p>Le Comité d'Organisation de la Coupe de France de Foot à 5 en salle est heureux de vous annoncer l’ouverture des intentions de participation pour cette compétition, qui se déroulera à TALENCE, du 09 au 11 JUIN 2017.<br/>
Les tournois Jeunes et Adultes seront à nouveau proposés, avec une possibilité de <b><u>groupe A et B pour les adultes également</u></b>, si le nombre d’équipes inscrites le permet cette année.</p>

<p>De façon à pouvoir effectuer une première estimation du nombre de participants, d'organiser au mieux votre séjour et de préparer les différents éléments de l'organisation, votre déclaration d'intention de participation se fait en ligne, en cliquant sur le lien de l'espace de connexion ci-après.</p>
<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>
<hr/>
DATE LIMITE DE DECLARATION D'INTENTION DE PARTICIPATION : <b>08 Février 2017</b>
<hr/>

<? if($active == 0){?>
VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>IMPORTANT : </b>Afin de terminer l'activation de votre compte-utilisateur  : </b><a href="<?= serveur;?>/users/login/2/<?php echo $key;?>">cliquer ici</a></b></li>
</ul>

<? } else {?>
RAPPEL DE VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Lien : <a href="<?= serveur;?>/users/login/1">https://extranet.handisport.org/users/login/1</a></li>
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

<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Marion PINEAU à : m.pineau@handisport.org ou 01 40 31 45 13






;







