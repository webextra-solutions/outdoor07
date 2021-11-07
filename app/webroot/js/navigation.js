$(function() {

    serveur = 'http://' + window.location.host;
    serveur2 = 'http://' + window.location.host;

	
  $('[data-toggle="popover"]').popover({
  	trigger: 'hover'
  })





	$('#partageLien').on('shown.bs.modal', function (e) {
		 $( "#share_lien" ).select();
		});

	

	 $("#myCarousel").carousel({
         interval : 7000,
         pause: false
     });
	 

	$('a').tooltip();
	$('img').tooltip();
	$('button').tooltip();
	$('i').tooltip();
	$('div').tooltip();
	$('tr').tooltip();
	

	
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});

	





	$('#0').click(function (e) { $('#tabActive').val(0);});
	$('#1').click(function (e) { $('#tabActive').val(1);});
	$('#2').click(function (e) { $('#tabActive').val(2);});
	$('#3').click(function (e) { $('#tabActive').val(3);});
	$('#4').click(function (e) { $('#tabActive').val(4);});
	$('#5').click(function (e) { $('#tabActive').val(5);});
	$('#6').click(function (e) { $('#tabActive').val(6);});
	$('#7').click(function (e) { $('#tabActive').val(7);});
	$('#9').click(function (e) { $('#tabActive').val(9);});
	$('#10').click(function (e) { $('#tabActive').val(10);});
	$('#11').click(function (e) { $('#tabActive').val(11);});
	$('#12').click(function (e) { $('#tabActive').val(12);});
	$('#13').click(function (e) { $('#tabActive').val(13);});
	$('#14').click(function (e) { $('#tabActive').val(14);});
	$('#15').click(function (e) { $('#tabActive').val(15);});
	$('#16').click(function (e) { $('#tabActive').val(16);});
	$('#17').click(function (e) { $('#tabActive').val(17);});


	$('#a0').click(function (e) { $('#tab2Active').val(0);});
	$('#a1').click(function (e) {  $('#tab2Active').val(1);});
	$('#a2').click(function (e) { $('#tab2Active').val(2);});
	$('#a3').click(function (e) { $('#tab2Active').val(3);});
	$('#a4').click(function (e) {  $('#tab2Active').val(4);});
	$('#a5').click(function (e) {  $('#tab2Active').val(5);});
	$('#a6').click(function (e) {  $('#tab2Active').val(6);});

