

  <? $connections = $this->requestAction('connections/indexAccueil');?>

  <script>

$(function() {

// BOITE DE DIALOGUE - Voir Support
<? if($msg_accueil == 0){?>
        $("#msgAccueil").modal();

<? }?>      



$("#form_msg_accueil").bind("submit", function (event) {
	$.ajax({async:true, data:$("#form_msg_accueil").serialize(), type:"POST", url:"\/users\/skipMsgAccueil"});
	$("#msgAccueil").modal('hide');
	return false;
	
});

});
</script>


<? setlocale(LC_TIME, 'fr_FR');?>


<?php $this ->assign('title_content', 'Tableau de bord - '.$this->Time->format(date('Y-m-d H:i:s'), '%A %e %B %Y // %H:%M'));?>





<div class="row">
  <div class="col-md-3">

    <!-- PROCHAINE SEANCE -->
    <div class="panel panel-default">            
      <div class="panel-heading"><h4>Prochaine séance</h4></div>
      <div class="panel-body">

        <? if(count($seance) >= 1){?>
        <table>
          <tr>
            <td>Séance N°<?= $seance['Seance']['num'];?>  • <?= $seance['Seance']['date'];?></td><td align="right" width="30">
              <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                  array('controller' => 'seances', 'action' => 'view', $seance['Seance']['id'],'personnes'), 
                  array('disabled' => false, 'class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
              );?></td></tr>
        </table>
        <? } else {?>

        Pas de séance à venir...

        <? }?>
      </div>
    </div>
  </div>

  <div class="col-md-3">
   <!-- LISTE DES CONNEXIONS EXTRANET-->
    <div class="panel panel-default">
        <div class="panel-heading">Dernières connexions</div>
        <div class="panel-body">
            <table cellspacing="0">
                <?php foreach ($connections as $row): ?>
                <tr class='lienTR'>
                    <td width="20"><i class="glyphicons chevron-right"></i></td>
                    <td><?php  echo $row['User']['Personne']['FN']; ?></td>
                    <td><?= $this -> Formatage -> dateHrFR($row['Connection']['created_last']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php unset($result); ?>
            </table>
        </div>
    </div>

</div>



<?
	// Profil - GESTIONNAIRE et CONSULTANT FEDERAL
	//if($this->Session->read('profil_user_id') == 4){ echo $this->element('accueil_GF'); }

  // Profil - CONSULTANT FEDERAL
//if($this->Session->read('profil_user_id') == 7){ echo $this->element('accueil_CF'); }

    // Profil - GESTIONNAIRE COMMISSION SPORTIVE
  //if($this->Session->read('profil_user_id') == 1){ echo $this->element('accueil_GCS'); }

  // Profil - GESTIONNAIRE et CONSULTANT DEPARTEMENTAL
  //if($this->Session->read('profil_user_id') == 2){ echo $this->element('accueil_GD'); }

  // Profil - GESTIONNAIRE et CONSULTANT REGIONAL
  //if($this->Session->read('profil_user_id') == 3){ echo $this->element('accueil_GR'); }


  // Profil - GESTIONNAIRE et CONSULTANT FEDERAL
 // if($this->Session->read('profil_user_id') == 8){ echo $this->element('accueil_GI'); }

  /*// Profil - GESTIONNAIRE et CONSULTANT FEDERAL
  if($this->Session->read('profil_user_id') == 1){ echo $this->element('accueil_GCS'); }

*/
?>

</div>





