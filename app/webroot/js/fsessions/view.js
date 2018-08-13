// JavaScript POUR - Fsessions/view.cyp
$(function() {

	$("#description").change(function(){
	  $('#isChanged').val(1);
	});

	$("#submitEventForm").click(function(){
	  $('#isChanged').val(0);
	});

	

	 $(window).bind('beforeunload', function() {
        if ($('#isChanged').val()=='1') {
            return 'Vous avez modifié certaines données ! Pensez à sauvegarder ces données en cliquant sur - SAUVEGARDER - en bas de votre page';
        }
    }); 

	

	

	// Nouveau lieu - Lieu principal
	$("#SiteName1").hide();
	$('#first').change(function(){

		var selected = $(this).val();
		if(selected == 1){
			$("#SiteName").val('Lieu principal');
			$("#SiteName1").hide();
			$('#SitePublished').prop('checked', true);
			$('#SitePublished').attr('disabled', true);
		} else {
			$("#SiteName").val('');
			$("#SiteName1").show();
			$('#SitePublished').removeAttr('checked');
			$('#SitePublished').removeAttr('disabled');
		}

	});


	// VERIFICATION AVANT PUBLICATION
	$(".submitCNFH").click(function(){
		error = '';

		if($('#nbRP').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez affecter au moins 1 responsable pédagogique.<br/>";
		}

		if($('#nbOrgas').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez affecter au moins 1 organisateur à votre session de formation.<br/>";
		}


		if($('#nbDatesLieux').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez affecter au moins 1 bloc Dates & lieu à votre session de formation.<br/>";
		}

		if($('#verifPlanning').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez ajouter un planning à votre session de formation.<br/>";
		}


		
		if(($('#contact_tel').val() == '' && $('#contact_email').val() == '')) {
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer au moins un contact tél ou email.\n";
		}
		
		if (error == ""){
			$('#confirm').empty();
			$('#confirm').append('Etes-vous sur de vouloir demander l\'agrément pour cette session de formation ?');
			$("#confirmForm2").modal();

			return false;
			
			

			//return confirm('Etes-vous sur de vouloir demander l\'agrément pour cette session de formation ?');

		} else {
			$('#headerAlert').empty();
			$('#headerAlert').append('Vous ne pouvez pas demander l\'agrément !');
			$('#alerts').empty();
			$('#alerts').append(error);
			$("#alertForm").modal();
			return false;		  
		} 

		
		
		
	});

	$("#confirmOui").click(function(){
			$('#FsessionForm').submit();
		});

	
	
	
	



});
