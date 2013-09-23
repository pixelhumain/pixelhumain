<?php
/**
 * TemplatesController.php
 *
 * Is a selection of template integrated from external sources
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 16/08/13
 */
class TemplatesController extends Controller 
{

    public function actionIndex() 
    {
       $name = "index";
       if(isset($_GET["name"])) 
           $name = $_GET["name"];
	   $this->render($name);
	}
	
    public function actionUpload() 
    {
        $upload_dir = 'upload/swe/';
        $allowed_ext = array('jpg','jpeg','png','gif');
        
        
        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    	    echo json_encode(array('error'=>'Error! Wrong HTTP method!'));
	        exit;
        }
        
        if(array_key_exists('imageFile',$_FILES) && $_FILES['imageFile']['error'] == 0 ){
        	
        	$pic = $_FILES['imageFile'];
        	$ext = pathinfo($pic['name'], PATHINFO_EXTENSION);
        	if(!in_array($ext,$allowed_ext)){
        		echo json_encode(array('error'=>'Only '.implode(',',$allowed_ext).' files are allowed!'));
    	        exit;
        	}	
        
        	// Move the uploaded file from the temporary 
        	// directory to the uploads folder:
        	
        	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
        		echo json_encode(array("success"=>true));
    	        exit;
        	}
        	
        }
        
        echo json_encode(array('error'=>'Something went wrong with your upload!'));
    	exit;
	}
}