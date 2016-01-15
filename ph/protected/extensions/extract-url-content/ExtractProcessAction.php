<?php
class ExtractProcessAction extends CAction{
	public $options = array();
	public function run()
    {
		if(isset($_POST["url"]))
		{
			$get_url = $_POST["url"]; 
			$urlVideo="";	
			$imageMedia="";
			$size=array("0");
			$page_title="";
			$page_body="";
			$description=false;
			$image_urls=array();
			/*Scénario à écrire pour les images
			*Si une image à une size plus élevée que la size alors vider le tableau d'image 
			*Et mettre celle qui a la plus grande size plus mettre à jour le size
			*Si égal ajouté au tableau des images pour laisser le choix
			*/
			//Include PHP HTML DOM parser (requires PHP 5 +)
			
			/*--------------- 
			*Si le lien est une image, on retourne le lien sinon on effectue le reste
			*if (getimagesize($get_url))
			* // image valide
				* else
				* // image invalide
			*--------------*/
			include_once("include/simple_html_dom.inc.php");
			$extension = pathinfo($get_url, PATHINFO_EXTENSION);
			//echo $extension;
			if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif" ){
				$sizeNewImage = getimagesize($get_url);
				$size[0]=$sizeNewImage[0];
				$output = array('title'=>$page_title, 'images'=>$image_urls, "imageMedia"=> $get_url,'content'=> $page_body, 'video' => $urlVideo,"size" => $size);
			}
			else{
				//$homepage = file_get_contents($get_url);
				//echo $homepage;
				//get URL content
				$get_content = file_get_html($get_url); 
				//print_r($get_content);
				//Get Page Title 
				foreach($get_content->find('title') as $element) 
				{
					$page_title = $element->plaintext;
				}
				
				//Get Body Text
				// Get meta description else replace with body text
		        $has_meta_description = $get_content->find('meta');
		
		        if($has_meta_description){ // if meta description is found
		            foreach($get_content->find('meta') as $element) {
		                if($element->name == 'description'){
		                    $strlength = strlen($element->content);
		                    if($strlength > 120){
		                        $pos=strpos($element->content, ' ', 120);
		                        $page_body = substr($element->content , 0, $pos)."...";
		                    }else {
		                        $page_body = $element->content;
		                    }
		                    $description = true;
		                } else if ($element->property == 'og:description'){
			                $strlength = strlen($element->content);
		                    if($strlength > 120){
		                        $pos=strpos($element->content, ' ', 120);
		                        $page_body = substr($element->content , 0, $pos)."...";
		                    }else {
		                        $page_body = $element->content;
		                    }
		                    $description = true;
		                }
		                if($element->property == 'og:image'){
							//if(@file_get_contents($element->content)) {
							$imageMedia = $element->content;
							$size=getimagesize($imageMedia);
							//}
		                }
		                
		                if ($element->property == "og:type" ){
			               $type = $element -> content;   
		                }
		                if(@$type && $type == "video"){
			                if ($element -> property == "og:video:url"){
						        $urlVideo = $element -> content; 
					        }
				        }
		            }
		        }
		        if($description != true){ //Get Body Text
			        // A APPROFONDIR
		            foreach($get_content->find('body') as $element) 
		            {
		                $page_body = trim($element->plaintext);
		                $strlength = strlen($element->content);	            
		                if($strlength > 200){
		                    $pos=strpos($page_body, ' ', 200); //Find the numeric position to substract
		                    $page_body = substr($page_body,0,$pos); //shorten text to 200 chars
		                }else {
		                    $page_body = trim($element->plaintext);
		                    $pos = strpos($page_body, ' ', 200);
		                    $page_body = substr($page_body,0,$pos); //shorten text to 200 chars
		                }
		            }
		            foreach($get_content->find('p') as $element) 
		            {
		                //echo $element->plaintext;
		                //echo $element->content;
		                //echo $page_body;
		            }
		        }
				//get all images URLs in the content
				if (empty($imageMedia)){
					foreach($get_content->find('img') as $element) 
					{
						/* check image URL is valid and name isn't blank.gif/blank.png etc..
						you can also use other methods to check if image really exist */
						/*var xhr = new XMLHttpRequest();
						xhr.open('HEAD', 'mon-url.com');
						xhr.onreadystatechange = function() {
						 
						    if (xhr.readyState == 4) {<br>        switch(xhr.status) {
						            case 200 :
						                // Good ! File exists ! Redirection...
						            break;
						            case 404 :
						                // File not found !
						            break;
						            case 402 :
						                // Maybe you will do another thing.
						            break;
						        }
						     }
						};
						 
						xhr.send(null);
						
						**
						 * Vérifie l'existance d'une URL
						 * @paramstring$url
						 * @returnboolean
						function url_exists($url){
						if(!is_string($url) || strlen($url)==0)return false;
						try {
						$essais = get_headers($url, 1);
						if(preg_match("#[^a-z0-9]2[0-9]{2}([^a-z0-9].*)$#i",$essais[0]))return true;
						}catch(Exception $e){}
						return false;
						}*/
						
						if(!preg_match('/blank.(.*)/i', $element->src) && (filter_var($element->src, FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)) || substr($element->src,0,2)=="//")
						{
							if(@file_get_contents($element->src)) {
								$sizeNewImage = getimagesize($element->src);
								if ($sizeNewImage["mime"]== "image/png" || $sizeNewImage["mime"]== "image/jpg" || $sizeNewImage["mime"]== "image/jpeg" ){
									if($sizeNewImage[0] == $size[0]){
										$image_urls[] =  $element->src;
									}else if ($sizeNewImage[0] > $size[0]){
										$image_urls=[];
								$image_urls[] =  $element->src;
										$size[0]=$sizeNewImage[0];
									}
	
								}
							}
						}
						else {
							if(@file_get_contents($get_url."".$element->src)) {
								$sizeNewImage = getimagesize($get_url."".$element->src);
								if ($sizeNewImage["mime"]== "image/png" || $sizeNewImage["mime"]== "image/jpg" || $sizeNewImage["mime"]== "image/jpeg" ){
									if($sizeNewImage[0] == $size[0]){
										$image_urls[] =  $get_url."".$element->src;
									}else if ($sizeNewImage[0] > $size[0]){
										$image_urls=[];
										$image_urls[] =  $get_url."".$element->src;
										$size[0]=$sizeNewImage[0];
									}
	
								}
							}
						}
					}	
				}
				//prepare for JSON 
				$output = array('title'=>$page_title, 'images'=>$image_urls, "imageMedia"=> $imageMedia,'content'=> $page_body, 'video' => $urlVideo,"size" => $size);
				
			}
			echo json_encode($output); //output JSON data
		}
	}
}
?>