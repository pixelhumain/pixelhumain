<?php
/**
 * TestController.php
 *
 * tous ce que propose le PH en terme d'action citoyenne
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class TestController extends Controller {

	public function actionIndex() {
	    $this->layout = "test";
	    if(Yii::app()->request->isAjaxRequest)
            echo $this->renderPartial("index",null,true);
        else
	   		$this->render("index");
	}

	public function actionTest() {
        Rest::json($_SERVER);    		
	}
	
	public function actionValidate() {
	    $this->layout = "test";
	    $e = new Event();
	    $e->validate("eventFormRDF");
	}
	

	public function actionEasyRDF(){
		$this->layout = "test";
		$foaf = new EasyRdf_Graph("http://njh.me/foaf.rdf");
		$foaf->load();
		$me = $foaf->primaryTopic();
		echo "My name is: ".$me->get('foaf:name')."\n";
	}


	public function actionCitiesdoublon(){
		$cities = PHDB::find( City::COLLECTION,array(), 0, array("insee", "name", "postalCodes"));
		$i = 0 ;
		$result = array();
		echo "nbcommune : " .count($cities). "<br/>";
		foreach ($cities as $key => $city) {
			$cp = array();
			foreach ($city["postalCodes"] as $key => $value) {
				$cp[] = $value["postalCode"];
			}
			$cp2 = $cp ;
			foreach ($cp2 as $key => $value) {
				unset($cp[$key]);




				if(in_array($value, $cp) ){
					$i++;
					$res = array();
					$res["insee"] = $city["insee"] ;
					$res["name"] = $city["name"] ;
					$res["cp"] = $value ;
					
					$k = 1 ;
					foreach ($city["postalCodes"] as $key => $c) {
						if($c["postalCode"] == $value){
							$res["name".$k] = $c["name"];
							$k++;
						}
					}
					$result[] = $res;
					
					foreach ($cp as $key => $b) {
						if($b == $value){
							unset($cp[$key]);
						}
					}
					
				}
			}
		}
		echo "Commune avec doublons : " .$i. "<br/>";

		echo "<br/>insee;name;cp_doublon";
		foreach ($result as $key => $value) {
			echo "<br/>".$value["insee"] . ";" . $value["name"] . ";" .$value["cp"]  ;
			$k = 1 ; 
			while(!empty($value["name".$k])){
				echo ";".$value["name".$k];
				$k++;
			}
		}

	}
}