<h3>Cher(e) <?php echo $Personne;?>,</h3>
<hr/>
Vous allez prochainement participer à une session de formation Handisport et nous vous en remercions !<br/><br/>A cette occasion, <?= $declarant;?> vous a pré-créé un compte EXTRANET HANDISPORT.<br/>
Ce compte vous permettra de :
<ul>
	<li>Accéder à votre "Parcours STAGIAIRE" à la Fédération Handisport ! </li>
	<li>Consulter les sessions de formations auxquelles vous avez participé.</li>
	<li>Renseigner votre fiche profil STAGIAIRE (expériences, coordonnées), nécessaires à l'ogranisateur.</li>
	<li>Visualiser l'ensemble de votre parcours (diplômes et unités de compétences obtenus)</li>
	<li>Télécharger/éditer vos documents (Attestation de formation, attestation de présence,...)</li>
</ul>
<hr/>

VOS INFORMATIONS DE CONNEXION :<br/>
- Identifiant : <b><?= $username;?></b><br/>
<p><b>IMPORTANT : </b>Afin de terminer l'activation de votre compte-utilisateur  : </b><a href="<?= serveur;?>/users/login/2/<?php echo $key;?>">cliquer ici</a></b></p>



