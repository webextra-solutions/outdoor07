Cher(e) <b><?= $user;?></b>,



<p>Vous avez effectué une inscription aux Journées Nationales Handisport <?= $this->Session->read('anneeEnCours');?> le : <b><?= $date_inscription;?></b><br/><br/>

Nous vous confirmons que nous avons bien pris en compte votre demande d’annulation :<br/>
 - Annulation effectuée le : <b><?= $date_annulation;?></b><br/>
 - Pour le motif suivant :<b><?= $annulation_details;?></b><br/><br/>
Nous vous rappelons qu’à compter du 10 mars <?= $this->Session->read('anneeEnCours');?>, aucun remboursement ne pourra être effectué sur les prestations comprenant hébergement et/ou restauration.

<p>Sportivement,
<br/>
L’équipe d’organisation</p>



<hr/>PRECISONS, RENSEIGNEMENTS COMPLEMENTAIRES<br/> Contacter Anne-Flore ANGOT à : lesjournees@handisport.org ou 01 40 31 45 72<hr/>

Fédération Française Handisport<br/>
42 rue Louis Lumière 75020 Paris<br/>
www.handisport.org 















