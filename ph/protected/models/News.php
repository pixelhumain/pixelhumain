<?php
/*
Contains anything generix for the site 
 */
class News
{
    
   			private static $NATURES_NAMES = array(
				"free_msg" 			=> "Message libre",
				"help" 				=> "Demande d'aide",				
				"idea" 				=> "Idée",
				"4" 				=> "Petites annonces",
				"question" 			=> "Question",			
				"6" 				=> "Débat",
				"rumor" 			=> "Rumeur",
				"true_information" 	=> "Information vérifiée" );
				
	
 			private static $THEMES_NAMES = array(
				"1" 	=> "Vie quotidienne",
				"2" 	=> "Logement",				
				"3" 	=> "Bricolage",
				"4" 	=> "Agriculture",
				"5" 	=> "Transport",			
				"6" 	=> "Éducation",
				"7" 	=> "Environnement",
				"8" 	=> "Écologie", 
				"9" 	=> "Énergie",				
				"10" 	=> "Santé",
				"11" 	=> "Art",
				"12" 	=> "Spiritualité",			
				"13" 	=> "Sciences",
				"14" 	=> "Guerre",
				"15" 	=> "Politique", 
				"16" 	=> "Histoire",
				"17" 	=> "Complot",
				"18" 	=> "Extra-terrestre",			
				"19" 	=> "Argent",
				"20" 	=> "Amour"  );
				
			public static function get_NATURES_NAMES($index){
			 return self::$NATURES_NAMES[strval($index)];
			}
			public static function get_THEMES_NAMES($index){
			 return self::$THEMES_NAMES[strval($index)];
			}
    
    
}