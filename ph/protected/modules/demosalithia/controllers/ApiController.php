<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tristan Goguet <tristan.goguet@gmail.com>
 * Date: 14/03/2014
 */
class ApiController extends Controller {

    const moduleTitle = "API DEMOSALITHIA";
    public static $moduleKey = "demosalithia";
    public $sidebar1 = array(
            
            array('label' => "Demosalithia", "key"=>"demosalithia", "iconClass"=>"fa fa-eye",
                "children"=> array(
                    array( "label" => "initMap", "href" => "javascript:;","iconClass"=>"fa fa-sitemap", )
                )),
            /*array('label' => "Views", "key"=>"views", "iconClass"=>"fa fa-eye", 'menuOnly'=>true,
                "children"=> array(
                    array( "label" => "Graph", "href" => "/ph/egpc","iconClass"=>"fa fa-sitemap", )
                )),
            */
        );
    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
        array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th",  "menuOnly"=>true,"children"=>PH::buildMenuChildren("applications") ));
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return array(
            //********************************************************************************
            //          MAP
            //********************************************************************************
            'savepositionuser'          => 'application.controllers.map.SavePositionUserAction',
            'showcitoyens'          	=> 'application.controllers.map.ShowCitoyensAction',
            'showcities'          		=> 'application.controllers.map.ShowCitiesAction',           
           
        );
    }
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("../../../../modules/api/views/index", array("path"=>'application.modules.'.$this::$moduleKey.'.views.api.') );
	}

  	/*
    public function actionLinkUser2Group() 
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['name'] ) )
        {
            $emails = explode(",",$_POST['email'] );
            $res = array(); 
            foreach ($emails as $email) {
                $res = array_merge($res, Group::addMember($email  , $_POST['name'], Group::TYPE_ASSOCIATION ));
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
    public function actionUnLinkUser2Group() 
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['name'] ) )
        {
            $emails = explode(",",$_POST['email'] );
            $res = array(); 
            foreach ($emails as $email) {
                $res = array_merge($res, Group::removeMember($email  , $_POST['name'], Group::TYPE_ASSOCIATION ));
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
	*/

}