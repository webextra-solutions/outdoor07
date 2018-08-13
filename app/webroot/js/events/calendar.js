
	$(function() {
		$('#famille').change(function(){
			$('#type').val('');
			var selected = $(this).val();

			$.ajax({
				type: "POST",
				url: 'https://extranet.handisport.org/events/ajax_get_type_event_list3',
				data: "ajax=true&id="+selected,
				success: function(msg){
					//console.log(msg);
					$('#type option').filter(function() {
	        			return +this.value != '';
	   				}).remove();
					$('#type').append(msg);					
				},
	            error:function() {
	                alert('La liste n’a pas pus être chargée');
	            }
			});
		});

	});
