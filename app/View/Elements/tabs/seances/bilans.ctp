


<div class="row">


	<? for ($i=1; $i <= $seance['Seance']['nb_groups']; $i++) {

		if($seance['Seance']['nb_groups'] >= 4){$col = 3;}
		if($seance['Seance']['nb_groups'] == 3){$col = 4;}
		if($seance['Seance']['nb_groups'] == 2){$col = 6;}


		?>

	<div class="col-md-<?= $col;?>">

		<?=$this->Form->input('Seance.bilan_gp'.$i, array(
		    'placeholder' => 'Ex:',
		    'label' => 'Bilan global - Groupe'.$i
		));?>
	</div>

	<? }?>
</div>

