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
	    $this->render("index");
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
}