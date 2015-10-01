<?php
class UploadAction extends CAction {
	

	public function run($dir,$folder=null,$ownerId=null,$input,$rename=false) {
		$upload_dir = Yii::app()->params['uploadUrl'];
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir,0775 );
        
        //ex: upload/communecter
        $upload_dir = Yii::app()->params['uploadUrl'].$dir.'/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir,0775 );

        //ex: upload/communecter/person
        if( isset( $folder )){
            $upload_dir .= $folder.'/';
            if( !file_exists ( $upload_dir ) )
                mkdir ( $upload_dir,0775 );
        }

        //ex: upload/communecter/person/userId
        if( isset( $ownerId ))
        {
            $upload_dir .= $ownerId.'/';
            if( !file_exists ( $upload_dir ) )
                mkdir ( $upload_dir,0775 );
        }
        
        $allowed_ext = array('jpg','jpeg','png','gif',"pdf","xls","xlsx","doc","docx","ppt","pptx","odt");
        
        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post')
        {
    	    echo json_encode(array('result'=>false,'error'=>Yii::t("document","Error! Wrong HTTP method!")));
	        exit;
        }

        if(array_key_exists($input,$_FILES) && $_FILES[$input]['error'] == 0 )
        {
        	
        	$pic = $_FILES[$input];
        	$ext = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
        	if(!in_array($ext,$allowed_ext))
            {
        		echo json_encode(array('result'=>false,'error'=>Yii::t("document","Only").implode(',',$allowed_ext).Yii::t("document","files are allowed!")));
    	        exit;
        	}	
        
        	// Move the uploaded file from the temporary 
        	// directory to the uploads folder:
        	//we use a unique Id for the iamge name Yii::app()->session["userId"].'.'.$ext
            //renaming file
            $cleanfileName = Document::clean(pathinfo($pic['name'], PATHINFO_FILENAME)).".".pathinfo($pic['name'], PATHINFO_EXTENSION);
        	$name = ($rename) ? Yii::app()->session["userId"].'.'.$ext : $cleanfileName;
            if( file_exists ( $upload_dir.$name ) )
                $name = time()."_".$name;
        	if( isset(Yii::app()->session["userId"]) && $name && 
                move_uploaded_file($pic['tmp_name'], $upload_dir.$name))
            {   
        		echo json_encode(array('result'=>true,
                                        "success"=>true,
                                        'name'=>$name,
                                        'dir'=> $upload_dir,
                                        'size'=> Document::getHumanFileSize ( filesize ( $upload_dir.$name ) ) ));
    	        exit;
        	}
        }
        echo json_encode(array('result'=>false,'error'=>Yii::t("document","Something went wrong with your upload!")));
    	exit;
	}

}