<?php
require_once('./config/configDB.php');
include('simple_html_dom.php');

if(isset($_POST["wikipage"])){
    //recuperer la source wikipedia pour pré remplir  les champs JSon
	$url = "http://fr.wikipedia.org/w/api.php?action=parse&format=json&page=" . $_POST["wikipage"]."&redirects&prop=text&callback=?";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Pixel Humain/1.0 (http://www.pixelhumain.com/)');
	curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	/*$headers = array("Content-Type: application/x-www-form-urlencoded; charset: UTF-8");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_HEADER, 1);*/

	$result = curl_exec($ch);
	
	if (!$result) {
	  exit('cURL Error: '.curl_error($ch));
	}
	curl_close($ch);
	
	$json = json_decode(substr($result,1,-1),true);
	$htmlStr = $json['parse']['text']['*'];
	//echo $htmlStr;
	$html = str_get_html($htmlStr);
	$table = $html->find('table.infobox_v2',0);
	$output = '';
	if(isset($table))
	{
		//echo $table->find('td',0);
		//var_dump($table);
		$output = '{"name":"'.$_POST["wikipage"].'"';
		foreach($table->find('tr') as $element) {
			
			if( $element->find('th') && $element->find('td') )
			{	
				if($output != '{')$output .= ',';
				$ct=0;// 0 = clef , 1 = valeure
				foreach($element->children as $e) {
					if($ct)$output .=  ':';
					$txt = $e->plaintext;
					$txt = str_replace("&#160;"," ",$txt);
					$txt = str_replace("&nbsp;"," ",$txt);
					$txt = str_replace('″',"''",$txt);
					if(!$ct){
						//keys shouldn't have spaces
						$txt = str_replace(' ','',$txt);
						//cas particulier
						if($txt == "Maire Mandat" )
							$txt = "Maire";
					}
					$output .= '"'.(($ct) ? $txt : strtolower($txt)).'"';
					$ct++;
				}
			}
		}
		//added fields 
		$output .= ',"imgGeo": "'.$_POST['imgGeo'].'",';
		$output .= '"imgLogo": "'.$_POST['imgLogo'].'",';
		$output .= '"imgValo": "'.$_POST['imgValo'].'",';
		$output .= '"activity": "'.$_POST['activities'].'",';
		$output .= '"geoPosition": "'.$_POST['geoPosition'].'"';
		$output .= '}';
		/*header('Content-Type: application/json; charset=utf-8');
		echo $output;*/
    	try { 
    	    //ecrire en BDD l'element construit
          $ch2 = curl_init();
          $url2 = "https://api.mongolab.com/api/1/databases/".$dbconfig['db']."/collections/france?apiKey=".$dbconfig['MONGOLAB_API_KEY'];
          curl_setopt($ch2, CURLOPT_URL, $url2);
          curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch2, CURLOPT_POST, 1);
          curl_setopt($ch2, CURLOPT_POSTFIELDS, $output);
          curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'Content-Length: ' . strlen($output),
              )
          );
         
          $response = curl_exec($ch2);
          $error = curl_error($ch2);
          $response_code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
          curl_close($ch2);
         
          echo json_encode(array("result"=>true,"json"=>$output));
        } catch (Exception $e) {
          echo json_encode(array("result"=>false));
        }
	} else {
		echo "<h1>Erreur de Contenu : no infobox found.</h1>";
	}
	
    
	
} else {
	echo "<h1>Erreur de Parametre : il faut au moins, le parametre page.</h1>";
}

/*$data = json_encode(
  array(
	"name"=>$_POST["name"],
    "pays"=>" France ",
    "région"=>"La Réunion",
    "département"=>"La Réunion (sous-préfecture)",
    "arrondissement"=>"Saint-Pierre",
    "canton"=>"Saint-Louis-3",
    "intercommunalité"=>"CIVIS",
    "maire"=>"Paul-Franco Técher 2008 - 2014",
    "codepostal"=>"97413",
    "codecommune"=>"97424",
    "gentilé"=>"Cilaosiens",
    "populationmunicipale"=>"5 807 hab. (2010)",
    "densité"=>"69 hab./km2 ",
    "coordonnées"=>"21° 08' 07'' Sud 55° 28' 16'' Est / -21.1353, 55.4711 / -21.1353; 55.4711 21° 08' 07'' S 55° 28' 16'' E / -21.1353, 55.4711 / -21.1353; 55.4711 ",
    "altitude"=>"Min. 370 m – Max. 3 071 m ",
    "superficie"=>"84,40 km2 ",
    "site web"=>"Ville-cilaos.fr",
    "imgGeo"=>"",
    "imgLogo"=>"http://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Blason_ville_DomFr_Cilaos_%28R%C3%A9union%29.svg/65px-Blason_ville_DomFr_Cilaos_%28R%C3%A9union%29.svg.png",
    "imgValo"=>"img/region/974/cilaos/800px-Cilaos.JPG",
    "activity"=>"camping climbing",
    "geoPosition"=>"center"
    )
);  */  

 
