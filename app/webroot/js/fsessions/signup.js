$(function() {


$('#SaveSignupStag').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: serveur + "/fsessions/signup2",
		type: 'POST',
		data: $(this).serialize(),
		async: true,
		dataExpression: true,
		success: function(){
			$("#content2, .popup_save").fadeIn('slow');
			$("#content2, .popup_save").delay(3000).fadeOut('slow');

			
		}
	});
});

	

	

	if($("#FsessionSTAFinancement").val() == 2){
		$("#financeur").show();
	}else{
		$("#financeur").hide();}


	

	

	



	$('#FsessionSTAFinancement').change(function(){
		var selected = $(this).val();
		if(selected == 1){
			$("#financeur").hide();
			$("#financeur input").val("");
		} else {
			$("#financeur").show();
		}

	});



	

	/*$("#SignupForm").validate({
		rules: {
			

    		
  		},
  		submitHandler: function(form) {

  				

	  			$("#confirmSignupForm").modal();
	  			$("#BtnConfirmForm67").click(function(){		
					form.submit();
					//alert('test');					
				});
			
		}
	});*/


	
});