$(function() {

	// Recherche Structure
	$('.search-structure').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructure',
		select:  function(event, ui) { 
		
		if(ui.item.id >= 100){
			var lien = "club/"+ ui.item.id;
		} else { 
			var lien = "departement/"+ ui.item.id;
		}
			window.location.href = lien;
		}
	});	




	// Recherche Structure
	$('#search-structure').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructure',
		select:  function(event, ui) { 
			$('#StructureId').val(ui.item.id);
		},
		appendTo : '#newProfilUser'
	});	



	// Recherche Structure 2
	$('#search-structure2').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructure2',
		select:  function(event, ui) { 
			$('#StructureId').val(ui.item.id);
		},
		appendTo : '#newProfilUser'
	});	


	

	// Recherche Structure 3
	$('.search-structure3').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructureAll',
		select:  function(event, ui) { 
			$('#StructureId').val(ui.item.id);
		},
		appendTo : '.modalBulle'
	});

	// Recherche Structure 3
	$('.search-structure4').autocomplete({
		minLength    : 3,
		source        : serveur+'/affiliations/searchStructureAll',
		select:  function(event, ui) { 
			$('#StructureId').val(ui.item.id);
		}
	});

	
	// RECHERCHER UNE PERSONNE
	$('#search-personne').autocomplete({
		minLength    : 2,
		source        : serveur2+'/personnes/searchPersonne',
		select:  function(event, ui) { 
			window.location.href = serveur+'/personnes/view/'+ui.item.id;
		},
		appendTo : '#newSearch'
	});	

	// RECHERCHER UNE PERSONNE
	$('#search-seance').autocomplete({
		minLength    : 1,
		source        : serveur2+'/seances/searchSeance',
		select:  function(event, ui) { 
			window.location.href = serveur+'/seances/view/'+ui.item.id;
		},
		appendTo : '#newSearch'
	});

	// RECHERCHER UNE DEMANDE DE COMPTE-UTILISATEUR
	$('#search-signup').autocomplete({
		minLength    : 1,
		source        : serveur+'/signups/searchSignup',
		select: function(event, ui) { 
			window.location.href = serveur+'/signups/view/'+ui.item.id;
		}
	});		


	// RECHERCHER UN COMPTE-UTILISATEUR
	$('#search-users').autocomplete({
		minLength    : 1,
		source        : serveur+'/users/searchUser',

		select: function(event, ui) { 
			window.location.href = serveur+'/users/view/'+ui.item.id;
		}
	});

	// RECHERCHER UN COMPTE-UTILISATEUR
	$('#search-annuaire').autocomplete({
		minLength    : 1,
		source        : serveur+'/annuaires/searchAnnuaire',

		select: function(event, ui) { 
			window.location.href = serveur+'/annuaires/view/'+ui.item.id+'/general';
		}
	});

	// RECHERCHER UN GROUP DE L4ANNUIARE
	$('#search-group').autocomplete({
		minLength    : 1,
		source        : serveur+'/groups/searchGroup',

		select: function(event, ui) { 
			window.location.href = serveur+'/groups/view/'+ui.item.id;
		}
	});

	


	// RECHERCHER UN COMPTE-UTILISATEUR
	$('#search-users2').autocomplete({
		minLength    : 1,
		source        : serveur+'/users/searchUser',

		select: function(event, ui) { 
			window.location.href = serveur+'/connections/index/null/'+ui.item.id;
		}
	});


	
	// RECHERCHER UN DE MES EVENEMENT
	$('#search-my-events').autocomplete({
		minLength    : 3,
		source        : serveur+'/events/searchMyEvent',
		select: function(event, ui) { 
			window.location.href = serveur+'/events/view/'+ui.item.id;
		}
	});

	// RECHERCHER UN DE MES EVENEMENT
	$('#search-other-events').autocomplete({
		minLength    : 1,
		source        : serveur+'/events/searchOtherEvent',

		select: function(event, ui) { 
			window.location.href = serveur+'/events/viewOtherEvent/'+ui.item.id;
		}
	});



	// RECHERCHER UN EVENEMENT
	$('#search-eventsCal').autocomplete({
		minLength    : 3,
		source        : serveur+'/events/searchEventCal',

		select: function(event, ui) { 
			window.location.href = serveur+'/events/viewEventCalendar/'+ui.item.id;
		}
	});

	// Rechercher UN SPORT
	$('.search-sport').autocomplete({
		minLength    : 2,
		source        : serveur+'/sports/searchSport',
		select:  function(event, ui) { 
			$('#SportId').val(ui.item.id);
		},
		appendTo : '#newEventSport'
	});	

	// RECHERCHER UNE COMMUNE
	$('.search-commune').autocomplete({
		minLength    : 3,
		source        : serveur+'/structures/searchCommune',
		select:  function(event, ui) { 
			$('#code_postal').val(ui.item.cp);	
			$('#communeSite').val(ui.item.commune);
		},
		appendTo : '#newEventSite'
	});

	// RECHERCHER UNE COMMUNE
	$('.search-commune4').autocomplete({
		minLength    : 3,
		source        : serveur+'/structures/searchCommune2',
		select:  function(event, ui) { 
			$('#villeFR').val(ui.item.cp);
			$('#cp').val(ui.item.cp);
			$('#commune').val(ui.item.commune);
		}
	});

	// RECHERCHER UNE COMMUNE
	$('.search-commune7').autocomplete({
		minLength    : 3,
		source        : serveur+'/personnes/searchCommune',
		select:  function(event, ui) { 
			$('#cp').val(ui.item.cp);
			$('#commune').val(ui.item.commune);
		}
	});


	// RECHERCHER UNE COMMUNE
	$('.search-commune2').autocomplete({
		minLength    : 3,
		source        : serveur+'/structures/searchCommune',
		select:  function(event, ui) { 
			$('#code_postal2').val(ui.item.cp);	
			$('#commune').val(ui.item.commune);
		}
	});

	// RECHERCHER UNE COMMUNE
	$('.search-commune3').autocomplete({
		minLength    : 3,
		source        : serveur+'/structures/searchCommune',
		select:  function(event, ui) { 
			$('#code_postal2').val(ui.item.cp);	
			$('#commune2').val(ui.item.commune);
		},
		appendTo : '#newAlerte'
	});


	
	// RECHERCHER UN TYPE EVENEMENT
	$('.search-typeEvent').autocomplete({
		minLength    : 2,
		source        : serveur+'/events/searchTypeEvent',
		select:  function(event, ui) { 
			$("#voirTypeEvent").modal();
	        $.get(serveur+'/events/viewTypeEvent',{id : ui.item.id},function(data){
					$('#ajaxData').empty().append(data);
			});
			return false;
		}
	});	

	// RECHERCHER UN DOCUMENT
	$('#search-documents').autocomplete({
		minLength    : 1,
		source        : serveur+'/documents/searchDocument',

		select: function(event, ui) { 
			window.location.href = serveur+'/documents/view/'+ui.item.id;
		}
	});	

	// RECHERCHER UN DOMAINE DE COMPETENCE
	$('.search-fdomaines').autocomplete({
		minLength    : 1,
		source        : serveur+'/ues/searchDomaine',

		select: function(event, ui) { 
			$("#voirDomaine").modal();
	        $.get(serveur+'/ues/viewDomaine',{id : ui.item.id},function(data){
					$('#ajaxDataDomaine').empty().append(data);
			});
			return false;
		}
	});

	// RECHERCHER UNE OPTION
	$('.search-foptions').autocomplete({
		minLength    : 1,
		source        : serveur+'/ues/searchOption',

		select: function(event, ui) { 
			$("#voirOption").modal();
	        $.get(serveur+'/ues/viewOption',{id : ui.item.id},function(data){
					$('#ajaxDataOption').empty().append(data);
			});
			return false;
		}
	});

	// RECHERCHER UNE DISCIPLINE
	$('.search-fsports').autocomplete({
		minLength    : 1,
		source        : serveur+'/ues/searchSport',

		select: function(event, ui) { 
			$("#voirSport").modal();
	        $.get(serveur+'/ues/viewSport',{id : ui.item.id},function(data){
					$('#ajaxDataSport').empty().append(data);
			});
			return false;
		}
	});

	// RECHERCHER UNE DISCIPLINE
	$('.search-ues').autocomplete({
		minLength    : 1,
		source        : serveur+'/ues/searchModule',

		select: function(event, ui) { 
			$("#voirModule").modal();
	        $.get(serveur+'/ues/viewModule',{id : ui.item.id},function(data){
					$('#ajaxDataModule').empty().append(data);
			});
			return false;
		}
	});


      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-stagiaireForView').autocomplete({
        minLength    : 2,
        source        : serveur+'/stagiaires/searchStagiaire',
        select:  function(event, ui) { 
          window.location.href = serveur+'/stagiaires/view/'+ui.item.id+'/general';
        },
        appendTo : '#newSearch'
      });

      

      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-intervForView').autocomplete({
        minLength    : 2,
        source        : serveur+'/intervs/searchInterv',
        select:  function(event, ui) { 
          window.location.href = serveur+'/intervs/view/'+ui.item.id+'/general';
        },
        appendTo : '#newSearch'
      }); 

      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-diplomeForView').autocomplete({
        minLength    : 1,
        source        : serveur+'/diplomes/searchDiplome',
        select:  function(event, ui) { 
          window.location.href = serveur+'/diplomes/view/'+ui.item.id+'/general';
        },
        appendTo : '#newSearch'
      }); 

      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-sessionForView').autocomplete({
        minLength    : 1,
        source        : serveur+'/fsessions/searchFsession',
        select:  function(event, ui) { 
          window.location.href = serveur+'/fsessions/view/'+ui.item.id+'/stagiaires';
        },
        appendTo : '#newSearch'
      }); 


      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-annuaireForView').autocomplete({
        minLength    : 1,
        source        : serveur+'/annuaires/searchAnnuaire',
        select:  function(event, ui) { 
          window.location.href = serveur+'/annuaires/view/'+ui.item.id+'/general';
        },
        appendTo : '#newSearch'
      });

      // Rechercher un stagiaire pour accéder à sa fiche
      $('.search-groupForView').autocomplete({
        minLength    : 1,
        source        : serveur+'/groups/searchGroup',
        select:  function(event, ui) { 
          window.location.href = serveur+'/groups/view/'+ui.item.id+'/general';
        },
        appendTo : '#newSearch'
      });
 
	

		
 });