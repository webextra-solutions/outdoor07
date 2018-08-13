<? 
	App::import('Vendor','PHPExcel');

	
		$this->PhpExcel->createWorksheet();
		$this->PhpExcel->setDefaultFont('Calibri', 12);
		$this->PhpExcel->setSheetName('Tous');
		$this->PhpExcel->addTableFooter();

		// CREATION FEUILLE 0 - TOUS
			

			$table_child = array(
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),
				array('label' => __('Nom/Prénom'), 'filter' => true),
				array('label' => __('Groupe'), 'filter' => true),
				array('label' => __('commentaires'), 'filter' => true)			
			);


			$table_cadres = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);

			$table_accomp = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);




			$this->PhpExcel->addTableRow(array('Exports Séance n°'.$seance['Seance']['num'].' -  '.$seance['Seance']['date']),5,array('size' => 22, 'bold' => true));							
			$this->PhpExcel->addTableRow(array('Tous les groupes • '.count($pratiquants_all).' enfants'),5,array('size' => 22, 'bold' => true));
			$this->PhpExcel->addTableRow(array('Généré le '.date('d/m/Y à H:i')),5);
			$this->PhpExcel->addTableRow(array(''),5);

			$this->PhpExcel->addTableRow(array(''),5);
			$this->PhpExcel->addTableRow(array('ENCADRANTS'),5,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_cadres, array('name' => 'Cambria', 'bold' => true));

			foreach ($encadrants_all as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(	
			    		$presence_proj,
			    		$presence_eff,		    		
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),5);
			$this->PhpExcel->addTableRow(array('ACCOMPAGNATEURS'),5,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_accomp, array('name' => 'Cambria', 'bold' => true));

			foreach ($accomps_all as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,			    		
			    		$row['Personne']['civilite'],
			    		$this->Listes->statutAccomp($row['PersonnesSeance']['statut_accompagnateur']).' - '.$row['PersonnesSeance']['PNF'],						    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),5);
			$this->PhpExcel->addTableRow(array('ENFANTS'),5,array('size' => 18, 'bold' => true));		
			$this->PhpExcel->addTableHeader($table_child, array('name' => 'Cambria', 'bold' => true));

			foreach ($pratiquants_all as $row) {				
				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}
			
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],	
			    		$row['PersonnesSeance']['groupe'],					    		
		    			$row['PersonnesSeance']['commentaires_parents']				    		
			    	),1,array('border' => PHPExcel_Style_Border::BORDER_MEDIUM)
			    );
				
			}
			$this->PhpExcel->addTableFooter();

		// CREATION FEUILLE 1 - GROUPE1
			$this->PhpExcel->addSheet('GROUPE 1');

			$table_child = array(
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),
				array('label' => __('Nom/Prénom'), 'filter' => true),
				array('label' => __('commentaires'), 'filter' => true),			
			);


			$table_cadres = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);

			$table_accomp = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);




			$this->PhpExcel->addTableRow(array('Exports Séance n°'.$seance['Seance']['num'].' -  '.$seance['Seance']['date']),4,array('size' => 22, 'bold' => true));							
			$this->PhpExcel->addTableRow(array('Groupe 1 • '.count($pratiquants_gp1).' enfants'),4,array('size' => 22, 'bold' => true));
			$this->PhpExcel->addTableRow(array('Généré le '.date('d/m/Y à H:i')),4);
			$this->PhpExcel->addTableRow(array(''),4);

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENCADRANTS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_cadres, array('name' => 'Cambria', 'bold' => true));

			foreach ($encadrants_gp1 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(	
			    		$presence_proj,
			    		$presence_eff,		    		
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ACCOMPAGNATEURS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_accomp, array('name' => 'Cambria', 'bold' => true));

			foreach ($accomps_gp1 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,			    		
			    		$row['Personne']['civilite'],
			    		$this->Listes->statutAccomp($row['PersonnesSeance']['statut_accompagnateur']).' - '.$row['PersonnesSeance']['PNF'],						    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENFANTS'),4,array('size' => 18, 'bold' => true));		
			$this->PhpExcel->addTableHeader($table_child, array('name' => 'Cambria', 'bold' => true));

			foreach ($pratiquants_gp1 as $row) {				
				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}
			
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
		    			$row['PersonnesSeance']['commentaires_parents']				    		
			    	)
			    );
				
			}
			$this->PhpExcel->addTableFooter();
	
		// CREATION FEUILLE 2 - GROUPE2
			$this->PhpExcel->addSheet('GROUPE 2');

			$table_child = array(
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),
				array('label' => __('Nom/Prénom'), 'filter' => true),
				array('label' => __('commentaires'), 'filter' => true),			
			);


			$table_cadres = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);

			$table_accomp = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);
				

			$this->PhpExcel->addTableRow(array('Exports Séance n°'.$seance['Seance']['num'].' -  '.$seance['Seance']['date']),4,array('size' => 22, 'bold' => true));							
			$this->PhpExcel->addTableRow(array('Groupe 2 • '.count($pratiquants_gp2).' enfants'),4,array('size' => 22, 'bold' => true));
			$this->PhpExcel->addTableRow(array('Généré le '.date('d/m/Y à H:i')),4);
			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array(''),4);

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENCADRANTS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_cadres, array('name' => 'Cambria', 'bold' => true));

			foreach ($encadrants_gp2 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(	
			    		$presence_proj,
			    		$presence_eff,		    		
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
		    			$row['PersonnesSeance']['commentaires_parents']				    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ACCOMPAGNATEURS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_accomp, array('name' => 'Cambria', 'bold' => true));

			foreach ($accomps_gp2 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,			    		
			    		$row['Personne']['civilite'],
			    		$this->Listes->statutAccomp($row['PersonnesSeance']['statut_accompagnateur']).' - '.$row['PersonnesSeance']['PNF'],					    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENFANTS'),4,array('size' => 18, 'bold' => true));		
			$this->PhpExcel->addTableHeader($table_child, array('name' => 'Cambria', 'bold' => true));

			foreach ($pratiquants_gp2 as $row) {				
				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}
			
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
		    			$row['PersonnesSeance']['commentaires_parents']				    		
			    	)
			    );
				
			}
			$this->PhpExcel->addTableFooter();

		// CREATION FEUILLE 3 - GROUPE3
			$this->PhpExcel->addSheet('GROUPE 3');

			$table_child = array(
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),
				array('label' => __('Nom/Prénom'), 'filter' => true),
				array('label' => __('commentaires'), 'filter' => true),			
			);


			$table_cadres = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);

			$table_accomp = array(	
				array('label' => __('Présence projetée'), 'filter' => true),
				array('label' => __('Présence effective'), 'filter' => true),
				array('label' => __('Civilite'), 'filter' => true),			
				array('label' => __('Nom/Prénom'), 'filter' => true),
			);


			$this->PhpExcel->addTableRow(array('Exports Séance n°'.$seance['Seance']['num'].' -  '.$seance['Seance']['date']),4,array('size' => 22, 'bold' => true));							
			$this->PhpExcel->addTableRow(array('Groupe 3 • '.count($pratiquants_gp3).' enfants'),4,array('size' => 22, 'bold' => true));
			$this->PhpExcel->addTableRow(array('Généré le '.date('d/m/Y à H:i')),4);
			$this->PhpExcel->addTableRow(array(''),4);
			

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENCADRANTS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_cadres, array('name' => 'Cambria', 'bold' => true));

			foreach ($encadrants_gp3 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(	
			    		$presence_proj,
			    		$presence_eff,		    		
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ACCOMPAGNATEURS'),4,array('size' => 18, 'bold' => true));	
			$this->PhpExcel->addTableHeader($table_accomp, array('name' => 'Cambria', 'bold' => true));

			foreach ($accomps_gp3 as $row) {	

				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}			
		
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,			    		
			    		$row['Personne']['civilite'],
			    		$this->Listes->statutAccomp($row['PersonnesSeance']['statut_accompagnateur']).' - '.$row['PersonnesSeance']['PNF'],					    		
			    	)
			    );
				
			}

			$this->PhpExcel->addTableRow(array(''),4);
			$this->PhpExcel->addTableRow(array('ENFANTS'),4,array('size' => 18, 'bold' => true));		
			$this->PhpExcel->addTableHeader($table_child, array('name' => 'Cambria', 'bold' => true));

			foreach ($pratiquants_gp3 as $row) {				
				if($row['PersonnesSeance']['presence'] == 1){$presence_proj = 'Oui';}
				if($row['PersonnesSeance']['presence'] == 2){$presence_proj = 'Non';}
				if($row['PersonnesSeance']['presence'] == null){$presence_proj = 'EN attente';}

				if($row['PersonnesSeance']['presence_eff'] == 1){$presence_eff = 'Oui';}
				if($row['PersonnesSeance']['presence_eff'] == 2){$presence_eff = 'Non';}
				if($row['PersonnesSeance']['presence_eff'] == null){$presence_eff = '';}
			
				$this->PhpExcel->addTableRow(
			    	array(
			    		$presence_proj,
			    		$presence_eff,
			    		$row['Personne']['civilite'],
			    		$row['PersonnesSeance']['PNF'],					    		
		    			$row['PersonnesSeance']['commentaires_parents']				    		
			    	)
			    );
				
			}
			$this->PhpExcel->addTableFooter();
	

	// EXPORT
	$this->PhpExcel->output('liste_personnes_seance_'.$seance['Seance']['num'].'.xlsx');

?>


