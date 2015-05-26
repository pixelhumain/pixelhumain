<?php
$module = Yii::app()->getController()->module->id;
$baseURL = Yii::app()->request->baseUrl;
$document = $this->document;
$text = $this->text;
$link = "";
$imageSize = 30;
if (isset($document) && isset($document['name']) && isset($document['folder'])) {
	$name = strtolower($document['name']);
	if(strrpos($name, ".pdf") != false)
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
					'<i class="fa fa-file-pdf-o fa-2x"></i>'.$text.'</a>';	
	else if( strrpos( $name, ".jpg" ) != false || strrpos($name, ".jpeg") != false || strrpos($name, ".gif")  != false || strrpos($name, ".png")  != false  )
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" data-lightbox="docs">'.
					'<img class="" src="'.Yii::app()->request->baseUrl."/".$module."/document/resized/25x25/upload/".$module."/".$document['folder']."/".$document['name'].'"/>'.
					$text.'</a>';	
	else
		$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
					'<i class="fa fa-file fa-2x"></i>'.$text.'</a>';
} else {
	throw new CTKException("The document is not well formated");
}
echo $link;
?>