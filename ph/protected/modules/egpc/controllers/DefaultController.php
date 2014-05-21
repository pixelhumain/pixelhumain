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

    const moduleTitle = "EGPC : Etat Généraux des pouvoirs citoyens";
    public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
    public $description = "Etat Généraux des pouvoirs citoyens : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
    public static $moduleKey = "egpc";

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
  
}