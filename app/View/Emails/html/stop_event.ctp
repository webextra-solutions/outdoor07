<? if($stop_event ==1){?>L'évenement suivant a été bloqué par <b><?= $stopEvent_declarant;?></b> le <b><?= date('d/m/Y à H:i');?></b><br/>
<? } else {?>L'évenement suivant a été débloqué par <b><?= $stopEvent_declarant;?></b> le <b><?= date('d/m/Y à H:i');?></b><br/><? }?>
Motif(s) : <b><?= $stop_event_details;?></b>
<hr/>

Libellé de l'évènement : <b><?= $event_name;?></b><br/>
Département : <b><?= $departement;?></b><br/>
Dates : <b><?= $event_dates;?></b><br/>
Déclaré par <b><?= $event_declarant;?></b> le <b><?= date('d/m/Y à H:i');?></b><hr/>
Cet email a été transmis aux différents utilisateurs concernés en fonction de la nature de l'événement (Comité régional, Comité départemental, Commission sportive).