$('#voirPlus').hide();
	$('.voirPlus').mouseover(function (e) { $('#voirPlus').show();});
	$('.voirPlus').mouseout(function (e) { $('#voirPlus').hide();});



	
	/*$( ".ddn" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1930:2000"
		});
	
	$( ".ajax-btn" ).button();

	$('#ddn .input-group.date').datepicker({
	    language: "fr",
	    endDate: "-15y",
		startView: 2
	});

	
	// BOITE DE DIALOGUE - EDITER COMPTE UTILISATEUR
    $( ".dialog-edit" ).dialog({
    	modal:true,
      autoOpen: false,
      width:700,
      show: {
        effect: "fade",
        duration: 200
      },
      hide: {
        effect: "fade",
        duration: 200
      },
      buttons: {
		   'Enregistrer': function() {
			$("#editUser").submit();
			$(this).dialog('close');
			},
							
			Annuler: function() {
				$( this ).dialog( "close" );
			}
		}
    });
    

	$( ".ajax-btn-edit" ).button();
	$(".ajax-btn-edit").click(function(){
		$( ".dialog-edit" ).dialog('open');
		$.get($(this).attr('href'),{},function(data){
				$('.dialog-edit').empty().append(data);
		});
		return false;
	});
	
	// BOITE DE DIALOGUE - VALIDER DEMANDE COMPTE UTILISATEUR
    $( ".dialog-validUser" ).dialog({
    	modal:true,
      autoOpen: false,
      width:700,
      show: {
        effect: "fade",
        duration: 200
      },
      hide: {
        effect: "fade",
        duration: 200
      },
      buttons: {
		   'Enregistrer': function() {
			$("#formValidUser").submit();
			$(this).dialog('close');
			},
							
			Annuler: function() {
				$( this ).dialog( "close" );
			}
		}
    });
    

	$( ".ajax-btn-validUser" ).button();
	$(".ajax-btn-validUser").click(function(){
		$( ".dialog-validUser" ).dialog('open');

		return false;
	});
	
	
	
	// BOITE DE DIALOGUE - AJOUTER COMPTE UTILISATEUR
   $( ".dialog-addUser" ).dialog({
    	modal:true,
      autoOpen: false,
      width:700,
      show: {
        effect: "fade",
        duration: 200
      },
      hide: {
        effect: "fade",
        duration: 200
      },
      buttons: {
		   'Enregistrer': function() {
			$("#formAddUser").submit();
			$(this).dialog('close');
			},
							
			Annuler: function() {
				$( this ).dialog( "close" );
			}
		}
    });
	
	
	
	$("#ajax-btn-addUser").click(function(){
		$( ".dialog-addUser" ).dialog('open');
		return false;		
		
	});
			

		
		// BOITE DE DIALOGUE - Mot de Passe Oublié
		   $( ".dialog-lostPwd" ).dialog({
		    	modal:true,
		      autoOpen: false,
		      width:700,
		      show: {
		        effect: "fade",
		        duration: 200
		      },
		      hide: {
		        effect: "fade",
		        duration: 200
		      },
		      buttons: {
				   'Envoyer' : function() {
					$("#formLostPwd").submit();
					$(this).dialog('close');
					},
									
					Annuler: function() {
						$( this ).dialog( "close" );
					}
				}
		    });

		   $("#ajax-btn-lostPwd").click(function(){		
				$( ".dialog-lostPwd" ).dialog('open');		
				return false;
			});

			   
			// BOITE DE DIALOGUE - CHANGER ETAT DEMANDE COMPTE UTILISATEUR
		   $( ".dialog-modifEtat" ).dialog({
		    	modal:true,
		      autoOpen: false,
		      width:700,
		      show: {
		        effect: "fade",
		        duration: 200
		      },
		      hide: {
		        effect: "fade",
		        duration: 200
		      },
		      buttons: {
				   'Enregistrer' : function() {
					$("#formModifEtat").submit();
					$(this).dialog('close');
					},
									
					Annuler: function() {
						$( this ).dialog( "close" );
					}
				}
		    });


		   
			$( ".ajax-btn-modifEtat" ).button();
			$(".ajax-btn-modifEtat").click(function(){
				$( ".dialog-modifEtat" ).dialog('open');
				$.get($(this).attr('href'),{},function(data){
						$('.dialog-modifEtat').empty().append(data);
				});
				return false;
			});
		   
			// BOITE DE DIALOGUE - Demande Compte utilisateur
		   $( ".dialog-askUser" ).dialog({
		    	modal:true,
		      autoOpen: false,
		      width:700,
		      show: {
		        effect: "fade",
		        duration: 200
		      },
		      hide: {
		        effect: "fade",
		        duration: 200
		      },
		      buttons: {
				   'Envoyer' : function() {
					$("#formAskUser").submit();
					$(this).dialog('close');
					},
									
					Annuler: function() {
						$( this ).dialog( "close" );
					}
				}
		    });

		   $("#ajax-btn-askUser").click(function(){		
				$( ".dialog-askUser" ).dialog('open');		
				return false;
			});
	
	
	
	// BOITE DE DIALOGUE - RECHERCHER COMPTE UTILISATEUR
	   $( ".dialog-searchUser" ).dialog({
	    	modal:true,
	      autoOpen: false,
	      width:700,
	      show: {
	        effect: "fade",
	        duration: 200
	      },
	      hide: {
	        effect: "fade",
	        duration: 200
	      }
	    });
		
		
		
		$("#rech-user").click(function(){
			$( ".dialog-searchUser" ).dialog('open');
			
				
		
			//$.get($(this).attr('href'),{},function(data){
			//		$('.dialog-add').empty().append(data);
			//});
			

			return false;		
			
		});
	



	// Recherche Structure
	$('.search-structure').autocomplete({
		minLength    : 1,
		source        : 'https://extranet.handisport.org/extranet-v3/affiliations/searchStructure',
		select:  function(event, ui) { 
		if(ui.item.type == 'DEP'){
			var lien = "departement/"+ ui.item.id;
		} else  if (ui.item.type == 'LIG'){ 
			var lien = "region/"+ ui.item.sCode;
		} else { 
			var lien = "club/"+ ui.item.id;
		}
			window.location.href = lien;
		}
	});	


	// Recherche Personne
	$('.search-personne').autocomplete({
		minLength    : 1,
		source        : 'personnes/searchPersonne',
		select:  function(event, ui) { 
			$('#PersonneId').val(ui.item.id);
			$('#username').val(ui.item.test);
		}
	});
	
	


	// Recherche User
	$('#search-users').autocomplete({
		minLength    : 1,
		source        : 'users/searchUser',

		select: function(event, ui) { 
			$( ".dialog-searchUser" ).dialog('close');
			$( ".dialog-edit" ).dialog('open');
			$.get('users/view/' + ui.item.id,{},function(data){
				$('.dialog-edit').empty().append(data);
		});
		return false;
		}
	});
	
	 */
	
	// BOITE DE DIALOGUE - Chargement de page
   $( "#preloader" ).dialog({
		modal:true,
	  autoOpen: false,
	  width:700,
	  show: {
		effect: "fade",
		duration: 200
	  },
	  hide: {
		effect: "fade",
		duration: 200
	  }
	});
	
	$(".preloader").change(function(){
		$( "#preloader" ).dialog('open');
		return false;		
	});

	
    
  });