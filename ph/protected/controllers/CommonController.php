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
    
    /*
     * Builds the corresponding content of a popin form 
     * according to a micrformat key value 
     * many ways to go from here : 
     * - the Key is descibed in the microformat collection 
     * 		all details are in the db entry
     * - generic 
     * */
    public function actionGetMicroformat($key) {
        
        $microformat = Yii::app()->mongodb->microformats->findOne( array( "key"=>$key ));
        $html = "";
        if($microformat){
            //clef trouvé dans microformats
            $html .= $this->renderPartial($microformat["template"],array("key"=>$key),true);
        }else {
            //clef pas trouvé dans microformats
            $html .= $this->renderPartial($_POST["template"],array("key"=>$key),true);
        }
        echo json_encode( array("result"=>true,"content"=>$html));
	}
	
}