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
            $microformat = Yii::app()->mongodb->microformats->findOne( array( "key"=>$_POST["key"] ));
            $html = "";
            if($microformat){
                //clef trouvé dans microformats
                if($microformat["template"] == "dynamicallyBuild")
                    $_POST["microformat"] = $microformat;
                $html .= $this->renderPartial($microformat["template"],$_POST,true);
            }else {
                //clef pas trouvé dans microformats
                $html .= $this->renderPartial($_POST["template"],$_POST,true);
            }
            echo json_encode( array("result"=>true,"content"=>$html));
        } else 
            echo json_encode( array("result"=>false,"content"=>"Votre ne peut aboutir"));
	}
    /**
     * Saves part of an entry genericlly based on 
     * - collection and id value
     */
	public function actionSave() {
	    $id = $_POST["id"];
	    $collection = $_POST["collection"];
	    $key = $_POST["key"];
	    unset($_POST['id']);
        unset($_POST['collection']);
        unset($_POST['key']);
        
        $microformat = Yii::app()->mongodb->microformats->findOne( array( "key"=> $key));
        
        $data = Yii::app()->mongodb->selectCollection($collection)->findOne(array("_id"=>new MongoId($id)));
        
        //TODO add validation process based on microformat defeinition of the form
        if($data){
            if( !$microformat && isset( $key )) {
                Yii::app()->mongodb->selectCollection($collection)->update(array("_id"=>new MongoId($id)), 
                                                                                    array('$set' => array( $key => $_POST[ $key ] ) ));
            } else {
                Yii::app()->mongodb->selectCollection($collection)->update(array("_id"=>new MongoId($id)), 
                                                                           array('$set' => $_POST ));
            }
                                                                                
            echo json_encode( array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true));
        }else
            echo json_encode( array("result"=>false,"content"=>"Votre ne peut aboutir"));
	}
	
}