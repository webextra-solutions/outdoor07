$(function() {


	
		serveur = 'https://' + window.location.host;
		
	


	// AJOUTER UN ITEM
    $( ".dialog-addItem" ).dialog({
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
			$("#formAddItem").submit();
			$(this).dialog('close');
			},
							
			Annuler: function() {
				$( this ).dialog( "close" );
			}
		}
    });

    $('#tabs').tabs();
    

	
	$("#btnAddItem").click(function(){
		$( ".dialog-addItem" ).dialog('open');
		return false;
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

	$("#btnAddMenu").click(function(){
		$( ".dialog-addMenu" ).dialog('open');
		return false;
	});

	// BOITE DE DIALOGUE - AJOUTER UN MENU
    $( ".dialog-addMenu" ).dialog({
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
			$("#formAddMenu").submit();
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
    
    



// BOITE DE DIALOGUE - Voir type évènement
$(".typesevents").click(function(){
        $("#voirTypeEvent").modal();
        $.get(serveur+'/events/viewTypeEvent',{id : $(this).attr("rel")},function(data){
				$('#ajaxData').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Epreuve
$(".epreuves").click(function(){
        $("#voirEpreuve").modal();
        $.get(serveur+'/events/viewEpreuve',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataEpreuve').empty().append(data);
		});
		return false;
});



// BOITE DE DIALOGUE - Voir type évènement
$(".sports").click(function(){
        $("#voirSport").modal();
        $.get(serveur+'/events/viewSport',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataActivite').empty().append(data);
		});
		return false;
});


// BOITE DE DIALOGUE - Voir NEWS
$(".news").click(function(){
        $("#voirNews").modal();
        $.get(serveur+'/articles/view',{id : $(this).attr("rel")},function(data){
				$('#ajaxData').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir NEWS 2
$(".news2").click(function(){
        $("#voirNews2").modal();
        $.get(serveur+'/articles/view2',{id : $(this).attr("rel")},function(data){
				$('#ajaxData').empty().append(data);
		});
		return false;
});


// BOITE DE DIALOGUE - Voir Menus
$(".menus").click(function(){
        $("#voirMenu").modal();
        $.get(serveur+'/menus/view',{id : $(this).attr("rel")},function(data){
				$('#ajaxData').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Support
$(".supports").click(function(){
        $("#voirSupport").modal();
        $.get(serveur+'/supports/view',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataSupport').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Support
$(".datesAnnexes").click(function(){
        $("#voirDateAnnexe").modal();
        $.get(serveur+'/events/viewDateAnnexe',{id : $(this).attr("rel"), view : $("#typeView").val()},function(data){
				$('#ajaxDataDateAnnexe').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Lieu de l'événement
$(".lieuxAnnexes").click(function(){
        $("#voirLieuAnnexe").modal();
        $.get(serveur+'/events/viewLieuAnnexe',{id : $(this).attr("rel"), view : $("#typeView").val()},function(data){
				$('#ajaxDataLieuAnnexe').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir le document de l'événement
$(".eventsDocs").click(function(){
        $("#voirEventDoc").modal();
        $.get(serveur+'/events/viewEventDoc',{id : $(this).attr("rel"), view : $("#typeView").val()},function(data){
				$('#ajaxDataEventDoc').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Lieu de l'événement
$(".documents").click(function(){
        $("#voirDocument").modal();
        $.get(serveur+'/documents/view',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataDocument').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Event Sans organisateur
$(".eventsSansOrga").click(function(){
        $("#voirEventSansOrga").modal();
        $.get(serveur+'/events/viewSansOrga',{id : $(this).attr("rel")},function(data){
				$('#ajaxVoirEventSansOrga').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Fonction - Paramétrage Annuaire
$(".fonctions").click(function(){
        $("#voirFonction").modal();
        $.get(serveur+'/annuaires/viewFonction',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataFonction').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir Fonction - Paramétrage Annuaire
$(".personGroup").click(function(){
        $("#voirPersonGroup").modal();
        $.get(serveur+'/groups/viewPersonGroup',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataPersonGroup').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir FAQ
$(".faqs").click(function(){
        $("#voirFaq").modal();
        $.get(serveur+'/faqs/view',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataFaq').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir FAQ
$(".faqs2").click(function(){
        $("#voirFaq").modal();
        $.get(serveur+'/faqs/view2',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataFaq').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir FAQ
$(".voirLicAff").click(function(){
        $("#voirLicAff").modal();
        $.get(serveur+'/accueils/viewLicAff',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataLicAff').empty().append(data);
		});
		return false;
});

// BOITE DE DIALOGUE - Voir ProfilUSER
$(".profilUser").click(function(){
        $("#voirProfilUser").modal();
        $.get(serveur+'/users/viewProfilUser',{id : $(this).attr("rel")},function(data){
				$('#ajaxProfilUser').empty().append(data);
		});
		return false;
});




// BOITE DE DIALOGUE - Voir Stat
$(".eventsUne").click(function(){
        $("#voirEventUne").modal();
        $.get(serveur+'/events/viewEventUne',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataEventUne').empty().append(data);
		});
		return false;
});


// BOITE DE DIALOGUE - modifier Stat
$(".modifyStats").click(function(){
        $("#modifyStat").modal();
        $.get(serveur+'/stats/modifyStat',{id : $(this).attr("rel")},function(data){
				$('#ajaxDataModifyStat').empty().append(data);
		});
		return false;
});


});