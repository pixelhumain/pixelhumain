<?php
/**
 * get a list of images by category and user id
 * @return [json] 
 */
class getUserImagesAction extends CAction
{
    public function run($type, $id)
    {
    	$listImagesPath =array();
    	$sort = array( 'created' => -1 );
    	$type = trim($type);
    	$listImages=Document::listMyDocumentByType($id, $type, "image", $sort);
    	foreach ($listImages as $key => $value) {
    		$imagePath = "upload".DIRECTORY_SEPARATOR.Yii::app()->controller->module->id.$value["folder"].$value["name"];
    		$imagePath = Yii::app()->getRequest()->getBaseUrl(true).DIRECTORY_SEPARATOR.$imagePath;
    		$imagePath = str_replace(DIRECTORY_SEPARATOR, "/", $imagePath);
    		$listImagesPath[$key]=$imagePath;
    	}
    	
	   	Rest::json($listImagesPath);
	    Yii::app()->end();
    }
}