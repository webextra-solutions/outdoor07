Cher(e) <b><?= $user;?></b>,

<p>
	Je vous prie de trouver ci-après les conditions administratives préalables obligatoires pour tout sportif, pilote, guide, cadre ou officiel postulant à une sélection et participation aux Jeux Paralympiques de RIO 2016.<br>
	Ce courrier vous est adressé dans le respect des pré-requis administratifs imposés par le Comité Paralympique International et le ROCOG à tout athlète, cadre et officiel susceptible de participer aux Jeux Paralympiques de RIO 2016.<br>
	Il est adressé à une <b>liste large</b> de sportifs, cadres et officiels.  En aucun cas, il ne représente un pré-engagement fédéral sur votre participation et/ou sélection aux Jeux Paralympiques de RIO 2016.<br/>
	Merci d'apporter la plus grande attention à la lecture et au respect des conditions détaillées ci-après.
<hr>
	<br>
<b>1.	Pré requis administratifs</b><br>
Vous devez impérativement, <b><u>avant le 25 Avril 2016</u></b>, sous peine de ne pas pouvoir postuler à une sélection paralympique :<br>
<ul><li>Renseigner le formulaire d'enregistrement de vos informations personnelles obligatoires en vous connectant à l'application web dédiée (voir <b>"Vos informations de connexion"</b> en bas de page).</li>
<li>Au sein de ce formulaire, retourner au format numérique tous les documents obligatoires (un envoi postal sera toléré - CPSF/accréditations 42, rue Louis Lumière 75020 Paris).</li></ul><br>
<b>2.	Pré-requis sportifs</b><br>
Réaliser les performances nécessaires et remplir toute condition du chemin de sélection de votre Fédération.<br><br>
<b>3.	Comité Paralympique de sélection</b><br>
Le Comité Paralympique et Sportif Français publie la liste des sportifs sélectionnés aux Jeux Paralympiques de RIO 2016 ainsi que l\'équipe d\'encadrement technique, médical et administratif à l'issue de chaque comité paralympique de sélection.<br>Vous devez également, si vous êtes sportif, guide ou pilote, dès réception du courrier de l\'Agence Française de Lutte contre le Dopage, répondre positivement aux impératifs de localisation qui vous seront signifiés, sous peine de ne pas pouvoir postuler à une sélection paralympique.<br><br>Vous remerciant de votre attention et de votre application à suivre ces directives, je vous souhaite une bonne saison sportive.<br><br><b>Gérard MASSON</b><br><i>Président de la Fédération Française Handisport</i>


<hr/>

Afin de démarrer votre pré-accréditation, vous devez vous connecter à l'extranet fédéral avec les informations ci-dessous.
<hr/>

<? if($active == 0){?>
VOS INFORMATIONS DE CONNEXION<br/>
Nous avons pré-créé un compte-utilisateur pour vous, vous n'avez plus qu'à l'activer !<br/>
<ul>
	<li>Votre identifiant : <b><?= $username;?></b></li>
	<li> VOTRE LIEN D'ACTIVATION  : <a href="<?= serveur;?>/users/login/8/<?php echo $key;?>"> <b style="color:#F00"> CLIQUER-ICI </b> </a></b></li>
</ul>

<? } else {?>
RAPPEL DE VOS INFORMATIONS DE CONNEXION
<ul>
	<li>Lien : <a href="<?= serveur;?>"><?= serveur;?></a></li>
	<li>Identifiant : <b><?= $username;?></b></li>
	<li>Mot de passe : Vous l'avez déjà puisque vous connaissez l'extranet ! En cas de perte, cliquez sur "mot de passe oublié" sur la page de connexion à l'extranet.</li>
</ul>
<? } ?>



<hr/><b>BESOIN D'AIDE</b><br/> Contacter Sabrina VINCENT à : s.vincent@handisport.org / 01 40 31 45 25<br/>ou  Dalila SAYAD à : d.sayad@handisport.org / 01 40 31 45 15<br/>

Fédération Française Handisport - 
42 rue Louis Lumière 75020 Paris -
www.handisport.org 













