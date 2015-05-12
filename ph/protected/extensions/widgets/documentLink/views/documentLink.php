<?php
$module = Yii::app()->getController()->module->id;
$baseURL = Yii::app()->request->baseUrl;
$document = $this->document;
$text = $this->text;
$link = "toto";
if (isset($document) && isset($document['name']) && isset($document['folder'])) {
	$name = strtolower($document['name']);
	if(strrpos($name, ".pdf") != false)
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
					'<i class="fa fa-file-pdf-o fa-3x icon-big"></i>'.$text.'</a>';	
	else if( strrpos( $name, ".jpg" ) != false || strrpos($name, ".jpeg") != false || strrpos($name, ".gif")  != false || strrpos($name, ".png")  != false  )
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" data-lightbox="docs">'.
					'<img width="50" class="" src="'.Yii::app()->request->baseUrl."/upload/".$module."/".$document['folder']."/".$document['name'].'"/>'.
					$text.'</a>';	
	else
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
					'<i class="fa fa-file fa-3x icon-big"></i>'.$text.'</a>';
} else {
	throw new CTKException("The document is not well formated");
}
echo $link;
?>