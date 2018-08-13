// JavaScript Document
function searchMotor(){
	
	var cptTypeStr = document.getElementById('AffiliationStructureType').value;
	var cptReg = document.getElementById('AffiliationStructureCode2').value;
	var cptDep = document.getElementById('AffiliationStructureId2').value;
	var cptPublic = document.getElementById('AffiliationPublic').value;
	var cptSport = document.getElementById('AffiliationSport').value;
	
	msgconfirm = cptReg + "Attention, en raison d\'un grand nombre de résultats attendus, cette recherche peux prendre du temps... \n\nMerci de votre compréhension. \n\nSouhaitez-vous tout de même continuer ?";
	msgalert = cptReg + "Le nombre de résultats attendus pour votre recherche est trop important ! Veuillez affiner votre recherche avec un deuxième critère. Merci";
	
	if(
		cptTypeStr == '' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic == '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
		
	else if(
		cptTypeStr == '' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic != '' &&
		cptSport == ''
		){alert(msgalert);return false;
		}
		
	else if(
		cptTypeStr == 'CLU' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic == '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
		
	//	
	else if(
		cptTypeStr == 'SEC' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic == '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
		
	else if(
		cptTypeStr == 'CLUSEC' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic == '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
		
	else if(
		cptTypeStr == 'SEC' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic != '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
	
	else if(
		cptTypeStr == 'CLU' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic != '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
		
	else if(
		cptTypeStr == 'CLUSEC' &&
		cptReg == '' &&
		cptDep == '' &&
		cptPublic != '' &&
		cptSport == ''
		){return confirm(msgconfirm);}
}