<?php
class IndexAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        //echo Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.api.';
		$controller->render("application.components.api.views.index", 
        	array( "path" => Yii::app()->params["modulePath"].Yii::app()->controller->module->id.'.views.api.') );
    }
}