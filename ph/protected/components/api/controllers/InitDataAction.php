<?php
/*
Initialising data for a module
will import all needed datasets to get a module working properly 
 */
class InitDataAction extends CAction
{
    public function run()
    {
    	$res = Admin::initModuleData( Yii::app()->controller->module->id );
    	Rest::json( $res );
    }
}