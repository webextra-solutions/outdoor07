Cher(e) <b><?= $user;?></b>,


<p>Votre équipe a été sélectionné(e) pour le prochain Grand Prix National des Jeunes qui se déroulera à Montélimar du 04 au 08 mai 2016.<br/>
Nous avons le plaisir de vous annoncer que vous pouvez dès à présent réaliser votre déclaration d’engagement définitif en ligne.<br/>
Avant de procéder à votre inscription, pensez à prendre connaissance de toutes les informations à votre disposition sur le déroulement du Grand Prix National des Jeunes.<br/>
</p>

<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>
<hr/>
DATE LIMITE DE DÉCLARATION D’ENGAGEMENTS DEFINITIFS : <b>19 FÉVRIER 2016</b>
<hr/>


RAPPEL DE VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Lien : <a href="<?= serveur;?>/users/login/1">https://extranet.handisport.org/users/login/1</a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>

<hr/>
<p>EN SAVOIR + SUR L'EVENEMENT </p>
<ul>
<? foreach ($docs as $row) {?>
	<li><?= $row['name'];?> - <?= $this->html->link('Télécharger', serveur.$row['url'], array('target' => '_blank'));?></li>
<? }?>
</ul>

<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Charles Hordenneau à : c.hordenneau@handisport.org ou 01 40 31 45 36<hr/>

Fédération Française Handisport<br/>
42 rue Louis Lumière 75020 Paris<br/>
www.handisport.org 















