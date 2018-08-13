$(function() {

	// Rechercher UN SPORT
	$('.search-sport2').autocomplete({
		minLength    : 2,
		source        : serveur+'/sports/searchSport',
		select:  function(event, ui) { 
			$('#SportId').val(ui.item.id);
			if(ui.item.id == 4){
				$('#specialSportCo').show();
			} else {
				$('#specialSportCo').hide();
			}
		}
	});

	
	
	$( "#EventTitre" ).hide();
	$( "#EventSousType" ).hide();
	$( "#EventType" ).hide();
	$( "#EventTypeComp" ).hide();
	$( "#EventName" ).hide();
	$( "#EventNameAuto" ).hide();
	$( "#EventYear" ).hide();
	$('#EventVilleETR').hide();
	$('#EventVilleFR').hide();
	$( "#EventActivite" ).hide();
	$( "#EventDates" ).hide();
	$( "#EventPays" ).hide();
	$( "#EventDep" ).hide();
	$("#infoLibAuto").hide();
	$("#EventMultisport").hide();
	$("#EventOrga").hide();
	$("#EventOrgaName").hide();
	$("#EventOrgaHorsFFH").hide();
	$("#helpBlock_multisport").hide();
	$( "#alertAAP" ).hide();




	

	
	$('.direct').change(
function(){

     $('#EventForm').submit();

});
	//$( "#EventCompet" ).hide();
	//$( "#EventTitre" ).hide();
	//$( "#EventNiveau" ).hide();
	//$( "#EventType" ).hide();
	//$( "#EventName" ).hide();
	//$('#continue').attr("disabled", "disabled");


	$("input[type=reset]").click(function() {
	    $( "#EventTypeComp" ).hide();
	    $( "#EventNiveau" ).hide();
		$( "#EventType" ).hide();
		$( "#EventYear" ).hide();
		$( "#EventDep" ).hide();
		$('#EventVilleETR').hide();
		$('#EventVilleFR').hide();
		$( "#EventActivite" ).hide();
		$( "#EventDates" ).hide();	
		$( "#EventPays" ).hide();	
		$( "#infoLibAuto").hide();
		$( "#EventName").hide();
		$( "#EventNameAuto" ).hide();
		$("#EventMultisport").hide();
		$("#EventOrga").hide();
		$("#EventOrgaName").hide();
		$("#EventOrgaHorsFFH").hide();
		$("#helpBlock_multisport").hide();

		$(':input','#EventForm')
		  .removeAttr('checked')
		  .removeAttr('selected')
		  .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
		  .val('');

		});

	
	

	// EVENEMENT COMPETITIF : OUI/NON
	$(".compet").change(function(){

			$( "#EventNiveau" ).show();
			$( "#EventName" ).hide();
			$( "#EventNameAuto" ).hide();
			$( "#EventTypeComp" ).hide();
			$( "#EventType" ).hide();
			$( "#EventDates" ).hide();	
			$( "#EventDep" ).hide();
			$('#niveau').val('');
			$("#infoLibAuto").hide();
			$("#EventYear").hide();
			$("#EventActivite").hide();
			$('#EventVilleETR').hide();
			$("#helpBlock_multisport").hide();
			$('#EventVilleFR').hide();
			$( "#EventPays" ).hide();
			$("#EventMultisport").hide();
			$("#EventOrga").hide();
			$("#EventOrgaName").hide();
			$("#EventOrgaHorsFFH").hide();
			$("#helpBlock_multisport").hide();

			$('#Reference0, #Reference1').removeAttr('checked');
			$('#Multisport0, #Multisport1').removeAttr('checked');


	});

	

	

	// NIVEAU GEOGRAPHIQUE
	$('#niveau').change(function(){


		$( "#EventType" ).show();
		

		$( "#EventName" ).hide();
		$( "#EventNameAuto" ).hide();
		$( "#EventTypeComp" ).hide();
		$( "#EventDates" ).hide();	
		$( "#EventDep" ).hide();
		$("#infoLibAuto").hide();
		$("#EventYear").hide();
		$("#EventActivite").hide();
		$('#EventVilleETR').hide();
		$('#EventVilleFR').hide();
		$( "#EventPays" ).hide();
		$("#EventMultisport").hide();
		$("#EventOrga").hide();
		$("#EventOrgaName").hide();
		$("#EventOrgaHorsFFH").hide();
		$("#helpBlock_multisport").hide();

		$('#Reference0, #Reference1').removeAttr('checked');
		$('#Multisport0, #Multisport1').removeAttr('checked');




	});


	// TYPE
	$('#type').change(function(){
		
		$("#nameAuto").val('');

		var selected = $(this).val();

		if(selected == 117){
			$("#alertAAP").show();
		} else {
			$("#alertAAP").hide();
		}

		// ajax
		$.get(serveur+'/events/ajax_get_champ',
			{ id : $(this).val() },
			function(data){


			
				if(data == 1){
					if($( "#niveau" ).val() == 6){
						$( "#EventPays" ).show();
					}
					$("#infoLibAuto").show();
					$("#eventAuto").val(1);
					$( "#EventTypeComp" ).show();
					
					
					$('#nameAuto').attr('name', 'data[Event][name]');
					$('#name').attr('name', 'data[Event][name3]');
					$("#EventOrga").show();
					
					$( "#EventYear" ).show();
					$( "#EventDep" ).show();
					$( "#EventVille" ).show();
					$('#EventVilleETR').hide();
					$('#EventVilleFR').show();
					$("#EventName").hide();
					$("#helpBlock_multisport").hide();
					
					$( "#EventDates" ).show();
					$("#EventMultisport").show();
					$("#EventOrgaName").show();
					$("#EventOrgaHorsFFH").hide();

					$('#Reference0, #Reference1').removeAttr('checked');
					$('#Multisport0, #Multisport1').removeAttr('checked');
				} else {
					$("#eventAuto").val(0);
					if($( "#niveau" ).val() == 6){
						$( "#EventPays" ).show();
					}
					$("#infoLibAuto").hide();
					$( "#EventTypeComp" ).hide();
					
					$('#name').attr('name', 'data[Event][name]');
					$('#nameAuto').attr('name', 'data[Event][name3]');

					$('#name').val("Type événement + Complément et/ou sport + Ville (FRA) + Année");
					$("#EventName").show();
					
					$("#EventOrga").show();
					
					$( "#EventDates" ).show();
					$( "#EventDep" ).show();
					$( "#EventYear" ).hide();
					$( "#EventVilleFR" ).hide();
					
					$("#EventMultisport").hide();
					$("#EventOrgaName").show();
					$("#EventOrgaHorsFFH").hide();
					$("#helpBlock_multisport").hide();

					$('#Reference0, #Reference1').removeAttr('checked');
					$('#Multisport0, #Multisport1').removeAttr('checked');

				}
			
			}
			
		);

	});

	// EVENEMENT MULTISPORT
	$("#multisport1").click(function(){
		$("#EventActivite").hide();
		$("#helpBlock_multisport").show();
	});

	$("#multisport0").click(function(){
		$("#EventActivite").show();
		$("#helpBlock_multisport").hide();
	});
		
			
	// ORGANISATEUR
	$("#reference0").click(function(){
		$('#EventOrgaName label').html('Structure FFH de référence <i class="glyphicons circle_question_mark" title="Club/comité/commission FFH impliqués dans l’organisation et servant de structure de référence"></i>');
		$("#EventOrgaName").show();
		$("#EventOrgaHorsFFH").show();
		
	});

	


	// Ajout année au libellé
	$("#btnLibAuto").click(function(){	

		paysAlpha = $("#pays option:selected").text();
		arrayPays = paysAlpha.split('(');	

		if( $("#multisport0").is(':checked')){
			if( $("#pays").val() == 75){
				$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#activite").val() + ' - ' + $("#villeFR").val().toUpperCase() + ' (' + arrayPays[1] + ' - ' + $("#year").val());	
			} else {
					
				$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#activite").val() + ' - ' + $("#villeETR").val().toUpperCase()+ ' (' + arrayPays[1] + ' - ' + $("#year").val());	
			}
		} 
		if( $("#multisport1").is(':checked') ){
			if( $("#pays").val() == 75){
				$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#villeFR").val().toUpperCase() + ' (' + arrayPays[1] + ' - ' + $("#year").val());	
			} else {
				$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#villeETR").val().toUpperCase()+ ' (' + arrayPays[1] + ' - ' + $("#year").val());	
			}
		}
	});

	// DEPARTEMENT EN FONCTION DU PAYS
	$("#pays").change(function(){

		var selected = $(this).val();
		if( selected == 75 ){	
			$( "#EventDep" ).show();
			$('#EventVilleETR').hide();
			$('#villeETR').val('');
			$('#EventVilleFR').show();
		} else {
			$( "#EventDep" ).hide();
			$( "#departement").val('');
			$('#EventVilleFR').hide();
			$('#villeFR').val('');
			$('#EventVilleETR').show();
		}	
	});

	$("#EventForm").validate({
		rules: {
			'data[Event][niveau]': {required:true},
			'data[Event][name]': {required:true},
			'data[Event][type]': {required:true},
		    'data[Event][cdc_file]': {
		    	extension: "pdf|doc|docx|xls|xlsx",
		    	maxfilesize: "2Mo"
		    },
		    'data[Event][multisport]': {
		     	required: function(element) {
		        	return $("#eventAuto").val() == 1;
		    	}
    		},

    		'data[Event][ffh]': {
		     	required: function(element) {
		        	return $("#eventAuto").val() == 1;
		    	}
    		},

    		
    		'data[Event][activite]': {
		     	required: function(element) {
		        	return $("#multisport0").is(":checked") && $('#eventAuto').val() == 1;
		    	}
    		},

    		'data[Event][year][year]': {
		     	required: function(element) {
		        	return $('#eventAuto').val() == 1;
		    	}
    		},

    		'data[Event][ville]': {
		     	required: function(element) {
		        	return $('#eventAuto').val() == 1 && $('#niveau').val() != 6 && $('#pays').val() == 75 && $('#specialSportCo').val() == 0;
		    	}
    		},

    		'data[Event][debut]': {required:true},
			'data[Event][fin]': {required:true},

			'data[Event][departement_id]': {
		     	required: function(element) {
		        	return $('#niveau').val() != 6 && $('#pays').val() == 75 && $('#specialSportCo').val() == 0;
		    	}
    		},

    		
    		

    		'data[Event][StructureName]': {
		     	required: function(element) {
		        	return $('#reference1').is(":checked") && $('#StructureName').val() == '';
		    	}
    		},


    	

    		'data[Event][structure_hors_ffh]': {
		     	required: function(element) {
		        	return $('#reference0').is(":checked") && $('#structure_hors_ffh').val() == '';
		    	}
    		}

    		
  		},
  		submitHandler: function(form) {

  				if($("#StructureId").val() == ''){ 
  					$('#StructureName').addClass('error');
  					alert ('Votre saisie n‘est pas valide. Vous devez sélectionner un structure organisatrice FFH dans la liste !'); return false;
  				}

  				if($("#nameAuto").val() == '' & $("#year").val() != ''){ 
  					$('#EventNameAuto').addClass('error');
  					alert ('Vous devez générer le libellé de votre événement !'); return false;
  				}

	  			$("#confirmForm").modal();
	  			$("#BtnConfirmForm").click(function(){		
					form.submit();					
				});
			
		}
	});

// Ajout année au libellé
	




	
});