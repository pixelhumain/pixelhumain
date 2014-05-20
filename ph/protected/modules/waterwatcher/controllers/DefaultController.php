<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends Controller {

    const moduleTitle = "Water Watcher";
    public static $moduleKey = "communecter";

    public $sidebar1 = array(
        array('label' => "Pourquoi", "key"=>"why","href"=>"javascript:;","onclick"=>"hideShow('.why')"),
        array('label' => "Quoi", "key"=>"what","href"=>"javascript:;","onclick"=>"hideShow('.what')"),
        array('label' => "Comment", "key"=>"how","href"=>"javascript:;","onclick"=>"hideShow('.how')"),
        array('label' => "Qui", "key"=>"who","href"=>"javascript:;","onclick"=>"hideShow('.who')"),
        array('label' => "Quand", "key"=>"when","href"=>"javascript:;","onclick"=>"hideShow('.when')"),
    );

    protected function beforeAction($action)
  	{
  		Yii::app()->theme  = "oneScreenApp";
		return parent::beforeAction($action);
  	}

    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("index");
	}
  /*public function actionGraph()
  {
    $this->render("graph");
  }*/
}