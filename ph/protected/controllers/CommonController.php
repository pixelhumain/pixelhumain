<?php
/**
 * CommonController.php
 *
 * Librairies et Methodes Transversales 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 29/01/14
 */
class CommonController extends Controller {
    
    /**
     * Builds the corresponding content of a popin form 
     * according to a micrformat key value 
     * many ways to go from here : 
     * - the Key is descibed in the microformat collection 
     * 		all details are in the db entry
     * - generic 
     * */
    public function actionGetMicroformat() {
        if(isset($_POST["key"])){
            $_POST["microformat"] = PHDB::findOne(PHType::TYPE_MICROFORMATS, array( "key"=>$_POST["key"] ));
            $html = "";
            $title = "Formulaire";
            if($_POST["microformat"]){
                //clef trouvé dans microformats
                if(isset($_POST["microformat"]["jsonSchema"]["title"]))
                    $title = $_POST["microformat"]["jsonSchema"]["title"];
                if($_POST["microformat"]["template"] == "dynamicallyBuild")
                    $_POST["microformat"] = $_POST["microformat"];
                $html .= $this->renderPartial($_POST["microformat"]["template"],$_POST,true);
            } else {
                //clef pas trouvé dans microformats
                $html .= $this->renderPartial($_POST["template"],$_POST,true);
            }
            echo json_encode( array("result"=>true,"title"=>$title,"content"=>$html));
        } else 
            echo json_encode( array("result"=>false,"title"=>$title,"content"=>"Votre ne peut aboutir"));
	}
    public function actionGetMicroformatHTML() {
        if(isset($_POST["microformat"]["jsonSchema"])){
            $html = "";
            if(isset($_POST["microformat"]["jsonSchema"]["title"]))
                $title = $_POST["microformat"]["jsonSchema"]["title"];
            $html .= $this->renderPartial("dynamicallyBuild",$_POST,true);
            
            echo json_encode( array("result"=>true,"title"=>$title,"content"=>$html) );
        } else 
            echo json_encode( array("result"=>false,"title"=>$_POST["microformat"]["jsonSchema"]["title"],"content"=>"Votre requete ne peut aboutir") );
    }
    /**
     * Saves part of an entry genericlly based on 
     * - collection and id value
     */
	public function actionSave() 
    {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
    	    //var_dump($_POST);
            $id = null;
    	    $data = null;
    	    $collection = $_POST["collection"];
    	    if( !empty($_POST["id"]) ){
    	        $id = $_POST["id"];
    	    }
    	    $key = $_POST["key"];

    	    unset($_POST['id']);
            if( $_POST['collection'] == PHType::TYPE_MICROFORMATS){
                $_POST['collection'] = $_POST['MFcollection'];
                unset( $_POST['MFcollection'] );
            }else {
                unset($_POST['collection']);
                unset($_POST['key']);
            }
            
            //empty fields aren't properly validated and must be removed
            /*foreach ($_POST as $k => $v) {
                echo $k." => ".$v."\n";
                if(empty($v))
                    unset($_POST[$k]);
            }*/
            $_POST["microformat"] = PHDB::findOne(PHType::TYPE_MICROFORMATS, array( "key"=> $key));
            $validate = ( !isset($_POST["microformat"] )  || !isset($_POST["microformat"]["jsonSchema"])) ? false : true;
            //validation process based on microformat defeinition of the form
            //by default dont perform validation test
            $valid = array("result"=>true);
            if($validate)
                $valid = PHDB::validate( $key, json_decode (json_encode ($_POST), FALSE) );
            
            if( $valid["result"] )
            {
                if($id)
                {
                    //update a single field
                    //else update whole map
                    $changeMap = ( !$_POST["microformat"] && isset( $key )) ? array('$set' => array( $key => $_POST[ $key ] ) ) : array('$set' => $_POST );
                    PHDB::update($collection,array("_id"=>new MongoId($id)), $changeMap);
                    $res = array("result"=>true,
                                 "msg"=>"Vos données ont été mise à jour.",
                                 "reload"=>true,
                                 "map"=>$_POST);
                } 
                else 
                {
                    PHDB::insert($collection, $_POST );
                    $res = array("result"=>true,
                                 "msg"=>"Vos données ont bien été enregistré.",
                                 "reload"=>true,
                                 "map"=>$_POST);
                }
            } else 
                $res = $valid;
            echo json_encode( $res );  
		}
	}
}