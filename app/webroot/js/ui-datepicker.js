$(function() {

$('#debut .input-group.date').datepicker({
    language: "fr"	
});

$('.fin .input-group.date').datepicker({
    language: "fr"	
});

	

$("#EventDebut").change(function(){
	$('#fin .input-group.date').datepicker({
	    language: "fr",
	    startDate: $("#EventDebut").val()	
	});
});

$('#FilterDebut').datepicker({
    language: "fr"	
});

$('#FilterFin').datepicker({
    language: "fr"	
});
$("#FilterDebut").change(function(){
	$('#FilterFin').datepicker({
	    language: "fr",
	    startDate: $("#FilterDebut").val()	
	});
});

$("#FsessionDebut").change(function(){
	$('#fin .input-group.date').datepicker({
	    language: "fr",
	    startDate: $("#FsessionDebut").val()	
	});
});


$('#debut2 .input-group.date').datepicker({
    language: "fr"	
});

$("#EventDebut2").change(function(){
	$('#fin2 .input-group.date').datepicker({
	    language: "fr",
	    startDate: $("#EventDebut2").val()	
	});
});

$("#MissionDebut").change(function(){
	$('#fin .input-group.date').datepicker({
	    language: "fr",
	    startDate: $("#MissionDebut").val()	
	});
});



// NOUVEAU BLOC-DATE COMPLEMENTAIRE - EVENEMENT
$('#blocEventDebut .input-group.date').datepicker({
    language: "fr",
    startDate : $("#EventDebut").val()	
});



$("#EventsDateDebut").change(function(){
	$('#blocEventFin .input-group.date').datepicker({
	    language: "fr",
	    startDate : $("#EventDebut").val(),
	    endDate : $("#EventFin").val()	
	});
});



// BLOC DATE RENOUVELLEMENT-  FIN EN FONCTION DU DEBUT
$('.blocEventDebutRenouv .input-group.date').datepicker({
    language: "fr"
});



$(".blocEventDebutRenouv").change(function(){
	$('.blocEventFinRenouv .input-group.date').datepicker({
	    language: "fr",
	    startDate : $("#debutRenouv").val(),
	});
});





		
	$('#ddn .input-group.date').datepicker({
	    language: "fr",
	    autoclose: true,
	    startView: 2,
	    todayBtn: "linked"
	});
	
	
	$( ".ajax-btn" ).button();



	$('.now .input-group.date').datepicker({
	     language: "fr",
   		 autoclose: true,
	    todayBtn: "linked"	
	});

	$('.now2 .input-group.date').datepicker({
	    language: "fr"		
	});

	$('#now .input-group.date').datepicker({
	    language: "fr"		
	});

	function dateDiff(date1, date2){
	    var diff = {}                           // Initialisation du retour
	    var tmp = date2 - date1;
	 
	    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
	    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
	 
	    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
	    diff.min = tmp % 60;                    // Extraction du nombre de minutes
	 
	    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
	    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
	     
	    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
	    diff.day = tmp;
	     
	    return diff;
	}


	var dateDiff = dateDiff(new Date('2016-03-23'), new Date('2016-12-31'));

	$('#expiration .input-group.date').datepicker({
	    language: "fr",	
	    startDate: '+'+dateDiff+'d'
	});

	
	
});