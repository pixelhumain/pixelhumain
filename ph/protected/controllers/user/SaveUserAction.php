<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class SaveUserAction extends CAction
{
    public function run()
    {

       $email = $_POST["email"];
        if( Yii::app()->request->isAjaxRequest )
        {
            //if exists login else create the new user

            $pwd = (isset($_POST["pwd"])) ? $_POST["pwd"] : null ;
            $res = Citoyen::register( $email, $pwd);
            $newInfos = array();
            if($user = PHDB::findOne(PHType::TYPE_CITOYEN,array( "email" => $email ) ))
            {
                $pos = array();
                //udate the new app specific fields
                if( isset($_POST["position"])){
                	$positionObj = array();
                	if(is_array($_POST["position"])){
                		for($i=0; $i<count($_POST["position"]); $i++){
	                		if($_POST["position"][$i]!= ""){
	                			array_push($positionObj, $_POST["position"][$i]);
	                		}
	                	}
                	}else{
                		$positionObj = $_POST["position"];
                	}
                	$newInfos["positions"] = $positionObj;
                }
                
                if( isset($_POST['supervisor']) )
                    $newInfos['supervisor'] = $_POST['supervisor'];
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['tel']) )
                    $newInfos['phoneNumber'] = $_POST['tel'];
                if( isset($_POST['url']) )
                    $newInfos['url'] = $_POST['url'];
                if( isset($_POST['skype']) )
                    $newInfos['skype'] = $_POST['skype'];
                if( isset($_POST['birth']) )
                    $newInfos['birth'] = $_POST['birth'];
                if( isset($_POST['name']) ){
                    $newInfos['name'] = $_POST['name'];
                    Yii::app()->session["user"] = array("name"=>$_POST['name']); 
                }
                if( isset($_POST['city']) )
                    $newInfos['city'] = $_POST['city'];
                if( isset($_POST['imagePath']) )
                    $newInfos['imagePath'] = $_POST['imagePath'];
                if(isset($_POST['cp']))
                    {
                         $newInfos["cp"] = $_POST['cp'];
                         $newInfos["address"] = array(
                           "@type"=>"PostalAddress",
                           "postalCode"=> $_POST['cp']);
                    }
                if(isset($_POST['country']))
                       $newInfos["address"]["addressLocality"]= $_POST['country'];

                if( isset($_POST['tags']))
                {
               		if($_POST['tags']!=""){
	                  $tabTags  = explode(",", $_POST['tags']);
	                  $newInfos["tags"]= $tabTags;
	     
	                  $tagsList = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));

	                  foreach( explode(",", $_POST['tags']) as $tag)
	                  {
	                    if(!in_array($tag, $tagsList['list']))
	                      PHDB::update( PHType::TYPE_LISTS,array("name"=>"tags"), array('$push' => array("list"=>$tag)));
	                  }
	                  $newInfos["tags"] = explode(",",$_POST['tags']);
	                }else{
	                	 $newInfos["tags"] = $_POST['tags'];
	                }

                }
                if( isset($_FILES['avatar'])) 
                {
                	echo "ok";
                	$pathImage = $this->processImage($_FILES['avatar'],$user["_id"]["$id"]);
                	if ($pathImage) {
                		 $newInfos["imagePath"] = $pathImage;
                	}
               }
                //specific application routines
                if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    //when registration is done for an application it must be registered
                	$newInfos['applications'] = array( $appKey => array( "usertype"=> (isset($_POST['type']) ) ? $_POST['type']:$_POST['app']  ));

                	$app = PHDB::findOne(PHType::TYPE_APPLICATIONS,array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                	if( isset( $app["registration"] ))
                        if( $app["registration"] == "mustBeConfirmed" )
                		      $newInfos['applications'][$appKey]["registrationConfirmed"] = false;
                        else if( $app["registration"] == "mailValidation" )
                        {
                            Yii::app()->session["userId"] = $user["_id"]; 
                            Yii::app()->session["userEmail"] = null;
                            
                            //send validation mail
                            //TODO : make emails as cron jobs
                            $title = $app["name"];
                            $logo = ( isset($app["logo"]) ) ? $this->module->assetsUrl.$app["logo"] : Yii::app()->getRequest()->getBaseUrl(true).'/images/logo/logo144.png';
                               
                            Mail::send(array("tpl"=>'validation',
                                             "subject" => 'Confirmer votre compte '.$title,
                                             "from"=>Yii::app()->params['adminEmail'],
                                             "to" => $email,
                                             "tplParams" => array( "user"  => $user["_id"] ,
                                                                     "title" => $title ,
                                                                     "logo"  => $logo,
                                                )));
                        }
                }
                //Social Network info
                $socialNetwork = array();
                if (isset($_POST["twitterAccount"])) $socialNetwork["twitterAccount"] = $_POST["twitterAccount"];
                if (isset($_POST["facebookAccount"])) $socialNetwork["facebookAccount"] = $_POST["facebookAccount"];
                if (isset($_POST["gplusAccount"])) $socialNetwork["gplusAccount"] = $_POST["gplusAccount"];
                if (isset($_POST["gitHubAccount"])) $socialNetwork["gitHubAccount"] = $_POST["gitHubAccount"];
                if (isset($_POST["linkedInAccount"])) $socialNetwork["linkedInAccount"] = $_POST["linkedInAccount"];
                if (isset($_POST["skypeAccount"])) $socialNetwork["skypeAccount"] = $_POST["skypeAccount"];
                $newInfos["socialNetwork"] = $socialNetwork;
                
                PHDB::update(PHType::TYPE_CITOYEN,
                            array("email" => $email), 
                            array('$set' => $newInfos ) 
                            );
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
    
	  private function processImage($image, $userID) {
	  	$image_name							= "image_".$userID;
     	$destination_folder = dirname(__FILE__).'/../../../upload/person/'.$image_name;
			$image_temp = $image['tmp_name']; //file temp
			$image_size_info    = getimagesize($image_temp);
			
			
		 if($image_size_info){
        $image_width        = $image_size_info[0]; //image width
				$image_height       = $image_size_info[1]; //image height
				$image_type         = $image_size_info['mime']; //image type
	    }else{
				die("Make sure image file is valid!");
		}
    switch($image_type){
        case 'image/png':
            $image_res =  imagecreatefrompng($image_temp);
            $image_extension ="png";
             break;
        case 'image/gif':
            $image_res =  imagecreatefromgif($image_temp);
            $image_extension ="gif";
             break;       
        case 'image/jpeg': case 'image/pjpeg':
            $image_res = imagecreatefromjpeg($image_temp);
             $image_extension ="jpg";
             break;           
        default:
            $image_res = false;
    }

    $path_file_to_save = $destination_folder.".".$image_extension;
     	$this->save_image($image_res,$path_file_to_save,$image_type );
     	$urlSaved = Yii::app()->getAssetManager()->publish($path_file_to_save);
    return $urlSaved;
  	}

##### Saves image resource to file #####
private function save_image($source, $destination, $image_type){
    switch(strtolower($image_type)){//determine mime type
        case 'image/png':
            imagepng($source, $destination); return true; //save png file
            break;
        case 'image/gif':
            imagegif($source, $destination); return true; //save gif file
            break;          
        case 'image/jpeg': case 'image/pjpeg':
            imagejpeg($source, $destination, '90'); return true; //save jpeg file
            break;
        default: return false;
    } 
  } 	
}