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

    const moduleTitle = "Communecter";
    public static $moduleKey = "communecter";

    public $sidebar1 = array(
        array('label' => "Acceuil", "key"=>"home","href"=>""),
        array('label' => "Quoi?", "key"=>"what","href"=>""),
        array('label' => "Comment?", "key"=>"how","href"=>""),
        array('label' => "Qui?", "key"=>"who","href"=>""),
        array('label' => "Quand?", "key"=>"when","href"=>""),
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
}