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

    const moduleTitle = "Module Sondage";
    public static $moduleKey = "survey";

    public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
    public $description = "Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
    
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
    $title = "Tous les sondages";
    $where = array("type"=>"survey");
    if(isset($_GET["cp"]))
      $where["cp"] = $_GET["cp"];
    $list = iterator_to_array(Yii::app()->mongodb->surveys->find ( $where ));
	  $this->render( "mixitup", array( "list" => $list,"title"=>$title )  );
	}
  public function actionEntries($surveyId) 
  {
    $where = array("type"=>"entry","survey"=>$surveyId);
    $list = iterator_to_array(Yii::app()->mongodb->surveys->find ( $where ));
    $survey = Yii::app()->mongodb->surveys->findOne ( array("_id"=>new MongoId ( $surveyId ) ) );
    $title = "Commune ".$survey["cp"]." : ".$survey["name"];
    $this->render( "mixitup", array( "list" => $list,"title"=>$title )  );
  }
  
}