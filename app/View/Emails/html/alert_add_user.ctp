
<h3>Cher(e) <?php echo $Personne;?>,</h3>

<p>Un compte extranet a été créé pour vous !</p>

La plateforme vous permettra de :<br/><br/>
 - Déclarer, administrer vos séances<br/>
 - Affecter les encadrants, parents et enfants aux séances<br/>
 - Ajouter des bilans de séance <br/>
 - Ajouter des commentaires aux enfants tout au long du cycle<br/>
 - Une partie est destinée aux parents afin de donner les présences aux séances à venir. Cela leur permet de connaitre les modalités de chacune des séances : <?= serveur;?>/seances/presence<br/><br/>

N'oubliez pas de terminer l'activation de votre compte en cliquant sur le lien ci-dessous<br/><br/>
<hr/>

Votre identifiant : <b><?= $username;?><br/>
<p><b>IMPORTANT : </b>Afin de terminer l'activation de votre compte-utilisateur  : </b><a href="<?= serveur;?>/users/login/2/<?php echo $key;?>">cliquer ici</a></b></p>



