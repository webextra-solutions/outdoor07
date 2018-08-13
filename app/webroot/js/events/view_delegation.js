
$(function() {

	$('#newPersonne').hide();

	// Recherche Structure 3
	$('.search-structureDeleg').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructureAll',
		select:  function(event, ui) { 
			$('#StructureDelegId').val(ui.item.id);
		},
		appendTo : '#newstructures'
	});

	// Recherche Personne
	$('.search-personne').autocomplete({
		minLength    : 3,
		source        : serveur+'/personnes/searchPersonne',
		select:  function(event, ui) { 
			$('#PersonneDelegId').val(ui.item.id);
		},
		appendTo : '#newparticipants'
	});

	 // BOITE DE DIALOGUE - Voir FAQ
	$(".tab").click(function(){
	  $('.tabActive').val($(this).attr("rel"));
	});


	// BOITE DE DIALOGUE - Voir STRUCTURE
	$(".structures").click(function(){
	        $("#voirStructure").modal();
	        $.get(serveur+'/delegations/viewStructure',{id : $(this).attr("rel")},function(data){
					$('#ajaxDataDelegationStr').empty().append(data);
			});
			return false;
	});

	

	//$('.inputIntention').attr('disabled',true);

	//$('.inputEngagement input').attr('disabled',true);


	$('#contact_urgence').show();



	


	


	$("#coord_name").mouseleave(function(){$('#urg_name').val($('#coord_name').val());});
	$("#coord_firstname").mouseleave(function(){$('#urg_firstname').val($('#coord_firstname').val());});
	$("#coord_tel").mouseleave(function(){
		var gsm = $("#coord_tel").val().substring(0,2); 

		if(gsm == '06' || gsm == '07'){
			$('#urg_tel').val($("#coord_tel").val());
		}

	});




	// VERIFICATION AVANT PUBLICATION
	$(".IM").change(function(){
		$('#nbIM').val(1);
	});

	// VERIFICATION AVANT PUBLICATION
	$(".SPCO").change(function(){
		$('#nbSPCO').val(1);
	});


	// VERIFICATION AVANT VALIDATION INTENTION
	$("#btnFinishIntention").click(function(){

		$( "#msg_error" ).empty();
		error = '';

		if($('#nbStr').val() == 0){
			error += "Veuillez affecter au moins 1 structure à votre délégation<br/>";
		}

		if($('#coord_name').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>nom</b> pour votre coordinateur<br/>";
		}
		if($('#coord_firstname').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>prénom</b> pour votre coordinateur<br/>";
		}
		if($('#coord_tel').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>téléphone</b> pour votre coordinateur<br/>";
		}



		if($('#urg_name').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>nom</b> pour votre contact urgence<br/>";
		}
		if($('#urg_firstname').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>prénom</b> pour votre contact urgence<br/>";
		}
		if($('#urg_tel').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>téléphone</b> pour votre contact urgence<br/>";
		}


		if($('#coord_email').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>email</b> pour votre coordinateur<br/>";
		}

		if($('#nbIM').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez remplir vos effectifs par indice de mobilité<br/>";
		}

		if($('#nbSPCO').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez remplir vos effectifs par épreuve<br/>";
		}

		if( $("#autonomie_intra0").is(':checked') || $("#autonomie_intra1").is(':checked')){
		} else {
			error += "<i class='glyphicons chevron-right'></i> Veuillez préciser si vous êtes autonome durant l’événement<br/>";		
		}

		if( $("#mode_transport").val()== ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez sélectionner un mode de transport<br/>";
		}
	


		if (error == ""){

			$('#finish_intention').val(1);
	  		$("#confirmForm").modal();  		
  			$("#BtnConfirmForm").click(function(){		
				$('#DelegationForm').submit();				
			});
		
			
			

		} else {

			$( "#msg_error" ).append( "<div>" + error + "</div>" );
			$("#error").modal();  
			return false;
			  
		} 
	});

	// VERIFICATION AVANT VALIDATION INTENTION
	$("#btnFinishEngagement").click(function(){

		$( "#msg_error" ).empty();
		error = '';

		if($('#nbStr').val() == 0){
			error += "Veuillez affecter au moins 1 structure à votre délégation<br/>";
		}

		if($('#coord_name').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>nom</b> pour votre coordinateur<br/>";
		}
		if($('#coord_firstname').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>prénom</b> pour votre coordinateur<br/>";
		}
		if($('#coord_tel').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>téléphone</b> pour votre coordinateur<br/>";
		}



		if($('#urg_name').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>nom</b> pour votre contact urgence<br/>";
		}
		if($('#urg_firstname').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>prénom</b> pour votre contact urgence<br/>";
		}
		if($('#urg_tel').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>téléphone</b> pour votre contact urgence<br/>";
		}


		if($('#coord_email').val() == ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez entrer un <b>email</b> pour votre coordinateur<br/>";
		}

		if($('#nbTeam').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez composer au moins une équipe<br/>";
		}

		if($('#verifEprParticipant').val() != 0){
			error += "<i class='glyphicons chevron-right'></i> 1 ou plusieurs de vos pratiquants n'ont pas d'épreuve affectée<br/>";
		}

		if($('#verifFullTeam').val() != 0){
			error += "<i class='glyphicons chevron-right'></i> 1 ou plusieurs de vos équipes sont incomplètes<br/>";
		}

		if($('#verifCapTeam').val() != 0){
			error += "<i class='glyphicons chevron-right'></i> 1 ou plusieurs de vos équipes n'ont pas de capitaine<br/>";
		}

		if($('#verif_participants_mobilite').val() != 0){
			error += "<i class='glyphicons chevron-right'></i> Vous n'avez pas précisé d'indice de mobilité pour 1 ou plusieurs de vos participants<br/>";
		}

		if($('#verif_participants_teeshirt').val() != 0){
			error += "<i class='glyphicons chevron-right'></i> Vous n'avez pas précisé de taille de teeshirt pour 1 ou plusieurs de vos participants<br/>";
		}

		if($('#capitaine_delegation').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Vous devez choisir un capitaine, parmi vos pratiquants, pour votre délégation<br/>";
		}


		

		/*if($('#nbEncadrants').val() == 0){
			error += "<i class='glyphicons chevron-right'></i> Veuillez affecter au moins 1 encadrant à votre délégation<br/>";
		}*/

		

		if( $("#autonomie_intra0").is(':checked') || $("#autonomie_intra1").is(':checked')){
		} else {
			error += "<i class='glyphicons chevron-right'></i> Veuillez préciser si vous êtes autonome durant l’événement<br/>";		
		}

		if( $("#DelegationTrAutonomie0").is(':checked') || $("#DelegationTrAutonomie1").is(':checked')){
		} else {
			error += "<i class='glyphicons chevron-right'></i> Veuillez préciser si vous êtes autonome pour votre arrivée et votre départ<br/>";		
		}

		
		if( $("#DelegationTrAutonomie0").is(':checked')){
			if( $("#mode_transport").val()== ''){
				error += "<i class='glyphicons chevron-right'></i> Veuillez sélectionner un mode de transport<br/>";
			}

			if ($("#DelegationTrSiteArrivee").val() == ''){
				error += "<i class='glyphicons chevron-right'></i> Veuillez sélectionner un lieu d'arrivée<br/>";
			}

			if ($("#DelegationTrSiteDepart").val() == ''){
				error += "<i class='glyphicons chevron-right'></i> Veuillez sélectionner un lieu de départ<br/>";
			}
		}



		



		if( $("DelegationTrJourArrivee").val()== ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez précisez votre jour d'arrivée<br/>";
		}

		if( $("DelegationTrJourDepart").val()== ''){
			error += "<i class='glyphicons chevron-right'></i> Veuillez précisez votre jour de départ<br/>";
		}




		if( $("#heb_conditions0").is(':checked') || $("#heb_conditions1").is(':checked')){
		} else {
			error += "<i class='glyphicons chevron-right'></i> Veuillez préciser si vous souhaitez des conditions particulières d'hébergement<br/>";		
		}

		var checked = $('input[type=checkbox][name*="Prestation"]:checked').length;
		if (checked == 0) {

			error += "<i class='glyphicons chevron-right'></i> Veuillez sélectionner au moins une prestation d'hébergement<br/>";
         
        }
	


		if (error == ""){

			$('#finish_engagement').val(1);
	  		$("#confirmForm").modal();  		
  			$("#BtnConfirmForm").click(function(){		
				$('#DelegationForm').submit();				
			});
		
			
			

		} else {

			$( "#msg_error" ).append( "<div>" + error + "</div>" );
			$("#error").modal();  
			return false;
			  
		} 
	});

	
	
	


});


/*$('#finish_intention').val(1);
	  		return confirm('Etes-vous sûr de vouloir continuer ?\nPassée cette étape, votre intention de participation sera alors terminée.\nVous ne pourrez plus modifier les informations.');*/