$(function() {

	


	

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

	$( "#EventNbDays" ).hide();
	$( "#EventPrefixe" ).hide();





	

	
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
		$( "#EventNbDays" ).hide();
		$( "#EventPrefixe" ).hide();

		$(':input','#EventForm')
		  .removeAttr('checked')
		  .removeAttr('selected')
		  .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
		  .val('');

		});

	
	

	

	

	

	// NIVEAU GEOGRAPHIQUE
	$('#niveau').change(function(){

		$('#type').val('');
		var selected = $(this).val();


		
		$( "#EventType" ).show();
		// ajax
		$.ajax({
			type: "POST",
			url: serveur+'/events/ajax_get_type_event_list2',
			data: "ajax=true&id="+selected+"&comp=1",
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
		$( "#EventNbDays" ).hide();

		$('#Reference0, #Reference1').removeAttr('checked');
		$('#Multisport0, #Multisport1').removeAttr('checked');




	});


	// TYPE
	$('#type').change(function(){
		
		$("#nameAuto").val('');

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
					$("#EventOrgaName").hide();
					$("#EventOrgaHorsFFH").hide();

					$('#Reference0, #Reference1').removeAttr('checked');
					$('#Multisport0, #Multisport1').removeAttr('checked');
					$( "#EventNbDays" ).hide();
					$( "#EventPrefixe" ).hide();
				} else {
					$("#eventAuto").val(0);
					if($( "#niveau" ).val() == 6){
						$( "#EventPays" ).show();
					}
					$("#infoLibAuto").hide();
					$( "#EventTypeComp" ).hide();
					
					$('#name').attr('name', 'data[Event][name]');
					$('#nameAuto').attr('name', 'data[Event][name3]');
					$("#EventName").show();
					
					$("#EventOrga").show();
					
					$( "#EventDates" ).show();
					$( "#EventDep" ).show();
					$( "#EventYear" ).hide();
					$( "#EventVilleFR" ).hide();
					
					$("#EventMultisport").hide();
					$("#EventOrgaName").hide();
					$("#EventOrgaHorsFFH").hide();
					$("#helpBlock_multisport").hide();

					$('#Reference0, #Reference1').removeAttr('checked');
					$('#Multisport0, #Multisport1').removeAttr('checked');
					$( "#EventNbDays" ).hide();
					$( "#EventPrefixe" ).hide();
				}
			
			}
			
		);

	});

	// EVENEMENT MULTISPORT
	$("#Multisport1").click(function(){
		$("#EventActivite").hide();
		$("#helpBlock_multisport").show();
	});

	$("#Multisport0").click(function(){
		$("#EventActivite").show();
		$("#helpBlock_multisport").hide();
	});
		
			
	

	
	// Ajout année au libellé
	$("#year").change(function(){
		$("#nameAuto").val('');
		$("#EventNameAuto").show();
		$('#nameAuto').attr("readonly", true);
		
	});


	// Ajout année au libellé
	$("#btnLibAuto").click(function(){	
		if( $("#Multisport0").is(':checked')){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - ' + $("#activite").val() + ' - ' + $("#year").val());	
		} 
		if( $("#Multisport1").is(':checked') ){
			$("#nameAuto").val($('#type option:selected').text() + ' ' + $("#type_complement").val() + ' - '  + $("#year").val());	
		}
		$("#EventOrgaName").show();
		$( "#EventPrefixe" ).show();
		
		});


	$("#prefixe").click(function(){
		$( "#EventNbDays" ).show();
	});

	


	$("#nbDays").change(function (e){
		$("#InputsWrapper").empty();
		for(d=1; d<= $("#nbDays").val(); d++){
		 	prefixe = $("#prefixe").val();
			name = '<b> ' + prefixe + ' ' + d + '</b>';
			$("#InputsWrapper").append('<h5>' + name +'</h5><div class="well"><div class="form-group required"><label for="EventDebut" class="col col-md-2 control-label">DU</label><div class="col col-md-9 required"><div class="nower"><div class="input-group date input-group-sm"><input name="data[Event]['+ d +'][debut]" class="form-control" placeholder="dd/mm/aaaa" type="text" id="Event'+ d +'Debut" required="required"><span class="input-group-addon"><i class="glyphicons calendar" data-original-title="" title=""></i></span></div></div></div></div><div class="form-group required"><label for="EventDebut" class="col col-md-2 control-label">AU</label><div class="col col-md-9 required"><div class="nower"><div class="input-group date input-group-sm"><input name="data[Event]['+ d +'][fin]" class="form-control" placeholder="dd/mm/aaaa" type="text" id="Event'+ d +'Fin" required="required"><span class="input-group-addon"><i class="glyphicons calendar" data-original-title="" title=""></i></span></div></div></div></div></div></div>');
		}
	    $('.nower .input-group.date').datepicker({language: "fr"});          
	    $('#continue').show();                         
	});

	$("#MultiEventForm").validate({
		rules: {
			'data[Event][niveau]': {required:true},
			'data[Event][name]': {required:true},
			'data[Event][type]': {required:true},
		    
		    'data[Event][multisport]': {
		     	required: true
    		},

    	
    		'data[Event][activite]': {
		     	required: function(element) {
		        	return $("#Multisport0").is(":checked");
		    	}
    		},

    		'data[Event][year][year]': {
		     	required: true
    		},

    		

    		'data[Event][debut]': {required:true},
			'data[Event][fin]': {required:true},

			

    		'data[Event][StructureName]': {
		     	required: function(element) {
		        	return $('#StructureName').val() == '';
		    	}
    		},

    		'data[Event][prefixe]': {
		     	required: true
    		},

    		'data[Event][nbJournees]': {
		     	required: true
    		}


    	

    		

    		
  		},
  		submitHandler: function(form) {

  				if($("#StructureId").val() == ''){ 

  					$('#StructureName').addClass('error');

  					alert ('Votre saisie n‘est pas valide. Vous devez sélectionner un structure organisatrice FFH dans la liste !'); return false;}
	  			$("#confirmForm").modal();
	  			$("#BtnConfirmForm").click(function(){		
					form.submit();					
				});
			
		}
	});

// Ajout année au libellé
	




	
});