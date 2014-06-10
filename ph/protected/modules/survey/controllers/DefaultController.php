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
    //login social setting 
    public $hasSocial = false;

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
    $where = array("type"=>SurveyType::TYPE_SURVEY);

    //check if information is Postal Code restricted 
    if(isset($_GET["cp"]))
      $where["cp"] = $_GET["cp"];
    $list = PHDB::find(PHType::TYPE_SURVEYS, $where );
    $user = ( isset( Yii::app()->session["userId"])) ? PHDB::findOne (PHType::TYPE_CITOYEN, array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) ) : null;
	  $this->render( "mixitup", array( "list" => $list,"title"=>$title,"where"=>$where,"user"=>$user )  );
	}
  public function actionEntries($surveyId) 
  {
    $where = array( "type"=>SurveyType::TYPE_ENTRY, "survey"=>$surveyId );

    //check if is moderated in which the proper filter will be added to the where clause
    $app = PHDB::findOne (PHType::TYPE_APPLICATIONS, array("key"=> self::$moduleKey ) );
    $isModerator = Survey::isModerator(Yii::app()->session["userId"], self::$moduleKey);

    if(!$isModerator && isset($app["moderation"]))
      $where['applications.'.self::$moduleKey.'.'.SurveyType::STATUS_CLEARED] = array('$exists'=>false);

    $list = PHDB::find(PHType::TYPE_SURVEYS, $where );
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;
    $title = "Commune ".$survey["cp"]." : ".$survey["name"];
    $user = ( isset( Yii::app()->session["userId"])) ? PHDB::findOne (PHType::TYPE_CITOYEN, array("_id"=>new MongoId ( Yii::app()->session["userId"] ) ) ) : null;


    $uniqueVoters = PHDB::count( PHType::TYPE_CITOYEN, array("applications.survey"=>array('$exists'=>true)) );
    $this->render( "mixitup", array( "list" => $list,
                                     "title"=>$title,
                                     "where"=>$where,
                                     "user"=>$user,
                                     "isModerator"=>$isModerator,
                                     "uniqueVoters"=>$uniqueVoters )  );
  }

  public function actionEntry($surveyId) 
  {
    $where = array("survey"=>$surveyId);
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;
    echo CJSON::encode( array( "title" => $survey["name"],
                               "content" => $this->renderPartial( "entry", array("survey"=>$survey), true),
                               "contentBrut" => $survey["message"] ) );
  }

  public function actionGraph($surveyId) 
  {
    $where = array("survey"=>$surveyId);
    $survey = PHDB::findOne (PHType::TYPE_SURVEYS, array("_id"=>new MongoId ( $surveyId ) ) );
    $where["survey"] = $survey;
    $voteDownCount = (isset($survey[ActionType::ACTION_VOTE_DOWN."Count"])) ? $survey[ActionType::ACTION_VOTE_DOWN."Count"] : 0;
    $voteAbstainCount = (isset($survey[ActionType::ACTION_VOTE_ABSTAIN."Count"])) ? $survey[ActionType::ACTION_VOTE_ABSTAIN."Count"] : 0;
    $voteUpCount = (isset($survey[ActionType::ACTION_VOTE_UP."Count"])) ? $survey[ActionType::ACTION_VOTE_UP."Count"] : 0;
    $totalVotes = $voteDownCount+$voteAbstainCount+$voteUpCount;
    $oneVote = 100/$totalVotes;
    $voteDownCount = $voteDownCount * $oneVote ;
    $voteAbstainCount = $voteAbstainCount * $oneVote;
    $voteUpCount = $voteUpCount * $oneVote;

    echo CJSON::encode( array( "title" => "Repartition de  votes : ".$survey["name"] ,
                               "content" => $this->renderPartial( "graph", array( "name" => $survey["name"],
                                                                                  "voteDownCount" => $voteDownCount,
                                                                                  "voteAbstainCount" => $voteAbstainCount,
                                                                                  "voteUpCount" => $voteUpCount), 
                                                                  true)));
  }
  
}