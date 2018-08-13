<script type="text/javascript">
	$(function() {
		

		// BOITE DE DIALOGUE - Voir Experience
		$(".extranetPOWER").click(function(){

	        $("#voirExtranetPOWER").modal();
	        $.get(serveur +'/modules/viewExtranetPower',{id : $(this).attr("rel")},function(data){
					$('#ajaxDataExtranetPOWER').empty().append(data);
			});
			return false;
		});

		

		
	});

</script>

<?php $this ->assign('title_content', '<i class="glyphicons cogwheels"></i> Paramètres');?>

<? if($this->Session->read('user_id') == 23){?>


<? if($extraPOW['Module']['extranet_off'] == 1){?>
<h5>Extranet actuellement fermé</h5>
<button type="button" class="btn btn-success btn-sm extranetPOWER" rel="1"><i class="glyphicons ok_2"></i> OUVRIR EXTRANET</button>
<? } else {?>
<h5>Extranet actuellement ouvert</h5>
<button type="button" class="btn btn-danger btn-sm extranetPOWER" rel="1"><i class="glyphicons power"></i> FERMER EXTRANET</button>
<? }?>
<? }?>



<!-- BOITE DE DIALOGUE - VOIR EXTRANET POWER -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="voirExtranetPOWER" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="ajaxDataExtranetPOWER"></div>       
    </div> 
</div>