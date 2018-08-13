$(function() {

	$( "#EventNiveau" ).hide();
	$( "#EventTitre" ).hide();
	$( "#EventSousType" ).hide();
	$( "#EventType" ).hide();
	$( "#EventTypeComp" ).hide();
	$( "#EventName" ).hide();
	$( "#EventNameAuto" ).hide();
	$( "#EventYear" ).hide();
	$( "#EventActivite" ).hide();
	$( "#EventDates" ).hide();
	$("#infoLibAuto").hide();
	$("#EventMultisport").hide();
	$("#EventCdc").hide();

	
	
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

		$( "#EventActivite" ).hide();
		$( "#EventDates" ).hide();	
	
		$( "#infoLibAuto").hide();
		$( "#EventName").hide();
		$( "#EventNameAuto" ).hide();
		$("#EventMultisport").hide();
		$("#EventCdc").hide();

	});

	
	

	// EVENEMENT COMPETITIF : OUI/NON
	$(".compet").change(function(){

			$( "#EventNiveau" ).show();
			$( "#EventName" ).hide();
			$( "#EventNameAuto" ).hide();
			$( "#EventTypeComp" ).hide();
			$( "#EventType" ).hide();
			$( "#EventDates" ).hide();	
			$('#niveau').val('');
			$("#infoLibAuto").hide();
			$("#EventYear").hide();
			$("#EventActivite").hide();
			$("#EventMultisport").hide();
			$("#EventCdc").hide();

	});

	

	

	// NIVEAU GEOGRAPHIQUE
	$('#niveau').change(function(){

		$('#type').val('');
		var selected = $(this).val();


		if( $('#EventCompetition0').is(":checked") ){
			var comp = 0;
		} 
		if( $('#EventCompetition1').is(":checked") ){
			var comp = 1;
		}
		$( "#EventType" ).show();
		// ajax
		$.ajax({
			type: "POST",
			url: serveur + '/events/ajax_get_type_event_list',
			data: "ajax=true&id="+selected+"&comp="+comp,
			success: function(msg){
				//console.log(msg);
				$('#type option').filter(function() {
        			return +this.value != '';
   				}).remove();
				$('#type').append(msg);
				
			}
		});

		$( "#EventName" ).hide();
		$( "#EventNameAuto" ).hide();
		$( "#EventTypeComp" ).hide();
		$( "#EventDates" ).hide();	
		$("#infoLibAuto").hide();
		$("#EventYear").hide();
		$("#EventActivite").hide();
		$("#EventMultisport").hide();
		$("#EventCdc").hide();
	});


	// TYPE
	$('#type').change(function(){
		
		$("#nameAuto").val('');

		// ajax
		$.get(serveur + '/events/ajax_get_champ',
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
	
					$( "#EventYear" ).show();

					$("#EventName").hide();
					
					$( "#EventDates" ).show();
					$("#EventMultisport").show();
					$("#EventCdc").show();
					
				} else {
					$("#eventAuto").val(0);
					
					$("#infoLibAuto").hide();
					$( "#EventTypeComp" ).hide();
					
					$('#name').attr('name', 'data[Event][name]');
					$('#nameAuto').attr('name', 'data[Event][name3]');
					$("#EventName").show();
					
					
					
					$( "#EventDates" ).show();
				
					$( "#EventYear" ).hide();
				
					$("#EventMultisport").hide();
					$("#EventCdc").show();
			
				}
			
			}
			
		);

	});

	// EVENEMENT MULTISPORT
	$("#multisport1").click(function(){
		$("#EventActivite").hide();
	});

	$("#multisport0").click(function(){
		$("#EventActivite").show();
	});
		
			
	

	
	// Ajout année au libellé
	$("#year").change(function(){
		$("#nameAuto").val('');
		$("#EventNameAuto").show();
		$('#nameAuto').attr("readonly", true);
		
	});

	// Ajout année au libellé
	$("#btnLibAuto").click(function(){	
		if( $("#multisport0").is(":checked")){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#activite").val() + ' - (ville à définir) - ' + $("#year").val());	
		} 
		if( $("#multisport1").is(":checked")){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - (ville à définir) - ' + $("#year").val());	
		}
	});

	



	

	$("#EventForm").validate({
		rules: {
			'data[Event][niveau]': {required:true},
			'data[Event][name]': {required:true},
			'data[Event][types_event_id]': {required:true},
			'data[Event][periode_cible]': {required:true},
		    'data[Event][cdc_file]': {
		    	extension: "pdf"
		    },
		    'data[Event][multisport]': {
		     	required: function(element) {
		        	return $("#eventAuto").val() == 1;
		    	}
    		},
    		'data[Event][activite]': {
		     	required: function(element) {
		        	return $("#Multisport0").is(":checked") && $('#eventAuto').val() == 1;
		    	}
    		},

    		'data[Event][year][year]': {
		     	required: function(element) {
		        	return $('#eventAuto').val() == 1;
		    	}
    		}
    		
  		},
  		submitHandler: function(form) {
	  			$("#confirmForm").modal();
	  			$("#BtnConfirmForm").click(function(){		
					form.submit();					
				});
			
		}
	});
	
		

	/*$("#type").change(function(){
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
				
			
	});	*/






	

	




	
});