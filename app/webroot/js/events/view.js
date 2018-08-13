// JavaScript POUR - Events/view.cyp
$(function() {

	// Recherche Structure 3
	$('.search-structureOrga').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructureAll',
		select:  function(event, ui) { 
			$('#StructureId').val(ui.item.id);
		},
		appendTo : '#newEventOrga'
	});

	$("#description").change(function(){
	  $('#isChanged').val(1);
	});

	$("#submitEventForm").click(function(){
	  $('#isChanged').val(0);
	  $('#AapGoAap').val(0);
	  $('#AapValidAap').val(0);
	  $('#AapBilanAap').val(0);
	  $('#AapCancelAap').val(0);
	  $('#AapAttribAap').val(0);

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
			$('#SitePublished').attr('readonly', true);

		} else {
			$("#SiteName").val('');
			$("#SiteName1").show();
			$('#SitePublished').removeAttr('checked');
			$('#SitePublished').removeAttr('readonly');
		}

	});


	// VERIFICATION AVANT PUBLICATION
	$("#btnPublier").click(function(){

		//alert($('#nbLieux').val()); 

		error = '';

		if($('#nbOrgas').val() == 0){
			error += "Veuillez affecter au moins 1 organisateur à votre événement\n";
		}

		if($('#nbSports').val() == 0 && $('#event_type_sport').val() == 1){
			error += "Veuillez affecter au moins 1 sport à votre événement\n";
		}

		if($('#calendar_ffh_published').val() == 0){
			error += "Veuillez préciser si votre événement doit faire l'objet d'une publication nationale (Onglet Général)\n";
		}

		// Exception utilisatuer CMS pour événement par Zone
		if(
	        $('#profil_structure_id').val() == 204 || 
	        $('#profil_structure_id').val() == 217 ||  
	        $('#profil_structure_id').val() == 207 || 
	        $('#profil_structure_id').val() == 204 || 
	        $('#profil_structure_id').val() == 3216
		  ){
				
		} else {
			if($('#nbLieux').val() == 0){
				error += "Veuillez affecter au moins 1 lieu principal à votre événement\n";
			}
		}


		if($('#contact_structure').val() == ''){
				error += "Veuillez entrer une structure de contact\n";
		}

		if(
			($('#contact_tel').val() == '' && $('#contact_email').val() == '')
			) 
			{
				error += "Veuillez entrer au moins un contact tél ou email\n";
		}
		
		if (error == ""){



			$('#publication').val(1);

			if($('#delaiPublication').val() == 1){
				return confirm('Attention, ce type d\'événement fait l\'objet d\'un délai de publication pour vérification.\n Il ne sera publié que 7 jours après votre action de publication. \nEtes-vous sur de vouloir publier votre événement ?');
			} else {
				return confirm('Etes-vous sur de vouloir publier votre événement ?');

			}
		
		
		} else {
		 	alert(error);


			return false;
		  
		} 	
	});


	// VERIFICATION AVANT TRANSMISSION APPEL A PROJET
	$("#btnGoAap").click(function(){

		//alert($('#AapBpAap').val().length); 

		error = '';

		if($('#nbOrgas').val() == 0){
			error += "Veuillez affecter au moins 1 organisateur à votre événement\n";
		}

		if($('#nbSports').val() == 0 && $('#event_type_sport').val() == 1){
			error += "Veuillez affecter au moins 1 sport à votre événement\n";
		}

		
		if($('#nbLieux').val() == 0){
			error += "Veuillez affecter au moins 1 lieu principal à votre événement\n";
		}


		// GENERAL
		
			if($('#AapNamePorteurAap').val() == ''){
					error += "Veuillez entrer un nom de porteur de projet\n";
			}

			if($('#AapTelPorteurAap').val() == ''){
					error += "Veuillez entrer un numéro de téléphone pour le porteur de projet\n";
			}

			if($('#AapEmailPorteurAap').val() == ''){
					error += "Veuillez entrer un email pour le porteur de projet\n";
			}

			if($('#AapSitesSportifsAap').val() == ''){
					error += "Veuillez renseigner les sites sportifs\n";
			}

			if($('#AapSitesHebergAap').val() == ''){
					error += "Veuillez renseigner les sites d‘hébergement\n";
			}

			if( $("#AapDeclaDdjscsAap0").is(':checked') == false && $("#AapDeclaDdjscsAap1").is(':checked') == false){
		        error += "Veuillez préciser si vous avez réalisé une déclaration DDJSCS\n";    
		      }
	    

			if($('#AapDescriptionAap').val() == ''){
					error += "Veuillez renseigner une description pour votre projet\n";
			}


		// OBJECTIFS


		if($('#AapObjA1').val() == '' && $('#AapObjA2').val() == '' && $('#AapObjAAutres').val() == ''){
				error += "Veuillez vous positionner sur les objectifs - Positionnement du séjour\n";
		}

		if($('#AapObjB1').val() == '' && $('#AapObjB2').val() == '' && $('#AapObjB3').val() == '' && $('#AapObjB4').val() == '' && $('#AapObjBAutres').val() == ''){
				error += "Veuillez vous positionner sur les objectifs sportifs\n";
		}

		if($('#AapObjC1').val() == '' && $('#AapObjC2').val() == '' && $('#AapObjC3').val() == '' && $('#AapObjC4').val() == '' && $('#AapObjCAutres').val() == ''){
				error += "Veuillez vous positionner sur les objectifs extra-sportifs\n";
		}


		// EFFECTIFS


		if($('#AapEffectifPrevMoins18Aap').val() == '' || $('#AapEffectifPrev18-35Aap').val() == '' || $('#AapEffectifPrevPlus35Aap').val() == ''){
				error += "Veuillez préciser vos effectifs prévisionnels par âge\n";
		}

		if($('#AapEffectifPrevFmAap').val() == '' || $('#AapEffectifPrevFeAap').val() == '' || $('#AapEffectifPrevMmAap').val() == '' || $('#AapEffectifPrevMAap').val() == '' || $('#AapEffectifPrevDvAap').val() == '' || $('#AapEffectifPrevDaAap').val() == ''){
				error += "Veuillez préciser vos effectifs prévisionnels par handicap\n";
		}

		if($('#AapEffectifPrevHAap').val() == '' || $('#AapEffectifPrevFAap').val() == ''){
				error += "Veuillez préciser vos effectifs prévisionnels par sexe\n";
		}

		if($('#AapEffectifPrevValideAap').val() == ''){
				error += "Veuillez préciser vos effectifs - personnes valides\n";
		}

		if($('#AapEffectifPrevEncadrementSportifAap').val() == ''){
				error += "Veuillez préciser vos effectifs - Encadrement sportif\n";
		}

		if($('#AapEffectifPrevVieQuotidienneAap').val() == ''){
				error += "Veuillez préciser vos effectifs - Vie quotidienne\n";
		}

		if($('#AapBpAap').val().length == 0 && $('#EventBpAapExist').val() == 0){
				error += "Veuillez charger votre budget prévisionnel\n";
		}

		if($('#AapPlanningAap').val().length == 0 && $('#EventPlanningAapExist').val() == 0){
				error += "Veuillez charger votre planning prévisionnel\n";
		}

		
		if (error == ""){
			$('#AapGoAap').val(1);		
			return confirm('Etes-vous sur de vouloir transmettre votre appel à projet ?');		
		} else {
		 	alert(error);
			return false;
		  
		} 				
	});


	// VERIFICATION AVANT VALIDATION APPEL A PROJET
	$("#btnValidAap").click(function(){
		error = '';
		if($('#AapMontantFinancementPrevuAap').val() == ''){
				error += "Veuillez entrer un montant pour le financement prévu de cet appel à projet\n";
		}

		if($('#AapAppreciationAap').val() == null){
				error += "Veuillez entrer une appréciation pour cet appel à projet\n";
		}
		if (error == ""){
			$('#AapValidAap').val(1);
				return confirm('Etes-vous sur de vouloir valider cette étape ?');
		} else {
		 	alert(error);
			return false;		  
		} 				
	});

	// VERIFICATION AVANT VALIDATION APPEL A PROJET
	$("#btnAttribAap").click(function(){
		error = '';
		if($('#AapMontantFinancementAttribueAap').val() == ''){
				error += "Veuillez entrer un montant pour le financement attribué de cet appel à projet\n";
		}

		if($('#AapAppreciationAap').val() == null){
				error += "Veuillez entrer une appréciation pour cet appel à projet\n";
		}
		if (error == ""){
			$('#AapAttribAap').val(1);
				return confirm('Etes-vous sur de vouloir valider cette étape?');
		} else {
		 	alert(error);
			return false;		  
		} 				
	});


	// VERIFICATION AVANT VALIDATION APPEL A PROJET
	$("#btnSubmitBilan").click(function(){
		error = '';



      	if(
      		$('#AapBilanBeneficiaire0').val() == '' || 
      		$('#AapBilanPointsPositifs').val() == '' || 
      		$('#AapBilanPointsEvolution').val() == '' || 
      		$('#AapBilanNbFirstSejour').val() == '' || 
      		$('#AapBilanPointsPositifs').val() == '' || 


      		($("#AapBilanBeneficiaire20").is(':checked') == false && $("#AapBilanBeneficiaire21").is(':checked') == false) || 
      		$('#AapBilanBeneficiaire2Detail').val() == '' || 
      		$('#AapBilanBeneficiaire3').val() == '' || 
      		$('#AapBilanBeneficiaire3Detail').val() == '' || 
      		$('#AapBilanBeneficiaire4').val() == '' || 
      		$('#AapBilanBeneficiaire4Detail').val() == '' || 
      		($("#AapBilanBeneficiaire50").is(':checked') == false && $("#AapBilanBeneficiaire51").is(':checked') == false) ||  
      		$('#AapBilanBeneficiaire5Detail').val() == '' || 

      		($("#AapBilanStr11").is(':checked') == false && $("#AapBilanStr10").is(':checked') == false) || 
      		$('#AapBilanStr1Detail').val() == '' ||

      		($("#AapBilanStr21").is(':checked') == false && $("#AapBilanStr20").is(':checked') == false) || 
      		$('#AapBilanStr2Detail').val() == '' || 


      		$('#AapEffectifPrevMoins18AapReel').val() == '' || 
      		$('#AapEffectifPrev18-35AapReel').val() == '' || 
      		$('#AapEffectifPrevPlus35AapReel').val() == '' ||
      		$('#AapEffectifPrevFmAapReel').val() == '' ||  
      		$('#AapEffectifPrevFeAapReel').val() == '' || 
      		$('#AapEffectifPrevMmAapReel').val() == '' || 
      		$('#AapEffectifPrevMAapReel').val() == '' || 
      		$('#AapEffectifPrevDvAapReel').val() == '' || 
      		$('#AapEffectifPrevDaAapReel').val() == '' || 
      		$('#AapEffectifPrevFeAapReel').val() == '' || 
      		$('#AapEffectifPrevHAapReel').val() == '' || 
      		$('#AapEffectifPrevFAapReel').val() == '' || 
      		$('#AapEffectifPrevValideAapReel').val() == '' || 
      		$('#AapEffectifPrevEncadrementSportifAapReel').val() == '' || 
      		$('#AapEffectifReelEncadrementVieQuotidienneAapReel').val() == '' ||
      		$('#AapNbJoursReel').val() == ''


      		){
				error += "Des réponses sont manquantes sur votre onglet BILAN Test\n";  
		}




      

		if($('#AapBquantAap').val().length == 0 && $('#EventBquantAapExist').val() == 0){
				error += "Veuillez charger votre budget quantitatif\n";
		}

		/*if($('#AapCouvMedAap').val().length == 0 && $('#EventPlanningAapExist').val() == 0){
				error += "Veuillez charger votre couverture médiatique\n";
		}*/



		/*if($('#EventBquantAap').val() == '' ){
				error += "Veuillez charger votre bilan quantitatif\n";
		}
		if($('#EventBqualAap').val() == '' ){
				error += "Veuillez charger votre bilan qualitatif\n";
		}
		if($('#EventListePartsAap').val() == '' ){
				error += "Veuillez charger votre bilan quantitatif\n";
		}*/
		if (error == ""){
				$('#AapBilanAap').val(1);
				return confirm('Etes-vous sur de vouloir soumettre votre bilan pour cet appel à projet ?');
		} else {
		 	alert(error);
			return false;		  
		} 				
	});

	// VERIFICATION AVANT REFUS APPEL A PROJET
	$("#btnCancelAap").click(function(){
		error = '';
		if($('#EventMontantFinancementAap').val() == '' || $('#EventMontantFinancementAap').val() == null){
		} else {
				error += "Vous ne pouvez pas attribuer de montant financement !\n";
		}

		if($('#EventAppreciationAap').val() == ''){
				error += "Veuillez attribuer une appréciation au projet\n";
		}
		if (error == ""){


			$('#AapCancelAap').val(1);
				return confirm('Etes-vous sur de vouloir refuser cet appel à projet ?');
		} else {
		 	alert(error);
			return false;		  
		} 				
	});


	
	
	
	// Ajout année au libellé
	$("#btnLibAuto").click(function(){	
		if( $("#multisport0").is(':checked')){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#activite").val() + ' - ' + $("#villeFR").val().toUpperCase() + ' ' + $("#year").val());	
		} 
		if( $("#multisport1").is(':checked') ){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#villeFR").val().toUpperCase() + ' ' + $("#year").val());	
		}
	});

	// VERIFICATION AVANT PUBLICATION
	$("#btnDePublier").click(function(){
		

			$('#publication').val(2);
		  
		
	});




});
