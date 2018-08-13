Cher(e) <b><?= $user;?></b>,


<p>Vous avez effectué vos intentions de participation pour la prochaine Coupe de France de Foot à 5 en salle  qui se déroulera à TALENCE, du 09 au 11 Juin 2017.<br/>
Aujourd’hui, nous avons le plaisir de vous annoncer que vous pouvez dès à présent réaliser votre déclaration d’engagement définitif en ligne, (sur le même principe que pour les intentions), en cliquant sur le lien ci-dessous.</p>

<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>
<hr/>
DATE LIMITE DE DÉCLARATION D’ENGAGEMENTS DEFINITIFS : <b>14 AVRIL 2017</b>
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

<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Marion PINEAU à : m.pineau@handisport.org ou 01 40 31 45 13<hr/>

Fédération Française Handisport<br/>
42 rue Louis Lumière 75020 Paris<br/>
www.handisport.org 













