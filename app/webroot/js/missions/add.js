$(function() {

	$( "#DetailsAccomps" ).hide();

	// NIVEAU GEOGRAPHIQUE
	$('#nb_accomps').change(function(){

		if($(this).val() == ''){
			$( "#DetailsAccomps" ).hide();
		} else {

			$( "#DetailsAccomps" ).show();
		}
	});



    $("#missionForm").validate({
	    rules: {
	     
	        
	      },
	      submitHandler: function(form) {

	         
	          $("#confirmForm").modal();
	          $("#BtnConfirmForm").click(function(){    
	          form.submit();          
	        });
	      
	    }
	  });

    


	
});