 <?=$this->Form->input('Seance.num', array(
			        'type' => 'select',
			        'options' => $this->Listes->genererListeNb(100),
			        'label' => 'Numéro',
			        'empty' => 'sélectionner'
			    ));?>


 <?=$this->Form->input('Seance.nb_groups', array(
        'type' => 'select',
        'options' => array(1 => 1,2=>2,3=>3,4=>4,5=>5),
        'label' => 'Nombre de groupes',
        'empty' => 'sélectionner'
    ));?>

 <?= $this->Form->input('payante', array(
    'type' => 'radio',
    'before' => '<div><label class="col col-md-3 control-label">Séance payante</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'
    )
  )); ?>


<?= $this->Form->input('active_others_persons', array(
    'type' => 'radio',
    'before' => '<div><label class="col col-md-3 control-label">Activer - Personnes supplémentaires (Parents,amis,...)</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'
    )
  )); ?>


<?= $this->Form->input('active_montant_supp', array(
    'type' => 'radio',
    'before' => '<div><label class="col col-md-3 control-label">Activer - Montant supplémentaire</label></div>',
    'legend' => false,
    'class' => false,
    'options' => array(
      1 => 'Oui',
      0 => 'Non'
    )
  )); ?>

<hr/>


		<div class="row">


				<? for ($i=1; $i <= $seance['Seance']['nb_groups']; $i++) {

					if($seance['Seance']['nb_groups'] >= 4){$col = 3;}
					if($seance['Seance']['nb_groups'] == 3){$col = 4;}
					if($seance['Seance']['nb_groups'] == 2){$col = 6;}
					if($seance['Seance']['nb_groups'] == 1){$col = 12;}



					?>

				<div class="col-md-<?= $col;?>">

					<h4>Goupe <?= $i;?></h4><hr/>
					<?=$this->Form->input('Seance.date_gp'.$i, array(
					    'type' => 'text',
					    'placeholder' => 'jj/mm/aaaa',
					    'label' => 'Date',
					    'beforeInput' => '<div id="debut"><div class="input-group date">',
					    'afterInput' => '<span class="input-group-addon"><i class="glyphicons calendar"></i></span></div></div>'
					));?>

					<?=$this->Form->input('Seance.debut_gp'.$i, array(
					    'type' => 'text',
					    'placeholder' => '00:00',
					    'label' => 'Début'
					));?>

					<?=$this->Form->input('Seance.fin_gp'.$i, array(
					    'type' => 'text',
					    'placeholder' => '00:00',
					    'label' => 'Fin'
					  ))?>

					<?=$this->Form->input('Seance.rdv_gp'.$i, array(
					    'type' => 'text',
					    'placeholder' => 'Ex: Crussol - Saint-Péray',
					    'label' => 'Rendez-vous'
					  ))?>

					<?=$this->Form->input('Seance.autres_informations_gp'.$i, array(
					    'placeholder' => 'Ex:',
					    'label' => 'Informations'
					));?>
				</div>

				<? }?>
			</div>






<!--		--><?//=$this->Form->input('Seance.sport1_gp1', array(
//		    'type' => 'select',
//		    'options' => $this->Listes->sports(),
//		    'label' => 'Activité 1',
//		    'empty' => 'sélectionner'
//		));?>
<!---->
<!--		--><?//=$this->Form->input('Seance.sport2_gp1', array(
//		    'type' => 'select',
//		    'options' => $this->Listes->sports(),
//		    'label' => 'Activité 2',
//		    'empty' => 'sélectionner'
//		));?>
<!---->
<!---->
<!--		-->
<!---->
<!---->
<!--		 --><?//=$this->Form->input('Seance.lieu_rdv', array(
//		    'type' => 'text',
//		    'placeholder' => 'Ex : Parc de Chavaray - Saint-Peray',
//		    'label' => 'Lieu de départ'
//		));?>
<!---->
<!--		<hr/>-->
<!---->
<!--		--><?//=$this->Form->input('Seance.besoins_materiels', array(
//		    'placeholder' => 'Ex:',
//		    'label' => 'Matériels nécessaires'
//		));?>
<!---->
<!--		<hr/> -->
<!---->
<!--		--><?//=$this->Form->input('Seance.besoins_accompagnateurs', array(
//		    'placeholder' => 'Ex:',
//		    'label' => 'Besoins accompagnateurs'
//		));?><!---->
<!---->
<!--	-->




