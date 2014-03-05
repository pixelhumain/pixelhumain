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
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
    	    $id = null;
    	    $data = null;
    	    $collection = $_POST["collection"];
    	    if( !empty($_POST["id"]) ){
    	        $id = $_POST["id"];
    	        $data = Yii::app()->mongodb->selectCollection($collection)->findOne(array("_id"=>new MongoId($id)));
    	    }
    	    $key = $_POST["key"];
    	    unset($_POST['id']);
            unset($_POST['collection']);
            unset($_POST['key']);
            
            $microformat = Yii::app()->mongodb->microformats->findOne( array( "key"=> $key));
            
            //TODO add validation process based on microformat defeinition of the form
            $res = array("result"=>false,"content"=>"Votre ne peut aboutir");
            if($data){
                if( !$microformat && isset( $key )) {
                    Yii::app()->mongodb->selectCollection($collection)->update(array("_id"=>new MongoId($id)), 
                                                                                        array('$set' => array( $key => $_POST[ $key ] ) ));
                } else {
                    Yii::app()->mongodb->selectCollection($collection)->update(array("_id"=>new MongoId($id)), 
                                                                               array('$set' => $_POST ));
                }
                                                                                    
                $res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
            } else {
                //TODO : test d'existance
                foreach($_POST as $k=>$v){
                    $pattern = '/^[0-9a-fA-F]{24}$/';
                    if( preg_match($pattern, $v) )
                        $_POST[$k] = new MongoId($v);
                }
                
                Yii::app()->mongodb->selectCollection($collection)->insert( $_POST );
                $res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
            }
            
            echo json_encode( $res );  
		}
	}
	
	
}