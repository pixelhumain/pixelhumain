<?php
class ExtractProcessAction extends CAction{
	    public $options = array();
	public function run()
    {
	if(isset($_POST["url"]))
	{
		$get_url = $_POST["url"]; 
			
			//Include PHP HTML DOM parser (requires PHP 5 +)
			include_once("include/simple_html_dom.inc.php");
			
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
	        $has_meta_description = $get_content->find('meta[name=description]');
	
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
	                }
	            }
	        }else { //Get Body Text
	
	            foreach($get_content->find('body') as $element) 
	            {
	                $page_body = trim($element->plaintext);
	                //echo $page_body;
	                $strlength = strlen($element->content);	            
	                if($strlength > 200){
	                    $pos=strpos($page_body, ' ', 200); //Find the numeric position to substract
	                    $page_body = substr($page_body,0,$pos ); //shorten text to 200 chars
	                }else {
	                    $page_body = trim($element->plaintext);
	                    $pos = strpos($page_body, ' ', 200);
	                    $page_body = substr($page_body,0,$pos ); //shorten text to 200 chars
	                }
	            }
	        }
        	$video="";
			foreach($get_content->find('iframe') as $element) 
			{
				//$video = $element->src;
				//echo "oui";
				//echo $element->src;
//				$page_body = trim($element->plaintext);
//				$pos=strpos($page_body, ' ', 200); //Find the numeric position to substract
//				$page_body = substr($page_body,0,$pos ); //shorten text to 200 chars
			}		
			$image_urls = array();
			
			//get all images URLs in the content
			foreach($get_content->find('img') as $element) 
			{
					/* check image URL is valid and name isn't blank.gif/blank.png etc..
					you can also use other methods to check if image really exist */
					//echo $element->currentsrc;

					if(!preg_match('/blank.(.*)/i', $element->src) && (filter_var($element->src, FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)) || substr($element->src,0,2)=="//")
					{
						$image_urls[] =  $element->src;
					}
					else {
						$image_urls[] =  $get_url."".$element->src;
					}
			}
			
			//prepare for JSON 
			$output = array('title'=>$page_title, 'images'=>$image_urls, 'content'=> $page_body, 'video' => $video);
			echo json_encode($output); //output JSON data
	}
	}
}
?>