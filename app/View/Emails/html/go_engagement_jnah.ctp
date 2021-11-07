Cher(e) <b><?= $user;?></b>,


<p>Votre délégation a été sélectionné(e) pour les prochains Jeux Nationaux de l'Avenir Handisport qui se dérouleront à Saint-Nazaire (44) du 24 au 27 Mai 2017.<br/>
Nous avons le plaisir de vous annoncer que vous pouvez dès à présent réaliser votre déclaration d’engagement définitif en ligne.<br/>
Avant de procéder à votre inscription, pensez à prendre connaissance de toutes les informations à votre disposition sur le déroulement des Jeux Nationaux de l’Avenir Handisport (compositions des délégations, engagements sportifs, conditions minimales et maximales de pratique , prêt de joueur, épreuves ouvertes/catégories…).</p>

<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>
<hr/>
DATE LIMITE DE DÉCLARATION D’ENGAGEMENTS DEFINITIFS : <b>17 MARS 2017</b>
<hr/>


RAPPEL DE VOS INFORMATIONS DE CONNEXION<br/>
<ul>
	<li>Lien : <a href="<?= serveur;?>/users/login/1">http://extranet.handisport.org/users/login/1</a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
s
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















