<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class GetUserImagesAction extends CAction
{
    public function run($type, $id)
    {
    	$listImagesPath =array();
    	$sort = array( 'created' => -1 );
    	if($type == "person"){
    		$type = "citoyens";
    	}
    	$listImages=Document::listMyDocumentByType($id, $type, "image", $sort);
    	foreach ($listImages as $key => $value) {
    		$imagePath = "upload".DIRECTORY_SEPARATOR.$value["folder"].$value["name"];
    		$imagePath = Yii::app()->getRequest()->getBaseUrl(true).DIRECTORY_SEPARATOR.$imagePath;
    		$imagePath = str_replace(DIRECTORY_SEPARATOR, "/", $imagePath);
    		$listImagesPath[$key]=$imagePath;
    	}
    	/*$directory = 'upload/communecter/'.$type.'/'.$id.'/';
    	//$directory = Yii::app()->params['uploadURL'].$type.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
		
		if(file_exists ( $directory )){
	    	//get all image files with a .jpg extension. This way you can add extension parser
	    	$images = glob($directory ."*.{jpg,png,gif}", GLOB_BRACE);
	    	
	    	foreach($images as $image){
	        	array_push($listImages, Yii::app()->getRequest()->getBaseUrl(true)."/".$image);
	    	}
	    }*/
	   	Rest::json($listImagesPath);
	    Yii::app()->end();
    }
}