<?php
class ExtractProcessAction extends CAction{
	public $options = array();
	
	public function run()
    {
	    function getDomain($url){
			return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1",$url);
		}	
	    function get_string_between($string){
		    $str = explode("#",$string);
		    if(@$str[1]){
			    $str=$str[1];
			    if (strpos($str, ".") > -1){
			    	$str = explode(".",$str);
			    	$str = $str[0];
			    }
			    if(in_array($str,["search","agenda","live","annonces","home", "welcome", "ressources"]) || $str=="")
			    	return false;
			    else
			    	return (strpos($str, "@") > -1) ? substr($str,(-strlen($str)+1)) : $str;
			}else 
				return false;
		}
		if(isset($_POST["url"]))
		{
			if(strpos($_POST["url"], Yii::app()->getRequest()->getBaseUrl(true)) > -1 
				&& (strpos($_POST["url"], "#page") > -1 
				|| (get_string_between($_POST["url"]) != false && !Slug::check(get_string_between($_POST["url"]))))){
				if(strpos($_POST["url"], "#page") > -1){
					$url=explode("#page.type.",$_POST["url"]);
					$url=explode(".id.",$url[1]);
					$type=$url[0];
					$id=$url[1];
					if(strpos($id, ".") > -1){
						$id=explode($id,".");
						$id=$id[0];	
					}
				}else{
					$res=Slug::getBySlug(get_string_between($_POST["url"]));
					$type=$res["type"];
					$id=$res["id"];
				}					
				//echo $id."/".$type;
				$element=Element::getSimpleByTypeAndId($type, $id);
				$element["type"]=$type;
				$output=array("type"=>"activityStream", "object"=> $element);
			}else{
				$get_url = $_POST["url"]; 
				$urlVideo="";	
				$imageMedia="";
				$size=array("0");
				$page_title="";
				$page_body="";
				$keywords=[];
				$description=false;
				$title=false;
				$urlVideoLink=false;
				$image_urls=array();
				$sourceName = getDomain ($get_url);
				/*Scénario à écrire pour les images
				*Si une image à une size plus élevée que la size alors vider le tableau d'image 
				*Et mettre celle qui a la plus grande size plus mettre à jour le size
				*Si égal ajouté au tableau des images pour laisser le choix
				*/
				//Include PHP HTML DOM parser (requires PHP 5 +)
				
				/*--------------- 
				*Si le lien est une image, on retourne le lien sinon on effectue le reste
				*--------------*/
				include_once("include/simple_html_dom.inc.php");
				$extension = pathinfo($get_url, PATHINFO_EXTENSION);
				//echo $extension;
				if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif" ){
					$sizeNewImage = getimagesize($get_url);
					$output=array('name'=>$page_title,
								'description' => $page_body,
								'images'=>$image_urls,
								'url'=> $get_url,
								"sourceName" => $sourceName
					);
					if(@$sizeNewImage){
						if($sizeNewImage[0]>350)
							$output["content"]["imageSize"]="large";
						else 
							$output["content"]["imageSize"]="small";
					}
					if($urlVideo!="")
						$output["content"]["videoLink"]=$urlVideo;
					//if($imageMedia!=""){
						$output["content"]["image"]=$get_url;

					//$output = array('title'=>$page_title, 'images'=>$image_urls, "imageMedia"=> $get_url,'content'=> $page_body, 'video' => $urlVideo,"size" => $size);
				}
				else{
					//$homepage = file_get_contents($get_url);
					//echo $homepage;
					//get URL content
					$get_content = file_get_html($get_url); 
					//print_r($get_content);
					
					//Get Body Text
					// Get meta description else replace with body text
			        $has_meta_description = $get_content->find('meta');
			
			        if($has_meta_description){ 
				        
				        // if meta description is found
			            foreach($get_content->find('meta') as $element) {
			                if($description != true && $element->name == 'description'){
			                    $strlength = strlen($element->content);
			                    if($strlength > 200){
			                        $page_body = substr($element->content , 0, 200)."...";
			                    }else {
			                        $page_body = $element->content;
			                    }
			                    $description = true;
			                }
			                if($element->name=="keywords"){
			                	$page_tags=$element->content;
			                	$keywords=explode(",", $page_tags);
			                }
			                if ($element->property == 'og:description'){
				                $strlength = strlen($element->content);
			                    if($strlength > 200){
			                        $page_body = substr($element->content , 0, 200)."...";
			                    }else {
			                        $page_body = $element->content;
			                    }
			                    $description = true;
			                }
			                
			                if($element->property == 'og:title'){
				                $page_title=$element->content;
				                if(json_encode($element->content) == "null")
				                	$page_title = utf8_encode($page_title);
				                $title = true;
			                }
			                
			                if ($element->name == 'twitter:description'){
				                $strlength = strlen($element->content);
			                    if($strlength > 200){
			                        $page_body = substr($element->content , 0, 200)."...";
			                    } else {
			                        $page_body = $element->content;
			                    }
			                    $description = true;
			                }
			                
			                if($element->property == 'og:image'){
				                $url=str_replace(' ', '%20', $element->content);
								if(@file_get_contents($url)) {
									$imageMedia = $url;
									$size=getimagesize($imageMedia);
								}
			                }
			                
			                if ($element->property == "og:type" ){
				               $type = $element -> content;   
			                }
			                //if(!@$type || $type == "video"){
				                if ($urlVideoLink != true && $element -> property == "og:video:url"){
							        $urlVideo = $element -> content; 
							        $urlVideoLink = true;
						        }
					        //}
			            }
			        }
			        if($description != true){ //Get Body Text
				        // A APPROFONDIR
			            foreach($get_content->find('body') as $element) 
			            {
				                $page_body = trim($element->plaintext);
				                $strlength = strlen($element->content);	            
				                if($strlength > 200){
				                  //  $pos=strpos($page_body, ' ', 200); //Find the numeric position to substract
				                    $page_body = substr($page_body,0,200); //shorten text to 200 chars
				                }else {
				                   // $page_body = trim($element->plaintext);
				                    //$pos = strpos($page_body, ' ', 200);
				                    $page_body = substr($page_body,0,200)."..."; //shorten text to 200 chars
				                }
			               // }
			            }
			            foreach($get_content->find('p') as $element) 
			            {
			                //echo $element->plaintext;
			                //echo $element->content;
			                //echo $page_body;
			            }
			        }
			        //Get Page Title 
			        if ($title != true){
						foreach($get_content->find('title') as $element) 
						{
							$page_title = $element->plaintext;
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
					$output=array('name'=>$page_title,
								'description' => $page_body,
								'images'=>$image_urls,
								'url'=> $get_url,
								"sourceName" => $sourceName,
								"keywords"=>$keywords
					);
					if(@$size){
						if($size[0]>350)
							$output["content"]["imageSize"]="large";
						else 
							$output["content"]["imageSize"]="small";
					}
					if($urlVideo!="")
						$output["content"]["videoLink"]=$urlVideo;
					if($imageMedia!="")
						$output["content"]["image"]=$imageMedia;
					//$output = $json;
					
				}
			}
			echo json_encode($output); //output JSON data
		}
	}
}
?>