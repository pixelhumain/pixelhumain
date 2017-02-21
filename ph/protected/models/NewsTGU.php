<?php
/*
Contains anything generix for the site 
 */
class NewsTGU
{
	const COLLECTION = "articles";
	public static $GENRE_COLOR = array( 	
		"free_msg" 			=> "white", 
		"help" 				=> "red", 
		"idea" 				=> "yellow", 
		"question" 			=> "purple", 
		"rumor" 			=> "orange", 
		"true_information" 	=> "green" );
	
	public static $NATURES_NAMES = array(
		"free_msg" 			=> "Message libre",
		"help" 				=> "Demande d'aide",				
		"idea" 				=> "Idée",
		"question" 			=> "Question",			
		"rumor" 			=> "Rumeur",
		"true_information" 	=> "Information vérifiée" );
			
	public static $THEMES_NAMES = array(
		"1" 	=> "Quotidien",
		"2" 	=> "Logement",				
		"3" 	=> "Bricolage",
		"4" 	=> "Agriculture",
		"5" 	=> "Transport",			
		"6" 	=> "Éducation",
		"7" 	=> "Nature",
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
		"18" 	=> "Sport",			
		"19" 	=> "Argent",
		"20" 	=> "Amour"  );
	
	public static function get_GENRE_COLOR($index){
	 return self::$GENRE_COLOR[strval($index)];
	}
	public static function get_NATURES_NAMES($index){
	 return self::$NATURES_NAMES[strval($index)];
	}
	public static function get_THEMES_NAMES($index){
	 return self::$THEMES_NAMES[strval($index)];
	}
    public static function getWhere($params=array()) {
	  	return PHDB::find( self::COLLECTION,$params);
	}

	//******************************************************************************
	//** GET NEWS STREAM HTML (transforme une liste de ARTICLES en format html)
	//** $newsList == Mongo.Articles
	//******************************************************************************	
	public static function getNewsStreamHtml($newsList,$module){
		
		$html = '<div class="spine"></div><ul class="columns">'; $count=0;
		foreach($newsList as $post){
		
		//récupère les infos sur l'auteur du post / News
		$where = array('_id' => $post['author'] );
		$author = PHDB::findOne(PHType::TYPE_CITOYEN, $where);
    	$color = "white";
    		
		$color = NEWS::get_GENRE_COLOR($post['genre']);
    	
    	//$html .=  "<div class='post'>";
		$html .=  "<li>".
					'<div class="timeline_element partition-white">';
		
			$html .=  "<div class='info_author_post'>";
								
				//PHOTO PROFIL
				$html .= "<div class='pic_profil_author_post'>".
						 "<img class='img_profil_round'  src='".Yii::app()->theme->baseUrl."/assets/images/avatar-1.jpg' height=55>".
						 "</div>";
			
				//ICO TYPE ACCOUNT
				$html .= "<div class='ico_type_account_author_post'>".
						 //"<img src='application/pictures/account_type/User-M_24_B.png' height=30>".
						 "</div>";
			
				//PSEUDO AUTHOR
				if(isset($author['name']))
				$html .= "<a href='' class='pseudo_author_post'>".
							$author['name'].
						 "</a>";
	
				//CITY AUTHOR
				if(isset($author['cp']))
				$html .= "<a href class='city_author_post'>- ".
							$author['cp'].
						 "</a>";
	
			$html .= "</div>"; //info_author_post
			
	
			$html .=  "<div class='header_post ".$color."'>";
			
				//IL Y A
				$html .= 	"<div class='ilya' style='float:left; max-width:100%; min-width:100%;'>".
								"<center><i class='fa fa-clock-o'></i>".
								"</br>il y a 18 minutes<center>".
							"</div>";
		
				//ILLUSTRATION POST 
				//if(isset($post['id_illustration']))
				if($count == 0)
				$html .= 	"<div style='float:left; max-width:100%; min-width:100%;'>".
								"<center><img src='".$module."/images/news/test_illu/illu_test.jpg' class='illustration_post'/></center>".
							"</div>";
				$count++;
			$html .= "</div>";
		
			
			//GENRE
			$html .= "<div class='nature_post'>".
					 "<img src='".$module."/images/news/natures/".$post['genre'].".png' class='img_illu_publication_nature' style='margin-top:0px;' title='nature du message : ".News::get_NATURES_NAMES($post['genre'])."' id='".$post['genre']."' height=50>".
					 "</div>";
				 
			//FAVORITES
			$html .= "<a href='' class='btn_circle_post' id='btn_circle_favorites' style='margin-left:12px; color:#23D1B9'>".
					 "<i class='fa fa-star' title='garder en favoris'></i>".
					 "</a>";
	
			//ARLERT MODERATION
			$html .= "<a href='' class='btn_circle_post' id='btn_circle_moderation' style='color:#E66B6B'>".
					 "<i class='fa fa-bell' title='signaler le contenu'></i>".
					 "</a>";
					 
								 
			//LIST THEMES	
			$html .= "<div class='list_themes_post'>";
			if(isset($post['about'])){
				foreach($post['about'] as $theme){
					$html .= "<div class='theme_post'>".
								"<img src='".$module."/images/news/themes/".$theme.".png' class='img_illu_publication_theme' title='thème : ".News::get_THEMES_NAMES($theme)."' id='".$theme."' style='margin-top:0px;' height=30>".
							 "</div>";
				}
			}
			$html .= "</div>";
			
			$html .= "<div class='panel-title' style='float:left; min-width:100%;'>".
						"<h4 style='font-size:15px; margin:0px; margin-left:10px; padding:0px;'><b>".News::get_NATURES_NAMES($post['genre'])."</b></h4>".
					"</div>";
		
			
			//TITLE
			if(isset($post['name']))
			$html .= "<div class='panel-title' style='float:left; min-width:100%;'>".
						"<h3 style='font-size:18px; margin:0px; margin-left:10px; padding:0px;'>".$post['name']."</h3>".
					"</div>";
		
			//CONTENT
			if(isset($post['text']))
			$html .= "<div class='panel-body' style='float:left;  margin-bottom:10px;'><p>".$post['text']."</p></div>";
		
			//BAR TOOL
			$html .= "<div class='bar_tools_post'>".
				"<ul>	
						<li><a href=''>j'aime</a></li>
						<li><a href=''>partager</a></li>						
				</ul>".
				"<ul style='float:left;'>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-comment'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-thumbs-up'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-share-alt'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-eye'></i></span></li>".
				
				"</ul>".
				"</div>";
					
		//$html .= "</div>"; //post
		$html .= "</li>"; //post
		
		}	
		
		$html.='</ul>';
		
		return $html;
	}
    
}