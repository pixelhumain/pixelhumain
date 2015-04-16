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
    	$directory = 'upload/communecter/'.$type.'/'.$id.'/';
    	//$directory = Yii::app()->params['uploadURL'].$type.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
		$listImages=array();
		if(file_exists ( $directory )){
	    	//get all image files with a .jpg extension. This way you can add extension parser
	    	$images = glob($directory ."*.{jpg,png,gif}", GLOB_BRACE);
	    	
	    	foreach($images as $image){
	        	array_push($listImages, Yii::app()->getRequest()->getBaseUrl(true)."/".$image);
	    	}
	    }
	   	Rest::json($listImages);
	    Yii::app()->end();
    }
}