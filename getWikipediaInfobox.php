<?php
include('simple_html_dom.php');


if(isset($_GET["page"])){
	$url = "http://fr.wikipedia.org/w/api.php?action=parse&format=json&page=" . $_GET["page"]."&redirects&prop=text&callback=?";
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
		$output = '{"name":"'.$_GET["page"].'"';
		foreach($table->find('tr') as $element) {
			
			if( $element->find('th') && $element->find('td') )
			{	
				if($output != '{')$output .= ',';
				$ct=0;
				foreach($element->children as $e) {
					if($ct)$output .=  ':';
					$txt = $e->plaintext;
					$txt = str_replace("&#160;"," ",$txt);
					$txt = str_replace("&nbsp;"," ",$txt);
					$txt = str_replace('″',"''",$txt);
					if(!$ct){
						//keys shouldn't have spaces
						$txt = str_replace(' ',"",$txt);
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
		$output .= ',"imgGeo": "",';
		$output .= '"imgLogo": "",';
		$output .= '"imgValo": "",';
		$output .= '"activity": "",';
		$output .= '"geoPosition": ""';
		$output .= '}';
		header('Content-Type: application/json; charset=utf-8');
		echo $output;
	} else {
		echo "<h1>Erreur de Contenu : no infobox found.</h1>";
	}
	// TODO : 
	//Save to PHDB 
	//show form to edit and add the added field values
	//save to PHDB 
} else {
	echo "<h1>Erreur de Parametre : il faut au moins, le parametre page.</h1>";
}
?>