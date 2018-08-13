Cher(e) <b><?= $user;?></b>,




<? if($convoque == 1 and $montant_du == 0){?>
	<p>Vous avez effectué une inscription aux Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?> le : <b><?= $date_inscription;?></b><br/>
	Nous vous remercions de l'intérêt que vous portez à cet évènement !<br/><br/>
	Votre participation est prise en charge par la fédération. Vous n'avez rien à régler.<br/>
	Nous vous rappelons également que pour participer aux JNH 2015 vous devez avoir une licence fédérale à jour au moment de l'événement.<br/><br/></p>
<? }?>

<? if($convoque == 1 and $montant_du != 0){?>
	<p>Vous avez effectué une inscription aux Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?> le : <b><?= $date_inscription;?></b><br/>
	Nous vous remercions de l'intérêt que vous portez à cet évènement !<br/><br/>
	Afin de terminer votre inscription, nous vous remercions de bien vouloir vous acquitter de la somme suivante, correspondant aux éventuelles prestations que vous avez commandées :
	<ul>
		<li>Montant à régler : <b><?= $montant_du;?> €</b></li>
	</ul>

	Retrouver le détail de vos prestations sur votre compte extranet dans la rubrique Hébergement Restauration.<br/><br/>

	<? if($facture_to_delegation != 0){?> Vous avez demandé à ce que vos frais soient intégrés à la facture de votre délégation<br/><br/>
		Le chèque global pour votre délégation est à établir à l'ordre de <b>FFH</b> en mentionnant au dos le nom de la ou les personnes concernées 
	<? } else {?>
		Le chèque  est à établir à l'ordre de <b>FFH</b> en mentionnant au dos le nom de la ou les personnes concernées 
	<? }?>
	et à envoyer à l'adresse suivante : <hr/><b>FFH Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?></b><br />
	42 rue Louis Lumière<br />75020 Paris<br />
	<hr/>
	Dès réception de votre paiement par nos services, vous recevrez un email de confirmation pour votre inscription défintive.

	<br/>
	Nous vous rappelons également que pour participer aux JNH <?= $this->Session->read('anneeEnCours');?> vous devez avoir une licence fédérale à jour au moment de l'événement.<br/><br/></p>
<? }?>

<? if($convoque != 1 and $montant_du != 0){?>
	<p>Vous avez effectué une inscription aux Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?> le : <b><?= $date_inscription;?></b><br/>
	Nous vous remercions de l'intérêt que vous portez à cet évènement !<br/><br/>
	Afin de terminer votre inscription, nous vous remercions de bien vouloir vous acquitter de la somme suivante, correspondant aux éventuelles prestations que vous avez commandées :
	<ul>
		<li>Montant à régler : <b><?= $montant_du;?> €</b></li>
	</ul>

	Retrouver le détail de vos prestations sur votre compte extranet dans la rubrique Hébergement Restauration.<br/><br/>

	<? if($facture_to_delegation != 0){?> Vous avez demandé à ce que vos frais soient intégrés à la facture de votre délégation<br/><br/>
		Le chèque global pour votre délégation est à établir à l'ordre de <b>FFH</b> en mentionnant au dos le nom de la ou les personnes concernées 
	<? } else {?>
		Le chèque  est à établir à l'ordre de <b>FFH</b> en mentionnant au dos le nom de la ou les personnes concernées 
	<? }?>
	et à envoyer à l'adresse suivante : <hr/><b>FFH Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?></b><br />
	42 rue Louis Lumière<br />75020 Paris<br />
	<hr/>
	Dès réception de votre paiement par nos services, vous recevrez un email de confirmation pour votre inscription défintive.

	<br/>
	Nous vous rappelons également que pour participer aux JNH <?= $this->Session->read('anneeEnCours');?> vous devez avoir une licence fédérale à jour au moment de l'événement.<br/><br/></p>
<? }?>

<p><b>Retrouvez toutes les informations nécessaires ci-dessous.</b></p>

<p>A très bientôt !<br/>
L’équipe d’organisation</p>
<hr/>



PRATIQUE : SUIVRE LE STATUT DE VOTRE INSCRIPTION • AVEC VOTRE COMPTE EXTRANET HANDISPORT<br/>
<ul>
	<li> <a href="<?= serveur;?>/users/login/1">https://extranet.handisport.org/users/login/1</a></li>	
</ul>



<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Anne-Flore ANGOT à : lesjournees@handisport.org ou 01 40 31 45 72<hr/>

Fédération Française Handisport<br/>
42 rue Louis Lumière 75020 Paris<br/>
www.handisport.org 















