<?php  
class FonctionsComponent extends Component { 
  
	function copierDossier ($dir2copy,$dir_paste,$chmod) {
      // On vérifie si $dir2copy est un dossier
        if (is_dir($dir2copy)) {
         
            // Si oui, on l'ouvre
            if ($dh = opendir($dir2copy)) {     
              // On liste les dossiers et fichiers de $dir2copy
              while (($file = readdir($dh)) !== false) {
                // Si le dossier dans lequel on veut coller n'existe pas, on le créé
                if (!is_dir($dir_paste)) mkdir ($dir_paste, $chmod);
         
                  // S'il s'agit d'un dossier, on relance la fonction rÃ©cursive
                  if(is_dir($dir2copy.$file) && $file != '..'  && $file != '.') copy_dir ( $dir2copy.$file.'/' , $dir_paste.$file.'/' );     
                    // S'il sagit d'un fichier, on le copue simplement
                    elseif($file != '..'  && $file != '.') copy ( $dir2copy.$file , $dir_paste.$file );                                       
                 }
         
              // On ferme $dir2copy
              closedir($dh);
         
            }
         
          }
        }

    


    
} 
?>