$(function() {

	$( "#EventCompet" ).hide(); 
	$( "#EventNiveau" ).hide();
	$( "#EventTitre" ).hide();
	$( "#EventSousType" ).hide();
	$( "#EventType" ).hide();
	$( "#EventTypeComp" ).hide();
	$( "#EventName" ).hide();
	$( "#EventYear" ).hide();
	$( "#EventVille" ).hide();
	$( "#EventActivite" ).hide();
	$( "#EventDates" ).hide();
	$( "#EventPays" ).hide();
	$( "#EventDep" ).show();

	$("#continue").prop('disabled', true);

	
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
	    $( "#EventCompet" ).hide();
	    $( "#EventSousType" ).hide();
	    $( "#EventNiveau" ).hide();
		$( "#EventTitre" ).hide();
		$( "#EventType" ).hide();
		$( "#EventYear" ).hide();
		$( "#EventVille" ).hide();
		$( "#EventActivite" ).hide();
		$( "#EventDates" ).hide();	
		$( "#EventPays" ).hide();	
	});

	
	// EVENEMENT SPORTIF : OUI/NON
	$(".sport").change(function(){
		if( $('#EventSport1').is(":checked") ){		
			$( "#EventCompet" ).show();
			$( "#EventName" ).hide();
			
		} else if( $('#EventSport0').is(":checked") ){
			$( "#EventName" ).show();
			$('#name').attr("type", "text");
			$('#name').val('');
			$( "#EventCompet" ).hide(); 
			$( "#EventNiveau" ).hide();
			$( "#EventTitre" ).hide();
			$( "#EventSousType" ).show();
			$( "#EventTypeComp" ).hide();
			$( "#EventYear" ).hide();
			$( "#EventVille" ).hide();
			$( "#EventActivite" ).hide();
			$( "#EventDates" ).show();	
		}	
	});

	// EVENEMENT COMPETITIF : OUI/NON
	$(".compet").change(function(){
		if( $('#EventCompetition1').is(":checked") ){	
			$( "#EventSousType" ).show();	
					
		} else if( $('#EventCompetition0').is(":checked") ){
			$( "#EventSousType" ).hide();
			$( "#EventTitre" ).hide();
			$( "#EventNiveau" ).show();
			$( "#EventName" ).show();
			$( "#EventTypeComp" ).hide();
			$( "#EventType" ).hide();
			$( "#EventDates" ).show();	
			$("#continue").prop('disabled', false);

		}	
	});

	// SOUS-TYPE 
	$(".sous_type").change(function(){

		$('#niveau, #type, #departement, #pays, #name, #year, #ville, #activite, #EventDebut, #EventFin, #type_complement, .titre').val('');

		var selected = $(this).val();
		if( selected == 1 ){	
			$( "#EventTitre" ).show();
			$( "#EventNiveau, #EventYear, #EventVille, #EventActivite, #EventDates, #EventPays, #EventType, #EventTypeComp" ).hide();

		} else {
			$( "#EventNiveau" ).show();
			$( "#EventTitre, #EventYear, #EventVille, #EventActivite, #EventDates, #EventPays, #EventType, #EventTypeComp" ).hide();
		}	
	});

	// DELIVRANCE DE TITRE : OUI/NON
	$(".titre").change(function(){		
			$( "#EventNiveau" ).show();		
	});	


	// NIVEAU GEOGRAPHIQUE
	$('#niveau').change(function(){
		$('#type').val('');
		var selected = $(this).val();

		var type = $(".sous_type").val();
		$( "#EventType" ).show();
		// ajax
		$.ajax({
			type: "POST",
			url: 'http://'+window.location.host+'/extranet-v3/events/ajax_get_type_event_list',
			data: "ajax=true&id="+selected+"&type="+type,
			success: function(msg){
				//console.log(msg);
				$('#type option').filter(function() {
        			return +this.value != '';
   				}).remove();

				$('#type').append(msg);
				
			}
		});

	});

	// DEPARTEMENT EN FONCTION DU PAYS
	$("#pays").change(function(){

		var selected = $(this).val();
		if( selected == 1 ){	
			$( "#EventDep" ).show();
		} else {
			$( "#EventDep" ).hide();
			$( "#departement").val('');
		}	
	});

	$("#type").change(function(){
			$( "#EventPays" ).show();
			//$('#pays option[value=1]').attr("selected", "selected");

			$( "#EventTypeComp" ).show();
			$('#name').attr("type", "hidden");
			$('#name').val($('#type option:selected').text());
		
			$('#continue').attr("disabled", false);
				$( "#EventYear" ).show();
				$( "#EventVille" ).show();
				$( "#EventActivite" ).show();
				$( "#EventDates" ).show();

			$("#continue").prop('disabled', false);
				
			
	});	




	

	




	
});