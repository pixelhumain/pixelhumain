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


	public function actionAddBadgeOpenData(){
		$types = array(Event::COLLECTION, Organization::COLLECTION, Project::COLLECTION);
		$res = array();
		foreach ($types as $key => $type) {
			$entities = PHDB::find($type,array("preferences.isOpenData" => true), 0, array("_id"));
			foreach ($entities as $key => $entity) {
				$eeeee[] = Badge::addAndUpdateBadges("opendata", (String)$entity["_id"], $type);
			}
			$res[$type] = $eeeee;

		}

		var_dump(count($res));

		foreach ($res as $key => $val) {
			echo "</br> </br>".$key;
			foreach ($val as $key2 => $val2) {
				echo "</br> </br>";
				echo "-------------------</br>";
				var_dump($val2);
			}		
		}
	}


}